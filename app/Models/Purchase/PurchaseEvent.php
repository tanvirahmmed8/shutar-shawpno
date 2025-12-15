<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'payload',
        'status',
        'dispatched_at',
        'error_message',
    ];

    protected $casts = [
        'payload' => 'array',
        'dispatched_at' => 'datetime',
    ];
}
