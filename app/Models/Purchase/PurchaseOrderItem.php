<?php

namespace App\Models\Purchase;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'requisition_item_id',
        'product_id',
        'description',
        'uom',
        'quantity',
        'received_qty',
        'outstanding_qty',
        'unit_price',
        'tax_percent',
        'tax_amount',
        'discount_percent',
        'discount_amount',
        'line_total',
        'metadata',
    ];

    protected $casts = [
        'order_id' => 'integer',
        'requisition_item_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'float',
        'received_qty' => 'float',
        'outstanding_qty' => 'float',
        'unit_price' => 'float',
        'tax_percent' => 'float',
        'tax_amount' => 'float',
        'discount_percent' => 'float',
        'discount_amount' => 'float',
        'line_total' => 'float',
        'metadata' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'order_id');
    }

    public function requisitionItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseRequisitionItem::class, 'requisition_item_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function grnItems(): HasMany
    {
        return $this->hasMany(PurchaseGrnItem::class, 'order_item_id');
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(PurchaseInvoiceItem::class, 'order_item_id');
    }
}
