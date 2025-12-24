<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoryShippingCostTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('category_shipping_costs')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'seller_id' => 0,
                'category_id' => 1,
                'cost' => 0.0,
                'multiply_qty' => NULL,
                'created_at' => '2025-12-17 21:51:34',
                'updated_at' => '2025-12-17 21:51:34',
              ),
              1 => 
              array (
                'id' => 2,
                'seller_id' => 0,
                'category_id' => 2,
                'cost' => 0.0,
                'multiply_qty' => NULL,
                'created_at' => '2025-12-17 21:51:34',
                'updated_at' => '2025-12-17 21:51:34',
              ),
              2 => 
              array (
                'id' => 3,
                'seller_id' => 0,
                'category_id' => 3,
                'cost' => 0.0,
                'multiply_qty' => NULL,
                'created_at' => '2025-12-17 21:51:34',
                'updated_at' => '2025-12-17 21:51:34',
              ),
              3 => 
              array (
                'id' => 4,
                'seller_id' => 0,
                'category_id' => 4,
                'cost' => 0.0,
                'multiply_qty' => NULL,
                'created_at' => '2025-12-17 21:51:34',
                'updated_at' => '2025-12-17 21:51:34',
              ),
              4 => 
              array (
                'id' => 5,
                'seller_id' => 0,
                'category_id' => 5,
                'cost' => 0.0,
                'multiply_qty' => NULL,
                'created_at' => '2025-12-17 21:51:34',
                'updated_at' => '2025-12-17 21:51:34',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('category_shipping_costs')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
