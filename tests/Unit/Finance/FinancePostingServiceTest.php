<?php

namespace Tests\Unit\Finance;

use App\Models\Finance\FinanceJournal;
use App\Models\Order;
use App\Models\WalletTransaction;
use App\Services\Finance\FinancePayloadBuilder;
use App\Services\Finance\FinancePostingService;
use App\Services\Finance\FinanceTransactionService;
use App\Support\FinanceFeature;
use Mockery;
use Tests\TestCase;

class FinancePostingServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        FinanceFeature::flushCache();
        parent::tearDown();
    }

    public function test_sales_posting_short_circuits_when_feature_disabled(): void
    {
        config()->set('finance_features.default_enabled', true);
        config()->set('finance_features.features.sales_orders', false);
        FinanceFeature::flushCache();

        $transactionService = Mockery::mock(FinanceTransactionService::class);
        $payloadBuilder = Mockery::mock(FinancePayloadBuilder::class);

        $service = new FinancePostingService($transactionService, $payloadBuilder);

        $order = Mockery::mock(Order::class)->makePartial();
        $order->setRawAttributes([
            'id' => 1,
            'finance_journal_id' => null,
            'order_group_id' => 'GRP-1',
        ], true);

        $transactionService->shouldNotReceive('record');
        $payloadBuilder->shouldNotReceive('buildSalesPayload');

        $this->assertNull($service->postSalesOrder($order));
    }

    public function test_wallet_credit_posts_when_feature_enabled(): void
    {
        config()->set('finance_features.default_enabled', false);
        config()->set('finance_features.features', ['wallet' => true]);
        FinanceFeature::flushCache();

        $transactionService = Mockery::mock(FinanceTransactionService::class);
        $payloadBuilder = Mockery::mock(FinancePayloadBuilder::class);

        $service = new FinancePostingService($transactionService, $payloadBuilder);

        $transaction = Mockery::mock(WalletTransaction::class)->makePartial();
        $transaction->setRawAttributes([
            'id' => 10,
            'finance_journal_id' => null,
            'credit' => 150.25,
            'debit' => 0,
            'transaction_type' => 'add_fund_by_admin',
            'transaction_id' => 'WALLET-10',
            'user_id' => 5,
        ], true);

        $transaction->shouldReceive('forceFill')->once()->andReturnSelf();
        $transaction->shouldReceive('save')->once()->andReturnTrue();

        $payload = ['reference' => 'WALLET-10'];
        $payloadBuilder->shouldReceive('buildWalletManualCreditPayload')
            ->once()
            ->with($transaction)
            ->andReturn($payload);

        $journal = new FinanceJournal();
        $journal->setRawAttributes(['id' => 99], true);

        $transactionService->shouldReceive('record')
            ->once()
            ->with('wallet.manual_credit', $payload, Mockery::on(function (array $context) {
                return $context['source_type'] === 'wallet_transaction'
                    && $context['category'] === 'wallet';
            }))
            ->andReturn($journal);

        $result = $service->postWalletTransaction($transaction);

        $this->assertSame($journal, $result);
    }
}
