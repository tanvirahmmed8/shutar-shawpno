<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseApprovalStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'step_order',
        'approver_id',
        'fallback_role',
        'threshold_amount',
        'auto_approve',
        'escalate_after_hours',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'route_id' => 'integer',
        'step_order' => 'integer',
        'approver_id' => 'integer',
        'threshold_amount' => 'float',
        'auto_approve' => 'boolean',
        'escalate_after_hours' => 'integer',
    ];

    public function route(): BelongsTo
    {
        return $this->belongsTo(PurchaseApprovalRoute::class, 'route_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approver_id');
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
