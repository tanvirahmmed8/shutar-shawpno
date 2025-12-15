<?php

namespace App\Models\Finance;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceExpense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expense_number',
        'account_id',
        'category',
        'payee_type',
        'payee_id',
        'amount',
        'currency',
        'exchange_rate',
        'expense_date',
        'status',
        'purpose',
        'journal_id',
        'submitted_by',
        'reviewed_by',
        'approved_by',
        'approved_at',
        'attachment_count',
        'metadata',
    ];

    protected $casts = [
        'account_id' => 'integer',
        'payee_id' => 'integer',
        'amount' => 'float',
        'exchange_rate' => 'float',
        'expense_date' => 'date',
        'journal_id' => 'integer',
        'submitted_by' => 'integer',
        'reviewed_by' => 'integer',
        'approved_by' => 'integer',
        'approved_at' => 'datetime',
        'attachment_count' => 'integer',
        'metadata' => 'array',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(FinanceAccount::class, 'account_id');
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'journal_id');
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'submitted_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'reviewed_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(FinanceAttachment::class, 'attachable');
    }
}
