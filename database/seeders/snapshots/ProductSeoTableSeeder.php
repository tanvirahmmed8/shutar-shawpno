<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeoTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('product_seos')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'product_id' => 5,
                'title' => NULL,
                'description' => NULL,
                'index' => '',
                'no_follow' => '',
                'no_image_index' => '',
                'no_archive' => '',
                'no_snippet' => '0',
                'max_snippet' => '0',
                'max_snippet_value' => '-1',
                'max_video_preview' => '0',
                'max_video_preview_value' => '-1',
                'max_image_preview' => '0',
                'max_image_preview_value' => 'large',
                'image' => NULL,
                'created_at' => '2025-12-17 21:38:46',
                'updated_at' => '2025-12-17 21:38:46',
              ),
              1 => 
              array (
                'id' => 2,
                'product_id' => 4,
                'title' => NULL,
                'description' => NULL,
                'index' => '',
                'no_follow' => '',
                'no_image_index' => '',
                'no_archive' => '',
                'no_snippet' => '0',
                'max_snippet' => '0',
                'max_snippet_value' => '-1',
                'max_video_preview' => '0',
                'max_video_preview_value' => '-1',
                'max_image_preview' => '0',
                'max_image_preview_value' => 'large',
                'image' => NULL,
                'created_at' => '2025-12-17 21:40:49',
                'updated_at' => '2025-12-17 21:40:49',
              ),
              2 => 
              array (
                'id' => 3,
                'product_id' => 3,
                'title' => NULL,
                'description' => NULL,
                'index' => '',
                'no_follow' => '',
                'no_image_index' => '',
                'no_archive' => '',
                'no_snippet' => '0',
                'max_snippet' => '0',
                'max_snippet_value' => '-1',
                'max_video_preview' => '0',
                'max_video_preview_value' => '-1',
                'max_image_preview' => '0',
                'max_image_preview_value' => 'large',
                'image' => NULL,
                'created_at' => '2025-12-17 21:41:53',
                'updated_at' => '2025-12-17 21:41:53',
              ),
              3 => 
              array (
                'id' => 4,
                'product_id' => 2,
                'title' => NULL,
                'description' => NULL,
                'index' => '',
                'no_follow' => '',
                'no_image_index' => '',
                'no_archive' => '',
                'no_snippet' => '0',
                'max_snippet' => '0',
                'max_snippet_value' => '-1',
                'max_video_preview' => '0',
                'max_video_preview_value' => '-1',
                'max_image_preview' => '0',
                'max_image_preview_value' => 'large',
                'image' => NULL,
                'created_at' => '2025-12-17 21:44:27',
                'updated_at' => '2025-12-17 21:44:27',
              ),
              4 => 
              array (
                'id' => 5,
                'product_id' => 1,
                'title' => NULL,
                'description' => NULL,
                'index' => '',
                'no_follow' => '',
                'no_image_index' => '',
                'no_archive' => '',
                'no_snippet' => '0',
                'max_snippet' => '0',
                'max_snippet_value' => '-1',
                'max_video_preview' => '0',
                'max_video_preview_value' => '-1',
                'max_image_preview' => '0',
                'max_image_preview_value' => 'large',
                'image' => NULL,
                'created_at' => '2025-12-17 21:45:41',
                'updated_at' => '2025-12-17 21:45:41',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('product_seos')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
