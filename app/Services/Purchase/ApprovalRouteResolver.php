<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseApprovalRoute;
use App\Models\Purchase\PurchaseRequisition;

class ApprovalRouteResolver
{
    public function resolveForRequisition(PurchaseRequisition $requisition): ?PurchaseApprovalRoute
    {
        $routes = PurchaseApprovalRoute::query()
            ->where('is_active', true)
            ->with('steps')
            ->orderByDesc('priority')
            ->get();

        foreach ($routes as $route) {
            $conditions = $route->conditions ?? [];
            if ($this->matchesConditions($requisition, $conditions)) {
                return $route;
            }
        }

        return null;
    }

    private function matchesConditions(PurchaseRequisition $requisition, array $conditions): bool
    {
        $minTotal = data_get($conditions, 'min_total');
        if ($minTotal !== null && (float) $requisition->grand_total < (float) $minTotal) {
            return false;
        }

        $maxTotal = data_get($conditions, 'max_total');
        if ($maxTotal !== null && (float) $requisition->grand_total > (float) $maxTotal) {
            return false;
        }

        $allowedPriorities = data_get($conditions, 'priorities');
        if (is_array($allowedPriorities) && ! in_array($requisition->priority, $allowedPriorities, true)) {
            return false;
        }

        return true;
    }
}
