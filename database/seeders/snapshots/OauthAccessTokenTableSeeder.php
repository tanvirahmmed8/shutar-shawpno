<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OauthAccessTokenTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('oauth_access_tokens')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => '6840b7d4ed685bf2e0dc593affa0bd3b968065f47cc226d39ab09f1422b5a1d9666601f3f60a79c1',
                'user_id' => 98,
                'client_id' => 1,
                'name' => 'LaravelAuthApp',
                'scopes' => '[]',
                'revoked' => 1,
                'created_at' => '2021-07-05 15:25:41',
                'updated_at' => '2021-07-05 15:25:41',
                'expires_at' => '2022-07-05 15:25:41',
              ),
              1 => 
              array (
                'id' => 'c42cdd5ae652b8b2cbac4f2f4b496e889e1a803b08672954c8bbe06722b54160e71dce3e02331544',
                'user_id' => 98,
                'client_id' => 1,
                'name' => 'LaravelAuthApp',
                'scopes' => '[]',
                'revoked' => 1,
                'created_at' => '2021-07-05 15:24:36',
                'updated_at' => '2021-07-05 15:24:36',
                'expires_at' => '2022-07-05 15:24:36',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('oauth_access_tokens')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
