<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PurchaseOrderApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'approvable_type',
        'approvable_id',
        'step',
        'approver_id',
        'status',
        'acted_at',
        'comments',
        'delegated_to',
    ];

    protected $casts = [
        'step' => 'integer',
        'approver_id' => 'integer',
        'acted_at' => 'datetime',
        'delegated_to' => 'integer',
    ];

    public function approvable(): MorphTo
    {
        return $this->morphTo();
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approver_id');
    }

    public function delegate(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'delegated_to');
    }
}
