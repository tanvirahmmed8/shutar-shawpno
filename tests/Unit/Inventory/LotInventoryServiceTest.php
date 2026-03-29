<?php

namespace Tests\Unit\Inventory;

use App\Exceptions\InsufficientLotStockException;
use App\Models\Inventory\InventoryLot;
use App\Models\Inventory\InventoryLotAllocation;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Purchase\PurchaseGrnItem;
use App\Services\Inventory\LotInventoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LotInventoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private LotInventoryService $service;

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

        $this->service = new LotInventoryService(new InventoryLot(), new InventoryLotAllocation());
    }

    public function test_create_lot_from_grn_item_creates_lot_and_refreshes_product_stock(): void
    {
        $product = $this->createPhysicalProduct();

        $grnId = DB::table('purchase_grns')->insertGetId([
            'code' => 'GRN-TEST-001',
            'order_id' => 1,
            'received_by' => 1,
            'status' => 'approved',
            'received_at' => now(),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $orderItemId = DB::table('purchase_order_items')->insertGetId([
            'order_id' => 1,
            'description' => 'Test item',
            'uom' => 'pcs',
            'quantity' => 10,
            'unit_price' => 7.5,
            'line_total' => 75,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $grnItem = PurchaseGrnItem::query()->create([
            'grn_id' => $grnId,
            'order_item_id' => $orderItemId,
            'product_id' => $product->id,
            'received_qty' => 5,
            'accepted_qty' => 5,
            'rejected_qty' => 0,
            'batch_number' => 'B-001',
            'lot_number' => 'L-001',
        ]);

        $lot = $this->service->createLotFromGrnItem($grnItem);

        $this->assertNotNull($lot);
        $this->assertSame($product->id, $lot->product_id);
        $this->assertSame('L-001', $lot->lot_number);
        $this->assertSame('B-001', $lot->batch_number);
        $this->assertEquals(5.0, (float) $lot->quantity_received);
        $this->assertEquals(5.0, (float) $lot->quantity_available);

        $product->refresh();
        $this->assertEquals(5.0, (float) $product->current_stock);
    }

    public function test_assert_sufficient_stock_passes_and_throws_when_insufficient(): void
    {
        $product = $this->createPhysicalProduct();

        InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 1,
            'quantity_received' => 3,
            'quantity_available' => 3,
            'unit_purchase_price' => 4,
            'purchased_at' => now(),
        ]);

        $this->service->assertSufficientStock($product->id, 2);
        $this->expectException(InsufficientLotStockException::class);
        $this->service->assertSufficientStock($product->id, 4);
    }

    public function test_reserve_for_order_detail_allocates_fifo_and_updates_stock(): void
    {
        $product = $this->createPhysicalProduct();

        $firstLot = InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 101,
            'lot_number' => 'L-OLD',
            'quantity_received' => 2,
            'quantity_available' => 2,
            'unit_purchase_price' => 5,
            'purchased_at' => Carbon::parse('2026-01-01 10:00:00'),
        ]);

        $secondLot = InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 102,
            'lot_number' => 'L-NEW',
            'quantity_received' => 3,
            'quantity_available' => 3,
            'unit_purchase_price' => 6,
            'purchased_at' => Carbon::parse('2026-01-02 10:00:00'),
        ]);

        $detailId = DB::table('order_details')->insertGetId([
            'order_id' => 1,
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

        $detail = OrderDetail::query()->findOrFail($detailId);

        $this->service->reserveForOrderDetail($detail);

        $detail->refresh();
        $firstLot->refresh();
        $secondLot->refresh();

        $this->assertTrue((bool) $detail->is_stock_decreased);
        $this->assertEquals(0.0, (float) $firstLot->quantity_available);
        $this->assertEquals(1.0, (float) $secondLot->quantity_available);

        $allocations = InventoryLotAllocation::query()
            ->where('order_detail_id', $detail->id)
            ->orderBy('id')
            ->get();

        $this->assertCount(2, $allocations);
        $this->assertEquals(2.0, (float) $allocations[0]->quantity);
        $this->assertEquals(2.0, (float) $allocations[1]->quantity);
        $this->assertNull($allocations[0]->released_at);
        $this->assertNull($allocations[1]->released_at);

        $product->refresh();
        $this->assertEquals(1.0, (float) $product->current_stock);
    }

    public function test_release_for_order_detail_restores_lot_quantities_and_marks_allocations_released(): void
    {
        $product = $this->createPhysicalProduct();

        $firstLot = InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 201,
            'lot_number' => 'L-201',
            'quantity_received' => 2,
            'quantity_available' => 2,
            'unit_purchase_price' => 5,
            'purchased_at' => Carbon::parse('2026-01-01 10:00:00'),
        ]);

        $secondLot = InventoryLot::query()->create([
            'product_id' => $product->id,
            'source_type' => 'manual',
            'source_id' => 202,
            'lot_number' => 'L-202',
            'quantity_received' => 3,
            'quantity_available' => 3,
            'unit_purchase_price' => 6,
            'purchased_at' => Carbon::parse('2026-01-02 10:00:00'),
        ]);

        $detailId = DB::table('order_details')->insertGetId([
            'order_id' => 1,
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

        $detail = OrderDetail::query()->findOrFail($detailId);

        $this->service->reserveForOrderDetail($detail);
        $this->service->releaseForOrderDetail($detail);

        $detail->refresh();
        $firstLot->refresh();
        $secondLot->refresh();

        $this->assertFalse((bool) $detail->is_stock_decreased);
        $this->assertEquals(2.0, (float) $firstLot->quantity_available);
        $this->assertEquals(3.0, (float) $secondLot->quantity_available);

        $allocations = InventoryLotAllocation::query()
            ->where('order_detail_id', $detail->id)
            ->get();

        $this->assertNotEmpty($allocations);
        $this->assertTrue($allocations->every(fn ($allocation) => $allocation->released_at !== null));

        $product->refresh();
        $this->assertEquals(5.0, (float) $product->current_stock);
    }

    private function createPhysicalProduct(): Product
    {
        $product = Product::query()->create([
            'added_by' => 'admin',
            'user_id' => 1,
            'name' => 'Test Product ' . uniqid(),
            'slug' => 'test-product-' . uniqid(),
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

        return $product->fresh();
    }
}
