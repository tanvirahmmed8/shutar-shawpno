<?php

namespace App\Observers;

use App\Models\WalletTransaction;
use App\Services\Finance\FinancePostingService;
use App\Support\FinanceFeature;

class WalletTransactionObserver
{
    public function created(WalletTransaction $transaction): void
    {
        if (! FinanceFeature::enabled('wallet')) {
            return;
        }

        if ($transaction->finance_journal_id) {
            return;
        }

        /** @var FinancePostingService $postingService */
        $postingService = app(FinancePostingService::class);
        $postingService->postWalletTransaction($transaction->fresh());
    }
}
