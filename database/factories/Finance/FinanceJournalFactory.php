<?php

namespace Database\Factories\Finance;

use App\Models\Finance\FinanceFiscalPeriod;
use App\Models\Finance\FinanceJournal;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceJournalFactory extends Factory
{
    protected $model = FinanceJournal::class;

    public function definition(): array
    {
        return [
            'journal_number' => 'JRN-' . $this->faker->unique()->numerify('####'),
            'fiscal_period_id' => FinanceFiscalPeriod::factory(),
            'entry_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'source_type' => 'test',
            'source_id' => $this->faker->randomNumber(),
            'source_reference' => $this->faker->uuid,
            'currency' => 'BDT',
            'exchange_rate' => 1,
            'status' => 'posted',
            'category' => 'test',
            'memo' => $this->faker->sentence,
            'line_count' => 0,
            'attachment_count' => 0,
        ];
    }
}
