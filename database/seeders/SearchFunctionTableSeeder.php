<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SearchFunctionTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('search_functions')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'key' => 'Dashboard',
                'url' => 'admin/dashboard',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              1 => 
              array (
                'id' => 2,
                'key' => 'Order All',
                'url' => 'admin/orders/list/all',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              2 => 
              array (
                'id' => 3,
                'key' => 'Order Pending',
                'url' => 'admin/orders/list/pending',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              3 => 
              array (
                'id' => 4,
                'key' => 'Order Processed',
                'url' => 'admin/orders/list/processed',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              4 => 
              array (
                'id' => 5,
                'key' => 'Order Delivered',
                'url' => 'admin/orders/list/delivered',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              5 => 
              array (
                'id' => 6,
                'key' => 'Order Returned',
                'url' => 'admin/orders/list/returned',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              6 => 
              array (
                'id' => 7,
                'key' => 'Order Failed',
                'url' => 'admin/orders/list/failed',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              7 => 
              array (
                'id' => 8,
                'key' => 'Brand Add',
                'url' => 'admin/brand/add-new',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              8 => 
              array (
                'id' => 9,
                'key' => 'Brand List',
                'url' => 'admin/brand/list',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              9 => 
              array (
                'id' => 10,
                'key' => 'Banner',
                'url' => 'admin/banner/list',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              10 => 
              array (
                'id' => 11,
                'key' => 'Category',
                'url' => 'admin/category/view',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              11 => 
              array (
                'id' => 12,
                'key' => 'Sub Category',
                'url' => 'admin/category/sub-category/view',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              12 => 
              array (
                'id' => 13,
                'key' => 'Sub sub category',
                'url' => 'admin/category/sub-sub-category/view',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              13 => 
              array (
                'id' => 14,
                'key' => 'Attribute',
                'url' => 'admin/attribute/view',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              14 => 
              array (
                'id' => 15,
                'key' => 'Product',
                'url' => 'admin/product/list',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              15 => 
              array (
                'id' => 16,
                'key' => 'Promotion',
                'url' => 'admin/coupon/add-new',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              16 => 
              array (
                'id' => 17,
                'key' => 'Custom Role',
                'url' => 'admin/custom-role/create',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              17 => 
              array (
                'id' => 18,
                'key' => 'Employee',
                'url' => 'admin/employee/add-new',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              18 => 
              array (
                'id' => 19,
                'key' => 'Seller',
                'url' => 'admin/sellers/seller-list',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              19 => 
              array (
                'id' => 20,
                'key' => 'Contacts',
                'url' => 'admin/contact/list',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              20 => 
              array (
                'id' => 21,
                'key' => 'Flash Deal',
                'url' => 'admin/deal/flash',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              21 => 
              array (
                'id' => 22,
                'key' => 'Deal of the day',
                'url' => 'admin/deal/day',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              22 => 
              array (
                'id' => 23,
                'key' => 'Language',
                'url' => 'admin/business-settings/language',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              23 => 
              array (
                'id' => 24,
                'key' => 'Mail',
                'url' => 'admin/business-settings/mail',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              24 => 
              array (
                'id' => 25,
                'key' => 'Shipping method',
                'url' => 'admin/business-settings/shipping-method/add',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              25 => 
              array (
                'id' => 26,
                'key' => 'Currency',
                'url' => 'admin/currency/view',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              26 => 
              array (
                'id' => 27,
                'key' => 'Payment method',
                'url' => 'admin/business-settings/payment-method',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              27 => 
              array (
                'id' => 28,
                'key' => 'SMS Gateway',
                'url' => 'admin/business-settings/sms-gateway',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              28 => 
              array (
                'id' => 29,
                'key' => 'Support Ticket',
                'url' => 'admin/support-ticket/view',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              29 => 
              array (
                'id' => 30,
                'key' => 'FAQ',
                'url' => 'admin/helpTopic/list',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              30 => 
              array (
                'id' => 31,
                'key' => 'About Us',
                'url' => 'admin/business-settings/about-us',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              31 => 
              array (
                'id' => 32,
                'key' => 'Terms and Conditions',
                'url' => 'admin/business-settings/terms-condition',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              32 => 
              array (
                'id' => 33,
                'key' => 'Web Config',
                'url' => 'admin/business-settings/web-config',
                'visible_for' => 'admin',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('search_functions')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
