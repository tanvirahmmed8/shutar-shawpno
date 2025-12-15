<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseVendorContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'role',
        'email',
        'phone',
        'is_primary',
        'preferred_channel',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'vendor_id' => 'integer',
        'is_primary' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(PurchaseVendor::class, 'vendor_id');
    }
}
