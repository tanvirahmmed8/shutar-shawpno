<?php

namespace App\Providers;

use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseInvoice;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Purchase\PurchaseVendor;
use App\Models\Purchase\PurchaseRequisition;
use App\Policies\Purchase\PurchaseGrnPolicy;
use App\Policies\Purchase\PurchaseInvoicePolicy;
use App\Policies\Purchase\PurchaseOrderPolicy;
use App\Policies\Purchase\PurchaseVendorPolicy;
use App\Policies\Purchase\PurchaseRequisitionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        PurchaseRequisition::class => PurchaseRequisitionPolicy::class,
        PurchaseOrder::class => PurchaseOrderPolicy::class,
        PurchaseVendor::class => PurchaseVendorPolicy::class,
        PurchaseInvoice::class => PurchaseInvoicePolicy::class,
        PurchaseGrn::class => PurchaseGrnPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
