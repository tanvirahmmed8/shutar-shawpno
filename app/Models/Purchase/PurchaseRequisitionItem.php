<?php

namespace App\Models\Purchase;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseRequisitionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'product_id',
        'description',
        'uom',
        'quantity',
        'unit_price',
        'line_total',
        'delivery_date',
        'metadata',
    ];

    protected $casts = [
        'requisition_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'float',
        'unit_price' => 'float',
        'line_total' => 'float',
        'delivery_date' => 'date',
        'metadata' => 'array',
    ];

    public function requisition(): BelongsTo
    {
        return $this->belongsTo(PurchaseRequisition::class, 'requisition_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
