<?php

return [
    'currency' => env('FINANCE_DEFAULT_CURRENCY', 'BDT'),

    'accounts' => [
        'cash_main' => [
            'code' => '1100',
            'label' => 'Cash in Hand',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        'bank_main' => [
            'code' => '1110',
            'label' => 'Bank Current Account',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        'gateway_clearing' => [
            'code' => '1120',
            'label' => 'Gateway Clearing Account',
            'category' => 'asset',
            'type' => 'control',
            'balance_type' => 'debit',
        ],
        'wallet_liability' => [
            'code' => '2400',
            'label' => 'Wallet Liability',
            'category' => 'liability',
            'type' => 'posting',
            'balance_type' => 'credit',
        ],
    ],

    'methods' => [
        'cash' => [
            'label' => 'cash',
            'accounts' => ['cash_main'],
            'default_account' => 'cash_main',
            'visible' => true,
        ],
        'bank_transfer' => [
            'label' => 'bank_transfer',
            'accounts' => ['bank_main'],
            'default_account' => 'bank_main',
            'visible' => true,
        ],
        'card' => [
            'label' => 'card',
            'accounts' => ['gateway_clearing', 'bank_main'],
            'default_account' => 'gateway_clearing',
            'visible' => true,
        ],
        'wallet' => [
            'label' => 'wallet',
            'accounts' => ['wallet_liability'],
            'default_account' => 'wallet_liability',
            'visible' => true,
        ],
        'other' => [
            'label' => 'other',
            'accounts' => ['cash_main', 'bank_main', 'gateway_clearing'],
            'default_account' => 'cash_main',
            'visible' => true,
        ],
        'default' => [
            'label' => 'default',
            'accounts' => ['cash_main', 'bank_main'],
            'default_account' => 'cash_main',
            'visible' => false,
        ],
    ],

    'aliases' => [
        'cash_on_delivery' => 'cash',
        'offline_payment' => 'bank_transfer',
        'pay_by_wallet' => 'wallet',
        'ssl_commerz_payment' => 'card',
        'paypal' => 'card',
        'stripe' => 'card',
        'razor_pay' => 'card',
        'paytm' => 'card',
        'bkash' => 'card',
        'nagad' => 'card',
        'digital_payment' => 'card',
    ],
];
