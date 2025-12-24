<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FinanceFiscalPeriodTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('finance_fiscal_periods')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'FY 2025',
                'fiscal_year' => '2025',
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
                'status' => 'open',
                'is_locked' => 0,
                'locked_at' => NULL,
                'locked_by' => NULL,
                'notes' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('finance_fiscal_periods')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
