<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OauthClientTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('oauth_clients')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 =>
              array (
                'id' => 1,
                'user_id' => NULL,
                'name' => 'tanvirsoft',
                'secret' => 'GEUx5tqkviM6AAQcz4oi1dcm1KtRdJPgw41lj0eI',
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2020-10-22 00:27:22',
                'updated_at' => '2020-10-22 00:27:22',
                'provider' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('oauth_clients')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
