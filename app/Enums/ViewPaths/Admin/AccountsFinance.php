<?php

namespace App\Enums\ViewPaths\Admin;

enum AccountsFinance
{
    const DASHBOARD = [
        URI => '',
        VIEW => 'admin-views.finance.dashboard',
    ];

    const ACCOUNTS_INDEX = [
        URI => 'accounts',
        VIEW => 'admin-views.finance.accounts.index',
    ];

    const ACCOUNTS_CREATE = [
        URI => 'accounts/create',
        VIEW => 'admin-views.finance.accounts.create',
    ];

    const ACCOUNTS_EDIT = [
        URI => 'accounts/{account}/edit',
        VIEW => 'admin-views.finance.accounts.edit',
    ];

    const PAYMENT_MAPPINGS_EDIT = [
        URI => 'payment-mappings',
        VIEW => 'admin-views.finance.payment-mappings.edit',
    ];

    const JOURNALS_INDEX = [
        URI => 'journals',
        VIEW => 'admin-views.finance.journals.index',
    ];

    const JOURNALS_CREATE = [
        URI => 'journals/create',
        VIEW => 'admin-views.finance.journals.create',
    ];

    const JOURNALS_EDIT = [
        URI => 'journals/{journal}/edit',
        VIEW => 'admin-views.finance.journals.edit',
    ];

    const JOURNALS_SHOW = [
        URI => 'journals/{journal}',
        VIEW => 'admin-views.finance.journals.show',
    ];

    const RECONCILIATIONS_INDEX = [
        URI => 'reconciliations',
        VIEW => 'admin-views.finance.reconciliations.index',
    ];

    const RECONCILIATIONS_CREATE = [
        URI => 'reconciliations/create',
        VIEW => 'admin-views.finance.reconciliations.create',
    ];

    const RECONCILIATIONS_SHOW = [
        URI => 'reconciliations/{reconciliation}',
        VIEW => 'admin-views.finance.reconciliations.show',
    ];

    const EXPENSES_INDEX = [
        URI => 'expenses',
        VIEW => 'admin-views.finance.expenses.index',
    ];

    const EXPENSES_CREATE = [
        URI => 'expenses/create',
        VIEW => 'admin-views.finance.expenses.create',
    ];

    const EXPENSES_EDIT = [
        URI => 'expenses/{expense}/edit',
        VIEW => 'admin-views.finance.expenses.edit',
    ];

    const EXPENSES_SHOW = [
        URI => 'expenses/{expense}',
        VIEW => 'admin-views.finance.expenses.show',
    ];

    const TRANSFERS_INDEX = [
        URI => 'transfers',
        VIEW => 'admin-views.finance.transfers.index',
    ];

    const TRANSFERS_CREATE = [
        URI => 'transfers/create',
        VIEW => 'admin-views.finance.transfers.create',
    ];

    const TRANSFERS_SHOW = [
        URI => 'transfers/{transfer}',
        VIEW => 'admin-views.finance.transfers.show',
    ];

    const REPORT_TRIAL_BALANCE = [
        URI => 'reports/trial-balance',
        VIEW => 'admin-views.finance.reports.trial-balance',
    ];

    const REPORT_BALANCE_SHEET = [
        URI => 'reports/balance-sheet',
        VIEW => 'admin-views.finance.reports.balance-sheet',
    ];

    const REPORT_INCOME_STATEMENT = [
        URI => 'reports/income-statement',
        VIEW => 'admin-views.finance.reports.income-statement',
    ];

    const REPORT_CASH_FLOW = [
        URI => 'reports/cash-flow',
        VIEW => 'admin-views.finance.reports.cash-flow',
    ];
}
