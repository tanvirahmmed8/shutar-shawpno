<?php

namespace App\Policies\Purchase;

use App\Models\Admin;
use App\Models\Purchase\PurchaseInvoice;

class PurchaseInvoicePolicy
{
    public function viewAny(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function view(Admin $user, PurchaseInvoice $invoice): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function create(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.manage-invoice');
    }

    public function update(Admin $user, PurchaseInvoice $invoice): bool
    {
        return $this->checkPermission($user, 'purchase.manage-invoice');
    }

    public function delete(Admin $user, PurchaseInvoice $invoice): bool
    {
        return $this->checkPermission($user, 'purchase.manage-invoice');
    }

    private function checkPermission(Admin $user, string $ability): bool
    {
        return method_exists($user, 'hasPermission') ? $user->hasPermission($ability) : true;
    }
}
