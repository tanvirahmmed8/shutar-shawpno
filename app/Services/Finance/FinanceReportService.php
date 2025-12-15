<?php

namespace App\Services\Finance;

use App\Models\Finance\FinanceFiscalPeriod;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceJournalRow;
use App\Models\Finance\FinanceTransfer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FinanceReportService
{
    public function trialBalance(array $filters = []): Collection
    {
        $query = FinanceJournalRow::query()
            ->select([
                'finance_journal_rows.account_id',
                'finance_accounts.code',
                'finance_accounts.name',
                'finance_accounts.category',
                'finance_accounts.balance_type',
                DB::raw("SUM(CASE WHEN finance_journal_rows.entry_type = 'debit' THEN finance_journal_rows.amount ELSE 0 END) as debit_total"),
                DB::raw("SUM(CASE WHEN finance_journal_rows.entry_type = 'credit' THEN finance_journal_rows.amount ELSE 0 END) as credit_total"),
            ])
            ->join('finance_journals', 'finance_journal_rows.journal_id', '=', 'finance_journals.id')
            ->join('finance_accounts', 'finance_journal_rows.account_id', '=', 'finance_accounts.id')
            ->whereNull('finance_journals.deleted_at')
            ->where('finance_journals.status', 'posted')
            ->when(!empty($filters['fiscal_period_id']), fn ($builder) => $builder->where('finance_journals.fiscal_period_id', $filters['fiscal_period_id']))
            ->when(!empty($filters['date_from']), fn ($builder) => $builder->whereDate('finance_journals.entry_date', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($builder) => $builder->whereDate('finance_journals.entry_date', '<=', $filters['date_to']))
            ->groupBy('finance_journal_rows.account_id', 'finance_accounts.code', 'finance_accounts.name', 'finance_accounts.category', 'finance_accounts.balance_type')
            ->orderBy('finance_accounts.code');

        return $query->get();
    }

    public function balanceSheet(array $filters = []): array
    {
        $rows = $this->trialBalance($filters);
        $assets = $rows->where('category', 'asset');
        $liabilities = $rows->where('category', 'liability');
        $equity = $rows->where('category', 'equity');

        return [
            'assets' => $assets,
            'liabilities' => $liabilities,
            'equity' => $equity,
            'assets_total' => $this->calculateBalance($assets, 'debit'),
            'liabilities_total' => $this->calculateBalance($liabilities, 'credit'),
            'equity_total' => $this->calculateBalance($equity, 'credit'),
        ];
    }

    public function incomeStatement(array $filters = []): array
    {
        $rows = $this->trialBalance($filters);
        $revenues = $rows->where('category', 'revenue');
        $expenses = $rows->where('category', 'expense');

        $revenueTotal = $this->calculateBalance($revenues, 'credit');
        $expenseTotal = $this->calculateBalance($expenses, 'debit');

        return [
            'revenues' => $revenues,
            'expenses' => $expenses,
            'revenue_total' => $revenueTotal,
            'expense_total' => $expenseTotal,
            'net_income' => $revenueTotal - $expenseTotal,
        ];
    }

    public function cashFlow(array $filters = []): array
    {
        $rows = $this->trialBalance($filters);
        $buckets = [
            'operating' => ['asset', 'liability', 'revenue', 'expense'],
            'investing' => ['other'],
            'financing' => ['equity'],
        ];

        $summary = collect($buckets)->mapWithKeys(function ($categories, $bucket) use ($rows) {
            $bucketRows = $rows->whereIn('category', $categories);
            $balanceType = $bucket === 'operating' ? 'debit' : 'credit';

            return [$bucket => $this->calculateBalance($bucketRows, $balanceType)];
        });

        return [
            'summary' => $summary,
            'rows' => $rows,
        ];
    }

    public function dashboardMetrics(array $filters = []): array
    {
        $trialBalance = $this->trialBalance($filters);
        $incomeStatement = $this->incomeStatement($filters);

        $journalQuery = FinanceJournal::query()
            ->where('status', 'posted')
            ->when(!empty($filters['fiscal_period_id']), fn ($builder) => $builder->where('fiscal_period_id', $filters['fiscal_period_id']))
            ->when(!empty($filters['date_from']), fn ($builder) => $builder->whereDate('entry_date', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($builder) => $builder->whereDate('entry_date', '<=', $filters['date_to']));

        $transferQuery = FinanceTransfer::query()
            ->where('status', 'pending')
            ->when(!empty($filters['date_from']), fn ($builder) => $builder->whereDate('created_at', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($builder) => $builder->whereDate('created_at', '<=', $filters['date_to']));

        return [
            'total_debit' => round($trialBalance->sum('debit_total'), 2),
            'total_credit' => round($trialBalance->sum('credit_total'), 2),
            'net_income' => round($incomeStatement['net_income'], 2),
            'posted_journals' => $journalQuery->count(),
            'pending_transfers' => $transferQuery->count(),
        ];
    }

    public function periodOptions(): Collection
    {
        return FinanceFiscalPeriod::orderByDesc('start_date')->get(['id', 'name']);
    }

    private function calculateBalance(Collection $rows, string $naturalBalance): float
    {
        return $rows->sum(function ($row) use ($naturalBalance) {
            $balance = $row->debit_total - $row->credit_total;
            if ($naturalBalance === 'credit') {
                $balance *= -1;
            }

            return $balance;
        });
    }
}
