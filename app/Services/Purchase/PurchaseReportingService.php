<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseInvoice;
use App\Models\Purchase\PurchaseOrder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseReportingService
{
    public function pipelineSummary(array $filters = []): array
    {
        $query = PurchaseOrder::query();
        $this->applyOrderFilters($query, $filters);

        $statusRows = (clone $query)
            ->select('status', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(grand_total) as total_amount'))
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $slaRows = PurchaseOrder::query()
            ->select(
                DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, approved_at)) as avg_hours_to_approve'),
                DB::raw('AVG(TIMESTAMPDIFF(HOUR, approved_at, sent_at)) as avg_hours_to_send')
            )
            ->first();

        return [
            'statuses' => $statusRows->map(function ($row) {
                return [
                    'status' => $row->status,
                    'count' => (int) $row->total_orders,
                    'amount' => (float) $row->total_amount,
                ];
            }),
            'sla' => [
                'hours_to_approve' => $slaRows?->avg_hours_to_approve ? round((float) $slaRows->avg_hours_to_approve, 2) : null,
                'hours_to_send' => $slaRows?->avg_hours_to_send ? round((float) $slaRows->avg_hours_to_send, 2) : null,
            ],
        ];
    }

    public function spendAnalysis(array $filters = []): array
    {
        $orderQuery = PurchaseOrder::query();
        $this->applyOrderFilters($orderQuery, $filters);

        $topVendors = (clone $orderQuery)
            ->select('vendor_id', DB::raw('SUM(grand_total) as total_spend'))
            ->whereNotNull('vendor_id')
            ->groupBy('vendor_id')
            ->orderByDesc('total_spend')
            ->with('vendor:id,display_name')
            ->limit(10)
            ->get()
            ->map(function ($row) {
                return [
                    'vendor_id' => $row->vendor_id,
                    'vendor_name' => $row->vendor?->display_name,
                    'total' => (float) $row->total_spend,
                ];
            });

        $monthly = PurchaseOrder::query()
            ->select(
                DB::raw("DATE_FORMAT(approved_at, '%Y-%m') as month"),
                DB::raw('SUM(grand_total) as total_spend')
            )
            ->whereNotNull('approved_at')
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get()
            ->map(fn($row) => ['month' => $row->month, 'total' => (float) $row->total_spend]);

        return [
            'top_vendors' => $topVendors,
            'monthly' => $monthly,
        ];
    }

    public function inboundQuality(array $filters = []): array
    {
        $grnQuery = PurchaseGrn::query()->with('order.vendor');
        if (! empty($filters['vendor_id'])) {
            $grnQuery->whereHas('order', fn(Builder $q) => $q->where('vendor_id', $filters['vendor_id']));
        }
        if (! empty($filters['date_from'])) {
            $grnQuery->whereDate('received_at', '>=', $filters['date_from']);
        }
        if (! empty($filters['date_to'])) {
            $grnQuery->whereDate('received_at', '<=', $filters['date_to']);
        }

        $totals = (clone $grnQuery)
            ->join('purchase_grn_items', 'purchase_grn_items.grn_id', '=', 'purchase_grns.id')
            ->select(
                DB::raw('SUM(purchase_grn_items.accepted_qty) as accepted'),
                DB::raw('SUM(purchase_grn_items.rejected_qty) as rejected')
            )
            ->first();

        $vendors = PurchaseGrn::query()
            ->join('purchase_grn_items', 'purchase_grn_items.grn_id', '=', 'purchase_grns.id')
            ->join('purchase_orders', 'purchase_orders.id', '=', 'purchase_grns.order_id')
            ->join('purchase_vendors', 'purchase_vendors.id', '=', 'purchase_orders.vendor_id')
            ->select(
                'purchase_vendors.id as vendor_id',
                'purchase_vendors.display_name',
                DB::raw('SUM(purchase_grn_items.rejected_qty) as total_rejected')
            )
            ->groupBy('purchase_vendors.id', 'purchase_vendors.display_name')
            ->orderByDesc('total_rejected')
            ->limit(10)
            ->get()
            ->map(fn($row) => [
                'vendor_id' => $row->vendor_id,
                'vendor_name' => $row->display_name,
                'rejected_qty' => (float) $row->total_rejected,
            ]);

        return [
            'accepted_qty' => (float) ($totals?->accepted ?? 0),
            'rejected_qty' => (float) ($totals?->rejected ?? 0),
            'top_rejections' => $vendors,
        ];
    }

    public function invoiceMatching(array $filters = []): array
    {
        $query = PurchaseInvoice::query();
        $this->applyInvoiceFilters($query, $filters);

        $statusCounts = (clone $query)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get()
            ->map(fn($row) => ['status' => $row->status, 'count' => (int) $row->total]);

        $matchCounts = PurchaseInvoice::query()
            ->select('match_status', DB::raw('COUNT(*) as total'))
            ->groupBy('match_status')
            ->get()
            ->map(fn($row) => ['match_status' => $row->match_status, 'count' => (int) $row->total]);

        $varianceTotal = PurchaseInvoice::query()
            ->where('match_status', 'mismatch')
            ->sum('match_variance');

        return [
            'statuses' => $statusCounts,
            'matching' => $matchCounts,
            'variance_value' => (float) $varianceTotal,
        ];
    }

    public function overdueDeliveries(array $filters = [], int $slaDays = 0)
    {
        $today = Carbon::today();
        $query = PurchaseOrder::query()
            ->with(['vendor:id,display_name', 'buyer:id,name'])
            ->where(function (Builder $builder) use ($today, $slaDays) {
                $builder->whereNotNull('expected_delivery')
                    ->whereDate('expected_delivery', '<', $today);
                if ($slaDays > 0) {
                    $builder->orWhere(function (Builder $sub) use ($slaDays) {
                        $cutoff = Carbon::now()->subDays($slaDays);
                        $sub->whereNull('last_receipt_at')
                            ->whereDate('approved_at', '<', $cutoff);
                    });
                }
            })
            ->where(fn(Builder $q) => $q->whereNull('receiving_status')->orWhere('receiving_status', '!=', 'complete'))
            ->orderBy('expected_delivery');

        $this->applyOrderFilters($query, $filters);

        return $query->limit(50)->get()->map(function (PurchaseOrder $order) use ($today) {
            $daysOverdue = $order->expected_delivery ? Carbon::parse($order->expected_delivery)->diffInDays($today) : null;
            return [
                'order_id' => $order->id,
                'code' => $order->code,
                'vendor' => $order->vendor?->display_name,
                'buyer' => $order->buyer?->name,
                'expected_delivery' => $order->expected_delivery,
                'days_overdue' => $daysOverdue,
            ];
        });
    }

    public function unmatchedInvoices(array $filters = [], int $pendingThresholdDays = 3)
    {
        $threshold = Carbon::now()->subDays($pendingThresholdDays);
        $query = PurchaseInvoice::with(['vendor', 'order:id,code'])
            ->where(function (Builder $builder) use ($threshold) {
                $builder->where('match_status', 'mismatch')
                    ->orWhere(function (Builder $sub) use ($threshold) {
                        $sub->where('match_status', 'pending')
                            ->whereDate('created_at', '<=', $threshold);
                    });
            });

        $this->applyInvoiceFilters($query, $filters);

        return $query->orderByDesc('created_at')
            ->limit(50)
            ->get()
            ->map(function (PurchaseInvoice $invoice) {
                return [
                    'invoice_id' => $invoice->id,
                    'code' => $invoice->code,
                    'status' => $invoice->status,
                    'match_status' => $invoice->match_status,
                    'vendor' => $invoice->vendor?->name,
                    'order_code' => $invoice->order?->code,
                    'match_variance' => (float) $invoice->match_variance,
                    'created_at' => $invoice->created_at,
                ];
            });
    }

    public function stalledApprovals(array $filters = [], int $thresholdDays = 3)
    {
        $threshold = Carbon::now()->subDays($thresholdDays);
        $orders = PurchaseOrder::with(['buyer:id,name', 'vendor:id,display_name'])
            ->where('status', 'pending_approval')
            ->whereDate('created_at', '<=', $threshold);

        $this->applyOrderFilters($orders, $filters);

        return $orders->limit(50)->get()->map(function (PurchaseOrder $order) use ($threshold) {
            return [
                'order_id' => $order->id,
                'code' => $order->code,
                'vendor' => $order->vendor?->display_name,
                'buyer' => $order->buyer?->name,
                'age_days' => Carbon::parse($order->created_at)->diffInDays(Carbon::now()),
            ];
        });
    }

    private function applyOrderFilters(Builder $query, array $filters): void
    {
        if (! empty($filters['vendor_id'])) {
            $query->where('vendor_id', $filters['vendor_id']);
        }
        if (! empty($filters['buyer_id'])) {
            $query->where('buyer_id', $filters['buyer_id']);
        }
        if (! empty($filters['status'])) {
            $query->whereIn('status', (array) $filters['status']);
        }
        if (! empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }
        if (! empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }
    }

    private function applyInvoiceFilters(Builder $query, array $filters): void
    {
        if (! empty($filters['vendor_id'])) {
            $query->where('vendor_id', $filters['vendor_id']);
        }
        if (! empty($filters['status'])) {
            $query->whereIn('status', (array) $filters['status']);
        }
        if (! empty($filters['match_status'])) {
            $query->whereIn('match_status', (array) $filters['match_status']);
        }
        if (! empty($filters['date_from'])) {
            $query->whereDate('invoice_date', '>=', $filters['date_from']);
        }
        if (! empty($filters['date_to'])) {
            $query->whereDate('invoice_date', '<=', $filters['date_to']);
        }
    }
}
