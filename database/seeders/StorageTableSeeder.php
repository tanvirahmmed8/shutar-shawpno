<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StorageTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('storages')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'data_type' => 'App\\Models\\DeliveryMan',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-09-17 16:21:33',
                'updated_at' => '2025-09-17 16:21:33',
              ),
              1 => 
              array (
                'id' => 2,
                'data_type' => 'App\\Models\\Banner',
                'data_id' => '1',
                'key' => 'photo',
                'value' => 'public',
                'created_at' => '2025-11-28 07:20:45',
                'updated_at' => '2025-11-28 07:20:45',
              ),
              2 => 
              array (
                'id' => 3,
                'data_type' => 'App\\Models\\ProductSeo',
                'data_id' => '1',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-12-17 21:38:46',
                'updated_at' => '2025-12-17 21:38:46',
              ),
              3 => 
              array (
                'id' => 4,
                'data_type' => 'App\\Models\\ProductSeo',
                'data_id' => '2',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-12-17 21:40:49',
                'updated_at' => '2025-12-17 21:40:49',
              ),
              4 => 
              array (
                'id' => 5,
                'data_type' => 'App\\Models\\ProductSeo',
                'data_id' => '3',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-12-17 21:41:53',
                'updated_at' => '2025-12-17 21:41:53',
              ),
              5 => 
              array (
                'id' => 6,
                'data_type' => 'App\\Models\\ProductSeo',
                'data_id' => '4',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-12-17 21:44:27',
                'updated_at' => '2025-12-17 21:44:27',
              ),
              6 => 
              array (
                'id' => 7,
                'data_type' => 'App\\Models\\ProductSeo',
                'data_id' => '5',
                'key' => 'image',
                'value' => 'public',
                'created_at' => '2025-12-17 21:45:41',
                'updated_at' => '2025-12-17 21:45:41',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('storages')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
