<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HelpTopicTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('help_topics')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'type' => 'vendor_registration',
                'question' => 'How do I register as a seller?',
                'answer' => 'To register, click on the "Sign Up" button, fill in your details, and verify your account via email.',
                'ranking' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              1 => 
              array (
                'id' => 2,
                'type' => 'vendor_registration',
                'question' => 'What are the fees for selling?',
                'answer' => 'Our platform charges a small commission on each sale. There are no upfront listing fees.',
                'ranking' => 2,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              2 => 
              array (
                'id' => 3,
                'type' => 'vendor_registration',
                'question' => 'How do I upload products?',
                'answer' => 'Log in to your seller account, go to the "Upload Products" section, and fill in the product details and images.',
                'ranking' => 3,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              3 => 
              array (
                'id' => 4,
                'type' => 'vendor_registration',
                'question' => 'How do I handle customer inquiries?',
                'answer' => 'You can manage customer inquiries directly through our platform\'s messaging system, ensuring quick and efficient communication.',
                'ranking' => 4,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              4 => 
              array (
                'id' => 5,
                'type' => 'vendor_registration',
                'question' => 'How do I register as a seller?',
                'answer' => 'To register, click on the "Sign Up" button, fill in your details, and verify your account via email.',
                'ranking' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              5 => 
              array (
                'id' => 6,
                'type' => 'vendor_registration',
                'question' => 'What are the fees for selling?',
                'answer' => 'Our platform charges a small commission on each sale. There are no upfront listing fees.',
                'ranking' => 2,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              6 => 
              array (
                'id' => 7,
                'type' => 'vendor_registration',
                'question' => 'How do I upload products?',
                'answer' => 'Log in to your seller account, go to the "Upload Products" section, and fill in the product details and images.',
                'ranking' => 3,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              7 => 
              array (
                'id' => 8,
                'type' => 'vendor_registration',
                'question' => 'How do I handle customer inquiries?',
                'answer' => 'You can manage customer inquiries directly through our platform\'s messaging system, ensuring quick and efficient communication.',
                'ranking' => 4,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('help_topics')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
