<?php

namespace App\Models\Purchase;

use App\Models\Inventory\InventoryLot;
use App\Models\Product;
use App\Models\Purchase\PurchaseGrnReturnItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseGrnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'order_item_id',
        'product_id',
        'uom',
        'batch_number',
        'lot_number',
        'expiry_date',
        'received_qty',
        'accepted_qty',
        'rejected_qty',
        'storage_location',
        'serial_numbers',
        'metadata',
        'remarks',
        'inspection_notes',
    ];

    protected $casts = [
        'grn_id' => 'integer',
        'order_item_id' => 'integer',
        'product_id' => 'integer',
        'expiry_date' => 'date',
        'received_qty' => 'float',
        'accepted_qty' => 'float',
        'rejected_qty' => 'float',
        'serial_numbers' => 'array',
        'metadata' => 'array',
    ];

    public function grn(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrn::class, 'grn_id');
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrderItem::class, 'order_item_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function returnItems(): HasMany
    {
        return $this->hasMany(PurchaseGrnReturnItem::class, 'grn_item_id');
    }

    public function inventoryLots(): HasMany
    {
        return $this->hasMany(InventoryLot::class, 'grn_item_id');
    }
}
