<?php

namespace App\Policies\Purchase;

use App\Models\Admin;
use App\Models\Purchase\PurchaseOrder;

class PurchaseOrderPolicy
{
    public function viewAny(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function view(Admin $user, PurchaseOrder $order): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function create(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.manage-po');
    }

    public function update(Admin $user, PurchaseOrder $order): bool
    {
        return $this->checkPermission($user, 'purchase.manage-po');
    }

    public function delete(Admin $user, PurchaseOrder $order): bool
    {
        return $this->checkPermission($user, 'purchase.manage-po');
    }

    public function send(Admin $user, PurchaseOrder $order): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    public function approve(Admin $user, PurchaseOrder $order): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    public function reject(Admin $user, PurchaseOrder $order): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    private function checkPermission(Admin $user, string $ability): bool
    {
        return method_exists($user, 'hasPermission') ? $user->hasPermission($ability) : true;
    }
}
