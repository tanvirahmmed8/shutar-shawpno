<?php

namespace App\Models\Finance;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceReconciliation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_id',
        'statement_name',
        'statement_date',
        'import_source',
        'opening_balance',
        'closing_balance',
        'statement_row_count',
        'matched_row_count',
        'status',
        'notes',
        'started_at',
        'completed_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'account_id' => 'integer',
        'statement_date' => 'date',
        'opening_balance' => 'float',
        'closing_balance' => 'float',
        'statement_row_count' => 'integer',
        'matched_row_count' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(FinanceAccount::class, 'account_id');
    }

    public function rows(): HasMany
    {
        return $this->hasMany(FinanceReconciliationRow::class, 'reconciliation_id');
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(FinanceAttachment::class, 'attachable');
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
