<?php

namespace App\Services\Purchase;

use App\Jobs\Purchase\DispatchPurchaseOrderCommunication;
use App\Models\Purchase\PurchaseApprovalRoute;
use App\Models\Purchase\PurchaseEvent;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Purchase\PurchaseOrderApproval;
use App\Models\Purchase\PurchaseOrderCommunication;
use App\Models\Purchase\PurchaseRequisition;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PurchaseOrderWorkflowService
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PENDING_APPROVAL = 'pending_approval';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_SENT = 'sent';
    public const STATUS_ACKNOWLEDGED = 'acknowledged';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_REJECTED = 'rejected';

    public const STATUS_PIPELINE = [
        self::STATUS_DRAFT,
        self::STATUS_PENDING_APPROVAL,
        self::STATUS_APPROVED,
        self::STATUS_SENT,
        self::STATUS_ACKNOWLEDGED,
        self::STATUS_CLOSED,
        self::STATUS_CANCELLED,
        self::STATUS_REJECTED,
    ];

    public function __construct(private PurchaseOrderPdfBuilder $pdfBuilder)
    {
    }

    public function generateCode(): string
    {
        do {
            $code = 'PO-' . now()->format('ymd') . '-' . Str::upper(Str::random(4));
        } while (PurchaseOrder::where('code', $code)->exists());

        return $code;
    }

    public function create(array $attributes, array $items): PurchaseOrder
    {
        if (empty($items)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_order_requires_items')],
            ]);
        }

        return DB::transaction(function () use ($attributes, $items) {
            $order = PurchaseOrder::create(array_merge($this->defaults(), $attributes, [
                'code' => $attributes['code'] ?? $this->generateCode(),
            ]));

            $this->syncItems($order, $items);
            $this->refreshTotals($order);
            $this->logEvent($order, 'po_created');

            return $order->fresh(['items', 'vendor']);
        });
    }

    public function update(PurchaseOrder $order, array $attributes, array $items): PurchaseOrder
    {
        $this->ensureEditable($order);

        if (empty($items)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_order_requires_items')],
            ]);
        }

        return DB::transaction(function () use ($order, $attributes, $items) {
            $order->forceFill(array_merge($attributes, [
                'updated_by' => auth('admin')->id(),
            ]))->save();

            $this->syncItems($order, $items);
            $this->refreshTotals($order);
            $this->logEvent($order, 'po_updated');

            return $order->fresh(['items', 'vendor']);
        });
    }

    public function convertFromRequisition(PurchaseRequisition $requisition, array $payload): PurchaseOrder
    {
        $requisition->loadMissing('items');
        if ($requisition->status !== 'approved') {
            throw ValidationException::withMessages([
                'requisition_id' => [__('purchase_requisition_not_ready_for_conversion')],
            ]);
        }

        if (empty($payload['vendor_id'])) {
            throw ValidationException::withMessages([
                'vendor_id' => [__('purchase_order_vendor_required')],
            ]);
        }

        $items = $requisition->items->map(function ($item) {
            return [
                'requisition_item_id' => $item->id,
                'product_id' => $item->product_id,
                'description' => $item->description,
                'uom' => $item->uom,
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price,
                'delivery_date' => optional($item->delivery_date)->format('Y-m-d'),
            ];
        })->toArray();

        $attributes = array_merge([
            'requisition_id' => $requisition->id,
            'currency' => $payload['currency'] ?? $requisition->currency,
        ], Arr::except($payload, ['items']));

        if (! array_key_exists('approval_route_id', $attributes) && $requisition->approval_route_id) {
            $attributes['approval_route_id'] = $requisition->approval_route_id;
        }

        $order = $this->create($attributes, $items);

        $requisition->forceFill([
            'status' => 'converted',
            'updated_by' => auth('admin')->id(),
        ])->save();

        $this->logEvent($order, 'po_converted', ['requisition_id' => $requisition->id]);

        return $order;
    }

    public function submitForApproval(PurchaseOrder $order, PurchaseApprovalRoute $route): void
    {
        $this->ensureEditable($order);
        $route->loadMissing('steps');

        if ($route->steps->isEmpty()) {
            throw ValidationException::withMessages([
                'approval_route_id' => [__('no_approval_steps_configured')],
            ]);
        }

        DB::transaction(function () use ($order, $route) {
            $order->approvals()->delete();
            foreach ($route->steps as $step) {
                $order->approvals()->create([
                    'step' => $step->step_order,
                    'approver_id' => $step->approver_id,
                    'status' => 'pending',
                ]);
            }

            $order->forceFill([
                'status' => self::STATUS_PENDING_APPROVAL,
                'approval_route_id' => $route->id,
            ])->save();

            $this->logEvent($order, 'po_submitted', ['route_id' => $route->id]);
        });
    }

    public function approve(PurchaseOrder $order, ?string $comments = null, ?int $actorId = null): void
    {
        if (! in_array($order->status, [self::STATUS_PENDING_APPROVAL, self::STATUS_DRAFT], true)) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_order_status_invalid_for_action')],
            ]);
        }

        $actor = $actorId ?: auth('admin')->id();

        DB::transaction(function () use ($order, $comments, $actor) {
            $approval = $this->resolvePendingApproval($order, $actor);
            if ($order->status === self::STATUS_PENDING_APPROVAL && $approval) {
                $approval->forceFill([
                    'status' => 'approved',
                    'acted_at' => now(),
                    'comments' => $comments,
                    'approver_id' => $approval->approver_id ?: $actor,
                ])->save();

                if ($order->approvals()->where('status', 'pending')->doesntExist()) {
                    $this->markApproved($order, $comments);
                }
            } else {
                $this->markApproved($order, $comments);
            }
        });
    }

    public function reject(PurchaseOrder $order, string $comments, ?int $actorId = null): void
    {
        if ($order->status !== self::STATUS_PENDING_APPROVAL) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_order_status_invalid_for_action')],
            ]);
        }

        $actor = $actorId ?: auth('admin')->id();

        DB::transaction(function () use ($order, $comments, $actor) {
            $approval = $this->resolvePendingApproval($order, $actor);
            if ($approval) {
                $approval->forceFill([
                    'status' => 'rejected',
                    'acted_at' => now(),
                    'comments' => $comments,
                    'approver_id' => $approval->approver_id ?: $actor,
                ])->save();
            }

            $order->forceFill([
                'status' => self::STATUS_REJECTED,
                'approved_at' => null,
            ])->save();

            $this->logEvent($order, 'po_rejected', ['comments' => $comments]);
        });
    }

    public function sendToVendor(PurchaseOrder $order, array $payload): PurchaseOrderCommunication
    {
        if (! in_array($order->status, [self::STATUS_APPROVED, self::STATUS_SENT], true)) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_order_status_invalid_for_action')],
            ]);
        }

        $recipient = trim((string) ($payload['recipient'] ?? ''));
        if ($recipient === '') {
            $recipient = optional($order->vendor->primaryContact)->email
                ?? $order->vendor->primary_email;
        }

        if (! $recipient) {
            throw ValidationException::withMessages([
                'recipient' => [__('purchase_order_vendor_email_required')],
            ]);
        }

        $channel = $payload['channel'] ?? 'email';
        $subject = $payload['subject'] ?? __('purchase_order_email_subject', ['code' => $order->code]);
        $message = $payload['message'] ?? null;

        return DB::transaction(function () use ($order, $recipient, $channel, $subject, $message) {
            $pdfPath = $this->pdfBuilder->build($order->loadMissing(['vendor', 'items']));

            $communication = $order->communications()->create([
                'channel' => $channel,
                'recipient' => $recipient,
                'status' => 'queued',
                'subject' => $subject,
                'attachment_path' => $pdfPath,
                'meta' => array_filter(['message' => $message]),
                'created_by' => auth('admin')->id(),
            ]);

            DispatchPurchaseOrderCommunication::dispatch($communication->id);

            $order->forceFill([
                'status' => self::STATUS_SENT,
                'sent_at' => $order->sent_at ?: now(),
            ])->save();

            $this->logEvent($order, 'po_send_requested', ['communication_id' => $communication->id]);

            return $communication;
        });
    }

    public function acknowledge(PurchaseOrder $order): void
    {
        if ($order->status !== self::STATUS_SENT) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_order_status_invalid_for_action')],
            ]);
        }

        $order->forceFill([
            'status' => self::STATUS_ACKNOWLEDGED,
        ])->save();

        $this->logEvent($order, 'po_acknowledged');
    }

    public function close(PurchaseOrder $order): void
    {
        if (! in_array($order->status, [self::STATUS_SENT, self::STATUS_ACKNOWLEDGED], true)) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_order_status_invalid_for_action')],
            ]);
        }

        $order->forceFill([
            'status' => self::STATUS_CLOSED,
            'closed_at' => now(),
        ])->save();

        $this->logEvent($order, 'po_closed');
    }

    private function syncItems(PurchaseOrder $order, array $items): void
    {
        $order->items()->delete();
        foreach ($items as $item) {
            $quantity = (float) ($item['quantity'] ?? 0);
            $unitPrice = (float) ($item['unit_price'] ?? 0);
            $lineSubtotal = $quantity * $unitPrice;
            $taxPercent = (float) ($item['tax_percent'] ?? 0);
            $taxAmount = array_key_exists('tax_amount', $item)
                ? (float) $item['tax_amount']
                : ($taxPercent ? ($lineSubtotal * $taxPercent / 100) : 0);
            $discountPercent = (float) ($item['discount_percent'] ?? 0);
            $discountAmount = array_key_exists('discount_amount', $item)
                ? (float) $item['discount_amount']
                : ($discountPercent ? ($lineSubtotal * $discountPercent / 100) : 0);
            $lineTotal = $lineSubtotal + $taxAmount - $discountAmount;

            $order->items()->create([
                'requisition_item_id' => $item['requisition_item_id'] ?? null,
                'product_id' => $item['product_id'] ?? null,
                'description' => $item['description'],
                'uom' => $item['uom'],
                'quantity' => $quantity,
                'received_qty' => $item['received_qty'] ?? 0,
                'unit_price' => $unitPrice,
                'tax_percent' => $taxPercent,
                'tax_amount' => $taxAmount,
                'discount_percent' => $discountPercent,
                'discount_amount' => $discountAmount,
                'line_total' => $lineTotal,
                'metadata' => $item['metadata'] ?? null,
            ]);
        }
    }

    private function refreshTotals(PurchaseOrder $order): void
    {
        $order->loadMissing('items');
        $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->unit_price);
        $lineGrandTotal = $order->items->sum('line_total');

        $grandTotal = $lineGrandTotal
            + (float) $order->freight_cost
            + (float) $order->tax_total
            - (float) $order->discount_total;

        $order->forceFill([
            'subtotal' => $subtotal,
            'grand_total' => max($grandTotal, 0),
        ])->save();
    }

    private function ensureEditable(PurchaseOrder $order): void
    {
        if ($order->status !== self::STATUS_DRAFT) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_order_not_editable')],
            ]);
        }
    }

    private function resolvePendingApproval(PurchaseOrder $order, ?int $actorId = null): ?PurchaseOrderApproval
    {
        $adminId = $actorId ?: auth('admin')->id();

        return $order->approvals()
            ->where('status', 'pending')
            ->where(function ($query) use ($adminId) {
                $query->where('approver_id', $adminId)
                    ->orWhereNull('approver_id');
            })
            ->orderBy('step')
            ->first();
    }

    private function markApproved(PurchaseOrder $order, ?string $comments = null): void
    {
        $order->forceFill([
            'status' => self::STATUS_APPROVED,
            'approved_at' => now(),
        ])->save();

        $this->logEvent($order, 'po_approved', array_filter(['comments' => $comments]));
    }

    private function logEvent(PurchaseOrder $order, string $event, array $payload = []): void
    {
        PurchaseEvent::create([
            'event_type' => $event,
            'payload' => array_merge([
                'order_id' => $order->id,
                'code' => $order->code,
                'status' => $order->status,
            ], $payload),
            'status' => 'recorded',
            'dispatched_at' => now(),
        ]);
    }

    private function defaults(): array
    {
        $adminId = auth('admin')->id();

        return [
            'buyer_id' => $adminId,
            'status' => self::STATUS_DRAFT,
            'receiving_status' => 'not_received',
            'received_percent' => 0,
            'exchange_rate' => 1,
            'freight_cost' => 0,
            'tax_total' => 0,
            'discount_total' => 0,
            'created_by' => $adminId,
            'updated_by' => $adminId,
        ];
    }
}
