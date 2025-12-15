<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderCommunication extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'channel',
        'recipient',
        'status',
        'subject',
        'attachment_path',
        'meta',
        'sent_at',
        'delivered_at',
        'created_by',
    ];

    protected $casts = [
        'order_id' => 'integer',
        'meta' => 'array',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'created_by' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'order_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
