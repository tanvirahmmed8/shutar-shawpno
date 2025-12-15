<?php

namespace App\Jobs\Purchase;

use App\Models\Purchase\PurchaseRequisition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DispatchRequisitionApprovalNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public PurchaseRequisition $requisition,
        public ?int $approverId,
        public string $event,
        public array $payload = []
    ) {
    }

    public function handle(): void
    {
        logger()->info('Requisition approval notification queued', [
            'requisition_id' => $this->requisition->id,
            'approver_id' => $this->approverId,
            'event' => $this->event,
            'payload' => $this->payload,
        ]);
    }
}
