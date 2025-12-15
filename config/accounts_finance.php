<?php

return [
    'enabled' => (bool) env('FEATURE_ACCOUNTS_FINANCE_MODULE', false),
    'module_key' => 'accounts_finance',
    'permissions' => [
        [
            'key' => 'accounts_finance.view-dashboard',
            'label' => 'accounts_finance_view_dashboard',
        ],
        [
            'key' => 'accounts_finance.manage-chart',
            'label' => 'accounts_finance_manage_chart',
        ],
        [
            'key' => 'accounts_finance.post-journal',
            'label' => 'accounts_finance_post_journal',
        ],
        [
            'key' => 'accounts_finance.reconcile',
            'label' => 'accounts_finance_reconcile',
        ],
        [
            'key' => 'accounts_finance.manage-expense',
            'label' => 'accounts_finance_manage_expense',
        ],
        [
            'key' => 'accounts_finance.view-reports',
            'label' => 'accounts_finance_view_reports',
        ],
    ],
];
