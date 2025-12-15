<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseInvoice;

class InvoiceMatchingService
{
    public function evaluate(PurchaseInvoice $invoice): array
    {
        $invoice->loadMissing([
            'order',
            'grn.items.orderItem',
            'items.orderItem',
        ]);

        $orderTotal = (float) ($invoice->order?->grand_total ?? 0);
        $grnTotal = $this->calculateGrnTotal($invoice);
        $invoiceTotal = (float) $invoice->grand_total;

        $baseline = $grnTotal > 0 ? $grnTotal : $orderTotal;
        $variance = $baseline > 0 ? abs($invoiceTotal - $baseline) : $invoiceTotal;
        $amountTolerance = (float) config('purchase.matching.amount_tolerance', 0.0);
        $percentTolerance = (float) config('purchase.matching.percent_tolerance', 0.0);
        $percentVariance = $baseline > 0 ? round(($variance / $baseline) * 100, 4) : 0.0;

        $status = 'pending';
        if ($baseline <= 0) {
            $status = 'pending';
        } elseif ($variance <= $amountTolerance && $percentVariance <= $percentTolerance) {
            $status = 'matched';
        } else {
            $status = 'mismatch';
        }

        return [
            'status' => $status,
            'variance' => round($variance, 4),
            'baseline' => round($baseline, 4),
            'details' => [
                'po_total' => round($orderTotal, 4),
                'grn_total' => round($grnTotal, 4),
                'invoice_total' => round($invoiceTotal, 4),
                'percent_variance' => $percentVariance,
                'tolerance_amount' => $amountTolerance,
                'tolerance_percent' => $percentTolerance,
            ],
        ];
    }

    private function calculateGrnTotal(PurchaseInvoice $invoice): float
    {
        $grn = $invoice->grn;
        if (! $grn) {
            return 0.0;
        }

        $grn->loadMissing('items.orderItem');
        return (float) $grn->items->sum(function ($item) {
            $unitPrice = (float) ($item->orderItem?->unit_price ?? 0);
            $accepted = (float) ($item->accepted_qty ?? $item->received_qty ?? 0);
            return round($accepted * $unitPrice, 4);
        });
    }
}
