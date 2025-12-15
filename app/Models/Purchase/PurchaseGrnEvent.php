<?php

namespace App\Models\Purchase;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseGrnEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'event_type',
        'payload',
        'created_by',
    ];

    protected $casts = [
        'grn_id' => 'integer',
        'payload' => 'array',
        'created_by' => 'integer',
    ];

    public function grn(): BelongsTo
    {
        return $this->belongsTo(PurchaseGrn::class, 'grn_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
