<?php

namespace App\Services\Finance;

use App\Models\DeliveryManTransaction;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceTransfer;
use App\Support\FinanceFeature;
use App\Models\Order;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnReturn;
use App\Models\Purchase\PurchaseInvoice;
use App\Models\RefundRequest;
use App\Models\WalletTransaction;
use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Log;
use Throwable;

class FinancePostingService
{
    public function __construct(
        private readonly FinanceTransactionService $transactionService,
        private readonly FinancePayloadBuilder $payloadBuilder,
    ) {
    }

    public function postSalesOrder(Order $order, string $eventKey = 'sales.order_paid'): ?FinanceJournal
    {
        if ($order->finance_journal_id) {
            return $order->financeJournal ?? null;
        }

        if (! $this->featureEnabled($this->resolveSalesFeatureKey($eventKey))) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildSalesPayload($order);
            $journal = $this->transactionService->record($eventKey, $payload, [
                'source_type' => 'order',
                'source_id' => $order->id,
                'source_reference' => $order->order_group_id,
                'category' => 'sales',
            ]);

            $order->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.order_post_failed', [
                'order_id' => $order->id,
                'event' => $eventKey,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postRefund(RefundRequest $refund): ?FinanceJournal
    {
        if ($refund->finance_journal_id) {
            return $refund->financeJournal ?? null;
        }

        if (! $this->featureEnabled('sales_orders')) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildRefundPayload($refund);
            $journal = $this->transactionService->record('sales.order_refund', $payload, [
                'source_type' => 'order',
                'source_id' => $refund->order_id,
                'source_reference' => $payload['order_number'] ?? $refund->order_id,
                'category' => 'sales',
            ]);

            $refund->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.refund_post_failed', [
                'refund_id' => $refund->id,
                'order_id' => $refund->order_id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postPurchaseGrn(PurchaseGrn $grn): ?FinanceJournal
    {
        if ($grn->finance_journal_id) {
            return $grn->financeJournal ?? null;
        }

        if (! $this->featureEnabled('purchases')) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildGrnPayload($grn);
            $journal = $this->transactionService->record('purchase.grn_received', $payload, [
                'source_type' => 'purchase_grn',
                'source_id' => $grn->id,
                'source_reference' => $grn->code,
                'category' => 'purchases',
            ]);

            $grn->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.grn_post_failed', [
                'grn_id' => $grn->id,
                'order_id' => $grn->order_id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postPurchaseInvoice(PurchaseInvoice $invoice): ?FinanceJournal
    {
        if ($invoice->finance_journal_id) {
            return $invoice->financeJournal ?? null;
        }

        if (! $this->featureEnabled('purchases')) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildPurchaseInvoicePayload($invoice);
            $journal = $this->transactionService->record('purchase.invoice_posted', $payload, [
                'source_type' => 'purchase_invoice',
                'source_id' => $invoice->id,
                'source_reference' => $invoice->invoice_number,
                'category' => 'purchases',
            ]);

            $invoice->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.invoice_post_failed', [
                'invoice_id' => $invoice->id,
                'order_id' => $invoice->order_id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postPurchaseReturn(PurchaseGrnReturn $return): ?FinanceJournal
    {
        if ($return->finance_journal_id) {
            return $return->financeJournal ?? null;
        }

        if (! $this->featureEnabled('purchases')) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildPurchaseReturnPayload($return);
            $journal = $this->transactionService->record('purchase.return_posted', $payload, [
                'source_type' => 'purchase_return',
                'source_id' => $return->id,
                'source_reference' => $return->grn?->code,
                'category' => 'purchases',
            ]);

            $return->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.purchase_return_post_failed', [
                'return_id' => $return->id,
                'order_id' => $return->order_id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postVendorPayment(WithdrawRequest $withdraw): ?FinanceJournal
    {
        if ($withdraw->finance_journal_id) {
            return $withdraw->financeJournal ?? null;
        }

        if (! $withdraw->seller_id) {
            return null;
        }

        if (! $this->featureEnabled('purchases')) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildVendorPaymentPayload($withdraw);
            $journal = $this->transactionService->record('purchase.vendor_payment', $payload, [
                'source_type' => 'withdraw_request',
                'source_id' => $withdraw->id,
                'source_reference' => $payload['reference'] ?? (string) $withdraw->id,
                'category' => 'purchases',
            ]);

            $withdraw->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.vendor_payment_post_failed', [
                'withdraw_id' => $withdraw->id,
                'seller_id' => $withdraw->seller_id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postDeliverymanPayout(WithdrawRequest $withdraw): ?FinanceJournal
    {
        if ($withdraw->finance_journal_id) {
            return $withdraw->financeJournal ?? null;
        }

        if (! $withdraw->delivery_man_id) {
            return null;
        }

        if (! $this->featureEnabled('deliveryman')) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildDeliverymanPayoutPayload($withdraw);
            $journal = $this->transactionService->record('deliveryman.payout', $payload, [
                'source_type' => 'deliveryman_withdraw',
                'source_id' => $withdraw->id,
                'source_reference' => $payload['reference'] ?? (string) $withdraw->id,
                'category' => 'operations',
            ]);

            $withdraw->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.deliveryman_payout_post_failed', [
                'withdraw_id' => $withdraw->id,
                'delivery_man_id' => $withdraw->delivery_man_id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postWalletTransaction(WalletTransaction $transaction): ?FinanceJournal
    {
        if ($transaction->finance_journal_id) {
            return $transaction->financeJournal ?? null;
        }

        if (! $this->featureEnabled('wallet')) {
            return null;
        }

        $isCredit = (float) $transaction->credit > 0;
        $isDebit = (float) $transaction->debit > 0;

        if (! $isCredit && ! $isDebit) {
            return null;
        }

        $eventKey = $isCredit ? $this->resolveWalletCreditEventKey($transaction) : 'wallet.withdrawal';

        try {
            if ($isCredit) {
                $payload = match ($eventKey) {
                    'wallet.loyalty_conversion' => $this->payloadBuilder->buildWalletLoyaltyPayload($transaction),
                    'wallet.manual_credit' => $this->payloadBuilder->buildWalletManualCreditPayload($transaction),
                    default => $this->payloadBuilder->buildWalletTopUpPayload($transaction),
                };
            } else {
                $payload = $this->payloadBuilder->buildWalletWithdrawalPayload($transaction);
            }

            $journal = $this->transactionService->record($eventKey, $payload, [
                'source_type' => 'wallet_transaction',
                'source_id' => $transaction->id,
                'source_reference' => $transaction->transaction_id,
                'category' => 'wallet',
            ]);

            $transaction->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.wallet_post_failed', [
                'wallet_transaction_id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'event' => $eventKey,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postFinanceTransfer(FinanceTransfer $transfer): ?FinanceJournal
    {
        if ($transfer->journal_id) {
            return $transfer->journal ?? null;
        }

        if (! $this->featureEnabled('transfers')) {
            return null;
        }

        if (! $transfer->source_account_id || ! $transfer->destination_account_id) {
            return null;
        }

        try {
            $payload = $this->payloadBuilder->buildFinanceTransferPayload($transfer);
            $journal = $this->transactionService->record('finance.transfer', $payload, [
                'source_type' => 'finance_transfer',
                'source_id' => $transfer->id,
                'source_reference' => $transfer->transfer_number,
                'category' => 'treasury',
                'source_account_id' => $transfer->source_account_id,
                'destination_account_id' => $transfer->destination_account_id,
                'currency' => $payload['currency'] ?? null,
            ]);

            $transfer->forceFill(['journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.transfer_post_failed', [
                'transfer_id' => $transfer->id,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    public function postDeliverymanTransaction(DeliveryManTransaction $transaction): ?FinanceJournal
    {
        if ($transaction->finance_journal_id) {
            return $transaction->financeJournal ?? null;
        }

        if (! $this->featureEnabled('deliveryman')) {
            return null;
        }

        $eventKey = match ($transaction->transaction_type) {
            'deliveryman_charge' => 'deliveryman.commission_accrual',
            'cash_in_hand' => 'deliveryman.cash_settlement',
            default => null,
        };

        if (! $eventKey) {
            return null;
        }

        try {
            $payload = $eventKey === 'deliveryman.cash_settlement'
                ? $this->payloadBuilder->buildDeliverymanCashSettlementPayload($transaction)
                : $this->payloadBuilder->buildDeliverymanCommissionPayload($transaction);

            $journal = $this->transactionService->record($eventKey, $payload, [
                'source_type' => 'deliveryman_transaction',
                'source_id' => $transaction->id,
                'source_reference' => $transaction->transaction_id,
                'category' => 'operations',
            ]);

            $transaction->forceFill(['finance_journal_id' => $journal->id])->save();

            return $journal;
        } catch (Throwable $exception) {
            Log::warning('finance.deliveryman_transaction_post_failed', [
                'transaction_id' => $transaction->id,
                'delivery_man_id' => $transaction->delivery_man_id,
                'event' => $eventKey,
                'message' => $exception->getMessage(),
            ]);

            return null;
        }
    }

    private function resolveWalletCreditEventKey(WalletTransaction $transaction): string
    {
        $type = $transaction->transaction_type;

        return match ($type) {
            'loyalty_point' => 'wallet.loyalty_conversion',
            'add_fund_by_admin' => 'wallet.manual_credit',
            default => 'wallet.top_up',
        };
    }

    private function featureEnabled(string $feature): bool
    {
        return FinanceFeature::enabled($feature);
    }

    private function resolveSalesFeatureKey(string $eventKey): string
    {
        return str_starts_with($eventKey, 'pos.') ? 'pos_orders' : 'sales_orders';
    }
}
