<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SocialMediaTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('social_medias')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'twitter',
                'link' => 'https://www.w3schools.com/howto/howto_css_table_responsive.asp',
                'icon' => 'fa fa-twitter',
                'active_status' => 1,
                'status' => 1,
                'created_at' => '2021-01-01 03:18:03',
                'updated_at' => '2021-01-01 03:18:25',
              ),
              1 => 
              array (
                'id' => 2,
                'name' => 'linkedin',
                'link' => 'https://linkedin.com/',
                'icon' => 'fa fa-linkedin',
                'active_status' => 1,
                'status' => 1,
                'created_at' => '2021-02-27 22:23:01',
                'updated_at' => '2021-02-27 22:23:05',
              ),
              2 => 
              array (
                'id' => 3,
                'name' => 'google-plus',
                'link' => 'https://google-plus.com/',
                'icon' => 'fa fa-google-plus-square',
                'active_status' => 1,
                'status' => 1,
                'created_at' => '2021-02-27 22:23:30',
                'updated_at' => '2021-02-27 22:23:33',
              ),
              3 => 
              array (
                'id' => 4,
                'name' => 'pinterest',
                'link' => 'https://pinterest.com/',
                'icon' => 'fa fa-pinterest',
                'active_status' => 1,
                'status' => 1,
                'created_at' => '2021-02-27 22:24:14',
                'updated_at' => '2021-02-27 22:24:26',
              ),
              4 => 
              array (
                'id' => 5,
                'name' => 'instagram',
                'link' => 'https://instagram.com/',
                'icon' => 'fa fa-instagram',
                'active_status' => 1,
                'status' => 1,
                'created_at' => '2021-02-27 22:24:36',
                'updated_at' => '2021-02-27 22:24:41',
              ),
              5 => 
              array (
                'id' => 6,
                'name' => 'facebook',
                'link' => 'https://facebook.com',
                'icon' => 'fa fa-facebook',
                'active_status' => 1,
                'status' => 1,
                'created_at' => '2021-02-28 01:19:42',
                'updated_at' => '2021-06-11 23:41:59',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('social_medias')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
