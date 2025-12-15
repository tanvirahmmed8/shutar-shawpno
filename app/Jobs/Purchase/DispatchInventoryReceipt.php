<?php

namespace App\Jobs\Purchase;

use App\Models\Purchase\PurchaseGrn;
use App\Services\Purchase\InventorySyncService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class DispatchInventoryReceipt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $grnId)
    {
    }

    public function handle(InventorySyncService $inventorySyncService): void
    {
        $grn = PurchaseGrn::with('items')->find($this->grnId);
        if (! $grn) {
            return;
        }

        $grn->forceFill([
            'inventory_sync_status' => 'processing',
        ])->save();

        try {
            $inventorySyncService->performSync($grn);
        } catch (Throwable $e) {
            Log::error('Failed inventory sync for GRN', [
                'grn_id' => $grn->id,
                'order_id' => $grn->order_id,
                'error' => $e->getMessage(),
            ]);

            $inventorySyncService->markFailed($grn, $e->getMessage());
            throw $e;
        }
    }
}
