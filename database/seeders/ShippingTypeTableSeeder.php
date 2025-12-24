<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShippingTypeTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('shipping_types')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'seller_id' => 0,
                'shipping_type' => 'order_wise',
                'created_at' => '2025-02-17 23:23:11',
                'updated_at' => '2025-02-19 17:34:32',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('shipping_types')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
