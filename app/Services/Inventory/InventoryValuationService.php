<?php

namespace App\Services\Inventory;

use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceJournalRow;
use App\Models\Product;

class InventoryValuationService
{
    public function syncFinanceInventoryBalance(): array
    {
        $inventoryValue = $this->calculateInventoryValue();
        $account = $this->getInventoryAccount();

        $ledgerBalance = null;
        $delta = null;

        if ($account) {
            $ledgerBalance = $this->calculateLedgerBalance($account->id);
            $delta = round($inventoryValue - $ledgerBalance, 4);

            $metadata = $account->metadata ?? [];
            $account->forceFill([
                'metadata' => array_merge($metadata, [
                    'inventory_value_snapshot' => round($inventoryValue, 4),
                    'ledger_balance_snapshot' => round($ledgerBalance, 4),
                    'inventory_ledger_delta' => $delta,
                    'snapshot_taken_at' => now()->toDateTimeString(),
                ]),
            ])->save();
        }

        return [
            'inventory_value' => round($inventoryValue, 4),
            'ledger_balance' => $ledgerBalance !== null ? round($ledgerBalance, 4) : null,
            'delta' => $delta,
        ];
    }

    private function calculateInventoryValue(): float
    {
        $value = Product::query()
            ->selectRaw('COALESCE(SUM(current_stock * purchase_price), 0) as total_value')
            ->value('total_value');

        return (float) $value;
    }

    private function calculateLedgerBalance(int $accountId): float
    {
        $balance = FinanceJournalRow::query()
            ->where('account_id', $accountId)
            ->whereHas('journal', fn($query) => $query->where('status', 'posted'))
            ->selectRaw("COALESCE(SUM(CASE WHEN entry_type = 'debit' THEN amount ELSE -amount END), 0) as balance")
            ->value('balance');

        return (float) $balance;
    }

    private function getInventoryAccount(): ?FinanceAccount
    {
        return FinanceAccount::query()->where('code', '1300')->first();
    }
}
