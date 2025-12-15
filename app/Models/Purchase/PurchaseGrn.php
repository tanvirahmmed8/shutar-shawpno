<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use App\Models\Finance\FinanceJournal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PurchaseGrn extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'order_id',
        'warehouse_id',
        'received_by',
        'checked_by',
        'status',
        'received_at',
        'remarks',
        'rejection_reason',
        'reviewed_at',
        'approved_at',
        'delivered_at',
        'inspection_score',
        'carrier',
        'return_reference',
        'attachments_count',
        'inventory_sync_status',
        'inventory_sync_payload',
        'inventory_synced_at',
        'finance_journal_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'order_id' => 'integer',
        'warehouse_id' => 'integer',
        'received_by' => 'integer',
        'checked_by' => 'integer',
        'received_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'approved_at' => 'datetime',
        'delivered_at' => 'datetime',
        'inventory_synced_at' => 'datetime',
        'inspection_score' => 'float',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'attachments_count' => 'integer',
        'inventory_sync_payload' => 'array',
        'finance_journal_id' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'order_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'received_by');
    }

    public function checker(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'checked_by');
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
        return $this->hasMany(PurchaseGrnItem::class, 'grn_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(PurchaseDocument::class, 'documentable');
    }

    public function events(): HasMany
    {
        return $this->hasMany(PurchaseGrnEvent::class, 'grn_id');
    }

    public function returns(): HasMany
    {
        return $this->hasMany(PurchaseGrnReturn::class, 'grn_id');
    }

    public function financeJournal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'finance_journal_id');
    }
}
