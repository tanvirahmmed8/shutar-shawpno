<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 0,
                'name' => 'walking customer',
                'f_name' => 'walking',
                'l_name' => 'customer',
                'phone' => '00000000000',
                'image' => 'def.png',
                'email' => 'walking@customer.com',
                'email_verified_at' => NULL,
                'password' => ' ',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2022-02-03 09:46:01',
                'street_address' => NULL,
                'country' => NULL,
                'city' => NULL,
                'zip' => NULL,
                'house_no' => NULL,
                'apartment_no' => NULL,
                'cm_firebase_token' => NULL,
                'is_active' => 1,
                'payment_card_last_four' => NULL,
                'payment_card_brand' => NULL,
                'payment_card_fawry_token' => NULL,
                'login_medium' => NULL,
                'social_id' => NULL,
                'is_phone_verified' => 0,
                'temporary_token' => NULL,
                'is_email_verified' => 0,
                'wallet_balance' => NULL,
                'loyalty_point' => NULL,
                'login_hit_count' => 0,
                'is_temp_blocked' => 0,
                'temp_block_time' => NULL,
                'referral_code' => NULL,
                'referred_by' => NULL,
                'app_language' => 'en',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('users')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
