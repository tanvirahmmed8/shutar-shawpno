<?php

namespace App\Jobs\Purchase;

use App\Models\Purchase\PurchaseOrderCommunication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DispatchPurchaseOrderCommunication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $communicationId)
    {
    }

    public function handle(): void
    {
        $communication = PurchaseOrderCommunication::with('order')->find($this->communicationId);
        if (! $communication) {
            return;
        }

        $meta = $communication->meta ?? [];
        $meta['message_id'] = $meta['message_id'] ?? (string) Str::uuid();

        Log::info('Simulated purchase order communication dispatch', [
            'communication_id' => $communication->id,
            'order_id' => $communication->order_id,
            'channel' => $communication->channel,
            'recipient' => $communication->recipient,
        ]);

        $communication->forceFill([
            'status' => 'delivered',
            'sent_at' => $communication->sent_at ?? now(),
            'delivered_at' => now(),
            'meta' => $meta,
        ])->save();
    }
}
