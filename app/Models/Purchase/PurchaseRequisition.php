<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequisition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'requester_id',
        'cost_center_id',
        'priority',
        'status',
        'needed_by',
        'justification',
        'currency',
        'subtotal',
        'tax_total',
        'grand_total',
        'approval_route_id',
        'approved_at',
        'rejected_reason',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'requester_id' => 'integer',
        'cost_center_id' => 'integer',
        'needed_by' => 'date',
        'subtotal' => 'float',
        'tax_total' => 'float',
        'grand_total' => 'float',
        'approval_route_id' => 'integer',
        'approved_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'requester_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseRequisitionItem::class, 'requisition_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(PurchaseDocument::class, 'documentable');
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(PurchaseOrderApproval::class, 'approvable')->orderBy('step');
    }

    public function approvalRoute(): BelongsTo
    {
        return $this->belongsTo(PurchaseApprovalRoute::class, 'approval_route_id');
    }
}
