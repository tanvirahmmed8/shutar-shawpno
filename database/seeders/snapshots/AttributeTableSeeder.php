<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AttributeTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('attributes')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'name' => 'Size',
                'created_at' => '2025-11-24 10:03:35',
                'updated_at' => '2025-11-24 10:03:35',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('attributes')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
