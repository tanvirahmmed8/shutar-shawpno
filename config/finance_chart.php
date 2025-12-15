<?php

return [
    'currency' => env('FINANCE_DEFAULT_CURRENCY', 'BDT'),

    'accounts' => [
        '1100' => [
            'name' => 'Cash in Hand',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        '1110' => [
            'name' => 'Bank Current Account',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        '1120' => [
            'name' => 'Gateway Clearing Account',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        '1300' => [
            'name' => 'Inventory Asset',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        '2100' => [
            'name' => 'Vendor Payables',
            'category' => 'liability',
            'type' => 'control',
            'balance_type' => 'credit',
        ],
        '2150' => [
            'name' => 'Goods Received Not Invoiced',
            'category' => 'liability',
            'type' => 'posting',
            'balance_type' => 'credit',
        ],
        '2300' => [
            'name' => 'Tax Liabilities',
            'category' => 'liability',
            'type' => 'posting',
            'balance_type' => 'credit',
        ],
        '2400' => [
            'name' => 'Wallet Liability',
            'category' => 'liability',
            'type' => 'posting',
            'balance_type' => 'credit',
        ],
        '2500' => [
            'name' => 'Deliveryman Payables',
            'category' => 'liability',
            'type' => 'posting',
            'balance_type' => 'credit',
        ],
        '4000' => [
            'name' => 'Sales Revenue',
            'category' => 'revenue',
            'type' => 'control',
            'balance_type' => 'credit',
        ],
        '4010' => [
            'name' => 'Sales Returns',
            'category' => 'revenue',
            'type' => 'posting',
            'balance_type' => 'debit',
        ],
        '5000' => [
            'name' => 'Operating Expenses',
            'category' => 'expense',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
    ],
];
