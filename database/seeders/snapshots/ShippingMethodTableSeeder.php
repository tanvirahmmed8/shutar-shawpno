<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShippingMethodTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('shipping_methods')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 2,
                'creator_id' => 1,
                'creator_type' => 'admin',
                'title' => 'Company Vehicle',
                'cost' => '5.00',
                'duration' => '2 Week',
                'status' => 0,
                'created_at' => '2021-05-26 02:57:04',
                'updated_at' => '2025-11-28 07:50:23',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('shipping_methods')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
