<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SellerTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('sellers')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'f_name' => 'al imrun',
                'l_name' => 'khandakar',
                'phone' => '01759412381',
                'image' => 'def.png',
                'email' => 'seller@seller.com',
                'password' => '$2y$10$uBvv.3oIwfeZut8/2RCQ9.yVpDWbvDZBwGPUAySB3qB/Ztfr2K67a',
                'status' => 'pending',
                'remember_token' => 'HLxkkXTnCZ',
                'created_at' => '2025-11-28 05:46:11',
                'updated_at' => '2025-11-28 05:46:11',
                'bank_name' => NULL,
                'branch' => NULL,
                'account_no' => NULL,
                'holder_name' => NULL,
                'auth_token' => NULL,
                'sales_commission_percentage' => NULL,
                'gst' => NULL,
                'cm_firebase_token' => NULL,
                'pos_status' => 0,
                'minimum_order_amount' => 0.0,
                'free_delivery_status' => 0,
                'free_delivery_over_amount' => 0.0,
                'app_language' => 'en',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('sellers')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
