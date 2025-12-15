<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'order_item_id',
        'grn_item_id',
        'description',
        'quantity',
        'unit_price',
        'tax_amount',
        'discount_amount',
        'line_total',
    ];

    protected $casts = [
        'invoice_id' => 'integer',
        'order_item_id' => 'integer',
        'grn_item_id' => 'integer',
        'quantity' => 'float',
        'unit_price' => 'float',
        'tax_amount' => 'float',
        'discount_amount' => 'float',
        'line_total' => 'float',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(PurchaseInvoice::class, 'invoice_id');
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'order_item_id');
    }

    public function grnItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrnItem::class, 'grn_item_id');
    }
}
