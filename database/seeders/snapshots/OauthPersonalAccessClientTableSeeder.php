<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OauthPersonalAccessClientTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('oauth_personal_access_clients')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'client_id' => 1,
                'created_at' => '2020-10-22 00:27:23',
                'updated_at' => '2020-10-22 00:27:23',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('oauth_personal_access_clients')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
