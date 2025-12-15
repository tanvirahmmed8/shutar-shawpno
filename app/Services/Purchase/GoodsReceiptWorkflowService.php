<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseEvent;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnEvent;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Purchase\PurchaseOrderItem;
use App\Models\Purchase\PurchaseGrnReturn;
use App\Services\Finance\FinancePostingService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class GoodsReceiptWorkflowService
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PENDING_REVIEW = 'pending_review';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_RETURNED = 'returned';

    public function __construct(
        private InventorySyncService $inventorySyncService,
        private FinancePostingService $financePostingService
    )
    {
    }

    public function generateCode(): string
    {
        do {
            $code = 'GRN-' . now()->format('ymd') . '-' . Str::upper(Str::random(4));
        } while (PurchaseGrn::where('code', $code)->exists());

        return $code;
    }

    public function create(PurchaseOrder $order, array $payload): PurchaseGrn
    {
        $order->loadMissing('items');
        $items = $payload['items'] ?? [];
        if (empty($items)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_grn_requires_items')],
            ]);
        }

        return DB::transaction(function () use ($order, $payload, $items) {
            $attributes = array_merge(
                $this->defaults($order, $payload),
                Arr::except($payload, ['items', 'order_id'])
            );
            $grn = PurchaseGrn::create($attributes);

            $this->syncItems($grn, $order, $items);
            $this->logEvent($grn, 'grn_created');

            return $grn->fresh(['items.orderItem']);
        });
    }

    public function update(PurchaseGrn $grn, PurchaseOrder $order, array $payload): PurchaseGrn
    {
        $this->ensureDraft($grn);
        $order->loadMissing('items');
        $items = $payload['items'] ?? [];
        if (empty($items)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_grn_requires_items')],
            ]);
        }

        return DB::transaction(function () use ($grn, $order, $payload, $items) {
            $grn->forceFill(array_merge(
                Arr::except($payload, ['items', 'order_id']),
                ['updated_by' => auth('admin')->id()]
            ))->save();

            $this->syncItems($grn, $order, $items);
            $this->logEvent($grn, 'grn_updated');

            return $grn->fresh(['items.orderItem']);
        });
    }

    public function submitForReview(PurchaseGrn $grn): void
    {
        $this->ensureDraft($grn);

        $grn->forceFill([
            'status' => self::STATUS_PENDING_REVIEW,
            'reviewed_at' => now(),
        ])->save();

        $this->logEvent($grn, 'grn_submitted');
    }

    public function reject(PurchaseGrn $grn, string $reason): void
    {
        if ($grn->status !== self::STATUS_PENDING_REVIEW) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_status_invalid_for_action')],
            ]);
        }

        $grn->forceFill([
            'status' => self::STATUS_REJECTED,
            'rejection_reason' => $reason,
            'reviewed_at' => now(),
            'approved_at' => null,
        ])->save();

        $this->logEvent($grn, 'grn_rejected', ['reason' => $reason]);
    }

    public function approve(PurchaseGrn $grn, array $context = []): void
    {
        if ($grn->status !== self::STATUS_PENDING_REVIEW) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_status_invalid_for_action')],
            ]);
        }

        DB::transaction(function () use ($grn, $context) {
            $grn->loadMissing('items.orderItem', 'order.items');
            foreach ($grn->items as $item) {
                $orderItem = $item->orderItem;
                if (! $orderItem) {
                    continue;
                }

                $orderItem->refresh();
                $newReceived = $orderItem->received_qty + $item->accepted_qty;
                $orderItem->forceFill([
                    'received_qty' => $newReceived,
                    'outstanding_qty' => max($orderItem->quantity - $newReceived, 0),
                ])->save();
            }

            $progress = $this->calculateReceivingProgress($grn->order);

            $grn->forceFill([
                'status' => self::STATUS_APPROVED,
                'approved_at' => now(),
                'checked_by' => $context['checked_by'] ?? auth('admin')->id(),
                'inventory_sync_status' => 'queued',
                'inventory_sync_payload' => $this->inventorySyncService->buildPayload($grn),
            ])->save();

            $grn->order->forceFill([
                'receiving_status' => $progress['status'],
                'received_percent' => $progress['percent'],
                'last_receipt_at' => now(),
                'updated_by' => auth('admin')->id(),
            ])->save();

            $this->logEvent($grn, 'grn_approved', ['receiving_status' => $progress['status']]);
        });

        $freshGrn = $grn->fresh(['items.orderItem', 'order']);
        $this->inventorySyncService->queue($freshGrn);
        $this->financePostingService->postPurchaseGrn($freshGrn);
    }

    public function markReturned(PurchaseGrn $grn, ?string $reference = null): void
    {
        if ($grn->status !== self::STATUS_APPROVED) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_status_invalid_for_action')],
            ]);
        }

        $grn->forceFill([
            'status' => self::STATUS_RETURNED,
            'return_reference' => $reference,
        ])->save();

        $this->logEvent($grn, 'grn_marked_returned', array_filter(['reference' => $reference]));
    }

    public function createReturn(PurchaseGrn $grn, array $payload): PurchaseGrnReturn
    {
        if ($grn->status !== self::STATUS_APPROVED) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_return_only_from_approved')],
            ]);
        }

        $itemsPayload = $payload['items'] ?? [];
        if (empty($itemsPayload)) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_grn_return_requires_items')],
            ]);
        }

        $grn->loadMissing(['items.returnItems', 'order']);
        $validatedItems = $this->validateReturnItems($grn, $itemsPayload);

        return DB::transaction(function () use ($grn, $payload, $validatedItems) {
            $return = $grn->returns()->create([
                'order_id' => $grn->order_id,
                'vendor_id' => $grn->order->vendor_id,
                'initiated_by' => auth('admin')->id(),
                'status' => 'draft',
                'carrier' => $payload['carrier'] ?? null,
                'tracking_number' => $payload['tracking_number'] ?? null,
                'return_reason' => $payload['return_reason'] ?? null,
                'notes' => $payload['notes'] ?? null,
            ]);

            $linePayloads = array_map(static function (array $item): array {
                return [
                    'grn_item_id' => $item['grn_item_id'],
                    'return_qty' => $item['return_qty'],
                    'disposition' => $item['disposition'] ?? 'vendor',
                    'restock_decision' => $item['restock_decision'] ?? null,
                    'remarks' => $item['remarks'] ?? null,
                ];
            }, $validatedItems);

            $return->items()->createMany($linePayloads);

            $document = $payload['document'] ?? null;
            if ($document instanceof UploadedFile) {
                $this->persistReturnDocument($return, $document);
            }

            $this->logEvent($grn, 'grn_rtv_created', ['return_id' => $return->id]);

            return $return->load(['items.grnItem']);
        });
    }

    public function markReturnShipped(PurchaseGrnReturn $return, array $payload = []): PurchaseGrnReturn
    {
        if (! in_array($return->status, ['draft', 'in_transit'], true)) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_return_status_invalid')],
            ]);
        }

        $return->loadMissing('grn');
        $return->forceFill([
            'status' => 'in_transit',
            'carrier' => $payload['carrier'] ?? $return->carrier,
            'tracking_number' => $payload['tracking_number'] ?? $return->tracking_number,
            'shipped_at' => $return->shipped_at ?? now(),
        ])->save();

        $this->logEvent($return->grn, 'grn_rtv_shipped', ['return_id' => $return->id]);

        return $return->fresh(['items.grnItem']);
    }

    public function closeReturn(PurchaseGrnReturn $return): PurchaseGrnReturn
    {
        if ($return->status === 'closed') {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_return_status_invalid')],
            ]);
        }

        $return->loadMissing('grn');
        $return->loadMissing('grn');
        $return->forceFill([
            'status' => 'closed',
            'closed_at' => now(),
        ])->save();

        $this->logEvent($return->grn, 'grn_rtv_closed', ['return_id' => $return->id]);

        $freshReturn = $return->fresh(['items.grnItem.orderItem', 'order', 'grn']);
        $this->financePostingService->postPurchaseReturn($freshReturn);

        return $freshReturn;
    }

    private function syncItems(PurchaseGrn $grn, PurchaseOrder $order, array $items): void
    {
        $existingIds = $grn->items()->pluck('id');
        if ($existingIds->isNotEmpty()) {
            $grn->items()->delete();
        }

        foreach ($items as $payload) {
            $orderItemId = (int) ($payload['order_item_id'] ?? 0);
            /** @var PurchaseOrderItem|null $orderItem */
            $orderItem = $order->items->firstWhere('id', $orderItemId);
            if (! $orderItem) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_item_invalid_order_line')],
                ]);
            }

            $received = (float) ($payload['received_qty'] ?? 0);
            $rejected = (float) ($payload['rejected_qty'] ?? 0);
            if ($received <= 0) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_item_requires_received_qty')],
                ]);
            }

            $accepted = array_key_exists('accepted_qty', $payload)
                ? (float) $payload['accepted_qty']
                : max($received - $rejected, 0);

            if ($rejected < 0 || $accepted < 0) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_item_invalid_split')],
                ]);
            }

            $totalAccounted = $accepted + $rejected;
            if (abs($totalAccounted - $received) > 0.0001) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_item_invalid_split')],
                ]);
            }

            $this->guardOutstandingQuantity($orderItem, $accepted);

            $grn->items()->create([
                'order_item_id' => $orderItem->id,
                'product_id' => $orderItem->product_id,
                'uom' => $payload['uom'] ?? $orderItem->uom,
                'batch_number' => $payload['batch_number'] ?? null,
                'lot_number' => $payload['lot_number'] ?? null,
                'expiry_date' => $payload['expiry_date'] ?? null,
                'received_qty' => $received,
                'accepted_qty' => $accepted,
                'rejected_qty' => $rejected,
                'storage_location' => $payload['storage_location'] ?? null,
                'serial_numbers' => $payload['serial_numbers'] ?? null,
                'metadata' => $payload['metadata'] ?? null,
                'remarks' => $payload['remarks'] ?? null,
                'inspection_notes' => $payload['inspection_notes'] ?? null,
            ]);
        }
    }

    private function guardOutstandingQuantity(PurchaseOrderItem $orderItem, float $accepted): void
    {
        $remaining = max($orderItem->quantity - $orderItem->received_qty, 0);
        if ($accepted > $remaining) {
            throw ValidationException::withMessages([
                'items' => [__('purchase_grn_item_exceeds_outstanding')],
            ]);
        }
    }

    private function calculateReceivingProgress(PurchaseOrder $order): array
    {
        $order->loadMissing('items');
        $totalOrdered = (float) $order->items->sum('quantity');
        $totalReceived = (float) $order->items->sum('received_qty');
        $percent = $totalOrdered > 0 ? round(min(($totalReceived / $totalOrdered) * 100, 100), 2) : 0;

        $status = 'not_received';
        if ($percent === 0.0) {
            $status = 'not_received';
        } elseif ($percent >= 99.9) {
            $status = 'complete';
        } else {
            $status = 'partial';
        }

        return [
            'status' => $status,
            'percent' => $percent,
        ];
    }

    private function defaults(PurchaseOrder $order, array $payload = []): array
    {
        $adminId = auth('admin')->id();

        return [
            'code' => $payload['code'] ?? $this->generateCode(),
            'order_id' => $order->id,
            'warehouse_id' => $payload['warehouse_id'] ?? null,
            'received_by' => $payload['received_by'] ?? $adminId,
            'status' => self::STATUS_DRAFT,
            'received_at' => $payload['received_at'] ?? now(),
            'remarks' => $payload['remarks'] ?? null,
            'created_by' => $adminId,
            'updated_by' => $adminId,
        ];
    }

    private function ensureDraft(PurchaseGrn $grn): void
    {
        if ($grn->status !== self::STATUS_DRAFT) {
            throw ValidationException::withMessages([
                'status' => [__('purchase_grn_not_editable')],
            ]);
        }
    }

    private function logEvent(PurchaseGrn $grn, string $event, array $payload = []): void
    {
        $meta = array_merge([
            'grn_id' => $grn->id,
            'order_id' => $grn->order_id,
            'status' => $grn->status,
        ], $payload);

        PurchaseGrnEvent::create([
            'grn_id' => $grn->id,
            'event_type' => $event,
            'payload' => $meta,
            'created_by' => auth('admin')->id(),
        ]);

        PurchaseEvent::create([
            'event_type' => $event,
            'payload' => array_merge($meta, ['code' => $grn->code]),
            'status' => 'recorded',
            'dispatched_at' => now(),
        ]);
    }

    private function validateReturnItems(PurchaseGrn $grn, array $items): array
    {
        $normalized = [];
        foreach ($items as $item) {
            $grnItemId = (int) ($item['grn_item_id'] ?? 0);
            if ($grnItemId <= 0) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_return_invalid_item')],
                ]);
            }

            $returnQty = (float) ($item['return_qty'] ?? 0);
            if ($returnQty <= 0) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_return_qty_invalid')],
                ]);
            }

            $grnItem = $grn->items->firstWhere('id', $grnItemId);
            if (! $grnItem) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_return_invalid_item')],
                ]);
            }

            $alreadyReturned = (float) $grnItem->returnItems->sum('return_qty');
            $available = max((float) $grnItem->rejected_qty - $alreadyReturned, 0);

            if ($available <= 0 || $returnQty - $available > 0.0001) {
                throw ValidationException::withMessages([
                    'items' => [__('purchase_grn_return_qty_exceeds_rejected')],
                ]);
            }

            $normalized[] = array_merge($item, [
                'grn_item_id' => $grnItemId,
                'return_qty' => $returnQty,
            ]);
        }

        return $normalized;
    }

    private function persistReturnDocument(PurchaseGrnReturn $return, UploadedFile $document): void
    {
        $disk = config('filesystems.default', 'public');
        $path = $document->store('purchase/rtv', $disk);

        $return->documents()->create([
            'file_path' => $path,
            'original_name' => $document->getClientOriginalName(),
            'mime_type' => $document->getClientMimeType(),
            'file_size' => $document->getSize(),
            'uploaded_by' => auth('admin')->id(),
            'category' => 'rtv_document',
        ]);

        if ($return->grn) {
            $attachments = (int) ($return->grn->attachments_count ?? 0);
            $return->grn->forceFill(['attachments_count' => $attachments + 1])->save();
        }
    }
}
