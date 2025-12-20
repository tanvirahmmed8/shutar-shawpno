<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BusinessSettingTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('business_settings')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'type' => 'system_default_currency',
                'value' => '2',
                'created_at' => '2020-10-11 13:43:44',
                'updated_at' => '2025-12-15 23:08:08',
              ),
              1 => 
              array (
                'id' => 2,
                'type' => 'language',
                'value' => '[{"id":"1","name":"english","direction":"ltr","code":"en","status":1,"default":true}]',
                'created_at' => '2020-10-11 13:53:02',
                'updated_at' => '2025-12-15 23:08:08',
              ),
              2 => 
              array (
                'id' => 3,
                'type' => 'mail_config',
                'value' => '{"status":0,"name":"demo","host":"mail.demo.com","driver":"SMTP","port":"587","username":"info@demo.com","email_id":"info@demo.com","encryption":"TLS","password":"demo"}',
                'created_at' => '2020-10-12 16:29:18',
                'updated_at' => '2021-07-06 18:32:01',
              ),
              3 => 
              array (
                'id' => 4,
                'type' => 'cash_on_delivery',
                'value' => '{"status":"1"}',
                'created_at' => NULL,
                'updated_at' => '2021-05-26 03:21:15',
              ),
              4 => 
              array (
                'id' => 6,
                'type' => 'ssl_commerz_payment',
                'value' => '{"status":"0","environment":"sandbox","store_id":"","store_password":""}',
                'created_at' => '2020-11-09 14:36:51',
                'updated_at' => '2023-01-10 11:51:56',
              ),
              5 => 
              array (
                'id' => 10,
                'type' => 'company_phone',
                'value' => '000000000',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              6 => 
              array (
                'id' => 11,
                'type' => 'company_name',
                'value' => 'Shutar Shawpno',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              7 => 
              array (
                'id' => 12,
                'type' => 'company_web_logo',
                'value' => '{"image_name":"2025-12-15-69404078de1fa.webp","storage":"public"}',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              8 => 
              array (
                'id' => 13,
                'type' => 'company_mobile_logo',
                'value' => '2021-02-20-6030c88c91911.png',
                'created_at' => NULL,
                'updated_at' => '2021-02-20 20:30:04',
              ),
              9 => 
              array (
                'id' => 14,
                'type' => 'terms_condition',
                'value' => '
                    terms and conditions
            
                    ',
                'created_at' => NULL,
                'updated_at' => '2021-06-11 07:51:36',
              ),
              10 => 
              array (
                'id' => 15,
                'type' => 'about_us',
                'value' => '
                    this is about us page. hello and hi from about page description..
            
                    ',
                'created_at' => NULL,
                'updated_at' => '2021-06-11 07:42:53',
              ),
              11 => 
              array (
                'id' => 16,
                'type' => 'sms_nexmo',
                'value' => '{"status":"0","nexmo_key":"custo5cc042f7abf4c","nexmo_secret":"custo5cc042f7abf4c@ssl"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              12 => 
              array (
                'id' => 17,
                'type' => 'company_email',
                'value' => 'Copy@ShutarShawpno.com',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              13 => 
              array (
                'id' => 18,
                'type' => 'colors',
                'value' => '{"primary":"#bca473","secondary":"#000000","primary_light":"#CFDFFB"}',
                'created_at' => '2020-10-11 19:53:02',
                'updated_at' => '2025-12-15 23:08:08',
              ),
              14 => 
              array (
                'id' => 19,
                'type' => 'company_footer_logo',
                'value' => '{"image_name":"2025-12-15-69403f8cbf0c3.webp","storage":"public"}',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:04:12',
              ),
              15 => 
              array (
                'id' => 20,
                'type' => 'company_copyright_text',
                'value' => 'CopyRight ShutarShawpno@2024',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              16 => 
              array (
                'id' => 21,
                'type' => 'download_app_apple_stroe',
                'value' => '{"status":0,"link":"https:\\/\\/www.target.com\\/s\\/apple+store++now?ref=tgt_adv_XS000000&AFID=msn&fndsrc=tgtao&DFA=71700000012505188&CPNG=Electronics_Portable+Computers&adgroup=Portable+Computers&LID=700000001176246&LNM=apple+store+near+me+now&MT=b&network=s&device=c&location=12&targetid=kwd-81913773633608:loc-12&ds_rl=1246978&ds_rl=1248099&gclsrc=ds"}',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              17 => 
              array (
                'id' => 22,
                'type' => 'download_app_google_stroe',
                'value' => '{"status":0,"link":"https:\\/\\/play.google.com\\/store?hl=en_US&gl=US"}',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              18 => 
              array (
                'id' => 23,
                'type' => 'company_fav_icon',
                'value' => '2021-03-02-603df1634614f.png',
                'created_at' => '2020-10-11 19:53:02',
                'updated_at' => '2021-03-02 20:03:48',
              ),
              19 => 
              array (
                'id' => 24,
                'type' => 'fcm_topic',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              20 => 
              array (
                'id' => 25,
                'type' => 'fcm_project_id',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              21 => 
              array (
                'id' => 26,
                'type' => 'push_notification_key',
                'value' => 'Put your firebase server key here.',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              22 => 
              array (
                'id' => 27,
                'type' => 'order_pending_message',
                'value' => '{"status":"1","message":"order pen message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              23 => 
              array (
                'id' => 28,
                'type' => 'order_confirmation_msg',
                'value' => '{"status":"1","message":"Order con Message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              24 => 
              array (
                'id' => 29,
                'type' => 'order_processing_message',
                'value' => '{"status":"1","message":"Order pro Message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              25 => 
              array (
                'id' => 30,
                'type' => 'out_for_delivery_message',
                'value' => '{"status":"1","message":"Order ouut Message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              26 => 
              array (
                'id' => 31,
                'type' => 'order_delivered_message',
                'value' => '{"status":"1","message":"Order del Message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              27 => 
              array (
                'id' => 33,
                'type' => 'sales_commission',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2021-06-12 00:13:13',
              ),
              28 => 
              array (
                'id' => 34,
                'type' => 'seller_registration',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => '2021-06-05 03:02:48',
              ),
              29 => 
              array (
                'id' => 35,
                'type' => 'pnc_language',
                'value' => '["en"]',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              30 => 
              array (
                'id' => 36,
                'type' => 'order_returned_message',
                'value' => '{"status":"1","message":"Order hh Message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              31 => 
              array (
                'id' => 37,
                'type' => 'order_failed_message',
                'value' => '{"status":null,"message":"Order fa Message"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              32 => 
              array (
                'id' => 40,
                'type' => 'delivery_boy_assign_message',
                'value' => '{"status":0,"message":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              33 => 
              array (
                'id' => 41,
                'type' => 'delivery_boy_start_message',
                'value' => '{"status":0,"message":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              34 => 
              array (
                'id' => 42,
                'type' => 'delivery_boy_delivered_message',
                'value' => '{"status":0,"message":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              35 => 
              array (
                'id' => 43,
                'type' => 'terms_and_conditions',
                'value' => 'my terms and conditions',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              36 => 
              array (
                'id' => 44,
                'type' => 'minimum_order_value',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              37 => 
              array (
                'id' => 45,
                'type' => 'privacy_policy',
                'value' => 'my privacy policy',
                'created_at' => NULL,
                'updated_at' => '2021-07-06 17:09:07',
              ),
              38 => 
              array (
                'id' => 48,
                'type' => 'currency_model',
                'value' => 'single_currency',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              39 => 
              array (
                'id' => 49,
                'type' => 'social_login',
                'value' => '[{"login_medium":"google","client_id":"","client_secret":"","status":1},{"login_medium":"facebook","client_id":"","client_secret":"","status":1}]',
                'created_at' => NULL,
                'updated_at' => '2024-10-27 14:14:24',
              ),
              40 => 
              array (
                'id' => 50,
                'type' => 'digital_payment',
                'value' => '{"status":"1"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              41 => 
              array (
                'id' => 51,
                'type' => 'phone_verification',
                'value' => '',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              42 => 
              array (
                'id' => 52,
                'type' => 'email_verification',
                'value' => '',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              43 => 
              array (
                'id' => 53,
                'type' => 'order_verification',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:31',
              ),
              44 => 
              array (
                'id' => 54,
                'type' => 'country_code',
                'value' => 'AF',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              45 => 
              array (
                'id' => 55,
                'type' => 'pagination_limit',
                'value' => '10',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              46 => 
              array (
                'id' => 56,
                'type' => 'shipping_method',
                'value' => 'inhouse_shipping',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              47 => 
              array (
                'id' => 59,
                'type' => 'forgot_password_verification',
                'value' => 'email',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              48 => 
              array (
                'id' => 61,
                'type' => 'stock_limit',
                'value' => '10',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:28:36',
              ),
              49 => 
              array (
                'id' => 64,
                'type' => 'announcement',
                'value' => '{"status":null,"color":null,"text_color":null,"announcement":null}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              50 => 
              array (
                'id' => 65,
                'type' => 'fawry_pay',
                'value' => '{"status":0,"merchant_code":"","security_key":""}',
                'created_at' => NULL,
                'updated_at' => '2022-01-18 15:46:30',
              ),
              51 => 
              array (
                'id' => 66,
                'type' => 'recaptcha',
                'value' => '{"status":0,"site_key":"","secret_key":""}',
                'created_at' => NULL,
                'updated_at' => '2022-01-18 15:46:30',
              ),
              52 => 
              array (
                'id' => 67,
                'type' => 'seller_pos',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              53 => 
              array (
                'id' => 70,
                'type' => 'refund_day_limit',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:31',
              ),
              54 => 
              array (
                'id' => 71,
                'type' => 'business_mode',
                'value' => '',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              55 => 
              array (
                'id' => 72,
                'type' => 'mail_config_sendgrid',
                'value' => '{"status":0,"name":"","host":"","driver":"","port":"","username":"","email_id":"","encryption":"","password":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              56 => 
              array (
                'id' => 73,
                'type' => 'decimal_point_settings',
                'value' => '2',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              57 => 
              array (
                'id' => 74,
                'type' => 'shop_address',
                'value' => 'vvbv',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              58 => 
              array (
                'id' => 75,
                'type' => 'billing_input_by_customer',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:30',
              ),
              59 => 
              array (
                'id' => 76,
                'type' => 'wallet_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              60 => 
              array (
                'id' => 77,
                'type' => 'loyalty_point_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              61 => 
              array (
                'id' => 78,
                'type' => 'wallet_add_refund',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              62 => 
              array (
                'id' => 79,
                'type' => 'loyalty_point_exchange_rate',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              63 => 
              array (
                'id' => 80,
                'type' => 'loyalty_point_item_purchase_point',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              64 => 
              array (
                'id' => 81,
                'type' => 'loyalty_point_minimum_point',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              65 => 
              array (
                'id' => 82,
                'type' => 'minimum_order_limit',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              66 => 
              array (
                'id' => 83,
                'type' => 'product_brand',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:28:36',
              ),
              67 => 
              array (
                'id' => 84,
                'type' => 'digital_product',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:28:36',
              ),
              68 => 
              array (
                'id' => 85,
                'type' => 'delivery_boy_expected_delivery_date_message',
                'value' => '{"status":0,"message":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              69 => 
              array (
                'id' => 86,
                'type' => 'order_canceled',
                'value' => '{"status":0,"message":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              70 => 
              array (
                'id' => 87,
                'type' => 'refund-policy',
                'value' => '{"status":1,"content":""}',
                'created_at' => NULL,
                'updated_at' => '2023-03-04 12:25:36',
              ),
              71 => 
              array (
                'id' => 88,
                'type' => 'return-policy',
                'value' => '{"status":1,"content":""}',
                'created_at' => NULL,
                'updated_at' => '2023-03-04 12:25:36',
              ),
              72 => 
              array (
                'id' => 89,
                'type' => 'cancellation-policy',
                'value' => '{"status":1,"content":""}',
                'created_at' => NULL,
                'updated_at' => '2023-03-04 12:25:36',
              ),
              73 => 
              array (
                'id' => 90,
                'type' => 'offline_payment',
                'value' => '{"status":0}',
                'created_at' => NULL,
                'updated_at' => '2023-03-04 12:25:36',
              ),
              74 => 
              array (
                'id' => 91,
                'type' => 'temporary_close',
                'value' => '{"status":0}',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:36:41',
              ),
              75 => 
              array (
                'id' => 92,
                'type' => 'vacation_add',
                'value' => '{"status":0,"vacation_start_date":null,"vacation_end_date":null,"vacation_note":null}',
                'created_at' => NULL,
                'updated_at' => '2023-03-04 12:25:36',
              ),
              76 => 
              array (
                'id' => 93,
                'type' => 'cookie_setting',
                'value' => '{"status":0,"cookie_text":null}',
                'created_at' => NULL,
                'updated_at' => '2023-03-04 12:25:36',
              ),
              77 => 
              array (
                'id' => 94,
                'type' => 'maximum_otp_hit',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-06-13 19:04:49',
              ),
              78 => 
              array (
                'id' => 95,
                'type' => 'otp_resend_time',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-06-13 19:04:49',
              ),
              79 => 
              array (
                'id' => 96,
                'type' => 'temporary_block_time',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-06-13 19:04:49',
              ),
              80 => 
              array (
                'id' => 97,
                'type' => 'maximum_login_hit',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-06-13 19:04:49',
              ),
              81 => 
              array (
                'id' => 98,
                'type' => 'temporary_login_block_time',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-06-13 19:04:49',
              ),
              82 => 
              array (
                'id' => 104,
                'type' => 'apple_login',
                'value' => '[{"login_medium":"apple","client_id":"","client_secret":"","status":1,"team_id":"","key_id":"","service_file":"","redirect_url":""}]',
                'created_at' => NULL,
                'updated_at' => '2024-10-27 14:14:24',
              ),
              83 => 
              array (
                'id' => 105,
                'type' => 'ref_earning_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 11:34:53',
              ),
              84 => 
              array (
                'id' => 106,
                'type' => 'ref_earning_exchange_rate',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 11:34:53',
              ),
              85 => 
              array (
                'id' => 107,
                'type' => 'guest_checkout',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:31',
              ),
              86 => 
              array (
                'id' => 108,
                'type' => 'minimum_order_amount',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:36:09',
              ),
              87 => 
              array (
                'id' => 109,
                'type' => 'minimum_order_amount_by_seller',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              88 => 
              array (
                'id' => 110,
                'type' => 'minimum_order_amount_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:30',
              ),
              89 => 
              array (
                'id' => 111,
                'type' => 'admin_login_url',
                'value' => 'admin',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              90 => 
              array (
                'id' => 112,
                'type' => 'employee_login_url',
                'value' => 'employee',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              91 => 
              array (
                'id' => 113,
                'type' => 'free_delivery_status',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:31',
              ),
              92 => 
              array (
                'id' => 114,
                'type' => 'free_delivery_responsibility',
                'value' => 'admin',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:31',
              ),
              93 => 
              array (
                'id' => 115,
                'type' => 'free_delivery_over_amount',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:36:09',
              ),
              94 => 
              array (
                'id' => 116,
                'type' => 'free_delivery_over_amount_seller',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2025-02-19 17:28:31',
              ),
              95 => 
              array (
                'id' => 117,
                'type' => 'add_funds_to_wallet',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              96 => 
              array (
                'id' => 118,
                'type' => 'minimum_add_fund_amount',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              97 => 
              array (
                'id' => 119,
                'type' => 'maximum_add_fund_amount',
                'value' => '0',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              98 => 
              array (
                'id' => 120,
                'type' => 'user_app_version_control',
                'value' => '{"for_android":{"status":1,"version":"14.1","link":""},"for_ios":{"status":1,"version":"14.1","link":""}}',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              99 => 
              array (
                'id' => 121,
                'type' => 'seller_app_version_control',
                'value' => '{"for_android":{"status":1,"version":"14.1","link":""},"for_ios":{"status":1,"version":"14.1","link":""}}',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              100 => 
              array (
                'id' => 122,
                'type' => 'delivery_man_app_version_control',
                'value' => '{"for_android":{"status":1,"version":"14.1","link":""},"for_ios":{"status":1,"version":"14.1","link":""}}',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              101 => 
              array (
                'id' => 123,
                'type' => 'whatsapp',
                'value' => '{"status":1,"phone":"00000000000"}',
                'created_at' => NULL,
                'updated_at' => '2023-10-13 17:34:53',
              ),
              102 => 
              array (
                'id' => 124,
                'type' => 'currency_symbol_position',
                'value' => 'left',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              103 => 
              array (
                'id' => 148,
                'type' => 'company_reliability',
                'value' => '[{"item":"delivery_info","title":"Fast Delivery all across the country","image":"","status":1},{"item":"safe_payment","title":"Safe Payment","image":"","status":1},{"item":"return_policy","title":"7 Days Return Policy","image":"","status":1},{"item":"authentic_product","title":"100% Authentic Products","image":"","status":1}]',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              104 => 
              array (
                'id' => 149,
                'type' => 'react_setup',
                'value' => '{"status":0,"react_license_code":"","react_domain":"","react_platform":""}',
                'created_at' => NULL,
                'updated_at' => '2024-01-09 10:05:15',
              ),
              105 => 
              array (
                'id' => 150,
                'type' => 'app_activation',
                'value' => '{"software_id":"","is_active":0}',
                'created_at' => NULL,
                'updated_at' => '2024-01-09 10:05:15',
              ),
              106 => 
              array (
                'id' => 151,
                'type' => 'shop_banner',
                'value' => '{"image_name":"2025-12-15-6940471caa871.webp","storage":"public"}',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:36:28',
              ),
              107 => 
              array (
                'id' => 152,
                'type' => 'map_api_status',
                'value' => '1',
                'created_at' => NULL,
                'updated_at' => '2024-03-27 09:12:32',
              ),
              108 => 
              array (
                'id' => 153,
                'type' => 'vendor_registration_header',
                'value' => '{"title":"Vendor Registration","sub_title":"Create your own store.Already have store?","image":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              109 => 
              array (
                'id' => 154,
                'type' => 'vendor_registration_sell_with_us',
                'value' => '{"title":"Why Sell With Us","sub_title":"Boost your sales! Join us for a seamless, profitable experience with vast buyer reach and top-notch support. Sell smarter today!","image":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              110 => 
              array (
                'id' => 155,
                'type' => 'download_vendor_app',
                'value' => '{"title":"Download Free Vendor App","sub_title":"Download our free seller app and start reaching millions of buyers on the go! Easy setup, manage listings, and boost sales anywhere.","image":null,"download_google_app":null,"download_google_app_status":0,"download_apple_app":null,"download_apple_app_status":0}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              111 => 
              array (
                'id' => 156,
                'type' => 'business_process_main_section',
                'value' => '{"title":"3 Easy Steps To Start Selling","sub_title":"Start selling quickly! Register, upload your products with detailed info and images, and reach millions of buyers instantly.","image":""}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              112 => 
              array (
                'id' => 157,
                'type' => 'business_process_step',
                'value' => '[{"title":"Get Registered","description":"Sign up easily and create your seller account in just a few minutes. It fast and simple to get started.","image":""},{"title":"Upload Products","description":"List your products with detailed descriptions and high-quality images to attract more buyers effortlessly.","image":""},{"title":"Start Selling","description":"Go live and start reaching millions of potential buyers immediately. Watch your sales grow with our vast audience.","image":""}]',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              113 => 
              array (
                'id' => 158,
                'type' => 'brand_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              114 => 
              array (
                'id' => 159,
                'type' => 'category_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              115 => 
              array (
                'id' => 160,
                'type' => 'vendor_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              116 => 
              array (
                'id' => 161,
                'type' => 'flash_deal_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              117 => 
              array (
                'id' => 162,
                'type' => 'featured_product_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              118 => 
              array (
                'id' => 163,
                'type' => 'feature_deal_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              119 => 
              array (
                'id' => 164,
                'type' => 'new_arrival_product_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              120 => 
              array (
                'id' => 165,
                'type' => 'top_vendor_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              121 => 
              array (
                'id' => 166,
                'type' => 'category_wise_product_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              122 => 
              array (
                'id' => 167,
                'type' => 'top_rated_product_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              123 => 
              array (
                'id' => 168,
                'type' => 'best_selling_product_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              124 => 
              array (
                'id' => 169,
                'type' => 'searched_product_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              125 => 
              array (
                'id' => 170,
                'type' => 'vendor_product_list_priority',
                'value' => '0',
                'created_at' => '2024-05-18 16:57:03',
                'updated_at' => '2024-05-18 16:57:03',
              ),
              126 => 
              array (
                'id' => 171,
                'type' => 'storage_connection_type',
                'value' => 'public',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              127 => 
              array (
                'id' => 172,
                'type' => 'google_search_console_code',
                'value' => '0',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              128 => 
              array (
                'id' => 173,
                'type' => 'bing_webmaster_code',
                'value' => '0',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              129 => 
              array (
                'id' => 174,
                'type' => 'baidu_webmaster_code',
                'value' => '0',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              130 => 
              array (
                'id' => 175,
                'type' => 'yandex_webmaster_code',
                'value' => '0',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              131 => 
              array (
                'id' => 176,
                'type' => 'firebase_otp_verification',
                'value' => '{"status":0,"web_api_key":""}',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              132 => 
              array (
                'id' => 177,
                'type' => 'maintenance_system_setup',
                'value' => '{"user_app":0,"user_website":0,"vendor_app":0,"deliveryman_app":0,"vendor_panel":0}',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              133 => 
              array (
                'id' => 178,
                'type' => 'maintenance_duration_setup',
                'value' => '{"maintenance_duration":"until_change","start_date":null,"end_date":null}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              134 => 
              array (
                'id' => 179,
                'type' => 'maintenance_message_setup',
                'value' => '{"business_number":1,"business_email":1,"maintenance_message":"We are Working On Something Special","message_body":"We apologize for any inconvenience. For immediate assistance, please contact with our support team"}',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
              135 => 
              array (
                'id' => 180,
                'type' => 'shipping-policy',
                'value' => '{"status":0,"content":""}',
                'created_at' => '2024-09-24 13:52:17',
                'updated_at' => '2024-09-24 13:52:17',
              ),
              136 => 
              array (
                'id' => 181,
                'type' => 'vendor_forgot_password_method',
                'value' => 'phone',
                'created_at' => '2024-10-27 14:14:24',
                'updated_at' => '2024-10-27 14:14:24',
              ),
              137 => 
              array (
                'id' => 182,
                'type' => 'deliveryman_forgot_password_method',
                'value' => 'phone',
                'created_at' => '2024-10-27 14:14:24',
                'updated_at' => '2024-10-27 14:14:24',
              ),
              138 => 
              array (
                'id' => 183,
                'type' => 'timezone',
                'value' => 'UTC',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              139 => 
              array (
                'id' => 184,
                'type' => 'default_location',
                'value' => '{"lat":"-33.8688","lng":"151.2195"}',
                'created_at' => NULL,
                'updated_at' => '2025-12-15 23:08:08',
              ),
              140 => 
              array (
                'id' => 185,
                'type' => 'invoice_settings',
                'value' => '{"terms_and_condition":null,"business_identity":null,"business_identity_value":null,"image":{"image_name":"2025-11-28-692953f5a1498.webp","storage":"public"}}',
                'created_at' => NULL,
                'updated_at' => '2025-11-28 07:49:09',
              ),
              141 => 
              array (
                'id' => 186,
                'type' => 'web_theme',
                'value' => 'default',
                'created_at' => NULL,
                'updated_at' => NULL,
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('business_settings')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
