<?php

namespace App\Models\Inventory;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnItem;
use App\Models\Purchase\PurchaseOrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryLot extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'source_type',
        'source_id',
        'grn_id',
        'grn_item_id',
        'order_item_id',
        'lot_number',
        'batch_number',
        'purchased_at',
        'quantity_received',
        'quantity_available',
        'unit_purchase_price',
        'currency',
        'metadata',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'source_id' => 'integer',
        'grn_id' => 'integer',
        'grn_item_id' => 'integer',
        'order_item_id' => 'integer',
        'quantity_received' => 'float',
        'quantity_available' => 'float',
        'unit_purchase_price' => 'float',
        'purchased_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function grn(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrn::class, 'grn_id');
    }

    public function grnItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrnItem::class, 'grn_item_id');
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'order_item_id');
    }

    public function allocations(): HasMany
    {
        return $this->hasMany(InventoryLotAllocation::class, 'lot_id');
    }
}
