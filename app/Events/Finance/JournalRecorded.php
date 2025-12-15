<?php

namespace App\Events\Finance;

use App\Models\Finance\FinanceJournal;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JournalRecorded
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public FinanceJournal $journal,
        public string $eventKey,
        public array $payload = [],
        public array $context = [],
    ) {
    }
}
