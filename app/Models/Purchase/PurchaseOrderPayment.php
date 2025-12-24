<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use App\Models\Finance\FinanceJournal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'amount',
        'currency',
        'payment_method',
        'payment_account_key',
        'payment_account',
        'payment_account_code',
        'finance_account_id',
        'finance_journal_id',
        'paid_at',
        'paid_by',
        'notes',
    ];

    protected $casts = [
        'purchase_order_id' => 'integer',
        'amount' => 'float',
        'finance_account_id' => 'integer',
        'finance_journal_id' => 'integer',
        'paid_at' => 'datetime',
        'paid_by' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    public function financeJournal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'finance_journal_id');
    }

    public function payer(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'paid_by');
    }
}
