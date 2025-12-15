<?php

namespace App\Models\Finance;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceFiscalPeriod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'fiscal_year',
        'start_date',
        'end_date',
        'status',
        'is_locked',
        'locked_at',
        'locked_by',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_locked' => 'boolean',
        'locked_at' => 'datetime',
        'locked_by' => 'integer',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function journals(): HasMany
    {
        return $this->hasMany(FinanceJournal::class, 'fiscal_period_id');
    }

    public function locker(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'locked_by');
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
