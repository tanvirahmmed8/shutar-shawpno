<?php

namespace App\Models\Finance;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceTransfer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transfer_number',
        'source_account_id',
        'destination_account_id',
        'amount',
        'currency',
        'exchange_rate',
        'status',
        'memo',
        'journal_id',
        'initiated_by',
        'approved_by',
        'initiated_at',
        'approved_at',
        'attachment_count',
        'metadata',
    ];

    protected $casts = [
        'source_account_id' => 'integer',
        'destination_account_id' => 'integer',
        'amount' => 'float',
        'exchange_rate' => 'float',
        'journal_id' => 'integer',
        'initiated_by' => 'integer',
        'approved_by' => 'integer',
        'initiated_at' => 'datetime',
        'approved_at' => 'datetime',
        'attachment_count' => 'integer',
        'metadata' => 'array',
    ];

    public function sourceAccount(): BelongsTo
    {
        return $this->belongsTo(FinanceAccount::class, 'source_account_id');
    }

    public function destinationAccount(): BelongsTo
    {
        return $this->belongsTo(FinanceAccount::class, 'destination_account_id');
    }

    public function journal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'journal_id');
    }

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'initiated_by');
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
