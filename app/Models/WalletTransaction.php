<?php

namespace App\Models;

use App\Models\Finance\FinanceJournal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'integer',
        'credit' => 'float',
        'debit' => 'float',
        'admin_bonus'=>'float',
        'balance'=>'float',
        'reference'=>'string',
        'finance_journal_id' => 'integer',
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
    ];

    protected $fillable = [
        'finance_journal_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function financeJournal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'finance_journal_id');
    }
}
