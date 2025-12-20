<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminRoleTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('admin_roles')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'Master Admin',
                'module_access' => '["purchase_management"]',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2025-11-27 06:50:20',
              ),
              1 => 
              array (
                'id' => 2,
                'name' => 'Employee',
                'module_access' => NULL,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('admin_roles')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
