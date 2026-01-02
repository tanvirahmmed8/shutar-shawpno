<?php

namespace App\Services\Inventory;

use App\Exceptions\InsufficientLotStockException;
use App\Models\Inventory\InventoryLot;
use App\Models\Inventory\InventoryLotAllocation;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Purchase\PurchaseGrnItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LotInventoryService
{
    public function __construct(
        private InventoryLot $lot,
        private InventoryLotAllocation $allocation,
    ) {}

    public function createLotFromGrnItem(PurchaseGrnItem $item): ?InventoryLot
    {
        $item->loadMissing('product', 'orderItem', 'grn');
        $product = $item->product;

        if (! $this->shouldTrackProduct($product)) {
            return null;
        }

        $acceptedQty = (float) $item->accepted_qty;
        if ($acceptedQty <= 0) {
            return null;
        }

        $unitCost = (float) ($item->orderItem?->unit_price ?? $product->purchase_price ?? 0);

        $lot = $this->lot->newQuery()->create([
            'product_id' => $product->id,
            'source_type' => 'purchase_grn',
            'source_id' => $item->grn_id,
            'grn_id' => $item->grn_id,
            'grn_item_id' => $item->id,
            'order_item_id' => $item->order_item_id,
            'lot_number' => $item->lot_number,
            'batch_number' => $item->batch_number,
            'purchased_at' => $item->grn?->received_at ?? now(),
            'quantity_received' => round($acceptedQty, 4),
            'quantity_available' => round($acceptedQty, 4),
            'unit_purchase_price' => round($unitCost, 4),
            'currency' => $item->orderItem?->order?->currency,
            'metadata' => [
                'warehouse_id' => $item->grn?->warehouse_id,
                'storage_location' => $item->storage_location,
            ],
        ]);

        $this->refreshProductStock($product->id);

        return $lot;
    }

    public function assertSufficientStock(int $productId, float $requiredQty): void
    {
        if ($requiredQty <= 0) {
            return;
        }

        $available = $this->getAvailableQuantity($productId);
        if ($requiredQty > $available + 1e-6) {
            throw new InsufficientLotStockException(
                "Insufficient lot stock for product ID {$productId}. Requested {$requiredQty}, available {$available}."
            );
        }
    }

    public function reserveForOrderDetail(OrderDetail $detail): void
    {
        $detail->loadMissing('product', 'lotAllocations');
        $product = $this->resolveProduct($detail);

        if (! $this->shouldTrackProduct($product) || (float) $detail->qty <= 0) {
            return;
        }

        $hasActiveAllocations = $detail->lotAllocations->whereNull('released_at')->isNotEmpty();
        if ($hasActiveAllocations) {
            return;
        }

        DB::transaction(function () use ($detail, $product) {
            $requiredQty = (float) $detail->qty;
            $lots = $this->lot->newQuery()
                ->where('product_id', $product->id)
                ->where('quantity_available', '>', 0)
                ->orderBy('purchased_at')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            $available = $lots->sum(fn ($lot) => (float) $lot->quantity_available);
            if ($requiredQty > $available + 1e-6) {
                throw new InsufficientLotStockException(
                    "Insufficient lot stock for product ID {$product->id}. Requested {$requiredQty}, available {$available}."
                );
            }

            $remaining = $requiredQty;
            $unitSalePrice = $this->calculateUnitSalePrice($detail);

            foreach ($lots as $lot) {
                if ($remaining <= 0) {
                    break;
                }

                $availableInLot = (float) $lot->quantity_available;
                if ($availableInLot <= 0) {
                    continue;
                }

                $consumeQty = min($availableInLot, $remaining);
                $lot->forceFill([
                    'quantity_available' => round($availableInLot - $consumeQty, 4),
                ])->save();

                $profit = ($unitSalePrice - (float) $lot->unit_purchase_price) * $consumeQty;

                $this->allocation->newQuery()->create([
                    'lot_id' => $lot->id,
                    'order_detail_id' => $detail->id,
                    'product_id' => $product->id,
                    'quantity' => round($consumeQty, 4),
                    'unit_purchase_price' => round($lot->unit_purchase_price, 4),
                    'unit_sale_price' => round($unitSalePrice, 4),
                    'profit_amount' => round($profit, 4),
                    'metadata' => [
                        'order_id' => $detail->order_id,
                    ],
                ]);

                $remaining -= $consumeQty;
            }

            if ($remaining > 1e-6) {
                throw new InsufficientLotStockException(
                    "Unable to allocate full quantity for product ID {$product->id}. Remaining {$remaining}."
                );
            }

            $detail->forceFill(['is_stock_decreased' => true])->save();
            $this->refreshProductStock($product->id);
        });
    }

    public function releaseForOrderDetail(OrderDetail $detail): void
    {
        $detail->loadMissing('product');
        $product = $this->resolveProduct($detail);

        if (! $this->shouldTrackProduct($product) || (float) $detail->qty <= 0 || ! $detail->is_stock_decreased) {
            return;
        }

        DB::transaction(function () use ($detail, $product) {
            /** @var Collection<int, \App\Models\Inventory\InventoryLotAllocation> $allocations */
            $allocations = $this->allocation->newQuery()
                ->where('order_detail_id', $detail->id)
                ->whereNull('released_at')
                ->lockForUpdate()
                ->get();

            if ($allocations->isEmpty()) {
                $this->createAdjustmentLotFromOrderDetail($detail, $product);
                return;
            }

            foreach ($allocations as $allocation) {
                $lot = $this->lot->newQuery()
                    ->whereKey($allocation->lot_id)
                    ->lockForUpdate()
                    ->first();

                if ($lot) {
                    $lot->forceFill([
                        'quantity_available' => round($lot->quantity_available + $allocation->quantity, 4),
                    ])->save();
                }

                $allocation->forceFill(['released_at' => now()])->save();
            }

            $detail->forceFill(['is_stock_decreased' => false])->save();
            $this->refreshProductStock($product->id);
        });
    }

    public function getAvailableQuantity(int $productId): float
    {
        return (float) $this->lot->newQuery()
            ->where('product_id', $productId)
            ->sum('quantity_available');
    }

    public function refreshProductStock(int $productId): void
    {
        $total = $this->getAvailableQuantity($productId);
        Product::withoutEvents(function () use ($productId, $total) {
            Product::whereKey($productId)->update(['current_stock' => round($total, 4)]);
        });
    }

    private function calculateUnitSalePrice(OrderDetail $detail): float
    {
        $qty = (float) $detail->qty;
        if ($qty <= 0) {
            return 0.0;
        }

        $discountPerUnit = $qty > 0 ? ($detail->discount / $qty) : 0;
        return (float) round($detail->price - $discountPerUnit, 6);
    }

    private function shouldTrackProduct(?Product $product): bool
    {
        if (! $product) {
            return false;
        }

        return $product->product_type === 'physical';
    }

    private function resolveProduct(OrderDetail $detail): ?Product
    {
        if ($detail->relationLoaded('product') && $detail->product) {
            return $detail->product;
        }

        return Product::find($detail->product_id);
    }

    private function createAdjustmentLotFromOrderDetail(OrderDetail $detail, Product $product): void
    {
        $qty = (float) $detail->qty;
        if ($qty <= 0) {
            return;
        }

        $lot = $this->lot->newQuery()->create([
            'product_id' => $product->id,
            'source_type' => 'order_return',
            'source_id' => $detail->id,
            'lot_number' => 'RETURN-' . $detail->id,
            'purchased_at' => now(),
            'quantity_received' => round($qty, 4),
            'quantity_available' => round($qty, 4),
            'unit_purchase_price' => round($product->purchase_price ?? 0, 4),
            'metadata' => [
                'order_id' => $detail->order_id,
                'reason' => 'order_release',
            ],
        ]);

        $detail->forceFill(['is_stock_decreased' => false])->save();
        $this->refreshProductStock($product->id);
    }
}
