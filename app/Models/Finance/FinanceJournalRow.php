<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinanceJournalRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_id',
        'account_id',
        'line_number',
        'entry_type',
        'amount',
        'currency',
        'exchange_rate',
        'description',
        'reference_type',
        'reference_id',
        'metadata',
    ];

    protected $casts = [
        'journal_id' => 'integer',
        'account_id' => 'integer',
        'line_number' => 'integer',
        'amount' => 'float',
        'exchange_rate' => 'float',
        'reference_id' => 'integer',
        'metadata' => 'array',
    ];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'journal_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(FinanceAccount::class, 'account_id');
    }
}
