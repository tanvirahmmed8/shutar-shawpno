<?php

namespace Tests\Feature\Order;

use App\Models\Inventory\InventoryLot;
use App\Models\Inventory\InventoryLotAllocation;
use App\Models\Order;
use App\Models\Product;
use App\Utils\OrderManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OrderLotAllocationFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        DB::table('business_settings')->insert([
            'type' => 'language',
            'value' => json_encode([
                ['code' => 'en', 'default' => true, 'direction' => 'ltr'],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_order_status_change_reserves_then_releases_lot_allocations(): void
    {
        $product = $this->createPhysicalProduct();

        $firstLot = InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 5001,
            'lot_number' => 'FIFO-OLD',
            'quantity_received' => 2,
            'quantity_available' => 2,
            'unit_purchase_price' => 5,
            'purchased_at' => Carbon::parse('2026-01-01 10:00:00'),
        ]);

        $secondLot = InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 5002,
            'lot_number' => 'FIFO-NEW',
            'quantity_received' => 3,
            'quantity_available' => 3,
            'unit_purchase_price' => 6,
            'purchased_at' => Carbon::parse('2026-01-02 10:00:00'),
        ]);

        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => 1,
            'order_status' => 'pending',
            'payment_status' => 'unpaid',
            'payment_method' => 'cash_on_delivery',
            'order_amount' => 48,
            'shipping_cost' => 0,
            'seller_id' => 1,
            'seller_is' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $detailId = DB::table('order_details')->insertGetId([
            'order_id' => $orderId,
            'product_id' => $product->id,
            'seller_id' => 1,
            'qty' => 4,
            'price' => 12,
            'tax' => 0,
            'discount' => 0,
            'tax_model' => 'exclude',
            'delivery_status' => 'pending',
            'payment_status' => 'unpaid',
            'is_stock_decreased' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order = Order::query()->with(['details.product'])->findOrFail($orderId);

        OrderManager::stock_update_on_order_status_change($order, 'confirmed');

        $firstLot->refresh();
        $secondLot->refresh();

        $this->assertEquals(0.0, (float) $firstLot->quantity_available);
        $this->assertEquals(1.0, (float) $secondLot->quantity_available);

        $allocations = InventoryLotAllocation::query()
            ->where('order_detail_id', $detailId)
            ->get();

        $this->assertCount(2, $allocations);
        $this->assertTrue($allocations->every(fn ($allocation) => $allocation->released_at === null));

        $this->assertDatabaseHas('order_details', [
            'id' => $detailId,
            'is_stock_decreased' => 1,
            'delivery_status' => 'confirmed',
        ]);

        OrderManager::stock_update_on_order_status_change($order->fresh(['details.product']), 'canceled');

        $firstLot->refresh();
        $secondLot->refresh();
        $releasedAllocations = InventoryLotAllocation::query()->where('order_detail_id', $detailId)->get();

        $this->assertEquals(2.0, (float) $firstLot->quantity_available);
        $this->assertEquals(3.0, (float) $secondLot->quantity_available);
        $this->assertTrue($releasedAllocations->every(fn ($allocation) => $allocation->released_at !== null));

        $this->assertDatabaseHas('order_details', [
            'id' => $detailId,
            'is_stock_decreased' => 0,
            'delivery_status' => 'canceled',
        ]);
    }

    private function createPhysicalProduct(): Product
    {
        return Product::query()->create([
            'added_by' => 'admin',
            'user_id' => 1,
            'name' => 'Flow Product ' . uniqid(),
            'slug' => 'flow-product-' . uniqid(),
            'product_type' => 'physical',
            'color_image' => '[]',
            'unit' => 'pcs',
            'unit_price' => 10,
            'purchase_price' => 5,
            'tax' => '0',
            'tax_model' => 'exclude',
            'discount' => '0',
            'current_stock' => 0,
            'status' => 1,
            'request_status' => 1,
        ]);
    }
}
