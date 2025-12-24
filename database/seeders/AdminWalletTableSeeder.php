<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminWalletTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('admin_wallets')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'admin_id' => 1,
                'inhouse_earning' => 0.0,
                'withdrawn' => 0.0,
                'created_at' => NULL,
                'updated_at' => NULL,
                'commission_earned' => 0.0,
                'delivery_charge_earned' => 0.0,
                'pending_amount' => 0.0,
                'total_tax_collected' => 0.0,
              ),
              1 => 
              array (
                'id' => 2,
                'admin_id' => 1,
                'inhouse_earning' => 0.0,
                'withdrawn' => 0.0,
                'created_at' => '2025-02-17 23:23:11',
                'updated_at' => '2025-02-17 23:23:11',
                'commission_earned' => 0.0,
                'delivery_charge_earned' => 0.0,
                'pending_amount' => 0.0,
                'total_tax_collected' => 0.0,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('admin_wallets')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
