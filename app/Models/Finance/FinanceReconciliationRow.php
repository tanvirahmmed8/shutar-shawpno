<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinanceReconciliationRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'reconciliation_id',
        'transaction_date',
        'description',
        'reference',
        'amount',
        'currency',
        'match_status',
        'journal_row_id',
        'metadata',
    ];

    protected $casts = [
        'reconciliation_id' => 'integer',
        'transaction_date' => 'date',
        'amount' => 'float',
        'journal_row_id' => 'integer',
        'metadata' => 'array',
    ];

    public function reconciliation(): BelongsTo
    {
        return $this->belongsTo(FinanceReconciliation::class, 'reconciliation_id');
    }

    public function journalRow(): BelongsTo
    {
        return $this->belongsTo(FinanceJournalRow::class, 'journal_row_id');
    }
}
