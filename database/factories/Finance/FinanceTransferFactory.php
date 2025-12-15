<?php

namespace Database\Factories\Finance;

use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceTransfer;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceTransferFactory extends Factory
{
    protected $model = FinanceTransfer::class;

    public function definition(): array
    {
        return [
            'transfer_number' => 'TRF-' . $this->faker->unique()->numerify('####'),
            'source_account_id' => FinanceAccount::factory(),
            'destination_account_id' => FinanceAccount::factory(),
            'amount' => $this->faker->randomFloat(2, 100, 5000),
            'currency' => 'BDT',
            'exchange_rate' => 1,
            'status' => 'pending',
            'memo' => $this->faker->sentence,
            'journal_id' => FinanceJournal::factory(),
        ];
    }
}
