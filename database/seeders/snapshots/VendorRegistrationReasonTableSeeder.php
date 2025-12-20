<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VendorRegistrationReasonTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('vendor_registration_reasons')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'title' => 'Millions of Users',
                'description' => 'Access a vast audience with millions of active users ready to buy your products.',
                'priority' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              1 => 
              array (
                'id' => 2,
                'title' => 'Free Marketing',
                'description' => 'Benefit from our extensive, no-cost marketing efforts to boost your visibility and sales.',
                'priority' => 2,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              2 => 
              array (
                'id' => 3,
                'title' => 'SEO Friendly',
                'description' => 'Enjoy enhanced search visibility with our SEO-friendly platform, driving more traffic to your listings.',
                'priority' => 3,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              3 => 
              array (
                'id' => 4,
                'title' => '24/7 Support',
                'description' => 'Get round-the-clock support from our dedicated team to resolve any issues and assist you anytime.',
                'priority' => 4,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              4 => 
              array (
                'id' => 5,
                'title' => 'Easy Onboarding',
                'description' => 'Start selling quickly with our user-friendly onboarding process designed to get you up and running fast.',
                'priority' => 5,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('vendor_registration_reasons')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
