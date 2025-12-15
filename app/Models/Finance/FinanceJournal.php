<?php

namespace App\Models\Finance;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceJournal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'journal_number',
        'fiscal_period_id',
        'entry_date',
        'source_type',
        'source_id',
        'source_reference',
        'currency',
        'exchange_rate',
        'status',
        'category',
        'memo',
        'line_count',
        'attachment_count',
        'posted_at',
        'posted_by',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fiscal_period_id' => 'integer',
        'entry_date' => 'date',
        'source_id' => 'integer',
        'exchange_rate' => 'float',
        'line_count' => 'integer',
        'attachment_count' => 'integer',
        'posted_at' => 'datetime',
        'posted_by' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function fiscalPeriod(): BelongsTo
    {
        return $this->belongsTo(FinanceFiscalPeriod::class, 'fiscal_period_id');
    }

    public function rows(): HasMany
    {
        return $this->hasMany(FinanceJournalRow::class, 'journal_id');
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(FinanceAttachment::class, 'attachable');
    }

    public function expense(): HasOne
    {
        return $this->hasOne(FinanceExpense::class, 'journal_id');
    }

    public function transfer(): HasOne
    {
        return $this->hasOne(FinanceTransfer::class, 'journal_id');
    }

    public function poster(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'posted_by');
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
