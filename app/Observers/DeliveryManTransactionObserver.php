<?php

namespace App\Observers;

use App\Models\DeliveryManTransaction;
use App\Services\Finance\FinancePostingService;
use App\Support\FinanceFeature;

class DeliveryManTransactionObserver
{
    public function created(DeliveryManTransaction $transaction): void
    {
        if (! FinanceFeature::enabled('deliveryman')) {
            return;
        }

        if ($transaction->finance_journal_id) {
            return;
        }

        /** @var FinancePostingService $postingService */
        $postingService = app(FinancePostingService::class);
        $postingService->postDeliverymanTransaction($transaction->fresh());
    }
}
