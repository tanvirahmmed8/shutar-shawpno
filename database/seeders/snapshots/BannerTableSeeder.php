<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BannerTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('banners')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'photo' => '2025-11-28-69294d4db2f10.webp',
                'banner_type' => 'Main Banner',
                'theme' => 'default',
                'published' => 1,
                'created_at' => '2025-11-28 07:20:45',
                'updated_at' => '2025-11-28 07:21:05',
                'url' => 'https://abc.com',
                'resource_type' => 'product',
                'resource_id' => NULL,
                'title' => NULL,
                'sub_title' => NULL,
                'button_text' => NULL,
                'background_color' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('banners')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
