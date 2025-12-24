<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use App\Models\Finance\FinanceJournal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'requisition_id',
        'vendor_id',
        'buyer_id',
        'approval_route_id',
        'currency',
        'exchange_rate',
        'status',
        'payment_terms',
        'payment_method',
        'payment_account_key',
        'payment_account',
        'payment_account_code',
        'freight_cost',
        'tax_total',
        'subtotal',
        'discount_total',
        'grand_total',
        'paid_total',
        'expected_delivery',
        'notes_internal',
        'notes_vendor',
        'receiving_status',
        'received_percent',
        'sent_at',
        'last_receipt_at',
        'approved_at',
        'closed_at',
        'finance_journal_id',
        'payment_status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'requisition_id' => 'integer',
        'vendor_id' => 'integer',
        'buyer_id' => 'integer',
        'approval_route_id' => 'integer',
        'exchange_rate' => 'float',
        'freight_cost' => 'float',
        'tax_total' => 'float',
        'subtotal' => 'float',
        'discount_total' => 'float',
        'grand_total' => 'float',
        'paid_total' => 'float',
        'received_percent' => 'float',
        'expected_delivery' => 'date',
        'sent_at' => 'datetime',
        'last_receipt_at' => 'datetime',
        'approved_at' => 'datetime',
        'closed_at' => 'datetime',
        'paid_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'finance_journal_id' => 'integer',
    ];

    public function requisition(): BelongsTo
    {
        return $this->belongsTo(PurchaseRequisition::class, 'requisition_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(PurchaseVendor::class, 'vendor_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'buyer_id');
    }

    public function approvalRoute(): BelongsTo
    {
        return $this->belongsTo(PurchaseApprovalRoute::class, 'approval_route_id');
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
        return $this->hasMany(PurchaseOrderItem::class, 'order_id');
    }

    public function communications(): HasMany
    {
        return $this->hasMany(PurchaseOrderCommunication::class, 'order_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(PurchaseOrderPayment::class, 'purchase_order_id');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(PurchaseDocument::class, 'documentable');
    }

    public function approvals(): MorphMany
    {
        return $this->morphMany(PurchaseOrderApproval::class, 'approvable');
    }

    public function grns(): HasMany
    {
        return $this->hasMany(PurchaseGrn::class, 'order_id');
    }

    public function grnReturns(): HasMany
    {
        return $this->hasMany(PurchaseGrnReturn::class, 'order_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(PurchaseInvoice::class, 'order_id');
    }

    public function financeJournal(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Finance\FinanceJournal::class, 'finance_journal_id');
    }
}
