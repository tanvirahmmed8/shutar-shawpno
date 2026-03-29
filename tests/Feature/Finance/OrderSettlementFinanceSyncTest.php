<?php

namespace Tests\Feature\Finance;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\Finance\FinancePostingService;
use App\Utils\OrderManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;

class OrderSettlementFinanceSyncTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_order_manager_settlement_posts_sales_journal(): void
    {
        $order = $this->createOrderForSettlement(paymentMethod: 'cash_on_delivery', orderType: 'default_type');

        $financePosting = Mockery::mock(FinancePostingService::class);
        $financePosting->shouldReceive('postSalesOrder')
            ->once()
            ->with(Mockery::type(Order::class), 'sales.order_paid')
            ->andReturnNull();

        app()->instance(FinancePostingService::class, $financePosting);

        OrderManager::wallet_manage_on_order_status_change($order, 'admin');

        $this->assertDatabaseHas('order_transactions', [
            'order_id' => $order->id,
            'status' => 'disburse',
        ]);
    }

    public function test_repository_settlement_posts_sales_journal(): void
    {
        $order = $this->createOrderForSettlement(paymentMethod: 'cash_on_delivery', orderType: 'default_type');

        $financePosting = Mockery::mock(FinancePostingService::class);
        $financePosting->shouldReceive('postSalesOrder')
            ->once()
            ->with(Mockery::type(Order::class), 'sales.order_paid')
            ->andReturnNull();

        app()->instance(FinancePostingService::class, $financePosting);

        /** @var OrderRepository $repository */
        $repository = app(OrderRepository::class);
        $repository->manageWalletOnOrderStatusChange($order, 'admin');

        $this->assertDatabaseHas('order_transactions', [
            'order_id' => $order->id,
            'status' => 'disburse',
        ]);
    }

    public function test_repository_settlement_uses_pos_event_for_pos_orders(): void
    {
        $order = $this->createOrderForSettlement(paymentMethod: 'cash_on_delivery', orderType: 'POS');

        $financePosting = Mockery::mock(FinancePostingService::class);
        $financePosting->shouldReceive('postSalesOrder')
            ->once()
            ->with(Mockery::type(Order::class), 'pos.sale_paid')
            ->andReturnNull();

        app()->instance(FinancePostingService::class, $financePosting);

        /** @var OrderRepository $repository */
        $repository = app(OrderRepository::class);
        $repository->manageWalletOnOrderStatusChange($order, 'admin');

        $this->assertDatabaseHas('order_transactions', [
            'order_id' => $order->id,
            'status' => 'disburse',
        ]);
    }

    private function createOrderForSettlement(string $paymentMethod, string $orderType): Order
    {
        $orderId = DB::table('orders')->insertGetId([
            'customer_id' => 1,
            'order_status' => 'delivered',
            'payment_status' => 'paid',
            'payment_method' => $paymentMethod,
            'order_type' => $orderType,
            'order_amount' => 120,
            'discount_amount' => 0,
            'admin_commission' => 10,
            'shipping_cost' => 0,
            'seller_id' => 1,
            'seller_is' => 'admin',
            'shipping_responsibility' => 'inhouse_shipping',
            'coupon_code' => null,
            'discount_type' => null,
            'is_shipping_free' => 0,
            'extra_discount' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('order_details')->insert([
            'order_id' => $orderId,
            'product_id' => 1,
            'seller_id' => 1,
            'qty' => 2,
            'price' => 60,
            'tax' => 0,
            'discount' => 0,
            'tax_model' => 'exclude',
            'delivery_status' => 'delivered',
            'payment_status' => 'paid',
            'is_stock_decreased' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Order::query()->findOrFail($orderId);
    }
}
