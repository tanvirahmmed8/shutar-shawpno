<?php

namespace App\Policies\Purchase;

use App\Models\Admin;
use App\Models\Purchase\PurchaseRequisition;

class PurchaseRequisitionPolicy
{
    public function viewAny(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function view(Admin $user, PurchaseRequisition $requisition): bool
    {
        return $this->checkPermission($user, 'purchase.view');
    }

    public function create(Admin $user): bool
    {
        return $this->checkPermission($user, 'purchase.manage-requisition');
    }

    public function update(Admin $user, PurchaseRequisition $requisition): bool
    {
        return $this->checkPermission($user, 'purchase.manage-requisition');
    }

    public function delete(Admin $user, PurchaseRequisition $requisition): bool
    {
        return $this->checkPermission($user, 'purchase.manage-requisition');
    }

    public function submit(Admin $user, PurchaseRequisition $requisition): bool
    {
        return $this->checkPermission($user, 'purchase.manage-requisition');
    }

    public function approve(Admin $user, PurchaseRequisition $requisition): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    public function reject(Admin $user, PurchaseRequisition $requisition): bool
    {
        return $this->checkPermission($user, 'purchase.approve');
    }

    private function checkPermission(Admin $user, string $ability): bool
    {
        return method_exists($user, 'hasPermission') ? $user->hasPermission($ability) : true;
    }
}
