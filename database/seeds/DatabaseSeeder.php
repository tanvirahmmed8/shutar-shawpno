<?php

require_once __DIR__ . '/AllDatabaseSeeder.php';

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
            AllDatabaseSeeder::class,
         ]);
    }
}
