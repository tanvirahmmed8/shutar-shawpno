<?php

namespace Database\Factories\Finance;

use App\Models\Finance\FinanceAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceAccountFactory extends Factory
{
    protected $model = FinanceAccount::class;

    public function definition(): array
    {
        $category = $this->faker->randomElement(['asset', 'liability', 'equity', 'revenue', 'expense']);
        $balanceType = in_array($category, ['asset', 'expense'], true) ? 'debit' : 'credit';

        return [
            'code' => (string) $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->company . ' Account',
            'category' => $category,
            'type' => $this->faker->word,
            'description' => $this->faker->sentence,
            'level' => 1,
            'is_leaf' => true,
            'is_active' => true,
            'is_postable' => true,
            'currency' => 'BDT',
            'balance_type' => $balanceType,
            'opening_balance' => 0,
        ];
    }
}
