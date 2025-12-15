<?php

namespace App\Services\Purchase;

use App\Models\Purchase\PurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PurchaseOrderPdfBuilder
{
    public function build(PurchaseOrder $order): string
    {
        $order->loadMissing(['vendor', 'items', 'buyer']);

        $pdf = Pdf::loadView('admin-views.purchase.orders.pdf', [
            'order' => $order,
        ]);

        $path = 'purchase-orders/' . $order->code . '-' . now()->timestamp . '.pdf';
        Storage::disk('local')->put($path, $pdf->output());

        return $path;
    }
}
