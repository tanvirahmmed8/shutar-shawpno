<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseGrnReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_id',
        'grn_item_id',
        'return_qty',
        'disposition',
        'restock_decision',
        'remarks',
    ];

    protected $casts = [
        'return_id' => 'integer',
        'grn_item_id' => 'integer',
        'return_qty' => 'float',
    ];

    public function grnReturn(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrnReturn::class, 'return_id');
    }

    public function grnItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrnItem::class, 'grn_item_id');
    }
}
