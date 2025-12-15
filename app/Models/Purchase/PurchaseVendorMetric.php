<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseVendorMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'total_po_count',
        'total_spend',
        'on_time_percent',
        'quality_score',
        'rejection_rate',
        'last_po_date',
        'metadata',
    ];

    protected $casts = [
        'vendor_id' => 'integer',
        'total_po_count' => 'integer',
        'total_spend' => 'float',
        'on_time_percent' => 'float',
        'quality_score' => 'float',
        'rejection_rate' => 'float',
        'last_po_date' => 'datetime',
        'metadata' => 'array',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(PurchaseVendor::class, 'vendor_id');
    }
}
