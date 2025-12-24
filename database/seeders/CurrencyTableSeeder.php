<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CurrencyTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('currencies')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'USD',
                'symbol' => '$',
                'code' => 'USD',
                'exchange_rate' => '1',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-27 19:39:37',
              ),
              1 => 
              array (
                'id' => 2,
                'name' => 'BDT',
                'symbol' => '৳',
                'code' => 'BDT',
                'exchange_rate' => '84',
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-07-06 17:52:58',
              ),
              2 => 
              array (
                'id' => 3,
                'name' => 'Indian Rupi',
                'symbol' => '₹',
                'code' => 'INR',
                'exchange_rate' => '60',
                'status' => 1,
                'created_at' => '2020-10-15 23:23:04',
                'updated_at' => '2021-06-05 00:26:38',
              ),
              3 => 
              array (
                'id' => 4,
                'name' => 'Euro',
                'symbol' => '€',
                'code' => 'EUR',
                'exchange_rate' => '100',
                'status' => 1,
                'created_at' => '2021-05-26 03:00:23',
                'updated_at' => '2021-06-05 00:25:29',
              ),
              4 => 
              array (
                'id' => 5,
                'name' => 'YEN',
                'symbol' => '¥',
                'code' => 'JPY',
                'exchange_rate' => '110',
                'status' => 1,
                'created_at' => '2021-06-11 04:08:31',
                'updated_at' => '2021-06-26 20:21:10',
              ),
              5 => 
              array (
                'id' => 6,
                'name' => 'Ringgit',
                'symbol' => 'RM',
                'code' => 'MYR',
                'exchange_rate' => '4.16',
                'status' => 1,
                'created_at' => '2021-07-03 17:08:33',
                'updated_at' => '2021-07-03 17:10:37',
              ),
              6 => 
              array (
                'id' => 7,
                'name' => 'Rand',
                'symbol' => 'R',
                'code' => 'ZAR',
                'exchange_rate' => '14.26',
                'status' => 1,
                'created_at' => '2021-07-03 17:12:38',
                'updated_at' => '2021-07-03 17:12:42',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('currencies')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
