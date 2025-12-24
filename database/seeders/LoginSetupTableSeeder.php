<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class LoginSetupTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('login_setups')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'key' => 'login_options',
                'value' => '{"manual_login":1,"otp_login":0,"social_login":1}',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              1 => 
              array (
                'id' => 2,
                'key' => 'social_media_for_login',
                'value' => '{"google":1,"facebook":1,"apple":1}',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              2 => 
              array (
                'id' => 3,
                'key' => 'email_verification',
                'value' => '0',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              3 => 
              array (
                'id' => 4,
                'key' => 'phone_verification',
                'value' => '0',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('login_setups')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
