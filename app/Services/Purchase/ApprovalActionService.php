<?php

namespace App\Services\Purchase;

use App\Jobs\Purchase\DispatchRequisitionApprovalNotification;
use App\Models\Purchase\PurchaseApprovalRoute;
use App\Models\Purchase\PurchaseOrderApproval;
use App\Models\Purchase\PurchaseRequisition;
use Illuminate\Support\Facades\DB;

class ApprovalActionService
{
    public function bootstrapApprovals(PurchaseRequisition $requisition, PurchaseApprovalRoute $route): void
    {
        DB::transaction(function () use ($requisition, $route) {
            $requisition->forceFill([
                'approval_route_id' => $route->id,
                'status' => 'pending_approval',
                'approved_at' => null,
                'rejected_reason' => null,
            ])->save();

            $requisition->approvals()->delete();

            foreach ($route->steps as $step) {
                $requisition->approvals()->create([
                    'step' => $step->step_order,
                    'approver_id' => $step->approver_id,
                    'status' => 'pending',
                ]);
            }

            $this->notifyNextApprover($requisition);
        });
    }

    public function approve(PurchaseRequisition $requisition, PurchaseOrderApproval $approval, ?string $comments = null, ?int $actorId = null): void
    {
        $actor = $actorId ?: auth('admin')->id();

        $approval->forceFill([
            'status' => 'approved',
            'acted_at' => now(),
            'comments' => $comments,
            'approver_id' => $approval->approver_id ?: $actor,
        ])->save();

        if (! $requisition->approvals()->where('status', 'pending')->exists()) {
            $requisition->forceFill([
                'status' => 'approved',
                'approved_at' => now(),
            ])->save();
            DispatchRequisitionApprovalNotification::dispatch($requisition, null, 'requisition_fully_approved');
        } else {
            $this->notifyNextApprover($requisition);
        }
    }

    public function reject(PurchaseRequisition $requisition, PurchaseOrderApproval $approval, ?string $comments = null, ?int $actorId = null): void
    {
        $actor = $actorId ?: auth('admin')->id();

        $requisition->forceFill([
            'status' => 'rejected',
            'rejected_reason' => $comments,
        ])->save();

        $approval->forceFill([
            'status' => 'rejected',
            'acted_at' => now(),
            'comments' => $comments,
            'approver_id' => $approval->approver_id ?: $actor,
        ])->save();

        DispatchRequisitionApprovalNotification::dispatch($requisition, null, 'requisition_rejected');
    }

    private function notifyNextApprover(PurchaseRequisition $requisition): void
    {
        $nextApproval = $requisition->approvals()
            ->where('status', 'pending')
            ->orderBy('step')
            ->first();

        if ($nextApproval) {
            DispatchRequisitionApprovalNotification::dispatch($requisition, $nextApproval->approver_id, 'approval_pending');
        } else {
            DispatchRequisitionApprovalNotification::dispatch($requisition, null, 'requisition_fully_approved');
        }
    }
}
