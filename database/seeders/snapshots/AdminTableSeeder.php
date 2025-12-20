<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'Master Admin',
                'phone' => '01759412381',
                'admin_role_id' => 1,
                'image' => 'def.png',
                'identify_image' => NULL,
                'identify_type' => NULL,
                'identify_number' => NULL,
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$EgHgGXqrqSnQmy4U4QQ0Puo1UprR2F8HFb.jrcGPeRE5KLKF8IKj.',
                'remember_token' => '4JQmDXW1la',
                'created_at' => '2025-02-17 23:23:11',
                'updated_at' => '2025-02-17 23:23:11',
                'status' => 1,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('admins')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
