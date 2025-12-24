<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'Jamdani Saree',
                'slug' => 'jamdani-saree',
                'icon' => '2025-12-17-6942d0f57a274.webp',
                'icon_storage_type' => 'public',
                'parent_id' => 0,
                'position' => 0,
                'created_at' => '2025-12-15 23:09:37',
                'updated_at' => '2025-12-17 21:49:09',
                'home_status' => 0,
                'priority' => 0,
              ),
              1 => 
              array (
                'id' => 2,
                'name' => 'Banarasi Saree',
                'slug' => 'banarasi-saree',
                'icon' => '2025-12-17-6942d0e31019f.webp',
                'icon_storage_type' => 'public',
                'parent_id' => 0,
                'position' => 0,
                'created_at' => '2025-12-15 23:10:03',
                'updated_at' => '2025-12-17 21:48:51',
                'home_status' => 0,
                'priority' => 1,
              ),
              2 => 
              array (
                'id' => 3,
                'name' => 'Cotton Saree',
                'slug' => 'cotton-saree',
                'icon' => '2025-12-17-6942d0da85b67.webp',
                'icon_storage_type' => 'public',
                'parent_id' => 0,
                'position' => 0,
                'created_at' => '2025-12-15 23:11:03',
                'updated_at' => '2025-12-17 21:48:42',
                'home_status' => 0,
                'priority' => 2,
              ),
              3 => 
              array (
                'id' => 4,
                'name' => 'Party Saree',
                'slug' => 'party-saree',
                'icon' => '2025-12-17-6942d0cf68abd.webp',
                'icon_storage_type' => 'public',
                'parent_id' => 0,
                'position' => 0,
                'created_at' => '2025-12-15 23:11:46',
                'updated_at' => '2025-12-17 21:48:31',
                'home_status' => 0,
                'priority' => 3,
              ),
              4 => 
              array (
                'id' => 5,
                'name' => 'Batik Saree',
                'slug' => 'batik-saree',
                'icon' => '2025-12-17-6942d0bf6a1cb.webp',
                'icon_storage_type' => 'public',
                'parent_id' => 0,
                'position' => 0,
                'created_at' => '2025-12-15 23:12:23',
                'updated_at' => '2025-12-17 21:48:15',
                'home_status' => 0,
                'priority' => 4,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('categories')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
