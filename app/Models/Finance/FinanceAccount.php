<?php

namespace App\Models\Finance;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'category',
        'type',
        'description',
        'parent_id',
        'level',
        'is_leaf',
        'is_active',
        'is_postable',
        'currency',
        'balance_type',
        'opening_balance',
        'metadata',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'level' => 'integer',
        'is_leaf' => 'boolean',
        'is_active' => 'boolean',
        'is_postable' => 'boolean',
        'opening_balance' => 'float',
        'metadata' => 'array',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function journalRows(): HasMany
    {
        return $this->hasMany(FinanceJournalRow::class, 'account_id');
    }

    public function reconciliations(): HasMany
    {
        return $this->hasMany(FinanceReconciliation::class, 'account_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(FinanceAttachment::class, 'attachable');
    }
}
