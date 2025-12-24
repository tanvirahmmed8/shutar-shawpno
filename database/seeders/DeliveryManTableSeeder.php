<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeliveryManTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('delivery_men')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'seller_id' => 0,
                'f_name' => 'Maggy Barrett',
                'l_name' => 'Hadassah Heath',
                'address' => 'Ut non obcaecati nul',
                'country_code' => '+677',
                'phone' => '+1 (995) 382-9383',
                'email' => 'torifojula@mailinator.com',
                'identity_number' => '329',
                'identity_type' => 'company_id',
                'identity_image' => '[{"image_name":"2025-09-17-68cae00d02c3c.webp","storage":"public"}]',
                'image' => '2025-09-17-68cae00d2e6ad.webp',
                'password' => '$2y$10$q5TlCknOJhaNdAKdwzL62.cqt0rqg/zK1eU.nryJrILlPEx4jGEDC',
                'bank_name' => NULL,
                'branch' => NULL,
                'account_no' => NULL,
                'holder_name' => NULL,
                'is_active' => 1,
                'is_online' => 1,
                'created_at' => '2025-09-17 16:21:33',
                'updated_at' => '2025-09-17 16:21:33',
                'auth_token' => '6yIRXJRRfp78qJsAoKZZ6TTqhzuNJ3TcdvPBmk6n',
                'fcm_token' => NULL,
                'app_language' => 'en',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('delivery_men')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
