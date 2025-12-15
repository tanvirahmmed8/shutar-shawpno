<?php

namespace Database\Factories\Finance;

use App\Models\Finance\FinanceFiscalPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceFiscalPeriodFactory extends Factory
{
    protected $model = FinanceFiscalPeriod::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 year', 'now');
        $end = (clone $start)->modify('+30 days');

        return [
            'name' => 'PER-' . $this->faker->unique()->numerify('####'),
            'fiscal_year' => (int) $start->format('Y'),
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'open',
            'is_locked' => false,
        ];
    }
}
