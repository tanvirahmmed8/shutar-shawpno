<?php

namespace Database\Factories\Finance;

use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceJournalRow;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceJournalRowFactory extends Factory
{
    protected $model = FinanceJournalRow::class;

    public function definition(): array
    {
        $entryType = $this->faker->randomElement(['debit', 'credit']);

        return [
            'journal_id' => FinanceJournal::factory(),
            'account_id' => FinanceAccount::factory(),
            'line_number' => $this->faker->numberBetween(1, 10),
            'entry_type' => $entryType,
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'currency' => 'BDT',
            'exchange_rate' => 1,
            'description' => $this->faker->sentence,
        ];
    }
}
