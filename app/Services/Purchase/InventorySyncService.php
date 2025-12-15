<?php

namespace App\Services\Purchase;

use App\Jobs\Purchase\DispatchInventoryReceipt;
use App\Models\Product;
use App\Models\Purchase\PurchaseEvent;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnEvent;
use App\Services\Inventory\InventoryValuationService;
use Illuminate\Support\Facades\DB;

class InventorySyncService
{
    public function __construct(private InventoryValuationService $inventoryValuationService)
    {
    }

    public function buildPayload(PurchaseGrn $grn): array
    {
        $grn->loadMissing('order', 'items.orderItem');

        $lines = $grn->items
            ->filter(fn ($item) => $item->accepted_qty > 0)
            ->map(function ($item) use ($grn) {
                return [
                    'order_item_id' => $item->order_item_id,
                    'product_id' => $item->product_id,
                    'sku' => data_get($item->orderItem?->metadata, 'sku'),
                    'accepted_qty' => $item->accepted_qty,
                    'uom' => $item->uom,
                    'warehouse_id' => $grn->warehouse_id,
                    'batch_number' => $item->batch_number,
                    'lot_number' => $item->lot_number,
                    'expiry_date' => $item->expiry_date?->format('Y-m-d'),
                    'storage_location' => $item->storage_location,
                ];
            })
            ->values()
            ->toArray();

        return [
            'grn_id' => $grn->id,
            'grn_code' => $grn->code,
            'order_id' => $grn->order_id,
            'order_code' => optional($grn->order)->code,
            'warehouse_id' => $grn->warehouse_id,
            'lines' => $lines,
        ];
    }

    public function queue(PurchaseGrn $grn): void
    {
        DispatchInventoryReceipt::dispatch($grn->id);
        $this->logEvent($grn, 'inventory_sync_queued');
    }

    public function performSync(PurchaseGrn $grn): void
    {
        $grn->loadMissing('items');
        $payload = $grn->inventory_sync_payload ?: $this->buildPayload($grn);

        if (empty($payload['lines'])) {
            $grn->forceFill([
                'inventory_sync_status' => 'synced',
                'inventory_synced_at' => now(),
                'inventory_sync_payload' => $payload,
            ])->save();

            $this->logEvent($grn, 'inventory_sync_skipped');
            $snapshot = $this->inventoryValuationService->syncFinanceInventoryBalance();
            $this->logEvent($grn->fresh(), 'inventory_valuation_synced', [
                'valuation_snapshot' => $snapshot,
            ]);
            return;
        }

        DB::transaction(function () use ($grn) {
            foreach ($grn->items as $item) {
                if (! $item->product_id || $item->accepted_qty <= 0) {
                    continue;
                }

                Product::whereKey($item->product_id)
                    ->lockForUpdate()
                    ->increment('current_stock', $item->accepted_qty);
            }

            $grn->forceFill([
                'inventory_sync_status' => 'synced',
                'inventory_synced_at' => now(),
            ])->save();
        });

        $grn->forceFill([
            'inventory_sync_payload' => $payload,
        ])->save();

        $freshGrn = $grn->fresh();
        $this->logEvent($freshGrn, 'inventory_sync_completed');

        $snapshot = $this->inventoryValuationService->syncFinanceInventoryBalance();
        $this->logEvent($freshGrn, 'inventory_valuation_synced', [
            'valuation_snapshot' => $snapshot,
        ]);
    }

    public function markFailed(PurchaseGrn $grn, string $message): void
    {
        $payload = $grn->inventory_sync_payload ?: [];
        $payload['error'] = $message;

        $grn->forceFill([
            'inventory_sync_status' => 'failed',
            'inventory_sync_payload' => $payload,
        ])->save();

        $this->logEvent($grn, 'inventory_sync_failed', ['message' => $message]);
    }

    private function logEvent(PurchaseGrn $grn, string $event, array $payload = []): void
    {
        $meta = array_merge([
            'grn_id' => $grn->id,
            'order_id' => $grn->order_id,
            'status' => $grn->status,
            'inventory_status' => $grn->inventory_sync_status,
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
}
