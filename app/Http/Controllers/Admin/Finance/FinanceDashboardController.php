<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Services\Finance\FinanceReportService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FinanceDashboardController extends BaseController
{
    public function __construct(private readonly FinanceReportService $reports)
    {
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|callable|RedirectResponse|null
    {
        $request = $request ?? request();
        $filters = [
            'fiscal_period_id' => $request->get('fiscal_period_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        return view(AccountsFinance::DASHBOARD[VIEW], [
            'sectionTitle' => translate('accounts_finance_dashboard'),
            'introText' => translate('accounts_finance_workspace_intro'),
            'metrics' => $this->reports->dashboardMetrics($filters),
            'incomeStatement' => $this->reports->incomeStatement($filters),
            'filters' => $filters,
            'periods' => $this->reports->periodOptions(),
        ]);
    }
}
