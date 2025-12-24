<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrationTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('migrations')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
              ),
              1 => 
              array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
              ),
              2 => 
              array (
                'id' => 3,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 1,
              ),
              3 => 
              array (
                'id' => 4,
                'migration' => '2020_09_08_105159_create_admins_table',
                'batch' => 1,
              ),
              4 => 
              array (
                'id' => 5,
                'migration' => '2020_09_08_111837_create_admin_roles_table',
                'batch' => 1,
              ),
              5 => 
              array (
                'id' => 6,
                'migration' => '2020_09_16_142451_create_categories_table',
                'batch' => 2,
              ),
              6 => 
              array (
                'id' => 7,
                'migration' => '2020_09_16_181753_create_categories_table',
                'batch' => 3,
              ),
              7 => 
              array (
                'id' => 8,
                'migration' => '2020_09_17_134238_create_brands_table',
                'batch' => 4,
              ),
              8 => 
              array (
                'id' => 9,
                'migration' => '2020_09_17_203054_create_attributes_table',
                'batch' => 5,
              ),
              9 => 
              array (
                'id' => 10,
                'migration' => '2020_09_19_112509_create_coupons_table',
                'batch' => 6,
              ),
              10 => 
              array (
                'id' => 11,
                'migration' => '2020_09_19_161802_create_curriencies_table',
                'batch' => 7,
              ),
              11 => 
              array (
                'id' => 12,
                'migration' => '2020_09_20_114509_create_sellers_table',
                'batch' => 8,
              ),
              12 => 
              array (
                'id' => 13,
                'migration' => '2020_09_23_113454_create_shops_table',
                'batch' => 9,
              ),
              13 => 
              array (
                'id' => 14,
                'migration' => '2020_09_23_115615_create_shops_table',
                'batch' => 10,
              ),
              14 => 
              array (
                'id' => 15,
                'migration' => '2020_09_23_153822_create_shops_table',
                'batch' => 11,
              ),
              15 => 
              array (
                'id' => 16,
                'migration' => '2020_09_21_122817_create_products_table',
                'batch' => 12,
              ),
              16 => 
              array (
                'id' => 17,
                'migration' => '2020_09_22_140800_create_colors_table',
                'batch' => 12,
              ),
              17 => 
              array (
                'id' => 18,
                'migration' => '2020_09_28_175020_create_products_table',
                'batch' => 13,
              ),
              18 => 
              array (
                'id' => 19,
                'migration' => '2020_09_28_180311_create_products_table',
                'batch' => 14,
              ),
              19 => 
              array (
                'id' => 20,
                'migration' => '2020_10_04_105041_create_search_functions_table',
                'batch' => 15,
              ),
              20 => 
              array (
                'id' => 21,
                'migration' => '2020_10_05_150730_create_customers_table',
                'batch' => 15,
              ),
              21 => 
              array (
                'id' => 22,
                'migration' => '2020_10_08_133548_create_wishlists_table',
                'batch' => 16,
              ),
              22 => 
              array (
                'id' => 23,
                'migration' => '2016_06_01_000001_create_oauth_auth_codes_table',
                'batch' => 17,
              ),
              23 => 
              array (
                'id' => 24,
                'migration' => '2016_06_01_000002_create_oauth_access_tokens_table',
                'batch' => 17,
              ),
              24 => 
              array (
                'id' => 25,
                'migration' => '2016_06_01_000003_create_oauth_refresh_tokens_table',
                'batch' => 17,
              ),
              25 => 
              array (
                'id' => 26,
                'migration' => '2016_06_01_000004_create_oauth_clients_table',
                'batch' => 17,
              ),
              26 => 
              array (
                'id' => 27,
                'migration' => '2016_06_01_000005_create_oauth_personal_access_clients_table',
                'batch' => 17,
              ),
              27 => 
              array (
                'id' => 28,
                'migration' => '2020_10_06_133710_create_product_stocks_table',
                'batch' => 17,
              ),
              28 => 
              array (
                'id' => 29,
                'migration' => '2020_10_06_134636_create_flash_deals_table',
                'batch' => 17,
              ),
              29 => 
              array (
                'id' => 30,
                'migration' => '2020_10_06_134719_create_flash_deal_products_table',
                'batch' => 17,
              ),
              30 => 
              array (
                'id' => 31,
                'migration' => '2020_10_08_115439_create_orders_table',
                'batch' => 17,
              ),
              31 => 
              array (
                'id' => 32,
                'migration' => '2020_10_08_115453_create_order_details_table',
                'batch' => 17,
              ),
              32 => 
              array (
                'id' => 33,
                'migration' => '2020_10_08_121135_create_shipping_addresses_table',
                'batch' => 17,
              ),
              33 => 
              array (
                'id' => 34,
                'migration' => '2020_10_10_171722_create_business_settings_table',
                'batch' => 17,
              ),
              34 => 
              array (
                'id' => 35,
                'migration' => '2020_09_19_161802_create_currencies_table',
                'batch' => 18,
              ),
              35 => 
              array (
                'id' => 36,
                'migration' => '2020_10_12_152350_create_reviews_table',
                'batch' => 18,
              ),
              36 => 
              array (
                'id' => 37,
                'migration' => '2020_10_12_161834_create_reviews_table',
                'batch' => 19,
              ),
              37 => 
              array (
                'id' => 38,
                'migration' => '2020_10_12_180510_create_support_tickets_table',
                'batch' => 20,
              ),
              38 => 
              array (
                'id' => 39,
                'migration' => '2020_10_14_140130_create_transactions_table',
                'batch' => 21,
              ),
              39 => 
              array (
                'id' => 40,
                'migration' => '2020_10_14_143553_create_customer_wallets_table',
                'batch' => 21,
              ),
              40 => 
              array (
                'id' => 41,
                'migration' => '2020_10_14_143607_create_customer_wallet_histories_table',
                'batch' => 21,
              ),
              41 => 
              array (
                'id' => 42,
                'migration' => '2020_10_22_142212_create_support_ticket_convs_table',
                'batch' => 21,
              ),
              42 => 
              array (
                'id' => 43,
                'migration' => '2020_10_24_234813_create_banners_table',
                'batch' => 22,
              ),
              43 => 
              array (
                'id' => 44,
                'migration' => '2020_10_27_111557_create_shipping_methods_table',
                'batch' => 23,
              ),
              44 => 
              array (
                'id' => 45,
                'migration' => '2020_10_27_114154_add_url_to_banners_table',
                'batch' => 24,
              ),
              45 => 
              array (
                'id' => 46,
                'migration' => '2020_10_28_170308_add_shipping_id_to_order_details',
                'batch' => 25,
              ),
              46 => 
              array (
                'id' => 47,
                'migration' => '2020_11_02_140528_add_discount_to_order_table',
                'batch' => 26,
              ),
              47 => 
              array (
                'id' => 48,
                'migration' => '2020_11_03_162723_add_column_to_order_details',
                'batch' => 27,
              ),
              48 => 
              array (
                'id' => 49,
                'migration' => '2020_11_08_202351_add_url_to_banners_table',
                'batch' => 28,
              ),
              49 => 
              array (
                'id' => 50,
                'migration' => '2020_11_10_112713_create_help_topic',
                'batch' => 29,
              ),
              50 => 
              array (
                'id' => 51,
                'migration' => '2020_11_10_141513_create_contacts_table',
                'batch' => 29,
              ),
              51 => 
              array (
                'id' => 52,
                'migration' => '2020_11_15_180036_add_address_column_user_table',
                'batch' => 30,
              ),
              52 => 
              array (
                'id' => 53,
                'migration' => '2020_11_18_170209_add_status_column_to_product_table',
                'batch' => 31,
              ),
              53 => 
              array (
                'id' => 54,
                'migration' => '2020_11_19_115453_add_featured_status_product',
                'batch' => 32,
              ),
              54 => 
              array (
                'id' => 55,
                'migration' => '2020_11_21_133302_create_deal_of_the_days_table',
                'batch' => 33,
              ),
              55 => 
              array (
                'id' => 56,
                'migration' => '2020_11_20_172332_add_product_id_to_products',
                'batch' => 34,
              ),
              56 => 
              array (
                'id' => 57,
                'migration' => '2020_11_27_234439_add__state_to_shipping_addresses',
                'batch' => 34,
              ),
              57 => 
              array (
                'id' => 58,
                'migration' => '2020_11_28_091929_create_chattings_table',
                'batch' => 35,
              ),
              58 => 
              array (
                'id' => 59,
                'migration' => '2020_12_02_011815_add_bank_info_to_sellers',
                'batch' => 36,
              ),
              59 => 
              array (
                'id' => 60,
                'migration' => '2020_12_08_193234_create_social_medias_table',
                'batch' => 37,
              ),
              60 => 
              array (
                'id' => 61,
                'migration' => '2020_12_13_122649_shop_id_to_chattings',
                'batch' => 37,
              ),
              61 => 
              array (
                'id' => 62,
                'migration' => '2020_12_14_145116_create_seller_wallet_histories_table',
                'batch' => 38,
              ),
              62 => 
              array (
                'id' => 63,
                'migration' => '2020_12_14_145127_create_seller_wallets_table',
                'batch' => 38,
              ),
              63 => 
              array (
                'id' => 64,
                'migration' => '2020_12_15_174804_create_admin_wallets_table',
                'batch' => 39,
              ),
              64 => 
              array (
                'id' => 65,
                'migration' => '2020_12_15_174821_create_admin_wallet_histories_table',
                'batch' => 39,
              ),
              65 => 
              array (
                'id' => 66,
                'migration' => '2020_12_15_214312_create_feature_deals_table',
                'batch' => 40,
              ),
              66 => 
              array (
                'id' => 67,
                'migration' => '2020_12_17_205712_create_withdraw_requests_table',
                'batch' => 41,
              ),
              67 => 
              array (
                'id' => 68,
                'migration' => '2021_02_22_161510_create_notifications_table',
                'batch' => 42,
              ),
              68 => 
              array (
                'id' => 69,
                'migration' => '2021_02_24_154706_add_deal_type_to_flash_deals',
                'batch' => 43,
              ),
              69 => 
              array (
                'id' => 70,
                'migration' => '2021_03_03_204349_add_cm_firebase_token_to_users',
                'batch' => 44,
              ),
              70 => 
              array (
                'id' => 71,
                'migration' => '2021_04_17_134848_add_column_to_order_details_stock',
                'batch' => 45,
              ),
              71 => 
              array (
                'id' => 72,
                'migration' => '2021_05_12_155401_add_auth_token_seller',
                'batch' => 46,
              ),
              72 => 
              array (
                'id' => 73,
                'migration' => '2021_06_03_104531_ex_rate_update',
                'batch' => 47,
              ),
              73 => 
              array (
                'id' => 74,
                'migration' => '2021_06_03_222413_amount_withdraw_req',
                'batch' => 48,
              ),
              74 => 
              array (
                'id' => 75,
                'migration' => '2021_06_04_154501_seller_wallet_withdraw_bal',
                'batch' => 49,
              ),
              75 => 
              array (
                'id' => 76,
                'migration' => '2021_06_04_195853_product_dis_tax',
                'batch' => 50,
              ),
              76 => 
              array (
                'id' => 77,
                'migration' => '2021_05_27_103505_create_product_translations_table',
                'batch' => 51,
              ),
              77 => 
              array (
                'id' => 78,
                'migration' => '2021_06_17_054551_create_soft_credentials_table',
                'batch' => 51,
              ),
              78 => 
              array (
                'id' => 79,
                'migration' => '2021_06_29_212549_add_active_col_user_table',
                'batch' => 52,
              ),
              79 => 
              array (
                'id' => 80,
                'migration' => '2021_06_30_212619_add_col_to_contact',
                'batch' => 53,
              ),
              80 => 
              array (
                'id' => 81,
                'migration' => '2021_07_01_160828_add_col_daily_needs_products',
                'batch' => 54,
              ),
              81 => 
              array (
                'id' => 82,
                'migration' => '2021_07_04_182331_add_col_seller_sales_commission',
                'batch' => 55,
              ),
              82 => 
              array (
                'id' => 83,
                'migration' => '2021_08_07_190655_add_seo_columns_to_products',
                'batch' => 56,
              ),
              83 => 
              array (
                'id' => 84,
                'migration' => '2021_08_07_205913_add_col_to_category_table',
                'batch' => 56,
              ),
              84 => 
              array (
                'id' => 85,
                'migration' => '2021_08_07_210808_add_col_to_shops_table',
                'batch' => 56,
              ),
              85 => 
              array (
                'id' => 86,
                'migration' => '2021_08_14_205216_change_product_price_col_type',
                'batch' => 56,
              ),
              86 => 
              array (
                'id' => 87,
                'migration' => '2021_08_16_201505_change_order_price_col',
                'batch' => 56,
              ),
              87 => 
              array (
                'id' => 88,
                'migration' => '2021_08_16_201552_change_order_details_price_col',
                'batch' => 56,
              ),
              88 => 
              array (
                'id' => 89,
                'migration' => '2019_09_29_154000_create_payment_cards_table',
                'batch' => 57,
              ),
              89 => 
              array (
                'id' => 90,
                'migration' => '2021_08_17_213934_change_col_type_seller_earning_history',
                'batch' => 57,
              ),
              90 => 
              array (
                'id' => 91,
                'migration' => '2021_08_17_214109_change_col_type_admin_earning_history',
                'batch' => 57,
              ),
              91 => 
              array (
                'id' => 92,
                'migration' => '2021_08_17_214232_change_col_type_admin_wallet',
                'batch' => 57,
              ),
              92 => 
              array (
                'id' => 93,
                'migration' => '2021_08_17_214405_change_col_type_seller_wallet',
                'batch' => 57,
              ),
              93 => 
              array (
                'id' => 94,
                'migration' => '2021_08_22_184834_add_publish_to_products_table',
                'batch' => 57,
              ),
              94 => 
              array (
                'id' => 95,
                'migration' => '2021_09_08_211832_add_social_column_to_users_table',
                'batch' => 57,
              ),
              95 => 
              array (
                'id' => 96,
                'migration' => '2021_09_13_165535_add_col_to_user',
                'batch' => 57,
              ),
              96 => 
              array (
                'id' => 97,
                'migration' => '2021_09_19_061647_add_limit_to_coupons_table',
                'batch' => 57,
              ),
              97 => 
              array (
                'id' => 98,
                'migration' => '2021_09_20_020716_add_coupon_code_to_orders_table',
                'batch' => 57,
              ),
              98 => 
              array (
                'id' => 99,
                'migration' => '2021_09_23_003059_add_gst_to_sellers_table',
                'batch' => 57,
              ),
              99 => 
              array (
                'id' => 100,
                'migration' => '2021_09_28_025411_create_order_transactions_table',
                'batch' => 57,
              ),
              100 => 
              array (
                'id' => 101,
                'migration' => '2021_10_02_185124_create_carts_table',
                'batch' => 57,
              ),
              101 => 
              array (
                'id' => 102,
                'migration' => '2021_10_02_190207_create_cart_shippings_table',
                'batch' => 57,
              ),
              102 => 
              array (
                'id' => 103,
                'migration' => '2021_10_03_194334_add_col_order_table',
                'batch' => 57,
              ),
              103 => 
              array (
                'id' => 104,
                'migration' => '2021_10_03_200536_add_shipping_cost',
                'batch' => 57,
              ),
              104 => 
              array (
                'id' => 105,
                'migration' => '2021_10_04_153201_add_col_to_order_table',
                'batch' => 57,
              ),
              105 => 
              array (
                'id' => 106,
                'migration' => '2021_10_07_172701_add_col_cart_shop_info',
                'batch' => 57,
              ),
              106 => 
              array (
                'id' => 107,
                'migration' => '2021_10_07_184442_create_phone_or_email_verifications_table',
                'batch' => 57,
              ),
              107 => 
              array (
                'id' => 108,
                'migration' => '2021_10_07_185416_add_user_table_email_verified',
                'batch' => 57,
              ),
              108 => 
              array (
                'id' => 109,
                'migration' => '2021_10_11_192739_add_transaction_amount_table',
                'batch' => 57,
              ),
              109 => 
              array (
                'id' => 110,
                'migration' => '2021_10_11_200850_add_order_verification_code',
                'batch' => 57,
              ),
              110 => 
              array (
                'id' => 111,
                'migration' => '2021_10_12_083241_add_col_to_order_transaction',
                'batch' => 57,
              ),
              111 => 
              array (
                'id' => 112,
                'migration' => '2021_10_12_084440_add_seller_id_to_order',
                'batch' => 57,
              ),
              112 => 
              array (
                'id' => 113,
                'migration' => '2021_10_12_102853_change_col_type',
                'batch' => 57,
              ),
              113 => 
              array (
                'id' => 114,
                'migration' => '2021_10_12_110434_add_col_to_admin_wallet',
                'batch' => 57,
              ),
              114 => 
              array (
                'id' => 115,
                'migration' => '2021_10_12_110829_add_col_to_seller_wallet',
                'batch' => 57,
              ),
              115 => 
              array (
                'id' => 116,
                'migration' => '2021_10_13_091801_add_col_to_admin_wallets',
                'batch' => 57,
              ),
              116 => 
              array (
                'id' => 117,
                'migration' => '2021_10_13_092000_add_col_to_seller_wallets_tax',
                'batch' => 57,
              ),
              117 => 
              array (
                'id' => 118,
                'migration' => '2021_10_13_165947_rename_and_remove_col_seller_wallet',
                'batch' => 57,
              ),
              118 => 
              array (
                'id' => 119,
                'migration' => '2021_10_13_170258_rename_and_remove_col_admin_wallet',
                'batch' => 57,
              ),
              119 => 
              array (
                'id' => 120,
                'migration' => '2021_10_14_061603_column_update_order_transaction',
                'batch' => 57,
              ),
              120 => 
              array (
                'id' => 121,
                'migration' => '2021_10_15_103339_remove_col_from_seller_wallet',
                'batch' => 57,
              ),
              121 => 
              array (
                'id' => 122,
                'migration' => '2021_10_15_104419_add_id_col_order_tran',
                'batch' => 57,
              ),
              122 => 
              array (
                'id' => 123,
                'migration' => '2021_10_15_213454_update_string_limit',
                'batch' => 57,
              ),
              123 => 
              array (
                'id' => 124,
                'migration' => '2021_10_16_234037_change_col_type_translation',
                'batch' => 57,
              ),
              124 => 
              array (
                'id' => 125,
                'migration' => '2021_10_16_234329_change_col_type_translation_1',
                'batch' => 57,
              ),
              125 => 
              array (
                'id' => 126,
                'migration' => '2021_10_27_091250_add_shipping_address_in_order',
                'batch' => 58,
              ),
              126 => 
              array (
                'id' => 127,
                'migration' => '2021_01_24_205114_create_paytabs_invoices_table',
                'batch' => 59,
              ),
              127 => 
              array (
                'id' => 128,
                'migration' => '2021_11_20_043814_change_pass_reset_email_col',
                'batch' => 59,
              ),
              128 => 
              array (
                'id' => 129,
                'migration' => '2021_11_25_043109_create_delivery_men_table',
                'batch' => 60,
              ),
              129 => 
              array (
                'id' => 130,
                'migration' => '2021_11_25_062242_add_auth_token_delivery_man',
                'batch' => 60,
              ),
              130 => 
              array (
                'id' => 131,
                'migration' => '2021_11_27_043405_add_deliveryman_in_order_table',
                'batch' => 60,
              ),
              131 => 
              array (
                'id' => 132,
                'migration' => '2021_11_27_051432_create_delivery_histories_table',
                'batch' => 60,
              ),
              132 => 
              array (
                'id' => 133,
                'migration' => '2021_11_27_051512_add_fcm_col_for_delivery_man',
                'batch' => 60,
              ),
              133 => 
              array (
                'id' => 134,
                'migration' => '2021_12_15_123216_add_columns_to_banner',
                'batch' => 60,
              ),
              134 => 
              array (
                'id' => 135,
                'migration' => '2022_01_04_100543_add_order_note_to_orders_table',
                'batch' => 60,
              ),
              135 => 
              array (
                'id' => 136,
                'migration' => '2022_01_10_034952_add_lat_long_to_shipping_addresses_table',
                'batch' => 60,
              ),
              136 => 
              array (
                'id' => 137,
                'migration' => '2022_01_10_045517_create_billing_addresses_table',
                'batch' => 60,
              ),
              137 => 
              array (
                'id' => 138,
                'migration' => '2022_01_11_040755_add_is_billing_to_shipping_addresses_table',
                'batch' => 60,
              ),
              138 => 
              array (
                'id' => 139,
                'migration' => '2022_01_11_053404_add_billing_to_orders_table',
                'batch' => 60,
              ),
              139 => 
              array (
                'id' => 140,
                'migration' => '2022_01_11_234310_add_firebase_toke_to_sellers_table',
                'batch' => 60,
              ),
              140 => 
              array (
                'id' => 141,
                'migration' => '2022_01_16_121801_change_colu_type',
                'batch' => 60,
              ),
              141 => 
              array (
                'id' => 142,
                'migration' => '2022_01_22_101601_change_cart_col_type',
                'batch' => 61,
              ),
              142 => 
              array (
                'id' => 143,
                'migration' => '2022_01_23_031359_add_column_to_orders_table',
                'batch' => 61,
              ),
              143 => 
              array (
                'id' => 144,
                'migration' => '2022_01_28_235054_add_status_to_admins_table',
                'batch' => 61,
              ),
              144 => 
              array (
                'id' => 145,
                'migration' => '2022_02_01_214654_add_pos_status_to_sellers_table',
                'batch' => 61,
              ),
              145 => 
              array (
                'id' => 146,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 62,
              ),
              146 => 
              array (
                'id' => 147,
                'migration' => '2022_02_11_225355_add_checked_to_orders_table',
                'batch' => 62,
              ),
              147 => 
              array (
                'id' => 148,
                'migration' => '2022_02_14_114359_create_refund_requests_table',
                'batch' => 62,
              ),
              148 => 
              array (
                'id' => 149,
                'migration' => '2022_02_14_115757_add_refund_request_to_order_details_table',
                'batch' => 62,
              ),
              149 => 
              array (
                'id' => 150,
                'migration' => '2022_02_15_092604_add_order_details_id_to_transactions_table',
                'batch' => 62,
              ),
              150 => 
              array (
                'id' => 151,
                'migration' => '2022_02_15_121410_create_refund_transactions_table',
                'batch' => 62,
              ),
              151 => 
              array (
                'id' => 152,
                'migration' => '2022_02_24_091236_add_multiple_column_to_refund_requests_table',
                'batch' => 62,
              ),
              152 => 
              array (
                'id' => 153,
                'migration' => '2022_02_24_103827_create_refund_statuses_table',
                'batch' => 62,
              ),
              153 => 
              array (
                'id' => 154,
                'migration' => '2022_03_01_121420_add_refund_id_to_refund_transactions_table',
                'batch' => 62,
              ),
              154 => 
              array (
                'id' => 155,
                'migration' => '2022_03_10_091943_add_priority_to_categories_table',
                'batch' => 63,
              ),
              155 => 
              array (
                'id' => 156,
                'migration' => '2022_03_13_111914_create_shipping_types_table',
                'batch' => 63,
              ),
              156 => 
              array (
                'id' => 157,
                'migration' => '2022_03_13_121514_create_category_shipping_costs_table',
                'batch' => 63,
              ),
              157 => 
              array (
                'id' => 158,
                'migration' => '2022_03_14_074413_add_four_column_to_products_table',
                'batch' => 63,
              ),
              158 => 
              array (
                'id' => 159,
                'migration' => '2022_03_15_105838_add_shipping_to_carts_table',
                'batch' => 63,
              ),
              159 => 
              array (
                'id' => 160,
                'migration' => '2022_03_16_070327_add_shipping_type_to_orders_table',
                'batch' => 63,
              ),
              160 => 
              array (
                'id' => 161,
                'migration' => '2022_03_17_070200_add_delivery_info_to_orders_table',
                'batch' => 63,
              ),
              161 => 
              array (
                'id' => 162,
                'migration' => '2022_03_18_143339_add_shipping_type_to_carts_table',
                'batch' => 63,
              ),
              162 => 
              array (
                'id' => 163,
                'migration' => '2022_04_06_020313_create_subscriptions_table',
                'batch' => 64,
              ),
              163 => 
              array (
                'id' => 164,
                'migration' => '2022_04_12_233704_change_column_to_products_table',
                'batch' => 64,
              ),
              164 => 
              array (
                'id' => 165,
                'migration' => '2022_04_19_095926_create_jobs_table',
                'batch' => 64,
              ),
              165 => 
              array (
                'id' => 166,
                'migration' => '2022_05_12_104247_create_wallet_transactions_table',
                'batch' => 65,
              ),
              166 => 
              array (
                'id' => 167,
                'migration' => '2022_05_12_104511_add_two_column_to_users_table',
                'batch' => 65,
              ),
              167 => 
              array (
                'id' => 168,
                'migration' => '2022_05_14_063309_create_loyalty_point_transactions_table',
                'batch' => 65,
              ),
              168 => 
              array (
                'id' => 169,
                'migration' => '2022_05_26_044016_add_user_type_to_password_resets_table',
                'batch' => 65,
              ),
              169 => 
              array (
                'id' => 170,
                'migration' => '2022_04_15_235820_add_provider',
                'batch' => 66,
              ),
              170 => 
              array (
                'id' => 171,
                'migration' => '2022_07_21_101659_add_code_to_products_table',
                'batch' => 66,
              ),
              171 => 
              array (
                'id' => 172,
                'migration' => '2022_07_26_103744_add_notification_count_to_notifications_table',
                'batch' => 66,
              ),
              172 => 
              array (
                'id' => 173,
                'migration' => '2022_07_31_031541_add_minimum_order_qty_to_products_table',
                'batch' => 66,
              ),
              173 => 
              array (
                'id' => 174,
                'migration' => '2022_08_11_172839_add_product_type_and_digital_product_type_and_digital_file_ready_to_products',
                'batch' => 67,
              ),
              174 => 
              array (
                'id' => 175,
                'migration' => '2022_08_11_173941_add_product_type_and_digital_product_type_and_digital_file_to_order_details',
                'batch' => 67,
              ),
              175 => 
              array (
                'id' => 176,
                'migration' => '2022_08_20_094225_add_product_type_and_digital_product_type_and_digital_file_ready_to_carts_table',
                'batch' => 67,
              ),
              176 => 
              array (
                'id' => 177,
                'migration' => '2022_10_04_160234_add_banking_columns_to_delivery_men_table',
                'batch' => 68,
              ),
              177 => 
              array (
                'id' => 178,
                'migration' => '2022_10_04_161339_create_deliveryman_wallets_table',
                'batch' => 68,
              ),
              178 => 
              array (
                'id' => 179,
                'migration' => '2022_10_04_184506_add_deliverymanid_column_to_withdraw_requests_table',
                'batch' => 68,
              ),
              179 => 
              array (
                'id' => 180,
                'migration' => '2022_10_11_103011_add_deliverymans_columns_to_chattings_table',
                'batch' => 68,
              ),
              180 => 
              array (
                'id' => 181,
                'migration' => '2022_10_11_144902_add_deliverman_id_cloumn_to_reviews_table',
                'batch' => 68,
              ),
              181 => 
              array (
                'id' => 182,
                'migration' => '2022_10_17_114744_create_order_status_histories_table',
                'batch' => 68,
              ),
              182 => 
              array (
                'id' => 183,
                'migration' => '2022_10_17_120840_create_order_expected_delivery_histories_table',
                'batch' => 68,
              ),
              183 => 
              array (
                'id' => 184,
                'migration' => '2022_10_18_084245_add_deliveryman_charge_and_expected_delivery_date',
                'batch' => 68,
              ),
              184 => 
              array (
                'id' => 185,
                'migration' => '2022_10_18_130938_create_delivery_zip_codes_table',
                'batch' => 68,
              ),
              185 => 
              array (
                'id' => 186,
                'migration' => '2022_10_18_130956_create_delivery_country_codes_table',
                'batch' => 68,
              ),
              186 => 
              array (
                'id' => 187,
                'migration' => '2022_10_20_164712_create_delivery_man_transactions_table',
                'batch' => 68,
              ),
              187 => 
              array (
                'id' => 188,
                'migration' => '2022_10_27_145604_create_emergency_contacts_table',
                'batch' => 68,
              ),
              188 => 
              array (
                'id' => 189,
                'migration' => '2022_10_29_182930_add_is_pause_cause_to_orders_table',
                'batch' => 68,
              ),
              189 => 
              array (
                'id' => 190,
                'migration' => '2022_10_31_150604_add_address_phone_country_code_column_to_delivery_men_table',
                'batch' => 68,
              ),
              190 => 
              array (
                'id' => 191,
                'migration' => '2022_11_05_185726_add_order_id_to_reviews_table',
                'batch' => 68,
              ),
              191 => 
              array (
                'id' => 192,
                'migration' => '2022_11_07_190749_create_deliveryman_notifications_table',
                'batch' => 68,
              ),
              192 => 
              array (
                'id' => 193,
                'migration' => '2022_11_08_132745_change_transaction_note_type_to_withdraw_requests_table',
                'batch' => 68,
              ),
              193 => 
              array (
                'id' => 194,
                'migration' => '2022_11_10_193747_chenge_order_amount_seller_amount_admin_commission_delivery_charge_tax_toorder_transactions_table',
                'batch' => 68,
              ),
              194 => 
              array (
                'id' => 195,
                'migration' => '2022_12_17_035723_few_field_add_to_coupons_table',
                'batch' => 69,
              ),
              195 => 
              array (
                'id' => 196,
                'migration' => '2022_12_26_231606_add_coupon_discount_bearer_and_admin_commission_to_orders',
                'batch' => 69,
              ),
              196 => 
              array (
                'id' => 197,
                'migration' => '2023_01_04_003034_alter_billing_addresses_change_zip',
                'batch' => 69,
              ),
              197 => 
              array (
                'id' => 198,
                'migration' => '2023_01_05_121600_change_id_to_transactions_table',
                'batch' => 69,
              ),
              198 => 
              array (
                'id' => 199,
                'migration' => '2023_02_02_113330_create_product_tag_table',
                'batch' => 70,
              ),
              199 => 
              array (
                'id' => 200,
                'migration' => '2023_02_02_114518_create_tags_table',
                'batch' => 70,
              ),
              200 => 
              array (
                'id' => 201,
                'migration' => '2023_02_02_152248_add_tax_model_to_products_table',
                'batch' => 70,
              ),
              201 => 
              array (
                'id' => 202,
                'migration' => '2023_02_02_152718_add_tax_model_to_order_details_table',
                'batch' => 70,
              ),
              202 => 
              array (
                'id' => 203,
                'migration' => '2023_02_02_171034_add_tax_type_to_carts',
                'batch' => 70,
              ),
              203 => 
              array (
                'id' => 204,
                'migration' => '2023_02_06_124447_add_color_image_column_to_products_table',
                'batch' => 70,
              ),
              204 => 
              array (
                'id' => 205,
                'migration' => '2023_02_07_120136_create_withdrawal_methods_table',
                'batch' => 70,
              ),
              205 => 
              array (
                'id' => 206,
                'migration' => '2023_02_07_175939_add_withdrawal_method_id_and_withdrawal_method_fields_to_withdraw_requests_table',
                'batch' => 70,
              ),
              206 => 
              array (
                'id' => 207,
                'migration' => '2023_02_08_143314_add_vacation_start_and_vacation_end_and_vacation_not_column_to_shops_table',
                'batch' => 70,
              ),
              207 => 
              array (
                'id' => 208,
                'migration' => '2023_02_09_104656_add_payment_by_and_payment_not_to_orders_table',
                'batch' => 70,
              ),
              208 => 
              array (
                'id' => 209,
                'migration' => '2023_03_27_150723_add_expires_at_to_phone_or_email_verifications',
                'batch' => 71,
              ),
              209 => 
              array (
                'id' => 210,
                'migration' => '2023_04_17_095721_create_shop_followers_table',
                'batch' => 71,
              ),
              210 => 
              array (
                'id' => 211,
                'migration' => '2023_04_17_111249_add_bottom_banner_to_shops_table',
                'batch' => 71,
              ),
              211 => 
              array (
                'id' => 212,
                'migration' => '2023_04_20_125423_create_product_compares_table',
                'batch' => 71,
              ),
              212 => 
              array (
                'id' => 213,
                'migration' => '2023_04_30_165642_add_category_sub_category_and_sub_sub_category_add_in_product_table',
                'batch' => 71,
              ),
              213 => 
              array (
                'id' => 214,
                'migration' => '2023_05_16_131006_add_expires_at_to_password_resets',
                'batch' => 71,
              ),
              214 => 
              array (
                'id' => 215,
                'migration' => '2023_05_17_044243_add_visit_count_to_tags_table',
                'batch' => 71,
              ),
              215 => 
              array (
                'id' => 216,
                'migration' => '2023_05_18_000403_add_title_and_subtitle_and_background_color_and_button_text_to_banners_table',
                'batch' => 71,
              ),
              216 => 
              array (
                'id' => 217,
                'migration' => '2023_05_21_111300_add_login_hit_count_and_is_temp_blocked_and_temp_block_time_to_users_table',
                'batch' => 71,
              ),
              217 => 
              array (
                'id' => 218,
                'migration' => '2023_05_21_111600_add_login_hit_count_and_is_temp_blocked_and_temp_block_time_to_phone_or_email_verifications_table',
                'batch' => 71,
              ),
              218 => 
              array (
                'id' => 219,
                'migration' => '2023_05_21_112215_add_login_hit_count_and_is_temp_blocked_and_temp_block_time_to_password_resets_table',
                'batch' => 71,
              ),
              219 => 
              array (
                'id' => 220,
                'migration' => '2023_06_04_210726_attachment_lenght_change_to_reviews_table',
                'batch' => 71,
              ),
              220 => 
              array (
                'id' => 221,
                'migration' => '2023_06_05_115153_add_referral_code_and_referred_by_to_users_table',
                'batch' => 72,
              ),
              221 => 
              array (
                'id' => 222,
                'migration' => '2023_06_21_002658_add_offer_banner_to_shops_table',
                'batch' => 72,
              ),
              222 => 
              array (
                'id' => 223,
                'migration' => '2023_07_08_210747_create_most_demandeds_table',
                'batch' => 72,
              ),
              223 => 
              array (
                'id' => 224,
                'migration' => '2023_07_31_111419_add_minimum_order_amount_to_sellers_table',
                'batch' => 72,
              ),
              224 => 
              array (
                'id' => 225,
                'migration' => '2023_08_03_105256_create_offline_payment_methods_table',
                'batch' => 72,
              ),
              225 => 
              array (
                'id' => 226,
                'migration' => '2023_08_07_131013_add_is_guest_column_to_carts_table',
                'batch' => 72,
              ),
              226 => 
              array (
                'id' => 227,
                'migration' => '2023_08_07_170601_create_offline_payments_table',
                'batch' => 72,
              ),
              227 => 
              array (
                'id' => 228,
                'migration' => '2023_08_12_102355_create_add_fund_bonus_categories_table',
                'batch' => 72,
              ),
              228 => 
              array (
                'id' => 229,
                'migration' => '2023_08_12_215346_create_guest_users_table',
                'batch' => 72,
              ),
              229 => 
              array (
                'id' => 230,
                'migration' => '2023_08_12_215659_add_is_guest_column_to_orders_table',
                'batch' => 72,
              ),
              230 => 
              array (
                'id' => 231,
                'migration' => '2023_08_12_215933_add_is_guest_column_to_shipping_addresses_table',
                'batch' => 72,
              ),
              231 => 
              array (
                'id' => 232,
                'migration' => '2023_08_15_000957_add_email_column_toshipping_address_table',
                'batch' => 72,
              ),
              232 => 
              array (
                'id' => 233,
                'migration' => '2023_08_17_222330_add_identify_related_columns_to_admins_table',
                'batch' => 72,
              ),
              233 => 
              array (
                'id' => 234,
                'migration' => '2023_08_20_230624_add_sent_by_and_send_to_in_notifications_table',
                'batch' => 72,
              ),
              234 => 
              array (
                'id' => 235,
                'migration' => '2023_08_20_230911_create_notification_seens_table',
                'batch' => 72,
              ),
              235 => 
              array (
                'id' => 236,
                'migration' => '2023_08_21_042331_add_theme_to_banners_table',
                'batch' => 72,
              ),
              236 => 
              array (
                'id' => 237,
                'migration' => '2023_08_24_150009_add_free_delivery_over_amount_and_status_to_seller_table',
                'batch' => 72,
              ),
              237 => 
              array (
                'id' => 238,
                'migration' => '2023_08_26_161214_add_is_shipping_free_to_orders_table',
                'batch' => 72,
              ),
              238 => 
              array (
                'id' => 239,
                'migration' => '2023_08_26_173523_add_payment_method_column_to_wallet_transactions_table',
                'batch' => 72,
              ),
              239 => 
              array (
                'id' => 240,
                'migration' => '2023_08_26_204653_add_verification_status_column_to_orders_table',
                'batch' => 72,
              ),
              240 => 
              array (
                'id' => 241,
                'migration' => '2023_08_26_225113_create_order_delivery_verifications_table',
                'batch' => 72,
              ),
              241 => 
              array (
                'id' => 242,
                'migration' => '2023_09_03_212200_add_free_delivery_responsibility_column_to_orders_table',
                'batch' => 72,
              ),
              242 => 
              array (
                'id' => 243,
                'migration' => '2023_09_23_153314_add_shipping_responsibility_column_to_orders_table',
                'batch' => 72,
              ),
              243 => 
              array (
                'id' => 244,
                'migration' => '2023_09_25_152733_create_digital_product_otp_verifications_table',
                'batch' => 72,
              ),
              244 => 
              array (
                'id' => 245,
                'migration' => '2023_09_27_191638_add_attachment_column_to_support_ticket_convs_table',
                'batch' => 73,
              ),
              245 => 
              array (
                'id' => 246,
                'migration' => '2023_10_01_205117_add_attachment_column_to_chattings_table',
                'batch' => 73,
              ),
              246 => 
              array (
                'id' => 247,
                'migration' => '2023_10_07_182714_create_notification_messages_table',
                'batch' => 73,
              ),
              247 => 
              array (
                'id' => 248,
                'migration' => '2023_10_21_113354_add_app_language_column_to_users_table',
                'batch' => 73,
              ),
              248 => 
              array (
                'id' => 249,
                'migration' => '2023_10_21_123433_add_app_language_column_to_sellers_table',
                'batch' => 73,
              ),
              249 => 
              array (
                'id' => 250,
                'migration' => '2023_10_21_124657_add_app_language_column_to_delivery_men_table',
                'batch' => 73,
              ),
              250 => 
              array (
                'id' => 251,
                'migration' => '2023_10_22_130225_add_attachment_to_support_tickets_table',
                'batch' => 73,
              ),
              251 => 
              array (
                'id' => 252,
                'migration' => '2023_10_25_113233_make_message_nullable_in_chattings_table',
                'batch' => 73,
              ),
              252 => 
              array (
                'id' => 253,
                'migration' => '2023_10_30_152005_make_attachment_column_type_change_to_reviews_table',
                'batch' => 73,
              ),
              253 => 
              array (
                'id' => 254,
                'migration' => '2024_01_14_192546_add_slug_to_shops_table',
                'batch' => 74,
              ),
              254 => 
              array (
                'id' => 255,
                'migration' => '2024_01_25_175421_add_country_code_to_emergency_contacts_table',
                'batch' => 75,
              ),
              255 => 
              array (
                'id' => 256,
                'migration' => '2024_02_01_200417_add_denied_count_and_approved_count_to_refund_requests_table',
                'batch' => 75,
              ),
              256 => 
              array (
                'id' => 257,
                'migration' => '2024_03_11_130425_add_seen_notification_and_notification_receiver_to_chattings_table',
                'batch' => 76,
              ),
              257 => 
              array (
                'id' => 258,
                'migration' => '2024_03_12_123322_update_images_column_in_refund_requests_table',
                'batch' => 76,
              ),
              258 => 
              array (
                'id' => 259,
                'migration' => '2024_03_21_134659_change_denied_note_column_type_to_text',
                'batch' => 76,
              ),
              259 => 
              array (
                'id' => 260,
                'migration' => '2024_04_03_093637_create_email_templates_table',
                'batch' => 77,
              ),
              260 => 
              array (
                'id' => 261,
                'migration' => '2024_04_17_102137_add_is_checked_column_to_carts_table',
                'batch' => 77,
              ),
              261 => 
              array (
                'id' => 262,
                'migration' => '2024_04_23_130436_create_vendor_registration_reasons_table',
                'batch' => 77,
              ),
              262 => 
              array (
                'id' => 263,
                'migration' => '2024_04_24_093932_add_type_to_help_topics_table',
                'batch' => 77,
              ),
              263 => 
              array (
                'id' => 264,
                'migration' => '2024_05_20_133216_create_review_replies_table',
                'batch' => 78,
              ),
              264 => 
              array (
                'id' => 265,
                'migration' => '2024_05_20_163043_add_image_alt_text_to_brands_table',
                'batch' => 78,
              ),
              265 => 
              array (
                'id' => 266,
                'migration' => '2024_05_26_152030_create_digital_product_variations_table',
                'batch' => 78,
              ),
              266 => 
              array (
                'id' => 267,
                'migration' => '2024_05_26_152339_create_product_seos_table',
                'batch' => 78,
              ),
              267 => 
              array (
                'id' => 268,
                'migration' => '2024_05_27_184401_add_digital_product_file_types_and_digital_product_extensions_to_products_table',
                'batch' => 78,
              ),
              268 => 
              array (
                'id' => 269,
                'migration' => '2024_05_30_101603_create_storages_table',
                'batch' => 78,
              ),
              269 => 
              array (
                'id' => 270,
                'migration' => '2024_06_10_174952_create_robots_meta_contents_table',
                'batch' => 78,
              ),
              270 => 
              array (
                'id' => 271,
                'migration' => '2024_06_12_105137_create_error_logs_table',
                'batch' => 78,
              ),
              271 => 
              array (
                'id' => 272,
                'migration' => '2024_07_03_130217_add_storage_type_columns_to_product_table',
                'batch' => 78,
              ),
              272 => 
              array (
                'id' => 273,
                'migration' => '2024_07_03_153301_add_icon_storage_type_to_catogory_table',
                'batch' => 78,
              ),
              273 => 
              array (
                'id' => 274,
                'migration' => '2024_07_03_171214_add_image_storage_type_to_brands_table',
                'batch' => 78,
              ),
              274 => 
              array (
                'id' => 275,
                'migration' => '2024_07_03_185048_add_storage_type_columns_to_shop_table',
                'batch' => 78,
              ),
              275 => 
              array (
                'id' => 276,
                'migration' => '2024_07_31_133306_create_login_setups_table',
                'batch' => 79,
              ),
              276 => 
              array (
                'id' => 277,
                'migration' => '2024_08_04_123750_add_preview_file_to_products_table',
                'batch' => 79,
              ),
              277 => 
              array (
                'id' => 278,
                'migration' => '2024_08_04_123805_create_authors_table',
                'batch' => 79,
              ),
              278 => 
              array (
                'id' => 279,
                'migration' => '2024_08_04_123845_create_publishing_houses_table',
                'batch' => 79,
              ),
              279 => 
              array (
                'id' => 280,
                'migration' => '2024_08_04_124023_create_digital_product_authors_table',
                'batch' => 79,
              ),
              280 => 
              array (
                'id' => 281,
                'migration' => '2024_08_04_124046_create_digital_product_publishing_houses_table',
                'batch' => 79,
              ),
              281 => 
              array (
                'id' => 282,
                'migration' => '2024_08_25_130313_modify_email_column_as_nullable_in_users_table',
                'batch' => 79,
              ),
              282 => 
              array (
                'id' => 283,
                'migration' => '2024_08_26_130313_modify_token_column_as_text_in_phone_or_email_verifications_table',
                'batch' => 79,
              ),
              283 => 
              array (
                'id' => 284,
                'migration' => '2024_10_01_130036_add_paid_amount_column_in_orders_table',
                'batch' => 80,
              ),
              284 => 
              array (
                'id' => 285,
                'migration' => '2024_10_01_131352_create_restock_products_table',
                'batch' => 80,
              ),
              285 => 
              array (
                'id' => 286,
                'migration' => '2024_10_01_132315_create_restock_product_customers_table',
                'batch' => 80,
              ),
              286 => 
              array (
                'id' => 290,
                'migration' => '2025_02_18_165709_create_add_fund_bonus_categories_table',
                'batch' => 0,
              ),
              287 => 
              array (
                'id' => 291,
                'migration' => '2025_02_18_165709_create_addon_settings_table',
                'batch' => 0,
              ),
              288 => 
              array (
                'id' => 292,
                'migration' => '2025_02_18_165709_create_admin_roles_table',
                'batch' => 0,
              ),
              289 => 
              array (
                'id' => 293,
                'migration' => '2025_02_18_165709_create_admin_wallet_histories_table',
                'batch' => 0,
              ),
              290 => 
              array (
                'id' => 294,
                'migration' => '2025_02_18_165709_create_admin_wallets_table',
                'batch' => 0,
              ),
              291 => 
              array (
                'id' => 295,
                'migration' => '2025_02_18_165709_create_admins_table',
                'batch' => 0,
              ),
              292 => 
              array (
                'id' => 296,
                'migration' => '2025_02_18_165709_create_analytic_scripts_table',
                'batch' => 0,
              ),
              293 => 
              array (
                'id' => 297,
                'migration' => '2025_02_18_165709_create_attributes_table',
                'batch' => 0,
              ),
              294 => 
              array (
                'id' => 298,
                'migration' => '2025_02_18_165709_create_authors_table',
                'batch' => 0,
              ),
              295 => 
              array (
                'id' => 299,
                'migration' => '2025_02_18_165709_create_banners_table',
                'batch' => 0,
              ),
              296 => 
              array (
                'id' => 300,
                'migration' => '2025_02_18_165709_create_billing_addresses_table',
                'batch' => 0,
              ),
              297 => 
              array (
                'id' => 301,
                'migration' => '2025_02_18_165709_create_brands_table',
                'batch' => 0,
              ),
              298 => 
              array (
                'id' => 302,
                'migration' => '2025_02_18_165709_create_business_settings_table',
                'batch' => 0,
              ),
              299 => 
              array (
                'id' => 303,
                'migration' => '2025_02_18_165709_create_cart_shippings_table',
                'batch' => 0,
              ),
              300 => 
              array (
                'id' => 304,
                'migration' => '2025_02_18_165709_create_carts_table',
                'batch' => 0,
              ),
              301 => 
              array (
                'id' => 305,
                'migration' => '2025_02_18_165709_create_categories_table',
                'batch' => 0,
              ),
              302 => 
              array (
                'id' => 306,
                'migration' => '2025_02_18_165709_create_category_shipping_costs_table',
                'batch' => 0,
              ),
              303 => 
              array (
                'id' => 307,
                'migration' => '2025_02_18_165709_create_chattings_table',
                'batch' => 0,
              ),
              304 => 
              array (
                'id' => 308,
                'migration' => '2025_02_18_165709_create_colors_table',
                'batch' => 0,
              ),
              305 => 
              array (
                'id' => 309,
                'migration' => '2025_02_18_165709_create_contacts_table',
                'batch' => 0,
              ),
              306 => 
              array (
                'id' => 310,
                'migration' => '2025_02_18_165709_create_coupons_table',
                'batch' => 0,
              ),
              307 => 
              array (
                'id' => 311,
                'migration' => '2025_02_18_165709_create_currencies_table',
                'batch' => 0,
              ),
              308 => 
              array (
                'id' => 312,
                'migration' => '2025_02_18_165709_create_customer_wallet_histories_table',
                'batch' => 0,
              ),
              309 => 
              array (
                'id' => 313,
                'migration' => '2025_02_18_165709_create_customer_wallets_table',
                'batch' => 0,
              ),
              310 => 
              array (
                'id' => 314,
                'migration' => '2025_02_18_165709_create_deal_of_the_days_table',
                'batch' => 0,
              ),
              311 => 
              array (
                'id' => 315,
                'migration' => '2025_02_18_165709_create_delivery_country_codes_table',
                'batch' => 0,
              ),
              312 => 
              array (
                'id' => 316,
                'migration' => '2025_02_18_165709_create_delivery_histories_table',
                'batch' => 0,
              ),
              313 => 
              array (
                'id' => 317,
                'migration' => '2025_02_18_165709_create_delivery_man_transactions_table',
                'batch' => 0,
              ),
              314 => 
              array (
                'id' => 318,
                'migration' => '2025_02_18_165709_create_delivery_men_table',
                'batch' => 0,
              ),
              315 => 
              array (
                'id' => 319,
                'migration' => '2025_02_18_165709_create_delivery_zip_codes_table',
                'batch' => 0,
              ),
              316 => 
              array (
                'id' => 320,
                'migration' => '2025_02_18_165709_create_deliveryman_notifications_table',
                'batch' => 0,
              ),
              317 => 
              array (
                'id' => 321,
                'migration' => '2025_02_18_165709_create_deliveryman_wallets_table',
                'batch' => 0,
              ),
              318 => 
              array (
                'id' => 322,
                'migration' => '2025_02_18_165709_create_digital_product_authors_table',
                'batch' => 0,
              ),
              319 => 
              array (
                'id' => 323,
                'migration' => '2025_02_18_165709_create_digital_product_otp_verifications_table',
                'batch' => 0,
              ),
              320 => 
              array (
                'id' => 324,
                'migration' => '2025_02_18_165709_create_digital_product_publishing_houses_table',
                'batch' => 0,
              ),
              321 => 
              array (
                'id' => 325,
                'migration' => '2025_02_18_165709_create_digital_product_variations_table',
                'batch' => 0,
              ),
              322 => 
              array (
                'id' => 326,
                'migration' => '2025_02_18_165709_create_email_templates_table',
                'batch' => 0,
              ),
              323 => 
              array (
                'id' => 327,
                'migration' => '2025_02_18_165709_create_emergency_contacts_table',
                'batch' => 0,
              ),
              324 => 
              array (
                'id' => 328,
                'migration' => '2025_02_18_165709_create_error_logs_table',
                'batch' => 0,
              ),
              325 => 
              array (
                'id' => 329,
                'migration' => '2025_02_18_165709_create_failed_jobs_table',
                'batch' => 0,
              ),
              326 => 
              array (
                'id' => 330,
                'migration' => '2025_02_18_165709_create_feature_deals_table',
                'batch' => 0,
              ),
              327 => 
              array (
                'id' => 331,
                'migration' => '2025_02_18_165709_create_flash_deal_products_table',
                'batch' => 0,
              ),
              328 => 
              array (
                'id' => 332,
                'migration' => '2025_02_18_165709_create_flash_deals_table',
                'batch' => 0,
              ),
              329 => 
              array (
                'id' => 333,
                'migration' => '2025_02_18_165709_create_guest_users_table',
                'batch' => 0,
              ),
              330 => 
              array (
                'id' => 334,
                'migration' => '2025_02_18_165709_create_help_topics_table',
                'batch' => 0,
              ),
              331 => 
              array (
                'id' => 335,
                'migration' => '2025_02_18_165709_create_jobs_table',
                'batch' => 0,
              ),
              332 => 
              array (
                'id' => 336,
                'migration' => '2025_02_18_165709_create_login_setups_table',
                'batch' => 0,
              ),
              333 => 
              array (
                'id' => 337,
                'migration' => '2025_02_18_165709_create_loyalty_point_transactions_table',
                'batch' => 0,
              ),
              334 => 
              array (
                'id' => 338,
                'migration' => '2025_02_18_165709_create_most_demandeds_table',
                'batch' => 0,
              ),
              335 => 
              array (
                'id' => 339,
                'migration' => '2025_02_18_165709_create_notification_messages_table',
                'batch' => 0,
              ),
              336 => 
              array (
                'id' => 340,
                'migration' => '2025_02_18_165709_create_notification_seens_table',
                'batch' => 0,
              ),
              337 => 
              array (
                'id' => 341,
                'migration' => '2025_02_18_165709_create_notifications_table',
                'batch' => 0,
              ),
              338 => 
              array (
                'id' => 342,
                'migration' => '2025_02_18_165709_create_oauth_access_tokens_table',
                'batch' => 0,
              ),
              339 => 
              array (
                'id' => 343,
                'migration' => '2025_02_18_165709_create_oauth_auth_codes_table',
                'batch' => 0,
              ),
              340 => 
              array (
                'id' => 344,
                'migration' => '2025_02_18_165709_create_oauth_clients_table',
                'batch' => 0,
              ),
              341 => 
              array (
                'id' => 345,
                'migration' => '2025_02_18_165709_create_oauth_personal_access_clients_table',
                'batch' => 0,
              ),
              342 => 
              array (
                'id' => 346,
                'migration' => '2025_02_18_165709_create_oauth_refresh_tokens_table',
                'batch' => 0,
              ),
              343 => 
              array (
                'id' => 347,
                'migration' => '2025_02_18_165709_create_offline_payment_methods_table',
                'batch' => 0,
              ),
              344 => 
              array (
                'id' => 348,
                'migration' => '2025_02_18_165709_create_offline_payments_table',
                'batch' => 0,
              ),
              345 => 
              array (
                'id' => 349,
                'migration' => '2025_02_18_165709_create_order_delivery_verifications_table',
                'batch' => 0,
              ),
              346 => 
              array (
                'id' => 350,
                'migration' => '2025_02_18_165709_create_order_details_table',
                'batch' => 0,
              ),
              347 => 
              array (
                'id' => 351,
                'migration' => '2025_02_18_165709_create_order_expected_delivery_histories_table',
                'batch' => 0,
              ),
              348 => 
              array (
                'id' => 352,
                'migration' => '2025_02_18_165709_create_order_status_histories_table',
                'batch' => 0,
              ),
              349 => 
              array (
                'id' => 353,
                'migration' => '2025_02_18_165709_create_order_transactions_table',
                'batch' => 0,
              ),
              350 => 
              array (
                'id' => 354,
                'migration' => '2025_02_18_165709_create_orders_table',
                'batch' => 0,
              ),
              351 => 
              array (
                'id' => 355,
                'migration' => '2025_02_18_165709_create_password_resets_table',
                'batch' => 0,
              ),
              352 => 
              array (
                'id' => 356,
                'migration' => '2025_02_18_165709_create_payment_requests_table',
                'batch' => 0,
              ),
              353 => 
              array (
                'id' => 357,
                'migration' => '2025_02_18_165709_create_paytabs_invoices_table',
                'batch' => 0,
              ),
              354 => 
              array (
                'id' => 358,
                'migration' => '2025_02_18_165709_create_personal_access_tokens_table',
                'batch' => 0,
              ),
              355 => 
              array (
                'id' => 359,
                'migration' => '2025_02_18_165709_create_phone_or_email_verifications_table',
                'batch' => 0,
              ),
              356 => 
              array (
                'id' => 360,
                'migration' => '2025_02_18_165709_create_product_compares_table',
                'batch' => 0,
              ),
              357 => 
              array (
                'id' => 361,
                'migration' => '2025_02_18_165709_create_product_seos_table',
                'batch' => 0,
              ),
              358 => 
              array (
                'id' => 362,
                'migration' => '2025_02_18_165709_create_product_stocks_table',
                'batch' => 0,
              ),
              359 => 
              array (
                'id' => 363,
                'migration' => '2025_02_18_165709_create_product_tag_table',
                'batch' => 0,
              ),
              360 => 
              array (
                'id' => 364,
                'migration' => '2025_02_18_165709_create_products_table',
                'batch' => 0,
              ),
              361 => 
              array (
                'id' => 365,
                'migration' => '2025_02_18_165709_create_publishing_houses_table',
                'batch' => 0,
              ),
              362 => 
              array (
                'id' => 366,
                'migration' => '2025_02_18_165709_create_refund_requests_table',
                'batch' => 0,
              ),
              363 => 
              array (
                'id' => 367,
                'migration' => '2025_02_18_165709_create_refund_statuses_table',
                'batch' => 0,
              ),
              364 => 
              array (
                'id' => 368,
                'migration' => '2025_02_18_165709_create_refund_transactions_table',
                'batch' => 0,
              ),
              365 => 
              array (
                'id' => 369,
                'migration' => '2025_02_18_165709_create_restock_product_customers_table',
                'batch' => 0,
              ),
              366 => 
              array (
                'id' => 370,
                'migration' => '2025_02_18_165709_create_restock_products_table',
                'batch' => 0,
              ),
              367 => 
              array (
                'id' => 371,
                'migration' => '2025_02_18_165709_create_review_replies_table',
                'batch' => 0,
              ),
              368 => 
              array (
                'id' => 372,
                'migration' => '2025_02_18_165709_create_reviews_table',
                'batch' => 0,
              ),
              369 => 
              array (
                'id' => 373,
                'migration' => '2025_02_18_165709_create_robots_meta_contents_table',
                'batch' => 0,
              ),
              370 => 
              array (
                'id' => 374,
                'migration' => '2025_02_18_165709_create_search_functions_table',
                'batch' => 0,
              ),
              371 => 
              array (
                'id' => 375,
                'migration' => '2025_02_18_165709_create_seller_wallet_histories_table',
                'batch' => 0,
              ),
              372 => 
              array (
                'id' => 376,
                'migration' => '2025_02_18_165709_create_seller_wallets_table',
                'batch' => 0,
              ),
              373 => 
              array (
                'id' => 377,
                'migration' => '2025_02_18_165709_create_sellers_table',
                'batch' => 0,
              ),
              374 => 
              array (
                'id' => 378,
                'migration' => '2025_02_18_165709_create_shipping_addresses_table',
                'batch' => 0,
              ),
              375 => 
              array (
                'id' => 379,
                'migration' => '2025_02_18_165709_create_shipping_methods_table',
                'batch' => 0,
              ),
              376 => 
              array (
                'id' => 380,
                'migration' => '2025_02_18_165709_create_shipping_types_table',
                'batch' => 0,
              ),
              377 => 
              array (
                'id' => 381,
                'migration' => '2025_02_18_165709_create_shop_followers_table',
                'batch' => 0,
              ),
              378 => 
              array (
                'id' => 382,
                'migration' => '2025_02_18_165709_create_shops_table',
                'batch' => 0,
              ),
              379 => 
              array (
                'id' => 383,
                'migration' => '2025_02_18_165709_create_social_medias_table',
                'batch' => 0,
              ),
              380 => 
              array (
                'id' => 384,
                'migration' => '2025_02_18_165709_create_soft_credentials_table',
                'batch' => 0,
              ),
              381 => 
              array (
                'id' => 385,
                'migration' => '2025_02_18_165709_create_stock_clearance_products_table',
                'batch' => 0,
              ),
              382 => 
              array (
                'id' => 386,
                'migration' => '2025_02_18_165709_create_stock_clearance_setups_table',
                'batch' => 0,
              ),
              383 => 
              array (
                'id' => 387,
                'migration' => '2025_02_18_165709_create_storages_table',
                'batch' => 0,
              ),
              384 => 
              array (
                'id' => 388,
                'migration' => '2025_02_18_165709_create_subscriptions_table',
                'batch' => 0,
              ),
              385 => 
              array (
                'id' => 389,
                'migration' => '2025_02_18_165709_create_support_ticket_convs_table',
                'batch' => 0,
              ),
              386 => 
              array (
                'id' => 390,
                'migration' => '2025_02_18_165709_create_support_tickets_table',
                'batch' => 0,
              ),
              387 => 
              array (
                'id' => 391,
                'migration' => '2025_02_18_165709_create_tags_table',
                'batch' => 0,
              ),
              388 => 
              array (
                'id' => 392,
                'migration' => '2025_02_18_165709_create_transactions_table',
                'batch' => 0,
              ),
              389 => 
              array (
                'id' => 393,
                'migration' => '2025_02_18_165709_create_translations_table',
                'batch' => 0,
              ),
              390 => 
              array (
                'id' => 394,
                'migration' => '2025_02_18_165709_create_users_table',
                'batch' => 0,
              ),
              391 => 
              array (
                'id' => 395,
                'migration' => '2025_02_18_165709_create_vendor_registration_reasons_table',
                'batch' => 0,
              ),
              392 => 
              array (
                'id' => 396,
                'migration' => '2025_02_18_165709_create_wallet_transactions_table',
                'batch' => 0,
              ),
              393 => 
              array (
                'id' => 397,
                'migration' => '2025_02_18_165709_create_wishlists_table',
                'batch' => 0,
              ),
              394 => 
              array (
                'id' => 398,
                'migration' => '2025_02_18_165709_create_withdraw_requests_table',
                'batch' => 0,
              ),
              395 => 
              array (
                'id' => 399,
                'migration' => '2025_02_18_165709_create_withdrawal_methods_table',
                'batch' => 0,
              ),
              396 => 
              array (
                'id' => 403,
                'migration' => '2024_11_02_075917_create_stock_clearance_setups_table',
                'batch' => 81,
              ),
              397 => 
              array (
                'id' => 404,
                'migration' => '2024_11_02_075931_create_stock_clearance_products_table',
                'batch' => 81,
              ),
              398 => 
              array (
                'id' => 405,
                'migration' => '2024_11_04_162929_create_analytic_scripts_table',
                'batch' => 81,
              ),
              399 => 
              array (
                'id' => 406,
                'migration' => '2025_11_24_162527_create_purchase_requisitions_table',
                'batch' => 81,
              ),
              400 => 
              array (
                'id' => 407,
                'migration' => '2025_11_24_162537_create_purchase_requisition_items_table',
                'batch' => 81,
              ),
              401 => 
              array (
                'id' => 408,
                'migration' => '2025_11_24_162546_create_purchase_orders_table',
                'batch' => 81,
              ),
              402 => 
              array (
                'id' => 409,
                'migration' => '2025_11_24_162550_create_purchase_order_items_table',
                'batch' => 81,
              ),
              403 => 
              array (
                'id' => 410,
                'migration' => '2025_11_24_162555_create_purchase_order_approvals_table',
                'batch' => 81,
              ),
              404 => 
              array (
                'id' => 411,
                'migration' => '2025_11_24_162600_create_purchase_documents_table',
                'batch' => 81,
              ),
              405 => 
              array (
                'id' => 412,
                'migration' => '2025_11_24_162606_create_purchase_grns_table',
                'batch' => 81,
              ),
              406 => 
              array (
                'id' => 413,
                'migration' => '2025_11_24_162613_create_purchase_grn_items_table',
                'batch' => 81,
              ),
              407 => 
              array (
                'id' => 414,
                'migration' => '2025_11_24_163002_create_purchase_invoices_table',
                'batch' => 81,
              ),
              408 => 
              array (
                'id' => 415,
                'migration' => '2025_11_24_163009_create_purchase_invoice_items_table',
                'batch' => 81,
              ),
              409 => 
              array (
                'id' => 416,
                'migration' => '2025_11_24_163014_create_purchase_events_table',
                'batch' => 81,
              ),
              410 => 
              array (
                'id' => 417,
                'migration' => '2025_11_25_035443_create_purchase_vendors_table',
                'batch' => 81,
              ),
              411 => 
              array (
                'id' => 418,
                'migration' => '2025_11_25_035447_create_purchase_vendor_contacts_table',
                'batch' => 81,
              ),
              412 => 
              array (
                'id' => 419,
                'migration' => '2025_11_25_035450_create_purchase_vendor_metrics_table',
                'batch' => 81,
              ),
              413 => 
              array (
                'id' => 420,
                'migration' => '2025_11_25_041347_create_purchase_approval_routes_table',
                'batch' => 81,
              ),
              414 => 
              array (
                'id' => 421,
                'migration' => '2025_11_25_041351_create_purchase_approval_steps_table',
                'batch' => 81,
              ),
              415 => 
              array (
                'id' => 422,
                'migration' => '2025_11_25_120000_create_purchase_order_communications_table',
                'batch' => 81,
              ),
              416 => 
              array (
                'id' => 423,
                'migration' => '2025_11_25_131500_update_purchase_grn_schema',
                'batch' => 81,
              ),
              417 => 
              array (
                'id' => 424,
                'migration' => '2025_11_25_140000_create_finance_accounts_table',
                'batch' => 81,
              ),
              418 => 
              array (
                'id' => 425,
                'migration' => '2025_11_25_140100_create_finance_fiscal_periods_table',
                'batch' => 81,
              ),
              419 => 
              array (
                'id' => 426,
                'migration' => '2025_11_25_140200_create_finance_journals_table',
                'batch' => 81,
              ),
              420 => 
              array (
                'id' => 427,
                'migration' => '2025_11_25_140300_create_finance_journal_rows_table',
                'batch' => 81,
              ),
              421 => 
              array (
                'id' => 428,
                'migration' => '2025_11_25_140400_create_finance_reconciliations_table',
                'batch' => 81,
              ),
              422 => 
              array (
                'id' => 429,
                'migration' => '2025_11_25_140500_create_finance_reconciliation_rows_table',
                'batch' => 81,
              ),
              423 => 
              array (
                'id' => 430,
                'migration' => '2025_11_25_140600_create_finance_expenses_table',
                'batch' => 81,
              ),
              424 => 
              array (
                'id' => 431,
                'migration' => '2025_11_25_140700_create_finance_transfers_table',
                'batch' => 81,
              ),
              425 => 
              array (
                'id' => 432,
                'migration' => '2025_11_25_140800_create_finance_attachments_table',
                'batch' => 81,
              ),
              426 => 
              array (
                'id' => 433,
                'migration' => '2025_11_27_120000_add_finance_journal_id_columns',
                'batch' => 82,
              ),
              427 => 
              array (
                'id' => 434,
                'migration' => '2025_11_27_130500_add_finance_journal_refs_to_purchase_tables',
                'batch' => 82,
              ),
              428 => 
              array (
                'id' => 435,
                'migration' => '2025_11_27_140100_add_finance_journal_to_withdraw_requests',
                'batch' => 82,
              ),
              429 => 
              array (
                'id' => 436,
                'migration' => '2025_11_27_150200_add_finance_journal_to_wallet_transactions',
                'batch' => 82,
              ),
              430 => 
              array (
                'id' => 437,
                'migration' => '2025_11_27_160300_add_finance_journal_to_delivery_man_transactions',
                'batch' => 82,
              ),
              431 => 
              array (
                'id' => 438,
                'migration' => '2025_11_28_120000_create_order_partial_payments_table',
                'batch' => 83,
              ),
              432 => 
              array (
                'id' => 439,
                'migration' => '2025_11_28_130500_add_payment_account_code_to_order_partial_payments_table',
                'batch' => 83,
              ),
              433 => 
              array (
                'id' => 440,
                'migration' => '2025_12_20_170153_create_add_fund_bonus_categories_table',
                'batch' => 0,
              ),
              434 => 
              array (
                'id' => 441,
                'migration' => '2025_12_20_170153_create_addon_settings_table',
                'batch' => 0,
              ),
              435 => 
              array (
                'id' => 442,
                'migration' => '2025_12_20_170153_create_admin_roles_table',
                'batch' => 0,
              ),
              436 => 
              array (
                'id' => 443,
                'migration' => '2025_12_20_170153_create_admin_wallet_histories_table',
                'batch' => 0,
              ),
              437 => 
              array (
                'id' => 444,
                'migration' => '2025_12_20_170153_create_admin_wallets_table',
                'batch' => 0,
              ),
              438 => 
              array (
                'id' => 445,
                'migration' => '2025_12_20_170153_create_admins_table',
                'batch' => 0,
              ),
              439 => 
              array (
                'id' => 446,
                'migration' => '2025_12_20_170153_create_analytic_scripts_table',
                'batch' => 0,
              ),
              440 => 
              array (
                'id' => 447,
                'migration' => '2025_12_20_170153_create_attributes_table',
                'batch' => 0,
              ),
              441 => 
              array (
                'id' => 448,
                'migration' => '2025_12_20_170153_create_authors_table',
                'batch' => 0,
              ),
              442 => 
              array (
                'id' => 449,
                'migration' => '2025_12_20_170153_create_banners_table',
                'batch' => 0,
              ),
              443 => 
              array (
                'id' => 450,
                'migration' => '2025_12_20_170153_create_billing_addresses_table',
                'batch' => 0,
              ),
              444 => 
              array (
                'id' => 451,
                'migration' => '2025_12_20_170153_create_brands_table',
                'batch' => 0,
              ),
              445 => 
              array (
                'id' => 452,
                'migration' => '2025_12_20_170153_create_business_settings_table',
                'batch' => 0,
              ),
              446 => 
              array (
                'id' => 453,
                'migration' => '2025_12_20_170153_create_cart_shippings_table',
                'batch' => 0,
              ),
              447 => 
              array (
                'id' => 454,
                'migration' => '2025_12_20_170153_create_carts_table',
                'batch' => 0,
              ),
              448 => 
              array (
                'id' => 455,
                'migration' => '2025_12_20_170153_create_categories_table',
                'batch' => 0,
              ),
              449 => 
              array (
                'id' => 456,
                'migration' => '2025_12_20_170153_create_category_shipping_costs_table',
                'batch' => 0,
              ),
              450 => 
              array (
                'id' => 457,
                'migration' => '2025_12_20_170153_create_chattings_table',
                'batch' => 0,
              ),
              451 => 
              array (
                'id' => 458,
                'migration' => '2025_12_20_170153_create_colors_table',
                'batch' => 0,
              ),
              452 => 
              array (
                'id' => 459,
                'migration' => '2025_12_20_170153_create_contacts_table',
                'batch' => 0,
              ),
              453 => 
              array (
                'id' => 460,
                'migration' => '2025_12_20_170153_create_coupons_table',
                'batch' => 0,
              ),
              454 => 
              array (
                'id' => 461,
                'migration' => '2025_12_20_170153_create_currencies_table',
                'batch' => 0,
              ),
              455 => 
              array (
                'id' => 462,
                'migration' => '2025_12_20_170153_create_customer_wallet_histories_table',
                'batch' => 0,
              ),
              456 => 
              array (
                'id' => 463,
                'migration' => '2025_12_20_170153_create_customer_wallets_table',
                'batch' => 0,
              ),
              457 => 
              array (
                'id' => 464,
                'migration' => '2025_12_20_170153_create_deal_of_the_days_table',
                'batch' => 0,
              ),
              458 => 
              array (
                'id' => 465,
                'migration' => '2025_12_20_170153_create_delivery_country_codes_table',
                'batch' => 0,
              ),
              459 => 
              array (
                'id' => 466,
                'migration' => '2025_12_20_170153_create_delivery_histories_table',
                'batch' => 0,
              ),
              460 => 
              array (
                'id' => 467,
                'migration' => '2025_12_20_170153_create_delivery_man_transactions_table',
                'batch' => 0,
              ),
              461 => 
              array (
                'id' => 468,
                'migration' => '2025_12_20_170153_create_delivery_men_table',
                'batch' => 0,
              ),
              462 => 
              array (
                'id' => 469,
                'migration' => '2025_12_20_170153_create_delivery_zip_codes_table',
                'batch' => 0,
              ),
              463 => 
              array (
                'id' => 470,
                'migration' => '2025_12_20_170153_create_deliveryman_notifications_table',
                'batch' => 0,
              ),
              464 => 
              array (
                'id' => 471,
                'migration' => '2025_12_20_170153_create_deliveryman_wallets_table',
                'batch' => 0,
              ),
              465 => 
              array (
                'id' => 472,
                'migration' => '2025_12_20_170153_create_digital_product_authors_table',
                'batch' => 0,
              ),
              466 => 
              array (
                'id' => 473,
                'migration' => '2025_12_20_170153_create_digital_product_otp_verifications_table',
                'batch' => 0,
              ),
              467 => 
              array (
                'id' => 474,
                'migration' => '2025_12_20_170153_create_digital_product_publishing_houses_table',
                'batch' => 0,
              ),
              468 => 
              array (
                'id' => 475,
                'migration' => '2025_12_20_170153_create_digital_product_variations_table',
                'batch' => 0,
              ),
              469 => 
              array (
                'id' => 476,
                'migration' => '2025_12_20_170153_create_email_templates_table',
                'batch' => 0,
              ),
              470 => 
              array (
                'id' => 477,
                'migration' => '2025_12_20_170153_create_emergency_contacts_table',
                'batch' => 0,
              ),
              471 => 
              array (
                'id' => 478,
                'migration' => '2025_12_20_170153_create_error_logs_table',
                'batch' => 0,
              ),
              472 => 
              array (
                'id' => 479,
                'migration' => '2025_12_20_170153_create_failed_jobs_table',
                'batch' => 0,
              ),
              473 => 
              array (
                'id' => 480,
                'migration' => '2025_12_20_170153_create_feature_deals_table',
                'batch' => 0,
              ),
              474 => 
              array (
                'id' => 481,
                'migration' => '2025_12_20_170153_create_finance_accounts_table',
                'batch' => 0,
              ),
              475 => 
              array (
                'id' => 482,
                'migration' => '2025_12_20_170153_create_finance_attachments_table',
                'batch' => 0,
              ),
              476 => 
              array (
                'id' => 483,
                'migration' => '2025_12_20_170153_create_finance_expenses_table',
                'batch' => 0,
              ),
              477 => 
              array (
                'id' => 484,
                'migration' => '2025_12_20_170153_create_finance_fiscal_periods_table',
                'batch' => 0,
              ),
              478 => 
              array (
                'id' => 485,
                'migration' => '2025_12_20_170153_create_finance_journal_rows_table',
                'batch' => 0,
              ),
              479 => 
              array (
                'id' => 486,
                'migration' => '2025_12_20_170153_create_finance_journals_table',
                'batch' => 0,
              ),
              480 => 
              array (
                'id' => 487,
                'migration' => '2025_12_20_170153_create_finance_reconciliation_rows_table',
                'batch' => 0,
              ),
              481 => 
              array (
                'id' => 488,
                'migration' => '2025_12_20_170153_create_finance_reconciliations_table',
                'batch' => 0,
              ),
              482 => 
              array (
                'id' => 489,
                'migration' => '2025_12_20_170153_create_finance_transfers_table',
                'batch' => 0,
              ),
              483 => 
              array (
                'id' => 490,
                'migration' => '2025_12_20_170153_create_flash_deal_products_table',
                'batch' => 0,
              ),
              484 => 
              array (
                'id' => 491,
                'migration' => '2025_12_20_170153_create_flash_deals_table',
                'batch' => 0,
              ),
              485 => 
              array (
                'id' => 492,
                'migration' => '2025_12_20_170153_create_guest_users_table',
                'batch' => 0,
              ),
              486 => 
              array (
                'id' => 493,
                'migration' => '2025_12_20_170153_create_help_topics_table',
                'batch' => 0,
              ),
              487 => 
              array (
                'id' => 494,
                'migration' => '2025_12_20_170153_create_jobs_table',
                'batch' => 0,
              ),
              488 => 
              array (
                'id' => 495,
                'migration' => '2025_12_20_170153_create_login_setups_table',
                'batch' => 0,
              ),
              489 => 
              array (
                'id' => 496,
                'migration' => '2025_12_20_170153_create_loyalty_point_transactions_table',
                'batch' => 0,
              ),
              490 => 
              array (
                'id' => 497,
                'migration' => '2025_12_20_170153_create_most_demandeds_table',
                'batch' => 0,
              ),
              491 => 
              array (
                'id' => 498,
                'migration' => '2025_12_20_170153_create_notification_messages_table',
                'batch' => 0,
              ),
              492 => 
              array (
                'id' => 499,
                'migration' => '2025_12_20_170153_create_notification_seens_table',
                'batch' => 0,
              ),
              493 => 
              array (
                'id' => 500,
                'migration' => '2025_12_20_170153_create_notifications_table',
                'batch' => 0,
              ),
              494 => 
              array (
                'id' => 501,
                'migration' => '2025_12_20_170153_create_oauth_access_tokens_table',
                'batch' => 0,
              ),
              495 => 
              array (
                'id' => 502,
                'migration' => '2025_12_20_170153_create_oauth_auth_codes_table',
                'batch' => 0,
              ),
              496 => 
              array (
                'id' => 503,
                'migration' => '2025_12_20_170153_create_oauth_clients_table',
                'batch' => 0,
              ),
              497 => 
              array (
                'id' => 504,
                'migration' => '2025_12_20_170153_create_oauth_personal_access_clients_table',
                'batch' => 0,
              ),
              498 => 
              array (
                'id' => 505,
                'migration' => '2025_12_20_170153_create_oauth_refresh_tokens_table',
                'batch' => 0,
              ),
              499 => 
              array (
                'id' => 506,
                'migration' => '2025_12_20_170153_create_offline_payment_methods_table',
                'batch' => 0,
              ),
              500 => 
              array (
                'id' => 507,
                'migration' => '2025_12_20_170153_create_offline_payments_table',
                'batch' => 0,
              ),
              501 => 
              array (
                'id' => 508,
                'migration' => '2025_12_20_170153_create_order_delivery_verifications_table',
                'batch' => 0,
              ),
              502 => 
              array (
                'id' => 509,
                'migration' => '2025_12_20_170153_create_order_details_table',
                'batch' => 0,
              ),
              503 => 
              array (
                'id' => 510,
                'migration' => '2025_12_20_170153_create_order_expected_delivery_histories_table',
                'batch' => 0,
              ),
              504 => 
              array (
                'id' => 511,
                'migration' => '2025_12_20_170153_create_order_partial_payments_table',
                'batch' => 0,
              ),
              505 => 
              array (
                'id' => 512,
                'migration' => '2025_12_20_170153_create_order_status_histories_table',
                'batch' => 0,
              ),
              506 => 
              array (
                'id' => 513,
                'migration' => '2025_12_20_170153_create_order_transactions_table',
                'batch' => 0,
              ),
              507 => 
              array (
                'id' => 514,
                'migration' => '2025_12_20_170153_create_orders_table',
                'batch' => 0,
              ),
              508 => 
              array (
                'id' => 515,
                'migration' => '2025_12_20_170153_create_password_resets_table',
                'batch' => 0,
              ),
              509 => 
              array (
                'id' => 516,
                'migration' => '2025_12_20_170153_create_payment_requests_table',
                'batch' => 0,
              ),
              510 => 
              array (
                'id' => 517,
                'migration' => '2025_12_20_170153_create_paytabs_invoices_table',
                'batch' => 0,
              ),
              511 => 
              array (
                'id' => 518,
                'migration' => '2025_12_20_170153_create_personal_access_tokens_table',
                'batch' => 0,
              ),
              512 => 
              array (
                'id' => 519,
                'migration' => '2025_12_20_170153_create_phone_or_email_verifications_table',
                'batch' => 0,
              ),
              513 => 
              array (
                'id' => 520,
                'migration' => '2025_12_20_170153_create_product_compares_table',
                'batch' => 0,
              ),
              514 => 
              array (
                'id' => 521,
                'migration' => '2025_12_20_170153_create_product_seos_table',
                'batch' => 0,
              ),
              515 => 
              array (
                'id' => 522,
                'migration' => '2025_12_20_170153_create_product_stocks_table',
                'batch' => 0,
              ),
              516 => 
              array (
                'id' => 523,
                'migration' => '2025_12_20_170153_create_product_tag_table',
                'batch' => 0,
              ),
              517 => 
              array (
                'id' => 524,
                'migration' => '2025_12_20_170153_create_products_table',
                'batch' => 0,
              ),
              518 => 
              array (
                'id' => 525,
                'migration' => '2025_12_20_170153_create_publishing_houses_table',
                'batch' => 0,
              ),
              519 => 
              array (
                'id' => 526,
                'migration' => '2025_12_20_170153_create_purchase_approval_routes_table',
                'batch' => 0,
              ),
              520 => 
              array (
                'id' => 527,
                'migration' => '2025_12_20_170153_create_purchase_approval_steps_table',
                'batch' => 0,
              ),
              521 => 
              array (
                'id' => 528,
                'migration' => '2025_12_20_170153_create_purchase_documents_table',
                'batch' => 0,
              ),
              522 => 
              array (
                'id' => 529,
                'migration' => '2025_12_20_170153_create_purchase_events_table',
                'batch' => 0,
              ),
              523 => 
              array (
                'id' => 530,
                'migration' => '2025_12_20_170153_create_purchase_grn_events_table',
                'batch' => 0,
              ),
              524 => 
              array (
                'id' => 531,
                'migration' => '2025_12_20_170153_create_purchase_grn_items_table',
                'batch' => 0,
              ),
              525 => 
              array (
                'id' => 532,
                'migration' => '2025_12_20_170153_create_purchase_grn_return_items_table',
                'batch' => 0,
              ),
              526 => 
              array (
                'id' => 533,
                'migration' => '2025_12_20_170153_create_purchase_grn_returns_table',
                'batch' => 0,
              ),
              527 => 
              array (
                'id' => 534,
                'migration' => '2025_12_20_170153_create_purchase_grns_table',
                'batch' => 0,
              ),
              528 => 
              array (
                'id' => 535,
                'migration' => '2025_12_20_170153_create_purchase_invoice_items_table',
                'batch' => 0,
              ),
              529 => 
              array (
                'id' => 536,
                'migration' => '2025_12_20_170153_create_purchase_invoices_table',
                'batch' => 0,
              ),
              530 => 
              array (
                'id' => 537,
                'migration' => '2025_12_20_170153_create_purchase_order_approvals_table',
                'batch' => 0,
              ),
              531 => 
              array (
                'id' => 538,
                'migration' => '2025_12_20_170153_create_purchase_order_communications_table',
                'batch' => 0,
              ),
              532 => 
              array (
                'id' => 539,
                'migration' => '2025_12_20_170153_create_purchase_order_items_table',
                'batch' => 0,
              ),
              533 => 
              array (
                'id' => 540,
                'migration' => '2025_12_20_170153_create_purchase_orders_table',
                'batch' => 0,
              ),
              534 => 
              array (
                'id' => 541,
                'migration' => '2025_12_20_170153_create_purchase_requisition_items_table',
                'batch' => 0,
              ),
              535 => 
              array (
                'id' => 542,
                'migration' => '2025_12_20_170153_create_purchase_requisitions_table',
                'batch' => 0,
              ),
              536 => 
              array (
                'id' => 543,
                'migration' => '2025_12_20_170153_create_purchase_vendor_contacts_table',
                'batch' => 0,
              ),
              537 => 
              array (
                'id' => 544,
                'migration' => '2025_12_20_170153_create_purchase_vendor_metrics_table',
                'batch' => 0,
              ),
              538 => 
              array (
                'id' => 545,
                'migration' => '2025_12_20_170153_create_purchase_vendors_table',
                'batch' => 0,
              ),
              539 => 
              array (
                'id' => 546,
                'migration' => '2025_12_20_170153_create_refund_requests_table',
                'batch' => 0,
              ),
              540 => 
              array (
                'id' => 547,
                'migration' => '2025_12_20_170153_create_refund_statuses_table',
                'batch' => 0,
              ),
              541 => 
              array (
                'id' => 548,
                'migration' => '2025_12_20_170153_create_refund_transactions_table',
                'batch' => 0,
              ),
              542 => 
              array (
                'id' => 549,
                'migration' => '2025_12_20_170153_create_restock_product_customers_table',
                'batch' => 0,
              ),
              543 => 
              array (
                'id' => 550,
                'migration' => '2025_12_20_170153_create_restock_products_table',
                'batch' => 0,
              ),
              544 => 
              array (
                'id' => 551,
                'migration' => '2025_12_20_170153_create_review_replies_table',
                'batch' => 0,
              ),
              545 => 
              array (
                'id' => 552,
                'migration' => '2025_12_20_170153_create_reviews_table',
                'batch' => 0,
              ),
              546 => 
              array (
                'id' => 553,
                'migration' => '2025_12_20_170153_create_robots_meta_contents_table',
                'batch' => 0,
              ),
              547 => 
              array (
                'id' => 554,
                'migration' => '2025_12_20_170153_create_search_functions_table',
                'batch' => 0,
              ),
              548 => 
              array (
                'id' => 555,
                'migration' => '2025_12_20_170153_create_seller_wallet_histories_table',
                'batch' => 0,
              ),
              549 => 
              array (
                'id' => 556,
                'migration' => '2025_12_20_170153_create_seller_wallets_table',
                'batch' => 0,
              ),
              550 => 
              array (
                'id' => 557,
                'migration' => '2025_12_20_170153_create_sellers_table',
                'batch' => 0,
              ),
              551 => 
              array (
                'id' => 558,
                'migration' => '2025_12_20_170153_create_shipping_addresses_table',
                'batch' => 0,
              ),
              552 => 
              array (
                'id' => 559,
                'migration' => '2025_12_20_170153_create_shipping_methods_table',
                'batch' => 0,
              ),
              553 => 
              array (
                'id' => 560,
                'migration' => '2025_12_20_170153_create_shipping_types_table',
                'batch' => 0,
              ),
              554 => 
              array (
                'id' => 561,
                'migration' => '2025_12_20_170153_create_shop_followers_table',
                'batch' => 0,
              ),
              555 => 
              array (
                'id' => 562,
                'migration' => '2025_12_20_170153_create_shops_table',
                'batch' => 0,
              ),
              556 => 
              array (
                'id' => 563,
                'migration' => '2025_12_20_170153_create_social_medias_table',
                'batch' => 0,
              ),
              557 => 
              array (
                'id' => 564,
                'migration' => '2025_12_20_170153_create_soft_credentials_table',
                'batch' => 0,
              ),
              558 => 
              array (
                'id' => 565,
                'migration' => '2025_12_20_170153_create_stock_clearance_products_table',
                'batch' => 0,
              ),
              559 => 
              array (
                'id' => 566,
                'migration' => '2025_12_20_170153_create_stock_clearance_setups_table',
                'batch' => 0,
              ),
              560 => 
              array (
                'id' => 567,
                'migration' => '2025_12_20_170153_create_storages_table',
                'batch' => 0,
              ),
              561 => 
              array (
                'id' => 568,
                'migration' => '2025_12_20_170153_create_subscriptions_table',
                'batch' => 0,
              ),
              562 => 
              array (
                'id' => 569,
                'migration' => '2025_12_20_170153_create_support_ticket_convs_table',
                'batch' => 0,
              ),
              563 => 
              array (
                'id' => 570,
                'migration' => '2025_12_20_170153_create_support_tickets_table',
                'batch' => 0,
              ),
              564 => 
              array (
                'id' => 571,
                'migration' => '2025_12_20_170153_create_tags_table',
                'batch' => 0,
              ),
              565 => 
              array (
                'id' => 572,
                'migration' => '2025_12_20_170153_create_transactions_table',
                'batch' => 0,
              ),
              566 => 
              array (
                'id' => 573,
                'migration' => '2025_12_20_170153_create_translations_table',
                'batch' => 0,
              ),
              567 => 
              array (
                'id' => 574,
                'migration' => '2025_12_20_170153_create_users_table',
                'batch' => 0,
              ),
              568 => 
              array (
                'id' => 575,
                'migration' => '2025_12_20_170153_create_vendor_registration_reasons_table',
                'batch' => 0,
              ),
              569 => 
              array (
                'id' => 576,
                'migration' => '2025_12_20_170153_create_wallet_transactions_table',
                'batch' => 0,
              ),
              570 => 
              array (
                'id' => 577,
                'migration' => '2025_12_20_170153_create_wishlists_table',
                'batch' => 0,
              ),
              571 => 
              array (
                'id' => 578,
                'migration' => '2025_12_20_170153_create_withdraw_requests_table',
                'batch' => 0,
              ),
              572 => 
              array (
                'id' => 579,
                'migration' => '2025_12_20_170153_create_withdrawal_methods_table',
                'batch' => 0,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('migrations')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
