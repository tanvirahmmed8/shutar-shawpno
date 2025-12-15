<?php

namespace App\Services\Finance;

use App\Models\DeliveryManTransaction;
use App\Models\Finance\FinanceTransfer;
use App\Models\Order;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnReturn;
use App\Models\Purchase\PurchaseInvoice;
use App\Models\Purchase\PurchaseOrderItem;
use App\Models\RefundRequest;
use App\Models\WalletTransaction;
use App\Models\WithdrawRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class FinancePayloadBuilder
{
    public function buildSalesPayload(Order $order): array
    {
        $details = $this->resolveOrderDetails($order);

        $grossSubtotal = $details->reduce(function (float $carry, $detail) {
            return $carry + (($detail->price ?? 0) * ($detail->qty ?? 0));
        }, 0.0);

        $productDiscount = $details->sum(fn ($detail) => (float) ($detail->discount ?? 0));
        $taxTotal = $details->sum(fn ($detail) => (float) ($detail->tax ?? 0));

        $couponDiscount = (float) ($order->discount_amount ?? 0);
        $extraDiscountValue = $this->resolveExtraDiscountAmount($order, $grossSubtotal, $productDiscount);
        $shippingDiscount = $this->resolveShippingDiscount($order);

        $shippingRevenue = max(((float) ($order->shipping_cost ?? 0)) - $shippingDiscount, 0.0);
        $netProductValue = max($grossSubtotal - $productDiscount - $couponDiscount - $extraDiscountValue, 0.0);

        $receivable = round($netProductValue + $shippingRevenue + $taxTotal, 2);

        return [
            'order_id' => $order->id,
            'order_number' => (string) ($order->id ?? ''),
            'entry_date' => $this->resolveEntryDate($order),
            'currency' => $order->currency ?? config('finance_mappings.default_currency'),
            'totals' => [
                'receivable' => $receivable,
                'subtotal' => round($grossSubtotal, 2),
                'shipping' => round($shippingRevenue, 2),
                'tax' => round($taxTotal, 2),
                'discount' => round($productDiscount + $couponDiscount + $extraDiscountValue, 2),
            ],
            'meta' => [
                'product_discount' => round($productDiscount, 2),
                'coupon_discount' => round($couponDiscount, 2),
                'extra_discount' => round($extraDiscountValue, 2),
                'shipping_discount' => round($shippingDiscount, 2),
                'order_amount_recorded' => round((float) ($order->order_amount ?? 0.0), 2),
            ],
        ];
    }

    public function buildPosPayload(Order $order): array
    {
        return $this->buildSalesPayload($order);
    }

    public function buildRefundPayload(RefundRequest $refund): array
    {
        $order = $refund->relationLoaded('order') ? $refund->order : $refund->order()->first();
        $detail = $refund->relationLoaded('orderDetails') ? $refund->orderDetails : $refund->orderDetails()->first();

        $refundAmount = round((float) ($refund->amount ?? 0), 2);
        $detailTax = (float) ($detail->tax ?? 0);
        $taxPortion = min($detailTax, $refundAmount);
        $subtotal = max($refundAmount - $taxPortion, 0.0);

        return [
            'order_id' => $refund->order_id,
            'order_number' => (string) ($order->id ?? $refund->order_id ?? ''),
            'refund_id' => $refund->id,
            'entry_date' => $this->resolveEntryDate($order),
            'totals' => [
                'refund_total' => $refundAmount,
                'subtotal' => round($subtotal, 2),
                'tax' => round($taxPortion, 2),
                'fees' => 0.0,
            ],
        ];
    }

    public function buildGrnPayload(PurchaseGrn $grn): array
    {
        $grn->loadMissing(['order', 'items.orderItem']);
        [$grossSubtotal, $taxTotal, $discountTotal] = $this->summarizeGrnItems($grn);

        $netSubtotal = max($grossSubtotal - $discountTotal, 0.0);
        $payable = max($netSubtotal + $taxTotal, 0.0);
        $entryDate = $this->resolveDateString($grn->approved_at?->toDateString() ?? $grn->received_at?->toDateString());

        return [
            'grn_id' => $grn->id,
            'order_id' => $grn->order_id,
            'grn_code' => $grn->code,
            'entry_date' => $entryDate,
            'currency' => $grn->order?->currency ?? config('finance_mappings.default_currency'),
            'totals' => [
                'subtotal' => round($netSubtotal, 2),
                'tax' => round($taxTotal, 2),
                'payable' => round($payable, 2),
            ],
            'meta' => [
                'gross_subtotal' => round($grossSubtotal, 2),
                'discount' => round($discountTotal, 2),
                'received_percent' => $grn->order?->received_percent ?? 0,
            ],
        ];
    }

    public function buildPurchaseInvoicePayload(PurchaseInvoice $invoice): array
    {
        $invoice->loadMissing(['order', 'items']);

        $entryDate = $this->resolveDateString($invoice->approved_at?->toDateString() ?? $invoice->invoice_date?->toDateString());
        $subtotal = (float) $invoice->subtotal;
        $tax = (float) $invoice->tax_total;
        $discount = (float) $invoice->discount_total;
        $grandTotal = max($invoice->grand_total, 0);

        return [
            'invoice_id' => $invoice->id,
            'invoice_number' => $invoice->invoice_number,
            'order_id' => $invoice->order_id,
            'grn_id' => $invoice->grn_id,
            'entry_date' => $entryDate,
            'currency' => $invoice->currency ?? $invoice->order?->currency ?? config('finance_mappings.default_currency'),
            'totals' => [
                'subtotal' => round(max($subtotal - $discount, 0.0), 2),
                'tax' => round($tax, 2),
                'payable' => round($grandTotal, 2),
            ],
            'meta' => [
                'freight' => round((float) $invoice->freight_total, 2),
                'discount' => round($discount, 2),
                'match_status' => $invoice->match_status,
            ],
        ];
    }

    public function buildPurchaseReturnPayload(PurchaseGrnReturn $return): array
    {
        $return->loadMissing(['items.grnItem.orderItem', 'order']);
        [$grossSubtotal, $taxTotal, $discountTotal] = $this->summarizeReturnItems($return);

        $netSubtotal = max($grossSubtotal - $discountTotal, 0.0);
        $payable = max($netSubtotal + $taxTotal, 0.0);
        $entryDate = $this->resolveDateString($return->closed_at?->toDateString());

        return [
            'return_id' => $return->id,
            'order_id' => $return->order_id,
            'grn_id' => $return->grn_id,
            'entry_date' => $entryDate,
            'currency' => $return->order?->currency ?? config('finance_mappings.default_currency'),
            'totals' => [
                'subtotal' => round($netSubtotal, 2),
                'tax' => round($taxTotal, 2),
                'payable' => round($payable, 2),
            ],
            'meta' => [
                'discount' => round($discountTotal, 2),
                'status' => $return->status,
            ],
        ];
    }

    public function buildWalletTopUpPayload(WalletTransaction $transaction): array
    {
        $payload = $this->baseWalletPayload($transaction);
        $amount = round((float) $transaction->credit, 2);

        $payload['totals']['received'] = $amount;
        $payload['totals']['amount'] = $amount;

        return $payload;
    }

    public function buildWalletWithdrawalPayload(WalletTransaction $transaction): array
    {
        $payload = $this->baseWalletPayload($transaction);
        $amount = round((float) $transaction->debit, 2);

        $payload['totals']['spent'] = $amount;

        return $payload;
    }

    public function buildWalletLoyaltyPayload(WalletTransaction $transaction): array
    {
        $payload = $this->baseWalletPayload($transaction);
        $amount = round((float) $transaction->credit, 2);

        $payload['totals']['converted'] = $amount;

        return $payload;
    }

    public function buildWalletManualCreditPayload(WalletTransaction $transaction): array
    {
        $payload = $this->baseWalletPayload($transaction);
        $amount = round((float) $transaction->credit, 2);

        $payload['totals']['amount'] = $amount;

        return $payload;
    }

    public function buildVendorPaymentPayload(WithdrawRequest $withdraw): array
    {
        $withdraw->loadMissing(['seller.shop', 'withdrawMethod']);

        $amount = round((float) $withdraw->amount, 2);
        $entryDate = $this->resolveDateString($withdraw->updated_at?->toDateString());
        $reference = sprintf('WD-%06d', $withdraw->id);

        return [
            'withdraw_id' => $withdraw->id,
            'reference' => $reference,
            'vendor_id' => $withdraw->seller_id,
            'vendor_name' => $withdraw->seller?->shop?->name ?? $withdraw->seller?->f_name,
            'entry_date' => $entryDate,
            'currency' => config('finance_mappings.default_currency'),
            'totals' => [
                'payment' => $amount,
            ],
            'meta' => [
                'transaction_note' => $withdraw->transaction_note,
                'withdraw_method' => $withdraw->withdrawMethod?->method_name,
            ],
        ];
    }

    public function buildDeliverymanCommissionPayload(DeliveryManTransaction $transaction): array
    {
        $entryDate = $this->resolveDateString(optional($transaction->created_at)->toDateString());
        $amount = $this->resolveDeliverymanTransactionAmount($transaction);

        return [
            'transaction_id' => $transaction->transaction_id,
            'reference' => $transaction->transaction_id,
            'delivery_man_id' => $transaction->delivery_man_id,
            'entry_date' => $entryDate,
            'currency' => config('finance_mappings.default_currency'),
            'totals' => [
                'commission' => $amount,
            ],
            'meta' => [
                'transaction_type' => $transaction->transaction_type,
                'user_type' => $transaction->user_type,
            ],
        ];
    }

    public function buildDeliverymanCashSettlementPayload(DeliveryManTransaction $transaction): array
    {
        $entryDate = $this->resolveDateString(optional($transaction->created_at)->toDateString());
        $amount = $this->resolveDeliverymanTransactionAmount($transaction);

        return [
            'transaction_id' => $transaction->transaction_id,
            'reference' => $transaction->transaction_id,
            'delivery_man_id' => $transaction->delivery_man_id,
            'entry_date' => $entryDate,
            'currency' => config('finance_mappings.default_currency'),
            'totals' => [
                'amount' => $amount,
            ],
            'meta' => [
                'transaction_type' => $transaction->transaction_type,
                'user_type' => $transaction->user_type,
            ],
        ];
    }

    public function buildDeliverymanPayoutPayload(WithdrawRequest $withdraw): array
    {
        $withdraw->loadMissing(['deliveryMan', 'withdrawMethod']);

        $amount = round((float) $withdraw->amount, 2);
        $entryDate = $this->resolveDateString($withdraw->approved_at?->toDateString() ?? $withdraw->updated_at?->toDateTimeString());
        $reference = sprintf('DMP-%06d', $withdraw->id);

        return [
            'withdraw_id' => $withdraw->id,
            'reference' => $reference,
            'delivery_man_id' => $withdraw->delivery_man_id,
            'delivery_man_name' => $withdraw->deliveryMan?->f_name,
            'entry_date' => $entryDate,
            'currency' => config('finance_mappings.default_currency'),
            'totals' => [
                'payment' => $amount,
            ],
            'meta' => [
                'transaction_note' => $withdraw->transaction_note,
                'withdraw_method' => $withdraw->withdrawMethod?->method_name,
            ],
        ];
    }

    public function buildFinanceTransferPayload(FinanceTransfer $transfer): array
    {
        $entryDate = $this->resolveDateString($transfer->approved_at?->toDateString() ?? $transfer->initiated_at?->toDateString());
        $amount = round((float) $transfer->amount, 2);

        return [
            'transfer_id' => $transfer->id,
            'transfer_number' => $transfer->transfer_number,
            'entry_date' => $entryDate,
            'currency' => strtoupper($transfer->currency ?? config('finance_mappings.default_currency')),
            'totals' => [
                'amount' => $amount,
            ],
            'meta' => [
                'exchange_rate' => $transfer->exchange_rate ?? 1,
                'memo' => $transfer->memo,
            ],
        ];
    }

    private function baseWalletPayload(WalletTransaction $transaction): array
    {
        $transaction->loadMissing('user');
        $entryDate = $this->resolveDateString(optional($transaction->created_at)->toDateString());

        return [
            'wallet_transaction_id' => $transaction->id,
            'transaction_id' => $transaction->transaction_id,
            'reference' => $transaction->reference ?? $transaction->transaction_id,
            'user_id' => $transaction->user_id,
            'entry_date' => $entryDate,
            'currency' => config('finance_mappings.default_currency'),
            'totals' => [],
            'meta' => [
                'transaction_type' => $transaction->transaction_type,
                'payment_method' => $transaction->payment_method,
                'user_email' => $transaction->user?->email,
            ],
        ];
    }

    /**
     * @return \Illuminate\Support\Collection<int, \App\Models\OrderDetail>
     */
    private function resolveOrderDetails(Order $order): Collection
    {
        if ($order->relationLoaded('details')) {
            return $order->details;
        }

        return $order->details()->get();
    }

    private function resolveDeliverymanTransactionAmount(DeliveryManTransaction $transaction): float
    {
        $amount = (float) ($transaction->credit ?: 0);
        if ($amount <= 0) {
            $amount = (float) ($transaction->debit ?: 0);
        }

        if ($amount <= 0) {
            $amount = abs((float) $transaction->credit - (float) $transaction->debit);
        }

        return round(abs($amount), 2);
    }

    private function resolveExtraDiscountAmount(Order $order, float $grossSubtotal, float $productDiscount): float
    {
        $raw = (float) ($order->extra_discount ?? 0);
        $type = $order->extra_discount_type ?? null;

        if ($raw <= 0) {
            return 0.0;
        }

        if ($type === 'free_shipping_over_order_amount') {
            return 0.0;
        }

        if ($type === 'percent') {
            $base = max($grossSubtotal - $productDiscount, 0.0);
            return ($base * $raw) / 100;
        }

        return $raw;
    }

    private function resolveShippingDiscount(Order $order): float
    {
        $raw = (float) ($order->extra_discount ?? 0);
        $type = $order->extra_discount_type ?? null;

        if ($raw <= 0) {
            return 0.0;
        }

        return $type === 'free_shipping_over_order_amount' ? $raw : 0.0;
    }

    private function resolveEntryDate(?Order $order): string
    {
        if ($order && $order->created_at) {
            return Carbon::parse($order->created_at)->toDateString();
        }

        return now()->toDateString();
    }

    private function summarizeGrnItems(PurchaseGrn $grn): array
    {
        $subtotal = 0.0;
        $tax = 0.0;
        $discount = 0.0;

        foreach ($grn->items as $item) {
            $orderItem = $item->orderItem;
            $accepted = (float) ($item->accepted_qty ?? 0);
            if (! $orderItem || $accepted <= 0) {
                continue;
            }

            $subtotal += $accepted * (float) ($orderItem->unit_price ?? 0);
            $tax += $accepted * $this->perUnitAmount($orderItem, 'tax_amount');
            $discount += $accepted * $this->perUnitAmount($orderItem, 'discount_amount');
        }

        return [$subtotal, $tax, $discount];
    }

    private function summarizeReturnItems(PurchaseGrnReturn $return): array
    {
        $subtotal = 0.0;
        $tax = 0.0;
        $discount = 0.0;

        foreach ($return->items as $item) {
            $grnItem = $item->grnItem;
            $orderItem = $grnItem?->orderItem;
            $qty = (float) ($item->return_qty ?? 0);
            if (! $orderItem || $qty <= 0) {
                continue;
            }

            $subtotal += $qty * (float) ($orderItem->unit_price ?? 0);
            $tax += $qty * $this->perUnitAmount($orderItem, 'tax_amount');
            $discount += $qty * $this->perUnitAmount($orderItem, 'discount_amount');
        }

        return [$subtotal, $tax, $discount];
    }

    private function perUnitAmount(?PurchaseOrderItem $orderItem, string $field): float
    {
        if (! $orderItem) {
            return 0.0;
        }

        $quantity = (float) ($orderItem->quantity ?? 0);
        if ($quantity <= 0) {
            return 0.0;
        }

        $total = (float) ($orderItem->{$field} ?? 0);

        return $total / $quantity;
    }

    private function resolveDateString(?string $value): string
    {
        if ($value) {
            return Carbon::parse($value)->toDateString();
        }

        return now()->toDateString();
    }
}
