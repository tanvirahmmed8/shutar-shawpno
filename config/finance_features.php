<?php

return [
    'default_enabled' => env('FINANCE_FEATURE_DEFAULT', true),

    'features' => [
        'sales_orders' => env('FINANCE_FEATURE_SALES_ORDERS', true),
        'pos_orders' => env('FINANCE_FEATURE_POS_ORDERS', true),
        'purchases' => env('FINANCE_FEATURE_PURCHASES', true),
        'wallet' => env('FINANCE_FEATURE_WALLET', true),
        'deliveryman' => env('FINANCE_FEATURE_DELIVERYMAN', true),
        'transfers' => env('FINANCE_FEATURE_TRANSFERS', true),
    ],
];
