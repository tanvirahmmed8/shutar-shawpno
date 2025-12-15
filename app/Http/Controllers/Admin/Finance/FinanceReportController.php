<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Services\Finance\FinanceReportService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FinanceReportController extends BaseController
{
    public function __construct(private readonly FinanceReportService $reports)
    {
    }

    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        return match ($type ?? 'trial-balance') {
            'balance-sheet' => $this->balanceSheet($request),
            'income-statement' => $this->incomeStatement($request),
            'cash-flow' => $this->cashFlow($request),
            default => $this->trialBalance($request),
        };
    }

    public function trialBalance(Request $request): View
    {
        $filters = $this->filters($request);
        $rows = $this->reports->trialBalance($filters);
        $totals = [
            'debit' => $rows->sum('debit_total'),
            'credit' => $rows->sum('credit_total'),
        ];

        return view(AccountsFinance::REPORT_TRIAL_BALANCE[VIEW], [
            'rows' => $rows,
            'totals' => $totals,
            'periods' => $this->reports->periodOptions(),
            'filters' => $filters,
        ]);
    }

    public function balanceSheet(Request $request): View
    {
        $filters = $this->filters($request);
        $data = $this->reports->balanceSheet($filters);

        return view(AccountsFinance::REPORT_BALANCE_SHEET[VIEW], [
            'assets' => $data['assets'],
            'liabilities' => $data['liabilities'],
            'equity' => $data['equity'],
            'assetsTotal' => $data['assets_total'],
            'liabilitiesTotal' => $data['liabilities_total'],
            'equityTotal' => $data['equity_total'],
            'filters' => $filters,
            'periods' => $this->reports->periodOptions(),
        ]);
    }

    public function incomeStatement(Request $request): View
    {
        $filters = $this->filters($request);
        $data = $this->reports->incomeStatement($filters);

        return view(AccountsFinance::REPORT_INCOME_STATEMENT[VIEW], [
            'revenues' => $data['revenues'],
            'expenses' => $data['expenses'],
            'revenueTotal' => $data['revenue_total'],
            'expenseTotal' => $data['expense_total'],
            'netIncome' => $data['net_income'],
            'filters' => $filters,
            'periods' => $this->reports->periodOptions(),
        ]);
    }

    public function cashFlow(Request $request): View
    {
        $filters = $this->filters($request);
        $data = $this->reports->cashFlow($filters);

        return view(AccountsFinance::REPORT_CASH_FLOW[VIEW], [
            'summary' => $data['summary'],
            'rows' => $data['rows'],
            'filters' => $filters,
            'periods' => $this->reports->periodOptions(),
        ]);
    }

    private function filters(Request $request): array
    {
        return [
            'fiscal_period_id' => $request->get('fiscal_period_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];
    }
}
