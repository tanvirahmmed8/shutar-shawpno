<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use App\Models\Finance\FinanceJournal;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PurchaseInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'vendor_id',
        'order_id',
        'grn_id',
        'status',
        'invoice_number',
        'invoice_date',
        'due_date',
        'currency',
        'exchange_rate',
        'subtotal',
        'tax_total',
        'discount_total',
        'freight_total',
        'grand_total',
        'match_status',
        'match_variance',
        'approved_by',
        'approved_at',
        'notes',
        'finance_journal_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'vendor_id' => 'integer',
        'order_id' => 'integer',
        'grn_id' => 'integer',
        'invoice_date' => 'date',
        'due_date' => 'date',
        'exchange_rate' => 'float',
        'subtotal' => 'float',
        'tax_total' => 'float',
        'discount_total' => 'float',
        'freight_total' => 'float',
        'grand_total' => 'float',
        'match_variance' => 'float',
        'approved_by' => 'integer',
        'approved_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'finance_journal_id' => 'integer',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'vendor_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'order_id');
    }

    public function grn(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrn::class, 'grn_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approved_by');
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
        return $this->hasMany(PurchaseInvoiceItem::class, 'invoice_id');
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
