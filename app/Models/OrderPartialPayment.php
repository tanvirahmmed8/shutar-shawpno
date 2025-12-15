<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPartialPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        'payment_account',
        'payment_account_code',
        'reference',
        'note',
        'paid_at',
        'created_by',
    ];

    protected $casts = [
        'order_id' => 'integer',
        'amount' => 'double',
        'payment_account_code' => 'string',
        'paid_at' => 'datetime',
        'created_by' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
