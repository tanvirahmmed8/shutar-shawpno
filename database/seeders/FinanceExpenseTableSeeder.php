<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FinanceExpenseTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('finance_expenses')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'expense_number' => '278',
                'account_id' => 6,
                'category' => 'Anim nostrum eligend',
                'payee_type' => 'Non voluptate qui pa',
                'payee_id' => 6,
                'amount' => '9.000000',
                'currency' => 'MOL',
                'exchange_rate' => '61.000000',
                'expense_date' => '2010-04-06',
                'status' => 'submitted',
                'purpose' => 'Unde repellendus Cu',
                'journal_id' => NULL,
                'submitted_by' => 1,
                'reviewed_by' => NULL,
                'approved_by' => NULL,
                'approved_at' => NULL,
                'attachment_count' => 0,
                'metadata' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:58:02',
                'updated_at' => '2025-11-27 06:58:02',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('finance_expenses')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
