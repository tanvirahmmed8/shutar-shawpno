<?php

namespace App\Models\Inventory;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryLotAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lot_id',
        'order_detail_id',
        'product_id',
        'quantity',
        'unit_purchase_price',
        'unit_sale_price',
        'profit_amount',
        'released_at',
        'metadata',
    ];

    protected $casts = [
        'lot_id' => 'integer',
        'order_detail_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'float',
        'unit_purchase_price' => 'float',
        'unit_sale_price' => 'float',
        'profit_amount' => 'float',
        'released_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function lot(): BelongsTo
    {
        return $this->belongsTo(InventoryLot::class, 'lot_id');
    }

    public function orderDetail(): BelongsTo
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
