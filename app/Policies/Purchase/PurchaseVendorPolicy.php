<?php

namespace App\Policies\Purchase;

use App\Models\Admin;
use App\Models\Purchase\PurchaseVendor;

class PurchaseVendorPolicy
{
    public function viewAny(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.manage-vendor');
    }

    public function view(Admin $user, PurchaseVendor $vendor): bool
    {
        return $this->checkPermission($user, 'purchase.manage-vendor');
    }

    public function create(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.manage-vendor');
    }

    public function update(Admin $user, PurchaseVendor $vendor): bool
    {
        return $this->checkPermission($user, 'purchase.manage-vendor');
    }

    public function delete(Admin $user, PurchaseVendor $vendor): bool
    {
        return $this->checkPermission($user, 'purchase.manage-vendor');
    }

    private function checkPermission(Admin $user, string $ability): bool
    {
        return method_exists($user, 'hasPermission') ? $user->hasPermission($ability) : true;
    }
}
