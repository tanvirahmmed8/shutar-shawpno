<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseEvent;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseInvoice;
use App\Models\Purchase\PurchaseOrder;
use App\Services\Finance\FinancePostingService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class InvoiceWorkflowService
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public const MATCH_PENDING = 'pending';
    public const MATCH_MATCHED = 'matched';
    public const MATCH_MISMATCH = 'mismatch';

    public function __construct(
        private InvoiceMatchingService $matchingService,
        private FinancePostingService $financePostingService
    )
    {
    }

    public function generateCode(): string
    {
        do {
            $code = 'INV-' . now()->format('ymd') . '-' . Str::upper(Str::random(4));
        } while (PurchaseInvoice::where('code', $code)->exists());

        return $code;
    }

    public function create(PurchaseOrder $order, array $payload): PurchaseInvoice
    {
        $order->loadMissing('items');
        $items = $payload['items'] ?? [];
        if (empty($items)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_invoice_requires_items')],
            ]);
        }

        $grn = $this->resolveGrn($payload['grn_id'] ?? null, $order);
        $this->guardInvoiceNumber($payload['invoice_number'] ?? null);

        return DB::transaction(function () use ($order, $payload, $items, $grn) {
            $invoice = PurchaseInvoice::create($this->buildAttributes($order, $payload, $grn));
            $this->syncItems($invoice, $items, $order, $grn);
            $this->recalculateTotals($invoice);
            $this->logEvent($invoice, 'invoice_created');

            return $invoice->fresh(['items.orderItem']);
        });
    }

    public function update(PurchaseInvoice $invoice, array $payload): PurchaseInvoice
    {
        $this->ensureDraft($invoice);
        $invoice->loadMissing('order.items', 'grn.items');
        $order = $invoice->order;
        $items = $payload['items'] ?? null;
        $grnId = $payload['grn_id'] ?? $invoice->grn_id;
        $grn = $this->resolveGrn($grnId, $order);

        if ($items !== null && empty($items)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_invoice_requires_items')],
            ]);
        }

        if (array_key_exists('invoice_number', $payload)) {
            $this->guardInvoiceNumber($payload['invoice_number']);
        }

        return DB::transaction(function () use ($invoice, $payload, $items, $order, $grn) {
            $header = Arr::only($payload, [
                'invoice_number',
                'invoice_date',
                'due_date',
                'currency',
                'exchange_rate',
                'freight_total',
                'notes',
            ]);

            $invoice->forceFill(array_merge($header, [
                'grn_id' => $grn?->id,
                'updated_by' => auth('admin')->id(),
                'match_status' => self::MATCH_PENDING,
                'match_variance' => 0,
            ]))->save();

            if (is_array($items)) {
                $this->syncItems($invoice, $items, $order, $grn);
            }

            $this->recalculateTotals($invoice);
            $this->logEvent($invoice, 'invoice_updated');

            return $invoice->fresh(['items.orderItem']);
        });
    }

    public function submit(PurchaseInvoice $invoice): PurchaseInvoice
    {
        $this->ensureDraft($invoice);

        $invoice->forceFill([
            'status' => self::STATUS_SUBMITTED,
            'updated_by' => auth('admin')->id(),
        ])->save();

        $this->logEvent($invoice, 'invoice_submitted');
        $this->runMatching($invoice);

        return $invoice->fresh();
    }

    public function runMatching(PurchaseInvoice $invoice): array
    {
        $result = $this->matchingService->evaluate($invoice);

        $invoice->forceFill([
            'match_status' => $result['status'],
            'match_variance' => $result['variance'],
        ])->save();

        $event = $result['status'] === self::MATCH_MATCHED ? 'invoice_matched' : null;
        if ($result['status'] === self::MATCH_MISMATCH) {
            $event = 'invoice_mismatch';
        }

        if ($event) {
            $this->logEvent($invoice, $event, $result);
        }

        return $result;
    }

    public function approve(PurchaseInvoice $invoice, array $context = []): void
    {
        if ($invoice->status !== self::STATUS_SUBMITTED) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_invoice_status_invalid_for_action')],
            ]);
        }

        if ($invoice->match_status !== self::MATCH_MATCHED) {
            throw ValidationException::withMessages([
                'match_status' => [__('purchase_invoice_match_required')],
            ]);
        }

        $invoice->forceFill([
            'status' => self::STATUS_APPROVED,
            'approved_by' => $context['approved_by'] ?? auth('admin')->id(),
            'approved_at' => now(),
        ])->save();

        $this->logEvent($invoice, 'invoice_approved');

        $this->financePostingService->postPurchaseInvoice(
            $invoice->fresh(['items', 'order'])
        );
    }

    public function reject(PurchaseInvoice $invoice, string $reason): void
    {
        if ($invoice->status !== self::STATUS_SUBMITTED) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_invoice_status_invalid_for_action')],
            ]);
        }

        $invoice->forceFill([
            'status' => self::STATUS_REJECTED,
            'notes' => trim($reason),
        ])->save();

        $this->logEvent($invoice, 'invoice_rejected', ['reason' => $reason]);
    }

    private function buildAttributes(PurchaseOrder $order, array $payload, ?PurchaseGrn $grn = null): array
    {
        $adminId = auth('admin')->id();
        $invoiceDate = $payload['invoice_date'] ?? now()->toDateString();
        $dueDate = $payload['due_date'] ?? now()->copy()->addDays(7)->toDateString();

        return [
            'code' => $payload['code'] ?? $this->generateCode(),
            'vendor_id' => $order->vendor_id,
            'order_id' => $order->id,
            'grn_id' => $grn?->id,
            'status' => self::STATUS_DRAFT,
            'invoice_number' => trim((string) $payload['invoice_number']),
            'invoice_date' => $invoiceDate,
            'due_date' => $dueDate,
            'currency' => $payload['currency'] ?? $order->currency,
            'exchange_rate' => $payload['exchange_rate'] ?? $order->exchange_rate ?? 1,
            'freight_total' => (float) ($payload['freight_total'] ?? 0),
            'subtotal' => 0,
            'tax_total' => 0,
            'discount_total' => 0,
            'grand_total' => 0,
            'match_status' => self::MATCH_PENDING,
            'match_variance' => 0,
            'notes' => $payload['notes'] ?? null,
            'created_by' => $adminId,
            'updated_by' => $adminId,
        ];
    }

    private function syncItems(PurchaseInvoice $invoice, array $items, PurchaseOrder $order, ?PurchaseGrn $grn = null): void
    {
        $invoice->items()->delete();
        $orderItems = $order->items;
        $grnItems = $grn?->items ?? collect();

        foreach ($items as $line) {
            $orderItemId = (int) ($line['order_item_id'] ?? 0);
            $orderItem = $orderItems->firstWhere('id', $orderItemId);
            if (! $orderItem) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_invoice_item_invalid_order_line')],
                ]);
            }

            $grnItemId = $line['grn_item_id'] ?? null;
            if ($grnItemId) {
                $matchedGrnItem = $grnItems->firstWhere('id', (int) $grnItemId);
                if (! $matchedGrnItem || (int) $matchedGrnItem->order_item_id !== $orderItem->id) {
                    throw ValidationException::withMessages([
                        'items' => [__('purchase_invoice_item_invalid_grn_line')],
                    ]);
                }
            }

            $quantity = (float) ($line['quantity'] ?? 0);
            if ($quantity <= 0) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_invoice_item_invalid_quantity')],
                ]);
            }

            $unitPrice = (float) ($line['unit_price'] ?? $orderItem->unit_price ?? 0);
            if ($unitPrice <= 0) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_invoice_item_invalid_price')],
                ]);
            }

            $taxAmount = (float) ($line['tax_amount'] ?? 0);
            $discountAmount = (float) ($line['discount_amount'] ?? 0);
            $lineTotal = round(($quantity * $unitPrice) + $taxAmount - $discountAmount, 4);

            $invoice->items()->create([
                'order_item_id' => $orderItem->id,
                'grn_item_id' => $grnItemId,
                'description' => $line['description'] ?? $orderItem->description,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'tax_amount' => $taxAmount,
                'discount_amount' => $discountAmount,
                'line_total' => $lineTotal,
            ]);
        }
    }

    private function recalculateTotals(PurchaseInvoice $invoice): void
    {
        $invoice->loadMissing('items');
        $items = $invoice->items;
        $subtotal = 0;
        $taxTotal = 0;
        $discountTotal = 0;

        foreach ($items as $item) {
            $subtotal += ($item->quantity * $item->unit_price);
            $taxTotal += $item->tax_amount;
            $discountTotal += $item->discount_amount;
        }

        $grandTotal = round($subtotal + $taxTotal + (float) $invoice->freight_total - $discountTotal, 4);

        $invoice->forceFill([
            'subtotal' => round($subtotal, 4),
            'tax_total' => round($taxTotal, 4),
            'discount_total' => round($discountTotal, 4),
            'grand_total' => $grandTotal,
        ])->save();
    }

    private function resolveGrn($grnId, PurchaseOrder $order): ?PurchaseGrn
    {
        $grnId = (int) $grnId;
        if ($grnId <= 0) {
            return null;
        }

        $grn = PurchaseGrn::with('items')->find($grnId);
        if (! $grn || $grn->order_id !== $order->id) {
            throw ValidationException::withMessages([
                'grn_id' => [__('purchase_invoice_invalid_grn')],
            ]);
        }

        return $grn;
    }

    private function guardInvoiceNumber(?string $invoiceNumber): void
    {
        if (! $invoiceNumber || trim($invoiceNumber) === '') {
            throw ValidationException::withMessages([
                'invoice_number' => [__('purchase_invoice_number_required')],
            ]);
        }
    }

    private function ensureDraft(PurchaseInvoice $invoice): void
    {
        if ($invoice->status !== self::STATUS_DRAFT) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_invoice_not_editable')],
            ]);
        }
    }

    private function logEvent(PurchaseInvoice $invoice, string $event, array $payload = []): void
    {
        $meta = array_merge([
            'invoice_id' => $invoice->id,
            'order_id' => $invoice->order_id,
            'status' => $invoice->status,
            'match_status' => $invoice->match_status,
        ], $payload);

        PurchaseEvent::create([
            'event_type' => $event,
            'payload' => array_merge($meta, ['code' => $invoice->code]),
            'status' => 'recorded',
            'dispatched_at' => now(),
        ]);
    }
}
