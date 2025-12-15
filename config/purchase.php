<?php

return [
    'enabled' => (bool) env('FEATURE_PURCHASE_MODULE', false),
    'module_key' => 'purchase_management',
    'matching' => [
        'amount_tolerance' => (float) env('PURCHASE_MATCH_TOLERANCE_AMOUNT', 0.00),
        'percent_tolerance' => (float) env('PURCHASE_MATCH_TOLERANCE_PERCENT', 0.0),
    ],
    'permissions' => [
        [
            'key' => 'purchase.view',
            'label' => 'purchase_workspace_access',
        ],
        [
            'key' => 'purchase.manage-requisition',
            'label' => 'purchase_requisition_access',
        ],
        [
            'key' => 'purchase.manage-po',
            'label' => 'purchase_order_access',
        ],
        [
            'key' => 'purchase.manage-invoice',
            'label' => 'purchase_invoice_access',
        ],
        [
            'key' => 'purchase.manage-vendor',
            'label' => 'purchase_vendor_access',
        ],
        [
            'key' => 'purchase.approve',
            'label' => 'purchase_approval_access',
        ],
        [
            'key' => 'purchase.manage-grn',
            'label' => 'purchase_grn_access',
        ],
        [
            'key' => 'purchase.view-reports',
            'label' => 'purchase_reports_access',
        ],
    ],
];
