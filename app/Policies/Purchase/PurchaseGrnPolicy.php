<?php

namespace App\Policies\Purchase;

use App\Models\Admin;
use App\Models\Purchase\PurchaseGrn;

class PurchaseGrnPolicy
{
    public function viewAny(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function view(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function create(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    public function update(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    public function delete(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    public function approve(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    public function reject(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    public function markReturned(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    public function retryInventory(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    public function initiateReturn(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    public function updateReturn(Admin $user, PurchaseGrn $grn): bool
    {
        return $this->checkPermission($user, 'purchase.manage-grn');
    }

    private function checkPermission(Admin $user, string $ability): bool
    {
        return method_exists($user, 'hasPermission') ? $user->hasPermission($ability) : true;
    }
}
