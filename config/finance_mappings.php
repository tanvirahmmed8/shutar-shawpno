<?php

return [
    'default_currency' => env('FINANCE_DEFAULT_CURRENCY', config('app.currency', 'USD')),
    'journal_prefix' => env('FINANCE_JOURNAL_PREFIX', 'FIN'),
    'auto_post' => (bool) env('FINANCE_AUTO_POST', true),

    'events' => [
        'sales.order_paid' => [
            'description' => 'Retail or marketplace order payment captured.',
            'source_type' => 'order',
            'category' => 'sales',
            'memo' => 'Order :order_number payment',
            'source_reference' => 'order_number',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '1100',
                    'amount' => 'totals.receivable',
                    'description' => 'Customer payment received',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '4000',
                    'amount' => 'totals.subtotal',
                    'description' => 'Product revenue',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '4000',
                    'amount' => 'totals.shipping',
                    'description' => 'Shipping revenue',
                    'skip_zero' => true,
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2300',
                    'amount' => 'totals.tax',
                    'description' => 'Tax liability',
                    'skip_zero' => true,
                ],
                [
                    'type' => 'debit',
                    'account_code' => '5000',
                    'amount' => 'totals.discount',
                    'description' => 'Discount expense',
                    'skip_zero' => true,
                ],
            ],
        ],

        'sales.order_refund' => [
            'description' => 'Order refund or return.',
            'source_type' => 'order',
            'category' => 'sales',
            'memo' => 'Order :order_number refund',
            'source_reference' => 'order_number',
            'lines' => [
                [
                    'type' => 'credit',
                    'account_code' => '1100',
                    'amount' => 'totals.refund_total',
                    'description' => 'Cash refunded',
                ],
                [
                    'type' => 'debit',
                    'account_code' => '4010',
                    'amount' => 'totals.subtotal',
                    'description' => 'Sales returns',
                ],
                [
                    'type' => 'debit',
                    'account_code' => '5000',
                    'amount' => 'totals.fees',
                    'description' => 'Refund fees',
                    'skip_zero' => true,
                ],
                [
                    'type' => 'debit',
                    'account_code' => '2300',
                    'amount' => 'totals.tax',
                    'description' => 'Tax reversal',
                    'skip_zero' => true,
                ],
            ],
        ],

        'pos.sale_paid' => [
            'description' => 'POS sale settlement.',
            'source_type' => 'pos_order',
            'category' => 'sales',
            'memo' => 'POS sale :order_number',
            'source_reference' => 'order_number',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '1100',
                    'amount' => 'totals.receivable',
                    'description' => 'POS cash received',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '4000',
                    'amount' => 'totals.subtotal',
                    'description' => 'POS revenue',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2300',
                    'amount' => 'totals.tax',
                    'description' => 'POS tax liability',
                    'skip_zero' => true,
                ],
            ],
        ],

        'purchase.invoice_posted' => [
            'description' => 'Supplier invoice recorded.',
            'source_type' => 'purchase_invoice',
            'category' => 'purchases',
            'memo' => 'Purchase invoice :invoice_number',
            'source_reference' => 'invoice_number',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '5000',
                    'amount' => 'totals.subtotal',
                    'description' => 'Purchases expense',
                ],
                [
                    'type' => 'debit',
                    'account_code' => '2300',
                    'amount' => 'totals.tax',
                    'description' => 'Input tax credit',
                    'skip_zero' => true,
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2100',
                    'amount' => 'totals.payable',
                    'description' => 'Vendor payable',
                ],
            ],
        ],

        'purchase.grn_received' => [
            'description' => 'Goods receipt accrual.',
            'source_type' => 'purchase_grn',
            'category' => 'purchases',
            'memo' => 'GRN :grn_code received',
            'source_reference' => 'grn_code',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '1300',
                    'amount' => 'totals.subtotal',
                    'description' => 'Inventory received',
                ],
                [
                    'type' => 'debit',
                    'account_code' => '2300',
                    'amount' => 'totals.tax',
                    'description' => 'Recoverable input tax',
                    'skip_zero' => true,
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2150',
                    'amount' => 'totals.payable',
                    'description' => 'Goods received not invoiced',
                ],
            ],
        ],

        'purchase.order_payment' => [
            'description' => 'Immediate payment recorded when a purchase order is approved.',
            'source_type' => 'purchase_order',
            'category' => 'purchases',
            'memo' => 'Purchase order :order_code payment',
            'source_reference' => 'order_code',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '1300',
                    'amount' => 'totals.amount',
                    'description' => 'Inventory advance',
                ],
                [
                    'type' => 'credit',
                    'account_id' => ['context_path' => 'payment_account_id'],
                    'amount' => 'totals.amount',
                    'description' => 'Cash / bank outflow',
                ],
            ],
        ],

        'purchase.return_posted' => [
            'description' => 'Vendor return / debit memo.',
            'source_type' => 'purchase_return',
            'category' => 'purchases',
            'memo' => 'Purchase return :reference_number',
            'source_reference' => 'reference_number',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '2100',
                    'amount' => 'totals.payable',
                    'description' => 'Reduce vendor payable',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '5000',
                    'amount' => 'totals.subtotal',
                    'description' => 'Purchase return',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2300',
                    'amount' => 'totals.tax',
                    'description' => 'Reverse input tax',
                    'skip_zero' => true,
                ],
            ],
        ],

        'purchase.vendor_payment' => [
            'description' => 'Vendor payment disbursement.',
            'source_type' => 'withdraw_request',
            'category' => 'purchases',
            'memo' => 'Vendor payment :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '2100',
                    'amount' => 'totals.payment',
                    'description' => 'Clear vendor payable',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '1100',
                    'amount' => 'totals.payment',
                    'description' => 'Cash / bank outflow',
                ],
            ],
        ],

        'deliveryman.payout' => [
            'description' => 'Deliveryman payout or settlement.',
            'source_type' => 'deliveryman_withdraw',
            'category' => 'operations',
            'memo' => 'Deliveryman payout :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '2500',
                    'amount' => 'totals.payment',
                    'description' => 'Reduce deliveryman payable',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '1100',
                    'amount' => 'totals.payment',
                    'description' => 'Cash / bank outflow',
                ],
            ],
        ],

        'finance.transfer' => [
            'description' => 'Internal transfer between finance accounts.',
            'source_type' => 'finance_transfer',
            'category' => 'treasury',
            'memo' => 'Transfer :transfer_number',
            'source_reference' => 'transfer_number',
            'lines' => [
                [
                    'type' => 'credit',
                    'account_id' => ['context_path' => 'source_account_id'],
                    'amount' => 'totals.amount',
                    'description' => 'Transfer out',
                ],
                [
                    'type' => 'debit',
                    'account_id' => ['context_path' => 'destination_account_id'],
                    'amount' => 'totals.amount',
                    'description' => 'Transfer in',
                ],
            ],
        ],

        'deliveryman.commission_accrual' => [
            'description' => 'Deliveryman commission expense accrued on delivery completion.',
            'source_type' => 'deliveryman_transaction',
            'category' => 'operations',
            'memo' => 'Deliveryman commission :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '5000',
                    'amount' => 'totals.commission',
                    'description' => 'Deliveryman commission expense',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2500',
                    'amount' => 'totals.commission',
                    'description' => 'Accrued deliveryman payable',
                ],
            ],
        ],

        'deliveryman.cash_settlement' => [
            'description' => 'Deliveryman remits collected cash to admin.',
            'source_type' => 'deliveryman_transaction',
            'category' => 'operations',
            'memo' => 'Deliveryman cash settlement :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '1100',
                    'amount' => 'totals.amount',
                    'description' => 'Cash received from deliveryman',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2500',
                    'amount' => 'totals.amount',
                    'description' => 'Reduce deliveryman payable',
                ],
            ],
        ],

        'wallet.top_up' => [
            'description' => 'Customer wallet top-up.',
            'source_type' => 'wallet_transaction',
            'category' => 'wallet',
            'memo' => 'Wallet top-up :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '1100',
                    'amount' => 'totals.received',
                    'description' => 'Funds received',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2400',
                    'amount' => 'totals.received',
                    'description' => 'Wallet liability',
                ],
            ],
        ],

        'wallet.loyalty_conversion' => [
            'description' => 'Loyalty points converted to wallet balance.',
            'source_type' => 'wallet_transaction',
            'category' => 'wallet',
            'memo' => 'Loyalty conversion :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '5000',
                    'amount' => 'totals.converted',
                    'description' => 'Loyalty conversion expense',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2400',
                    'amount' => 'totals.converted',
                    'description' => 'Wallet liability',
                ],
            ],
        ],

        'wallet.manual_credit' => [
            'description' => 'Manual wallet adjustment by admin.',
            'source_type' => 'wallet_transaction',
            'category' => 'wallet',
            'memo' => 'Manual wallet credit :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '5000',
                    'amount' => 'totals.amount',
                    'description' => 'Wallet adjustment expense',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '2400',
                    'amount' => 'totals.amount',
                    'description' => 'Wallet liability',
                ],
            ],
        ],

        'wallet.withdrawal' => [
            'description' => 'Wallet withdrawal or payment.',
            'source_type' => 'wallet_transaction',
            'category' => 'wallet',
            'memo' => 'Wallet payout :reference',
            'source_reference' => 'reference',
            'lines' => [
                [
                    'type' => 'debit',
                    'account_code' => '2400',
                    'amount' => 'totals.spent',
                    'description' => 'Reduce wallet liability',
                ],
                [
                    'type' => 'credit',
                    'account_code' => '1100',
                    'amount' => 'totals.spent',
                    'description' => 'Cash paid out',
                ],
            ],
        ],
    ],
];
