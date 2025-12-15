<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseVendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'display_name',
        'legal_name',
        'vendor_type',
        'category',
        'website',
        'primary_email',
        'primary_phone',
        'payment_terms',
        'incoterm',
        'currency',
        'lead_time_days',
        'min_order_value',
        'tax_id',
        'rating',
        'status',
        'tags',
        'attributes',
        'contract_expires_at',
        'compliance_status',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'lead_time_days' => 'integer',
        'min_order_value' => 'float',
        'rating' => 'float',
        'tags' => 'array',
        'attributes' => 'array',
        'contract_expires_at' => 'date',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function contacts(): HasMany
    {
        return $this->hasMany(PurchaseVendorContact::class, 'vendor_id');
    }

    public function primaryContact(): HasOne
    {
        return $this->hasOne(PurchaseVendorContact::class, 'vendor_id')
            ->where('is_primary', true);
    }

    public function metrics(): HasOne
    {
        return $this->hasOne(PurchaseVendorMetric::class, 'vendor_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(PurchaseDocument::class, 'documentable');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
