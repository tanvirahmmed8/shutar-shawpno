<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FinanceAccountTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('finance_accounts')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'code' => '4000',
                'name' => 'Sales Revenue',
                'category' => 'revenue',
                'type' => 'control',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 0,
                'is_active' => 1,
                'is_postable' => 0,
                'currency' => 'USD',
                'balance_type' => 'credit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              1 => 
              array (
                'id' => 2,
                'code' => '4010',
                'name' => 'Sales Returns',
                'category' => 'revenue',
                'type' => 'posting',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 1,
                'is_active' => 1,
                'is_postable' => 1,
                'currency' => 'USD',
                'balance_type' => 'debit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              2 => 
              array (
                'id' => 3,
                'code' => '1100',
                'name' => 'Payment Clearing',
                'category' => 'asset',
                'type' => 'control',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 0,
                'is_active' => 1,
                'is_postable' => 0,
                'currency' => 'USD',
                'balance_type' => 'debit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              3 => 
              array (
                'id' => 4,
                'code' => '2100',
                'name' => 'Vendor Payables',
                'category' => 'liability',
                'type' => 'control',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 0,
                'is_active' => 1,
                'is_postable' => 0,
                'currency' => 'USD',
                'balance_type' => 'credit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              4 => 
              array (
                'id' => 5,
                'code' => '5000',
                'name' => 'Operating Expenses',
                'category' => 'expense',
                'type' => 'control',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 0,
                'is_active' => 1,
                'is_postable' => 0,
                'currency' => 'USD',
                'balance_type' => 'debit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              5 => 
              array (
                'id' => 6,
                'code' => '2300',
                'name' => 'Tax Liabilities',
                'category' => 'liability',
                'type' => 'posting',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 1,
                'is_active' => 1,
                'is_postable' => 1,
                'currency' => 'USD',
                'balance_type' => 'credit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              6 => 
              array (
                'id' => 7,
                'code' => '2400',
                'name' => 'Wallet Liability',
                'category' => 'liability',
                'type' => 'posting',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 1,
                'is_active' => 1,
                'is_postable' => 1,
                'currency' => 'USD',
                'balance_type' => 'credit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-27 06:50:20',
                'updated_at' => '2025-11-27 06:50:20',
              ),
              7 => 
              array (
                'id' => 8,
                'code' => '2500',
                'name' => 'Deliveryman Payables',
                'category' => 'liability',
                'type' => 'posting',
                'description' => NULL,
                'parent_id' => NULL,
                'level' => 1,
                'is_leaf' => 1,
                'is_active' => 1,
                'is_postable' => 1,
                'currency' => 'USD',
                'balance_type' => 'credit',
                'opening_balance' => '0.000000',
                'metadata' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2025-11-28 05:18:08',
                'updated_at' => '2025-11-28 05:18:08',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('finance_accounts')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
