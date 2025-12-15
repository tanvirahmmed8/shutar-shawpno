<?php

use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceFiscalPeriod;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FinanceChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('finance_accounts')) {
            return;
        }

        $chart = config('finance_chart.accounts', []);
        if (empty($chart)) {
            return;
        }

        $currency = strtoupper((string) config('finance_chart.currency', 'BDT'));
        if (strlen($currency) !== 3) {
            $currency = 'BDT';
        }

        foreach ($chart as $code => $definition) {
            $name = $definition['name'] ?? $code;
            $category = $definition['category'] ?? 'asset';
            $type = $definition['type'] ?? 'control';
            $balanceType = $definition['balance_type'] ?? 'debit';

            FinanceAccount::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'category' => $category,
                    'type' => $type,
                    'level' => 1,
                    'is_leaf' => $type === 'posting',
                    'is_active' => true,
                    'is_postable' => $type === 'posting',
                    'currency' => $currency,
                    'balance_type' => $balanceType,
                    'opening_balance' => 0,
                ]
            );
        }

        if (!Schema::hasTable('finance_fiscal_periods')) {
            return;
        }

        $now = Carbon::now();
        FinanceFiscalPeriod::firstOrCreate(
            ['fiscal_year' => $now->format('Y'), 'name' => 'FY ' . $now->format('Y')],
            [
                'start_date' => $now->copy()->startOfYear(),
                'end_date' => $now->copy()->endOfYear(),
                'status' => 'open',
                'is_locked' => false,
            ]
        );
    }
}
