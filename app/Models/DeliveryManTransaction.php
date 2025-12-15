<?php

namespace App\Models;

use App\Models\Finance\FinanceJournal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserTransaction
 *
 * @property int $id Primary
 * @property int $delivery_man_id
 * @property int $user_id
 * @property string $user_type
 * @property string $transaction_id
 * @property float $debit
 * @property float $credit
 * @property string $transaction_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int|null $finance_journal_id
 *
 * @package App\Models
 */
class DeliveryManTransaction extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'delivery_man_id' => 'integer',
        'user_id' => 'integer',
        'debit' => 'float',
        'credit' => 'float',
        'finance_journal_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'delivery_man_id',
        'user_id',
        'user_type',
        'transaction_id',
        'debit',
        'credit',
        'transaction_type',
        'finance_journal_id',
    ];

    public function financeJournal(): BelongsTo
    {
        return $this->belongsTo(FinanceJournal::class, 'finance_journal_id');
    }

}
