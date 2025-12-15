<?php

namespace Tests\Feature\Finance;

use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceFiscalPeriod;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceJournalRow;
use App\Models\Finance\FinanceTransfer;
use App\Services\Finance\FinanceReportService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FinanceReportServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setupFinanceSchema();
    }

    private function setupFinanceSchema(): void
    {
        Schema::dropIfExists('finance_journal_rows');
        Schema::dropIfExists('finance_transfers');
        Schema::dropIfExists('finance_journals');
        Schema::dropIfExists('finance_accounts');
        Schema::dropIfExists('finance_fiscal_periods');

        Schema::create('finance_fiscal_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('fiscal_year')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('open');
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('finance_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name')->nullable();
            $table->string('category');
            $table->string('balance_type')->default('debit');
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('level')->default(1);
            $table->boolean('is_leaf')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_postable')->default(true);
            $table->string('currency')->nullable();
            $table->decimal('opening_balance', 18, 2)->default(0);
            $table->json('metadata')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('finance_journals', function (Blueprint $table) {
            $table->id();
            $table->string('journal_number')->nullable();
            $table->foreignId('fiscal_period_id')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('source_type')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('source_reference')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('exchange_rate', 12, 4)->default(1);
            $table->string('status')->default('draft');
            $table->string('category')->nullable();
            $table->text('memo')->nullable();
            $table->integer('line_count')->default(0);
            $table->integer('attachment_count')->default(0);
            $table->timestamp('posted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('finance_journal_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id');
            $table->foreignId('account_id');
            $table->integer('line_number')->default(1);
            $table->string('entry_type');
            $table->decimal('amount', 18, 2);
            $table->string('currency')->nullable();
            $table->decimal('exchange_rate', 12, 4)->default(1);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('finance_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_number')->nullable();
            $table->foreignId('source_account_id')->nullable();
            $table->foreignId('destination_account_id')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('currency')->nullable();
            $table->decimal('exchange_rate', 12, 4)->default(1);
            $table->string('status')->default('pending');
            $table->text('memo')->nullable();
            $table->integer('attachment_count')->default(0);
            $table->json('metadata')->nullable();
            $table->foreignId('journal_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function test_dashboard_metrics_rollup_trial_balance_and_transfers(): void
    {
        $period = FinanceFiscalPeriod::factory()->create([
            'name' => 'PER-2024-01',
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-31',
        ]);

        $assetAccount = FinanceAccount::factory()->create([
            'category' => 'asset',
            'balance_type' => 'debit',
            'code' => '1000',
        ]);
        $revenueAccount = FinanceAccount::factory()->create([
            'category' => 'revenue',
            'balance_type' => 'credit',
            'code' => '4000',
        ]);
        $expenseAccount = FinanceAccount::factory()->create([
            'category' => 'expense',
            'balance_type' => 'debit',
            'code' => '5000',
        ]);

        $journal = FinanceJournal::factory()->create([
            'fiscal_period_id' => $period->id,
            'entry_date' => '2024-01-05',
            'status' => 'posted',
        ]);

        FinanceJournalRow::factory()->create([
            'journal_id' => $journal->id,
            'account_id' => $assetAccount->id,
            'entry_type' => 'debit',
            'amount' => 700,
        ]);

        FinanceJournalRow::factory()->create([
            'journal_id' => $journal->id,
            'account_id' => $expenseAccount->id,
            'entry_type' => 'debit',
            'amount' => 300,
        ]);

        FinanceJournalRow::factory()->create([
            'journal_id' => $journal->id,
            'account_id' => $revenueAccount->id,
            'entry_type' => 'credit',
            'amount' => 1000,
        ]);

        FinanceTransfer::factory()->create([
            'status' => 'pending',
            'journal_id' => null,
        ]);

        /** @var FinanceReportService $service */
        $service = app(FinanceReportService::class);

        $metrics = $service->dashboardMetrics(['fiscal_period_id' => $period->id]);
        $incomeStatement = $service->incomeStatement(['fiscal_period_id' => $period->id]);

        $this->assertSame(1000.0, $metrics['total_debit']);
        $this->assertSame(1000.0, $metrics['total_credit']);
        $this->assertSame(700.0, $incomeStatement['net_income']);
        $this->assertSame(1, $metrics['posted_journals']);
        $this->assertSame(1, $metrics['pending_transfers']);
    }

    public function test_trial_balance_filters_by_period_and_dates(): void
    {
        $periodA = FinanceFiscalPeriod::factory()->create([
            'name' => 'PER-A',
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-31',
        ]);
        $periodB = FinanceFiscalPeriod::factory()->create([
            'name' => 'PER-B',
            'start_date' => '2024-02-01',
            'end_date' => '2024-02-29',
        ]);

        $account = FinanceAccount::factory()->create([
            'category' => 'asset',
            'balance_type' => 'debit',
            'code' => '1100',
        ]);

        $journalA = FinanceJournal::factory()->create([
            'fiscal_period_id' => $periodA->id,
            'entry_date' => '2024-01-15',
            'status' => 'posted',
        ]);
        $journalB = FinanceJournal::factory()->create([
            'fiscal_period_id' => $periodB->id,
            'entry_date' => '2024-02-15',
            'status' => 'posted',
        ]);

        FinanceJournalRow::factory()->create([
            'journal_id' => $journalA->id,
            'account_id' => $account->id,
            'entry_type' => 'debit',
            'amount' => 200,
        ]);

        FinanceJournalRow::factory()->create([
            'journal_id' => $journalB->id,
            'account_id' => $account->id,
            'entry_type' => 'debit',
            'amount' => 500,
        ]);

        /** @var FinanceReportService $service */
        $service = app(FinanceReportService::class);

        $periodRows = $service->trialBalance(['fiscal_period_id' => $periodA->id]);
        $this->assertCount(1, $periodRows);
        $this->assertEquals(200.0, $periodRows->first()->debit_total);

        $dateRows = $service->trialBalance(['date_from' => '2024-02-01', 'date_to' => '2024-02-28']);
        $this->assertEquals(500.0, $dateRows->first()->debit_total);
    }
}
