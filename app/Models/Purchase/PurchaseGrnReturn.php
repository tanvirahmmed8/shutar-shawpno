<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use App\Models\Finance\FinanceJournal;
use App\Models\Purchase\PurchaseDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PurchaseGrnReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'order_id',
        'vendor_id',
        'initiated_by',
        'status',
        'carrier',
        'tracking_number',
        'return_reason',
        'notes',
        'shipped_at',
        'closed_at',
        'finance_journal_id',
    ];

    protected $casts = [
        'grn_id' => 'integer',
        'order_id' => 'integer',
        'vendor_id' => 'integer',
        'initiated_by' => 'integer',
        'shipped_at' => 'datetime',
        'closed_at' => 'datetime',
        'finance_journal_id' => 'integer',
    ];

    public function grn(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrn::class, 'grn_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'order_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(PurchaseVendor::class, 'vendor_id');
    }

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'initiated_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseGrnReturnItem::class, 'return_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(PurchaseDocument::class, 'documentable');
    }

    public function financeJournal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'finance_journal_id');
    }
}
