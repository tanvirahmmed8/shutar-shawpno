<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->seedTable('addon_settings', $this->addon_settings, ['id']);
            $this->seedTable('business_settings', $this->business_settings, ['type']);
            $this->seedTable('colors', $this->colors, ['code']);
            $this->seedTable('currencies', $this->currencies, ['code']);
            $this->seedTable('notification_messages', $this->notification_messages, ['user_type', 'key']);
            $this->seedTable('social_medias', $this->social_medias, ['name']);
            $this->seedTable('users', $this->users, ['email']);
            $this->seedTable('email_templates', $this->email_templates, ['template_name', 'user_type']);
            $this->seedTable('help_topics', $this->help_topics, ['type', 'question']);
        });

        $this->call([
            \AdminRoleTable::class,
            \AdminTable::class,
            \SellerTableSeeder::class,
            \PurchasePermissionSeeder::class,
            \FinanceChartSeeder::class,
        ]);
    }

    private array $modelCache = [];

    private function seedTable(string $table, array $rows, array $keyColumns = []): void
    {
        if (empty($rows)) {
            return;
        }

        $model = $this->modelFor($table);
        foreach ($rows as $row) {
            $criteria = $this->buildCriteria($row, $keyColumns);
            if (empty($criteria)) {
                continue;
            }

            $model->newQuery()->updateOrCreate($criteria, $row);
        }
    }

    private function buildCriteria(array $row, array $preferredColumns): array
    {
        $columns = $preferredColumns ?: $this->inferColumns($row);
        $criteria = [];
        foreach ($columns as $column) {
            if (array_key_exists($column, $row)) {
                $criteria[$column] = $row[$column];
            }
        }

        if (!empty($criteria)) {
            return $criteria;
        }

        if (!empty($row)) {
            $firstKey = array_key_first($row);
            return [$firstKey => $row[$firstKey]];
        }

        return [];
    }

    private function inferColumns(array $row): array
    {
        $candidates = ['id', 'type', 'key_name', 'key', 'code', 'email', 'name'];
        foreach ($candidates as $column) {
            if (array_key_exists($column, $row)) {
                return [$column];
            }
        }

        return [];
    }

    private function modelFor(string $table): Model
    {
        if (!array_key_exists($table, $this->modelCache)) {
            $model = new class extends Model {
                protected $guarded = [];
                public $timestamps = false;
            };

            $model->setTable($table);
            $this->modelCache[$table] = $model;
        }

        return $this->modelCache[$table];
    }

    protected $business_settings =
    [
        [
            'type' => 'system_default_currency',
            'value' => '2'
        ],
        [
            'type' => 'language',
            'value' => '[{"id":"1","name":"english","direction":"ltr","code":"en","status":1,"default":true}]'
        ],
        [
            'type' => 'mail_config',
            'value' => '{"status":0,"name":"demo","host":"mail.demo.com","driver":"SMTP","port":"587","username":"info@demo.com","email_id":"info@demo.com","encryption":"TLS","password":"demo"}'
        ],
        [
            'type' => 'cash_on_delivery',
            'value' => '{"status":"1"}'
        ],
        [
            'type' => 'ssl_commerz_payment',
            'value' => '{"status":"0","environment":"sandbox","store_id":"","store_password":""}'
        ],
        [
            'type' => 'company_phone',
            'value' => '000000000'
        ],
        [
            'type' => 'company_name',
            'value' => 'Demo'
        ],
        [
            'type' => 'company_web_logo',
            'value' => '2021-05-25-60ad1b313a9d4.png'
        ],
        [
            'type' => 'company_mobile_logo',
            'value' => '2021-02-20-6030c88c91911.png'
        ],
        [
            'type' => 'terms_condition',
            'value' => '
        terms and conditions

        '
        ],
        [
            'type' => 'about_us',
            'value' => '
        this is about us page. hello and hi from about page description..

        '
        ],
        [
            'type' => 'sms_nexmo',
            'value' => '{"status":"0","nexmo_key":"custo5cc042f7abf4c","nexmo_secret":"custo5cc042f7abf4c@ssl"}'
        ],
        [
            'type' => 'company_email',
            'value' => 'Copy@shutarshawpno.com'
        ],
        [
            'type' => 'colors',
            'value' => '{"primary":"#bca473","secondary":"#000000","primary_light":"#CFDFFB"}'
        ],
        [
            'type' => 'company_footer_logo',
            'value' => '2021-02-20-6030c8a02a5f9.png'
        ],
        [
            'type' => 'company_copyright_text',
            'value' => 'CopyRight ShutarShawpno@2025'
        ],
        [
            'type' => 'download_app_apple_stroe',
            'value' => '{"status":"1","link":"https:\/\/www.target.com\/s\/apple+store++now?ref=tgt_adv_XS000000&AFID=msn&fndsrc=tgtao&DFA=71700000012505188&CPNG=Electronics_Portable+Computers&adgroup=Portable+Computers&LID=700000001176246&LNM=apple+store+near+me+now&MT=b&network=s&device=c&location=12&targetid=kwd-81913773633608:loc-12&ds_rl=1246978&ds_rl=1248099&gclsrc=ds"}'
        ],
        [
            'type' => 'download_app_google_stroe',
            'value' => '{"status":"1","link":"https:\/\/play.google.com\/store?hl=en_US&gl=US"}'
        ],
        [
            'type' => 'company_fav_icon',
            'value' => '2021-03-02-603df1634614f.png'
        ],
        [
            'type' => 'fcm_topic',
            'value' => '0'
        ],
        [
            'type' => 'fcm_project_id',
            'value' => '0'
        ],
        [
            'type' => 'push_notification_key',
            'value' => 'Put your firebase server key here.'
        ],
        [
            'type' => 'order_pending_message',
            'value' => '{"status":"1","message":"order pen message"}'
        ],
        [
            'type' => 'order_confirmation_msg',
            'value' => '{"status":"1","message":"Order con Message"}'
        ],
        [
            'type' => 'order_processing_message',
            'value' => '{"status":"1","message":"Order pro Message"}'
        ],
        [
            'type' => 'out_for_delivery_message',
            'value' => '{"status":"1","message":"Order ouut Message"}'
        ],
        [
            'type' => 'order_delivered_message',
            'value' => '{"status":"1","message":"Order del Message"}'
        ],
        [
            'type' => 'sales_commission',
            'value' => '0'
        ],
        [
            'type' => 'seller_registration',
            'value' => '1'
        ],
        [
            'type' => 'pnc_language',
            'value' => '["en"]'
        ],
        [
            'type' => 'order_returned_message',
            'value' => '{"status":"1","message":"Order hh Message"}'
        ],
        [
            'type' => 'order_failed_message',
            'value' => '{"status":null,"message":"Order fa Message"}'
        ],
        [
            'type' => 'delivery_boy_assign_message',
            'value' => '{"status":0,"message":""}'
        ],
        [
            'type' => 'delivery_boy_start_message',
            'value' => '{"status":0,"message":""}'
        ],
        [
            'type' => 'delivery_boy_delivered_message',
            'value' => '{"status":0,"message":""}'
        ],
        [
            'type' => 'terms_and_conditions',
            'value' => 'my terms and conditions'
        ],
        [
            'type' => 'minimum_order_value',
            'value' => '1'
        ],
        [
            'type' => 'privacy_policy',
            'value' => 'my privacy policy'
        ],
        [
            'type' => 'currency_model',
            'value' => 'single_currency'
        ],
        [
            'type' => 'social_login',
            'value' => '[{"login_medium":"google","client_id":"","client_secret":"","status":1},{"login_medium":"facebook","client_id":"","client_secret":"","status":1}]'
        ],
        [
            'type' => 'digital_payment',
            'value' => '{"status":"1"}'
        ],
        [
            'type' => 'phone_verification',
            'value' => '0'
        ],
        [
            'type' => 'email_verification',
            'value' => '0'
        ],
        [
            'type' => 'order_verification',
            'value' => '0'
        ],
        [
            'type' => 'country_code',
            'value' => 'AF'
        ],
        [
            'type' => 'pagination_limit',
            'value' => '10'
        ],
        [
            'type' => 'shipping_method',
            'value' => 'inhouse_shipping'
        ],
        [
            'type' => 'forgot_password_verification',
            'value' => 'email'
        ],
        [
            'type' => 'stock_limit',
            'value' => '10'
        ],
        [
            'type' => 'announcement',
            'value' => '{"status":null,"color":null,"text_color":null,"announcement":null}'
        ],
        [
            'type' => 'fawry_pay',
            'value' => '{"status":0,"merchant_code":"","security_key":""}'
        ],
        [
            'type' => 'recaptcha',
            'value' => '{"status":0,"site_key":"","secret_key":""}'
        ],
        [
            'type' => 'seller_pos',
            'value' => '0'
        ],
        [
            'type' => 'refund_day_limit',
            'value' => '0'
        ],
        [
            'type' => 'business_mode',
            'value' => 'single'
        ],
        [
            'type' => 'mail_config_sendgrid',
            'value' => '{"status":0,"name":"","host":"","driver":"","port":"","username":"","email_id":"","encryption":"","password":""}'
        ],
        [
            'type' => 'decimal_point_settings',
            'value' => '2'
        ],
        [
            'type' => 'shop_address',
            'value' => 'vvbv'
        ],
        [
            'type' => 'billing_input_by_customer',
            'value' => '1'
        ],
        [
            'type' => 'wallet_status',
            'value' => '0'
        ],
        [
            'type' => 'loyalty_point_status',
            'value' => '0'
        ],
        [
            'type' => 'wallet_add_refund',
            'value' => '0'
        ],
        [
            'type' => 'loyalty_point_exchange_rate',
            'value' => '0'
        ],
        [
            'type' => 'loyalty_point_item_purchase_point',
            'value' => '0'
        ],
        [
            'type' => 'loyalty_point_minimum_point',
            'value' => '0'
        ],
        [
            'type' => 'minimum_order_limit',
            'value' => '1'
        ],
        [
            'type' => 'product_brand',
            'value' => '1'
        ],
        [
            'type' => 'digital_product',
            'value' => '1'
        ],
        [
            'type' => 'delivery_boy_expected_delivery_date_message',
            'value' => '{"status":0,"message":""}'
        ],
        [
            'type' => 'order_canceled',
            'value' => '{"status":0,"message":""}'
        ],
        [
            'type' => 'refund-policy',
            'value' => '{"status":1,"content":""}'
        ],
        [
            'type' => 'return-policy',
            'value' => '{"status":1,"content":""}'
        ],
        [
            'type' => 'cancellation-policy',
            'value' => '{"status":1,"content":""}'
        ],
        [
            'type' => 'offline_payment',
            'value' => '{"status":0}'
        ],
        [
            'type' => 'temporary_close',
            'value' => '{"status":0}'
        ],
        [
            'type' => 'vacation_add',
            'value' => '{"status":0,"vacation_start_date":null,"vacation_end_date":null,"vacation_note":null}'
        ],
        [
            'type' => 'cookie_setting',
            'value' => '{"status":0,"cookie_text":null}'
        ],
        [
            'type' => 'maximum_otp_hit',
            'value' => '0'
        ],
        [
            'type' => 'otp_resend_time',
            'value' => '0'
        ],
        [
            'type' => 'temporary_block_time',
            'value' => '0'
        ],
        [
            'type' => 'maximum_login_hit',
            'value' => '0'
        ],
        [
            'type' => 'temporary_login_block_time',
            'value' => '0'
        ],
        [
            'type' => 'apple_login',
            'value' => '[{"login_medium":"apple","client_id":"","client_secret":"","status":1,"team_id":"","key_id":"","service_file":"","redirect_url":""}]'
        ],
        [
            'type' => 'ref_earning_status',
            'value' => '0'
        ],
        [
            'type' => 'ref_earning_exchange_rate',
            'value' => '0'
        ],
        [
            'type' => 'guest_checkout',
            'value' => '0'
        ],
        [
            'type' => 'minimum_order_amount',
            'value' => '0'
        ],
        [
            'type' => 'minimum_order_amount_by_seller',
            'value' => '0'
        ],
        [
            'type' => 'minimum_order_amount_status',
            'value' => '0'
        ],
        [
            'type' => 'admin_login_url',
            'value' => 'admin'
        ],
        [
            'type' => 'employee_login_url',
            'value' => 'employee'
        ],
        [
            'type' => 'free_delivery_status',
            'value' => '0'
        ],
        [
            'type' => 'free_delivery_responsibility',
            'value' => 'admin'
        ],
        [
            'type' => 'free_delivery_over_amount',
            'value' => '0'
        ],
        [
            'type' => 'free_delivery_over_amount_seller',
            'value' => '0'
        ],
        [
            'type' => 'add_funds_to_wallet',
            'value' => '0'
        ],
        [
            'type' => 'minimum_add_fund_amount',
            'value' => '0'
        ],
        [
            'type' => 'maximum_add_fund_amount',
            'value' => '0'
        ],
        [
            'type' => 'user_app_version_control',
            'value' => '{"for_android":{"status":1,"version":"14.1","link":""},"for_ios":{"status":1,"version":"14.1","link":""}}'
        ],
        [
            'type' => 'seller_app_version_control',
            'value' => '{"for_android":{"status":1,"version":"14.1","link":""},"for_ios":{"status":1,"version":"14.1","link":""}}'
        ],
        [
            'type' => 'delivery_man_app_version_control',
            'value' => '{"for_android":{"status":1,"version":"14.1","link":""},"for_ios":{"status":1,"version":"14.1","link":""}}'
        ],
        [
            'type' => 'whatsapp',
            'value' => '{"status":1,"phone":"00000000000"}'
        ],
        [
            'type' => 'currency_symbol_position',
            'value' => 'left'
        ],
        [
            'type' => 'company_reliability',
            'value' => '[{"item":"delivery_info","title":"Fast Delivery all across the country","image":"","status":1},{"item":"safe_payment","title":"Safe Payment","image":"","status":1},{"item":"return_policy","title":"7 Days Return Policy","image":"","status":1},{"item":"authentic_product","title":"100% Authentic Products","image":"","status":1}]'
        ],
        [
            'type' => 'react_setup',
            'value' => '{"status":0,"react_license_code":"","react_domain":"","react_platform":""}'
        ],
        [
            'type' => 'app_activation',
            'value' => '{"software_id":"","is_active":0}'
        ],
        [
            'type' => 'shop_banner',
            'value' => '0'
        ],
        [
            'type' => 'map_api_status',
            'value' => '1'
        ],
        [
            'type' => 'vendor_registration_header',
            'value' => '{"title":"Vendor Registration","sub_title":"Create your own store.Already have store?","image":""}'
        ],
        [
            'type' => 'vendor_registration_sell_with_us',
            'value' => '{"title":"Why Sell With Us","sub_title":"Boost your sales! Join us for a seamless, profitable experience with vast buyer reach and top-notch support. Sell smarter today!","image":""}'
        ],
        [
            'type' => 'download_vendor_app',
            'value' => '{"title":"Download Free Vendor App","sub_title":"Download our free seller app and start reaching millions of buyers on the go! Easy setup, manage listings, and boost sales anywhere.","image":null,"download_google_app":null,"download_google_app_status":0,"download_apple_app":null,"download_apple_app_status":0}'
        ],
        [
            'type' => 'business_process_main_section',
            'value' => '{"title":"3 Easy Steps To Start Selling","sub_title":"Start selling quickly! Register, upload your products with detailed info and images, and reach millions of buyers instantly.","image":""}'
        ],
        [
            'type' => 'business_process_step',
            'value' => '[{"title":"Get Registered","description":"Sign up easily and create your seller account in just a few minutes. It fast and simple to get started.","image":""},{"title":"Upload Products","description":"List your products with detailed descriptions and high-quality images to attract more buyers effortlessly.","image":""},{"title":"Start Selling","description":"Go live and start reaching millions of potential buyers immediately. Watch your sales grow with our vast audience.","image":""}]'
        ],
        [
            'type' => 'brand_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'category_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'vendor_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'flash_deal_priority',
            'value' => '0'
        ],
        [
            'type' => 'featured_product_priority',
            'value' => '0'
        ],
        [
            'type' => 'feature_deal_priority',
            'value' => '0'
        ],
        [
            'type' => 'new_arrival_product_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'top_vendor_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'category_wise_product_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'top_rated_product_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'best_selling_product_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'searched_product_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'vendor_product_list_priority',
            'value' => '0'
        ],
        [
            'type' => 'storage_connection_type',
            'value' => 'public'
        ],
        [
            'type' => 'google_search_console_code',
            'value' => '0'
        ],
        [
            'type' => 'bing_webmaster_code',
            'value' => '0'
        ],
        [
            'type' => 'baidu_webmaster_code',
            'value' => '0'
        ],
        [
            'type' => 'yandex_webmaster_code',
            'value' => '0'
        ],
        [
            'type' => 'firebase_otp_verification',
            'value' => '{"status":0,"web_api_key":""}'
        ],
        [
            'type' => 'maintenance_system_setup',
            'value' => '{"user_app":0,"user_website":0,"vendor_app":0,"deliveryman_app":0,"vendor_panel":0}'
        ],
        [
            'type' => 'maintenance_duration_setup',
            'value' => '{"maintenance_duration":"until_change","start_date":null,"end_date":null}'
        ],
        [
            'type' => 'maintenance_message_setup',
            'value' => '{"business_number":1,"business_email":1,"maintenance_message":"We are Working On Something Special","message_body":"We apologize for any inconvenience. For immediate assistance, please contact with our support team"}'
        ],
        [
            'type' => 'shipping-policy',
            'value' => '{"status":0,"content":""}'
        ],
        [
            'type' => 'vendor_forgot_password_method',
            'value' => 'phone'
        ],
        [
            'type' => 'deliveryman_forgot_password_method',
            'value' => 'phone'
        ],
        [
            'type' => 'timezone',
            'value' => 'UTC'
        ],
        [
            'type' => 'default_location',
            'value' => '{"lat":"-33.8688","lng":"151.2195"}'
        ],
        [
            'type' => 'invoice_settings',
            'value' => '{"terms_and_condition":null,"business_identity":null,"business_identity_value":null,"image":null}'
        ],
        [
            'type' => 'web_theme',
            'value' => 'default'
        ]
    ];
    protected $addon_settings =
    [
        [
            'id' => '070c6bbd-d777-11ed-96f4-0c7a158e4469',
            'key_name' => 'twilio',
            'live_values' => '{"gateway":"twilio","mode":"live","status":"0","sid":"data","messaging_service_sid":"data","token":"data","from":"data","otp_template":"data"}',
            'test_values' => '{"gateway":"twilio","mode":"live","status":"0","sid":"data","messaging_service_sid":"data","token":"data","from":"data","otp_template":"data"}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '070c766c-d777-11ed-96f4-0c7a158e4469',
            'key_name' => '2factor',
            'live_values' => '{"gateway":"2factor","mode":"live","status":"0","api_key":"data"}',
            'test_values' => '{"gateway":"2factor","mode":"live","status":"0","api_key":"data"}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '0d8a9308-d6a5-11ed-962c-0c7a158e4469',
            'key_name' => 'mercadopago',
            'live_values' => '{"gateway":"mercadopago","mode":"live","status":0,"access_token":"","public_key":""}',
            'test_values' => '{"gateway":"mercadopago","mode":"live","status":0,"access_token":"","public_key":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Mercadopago","gateway_image":null}'
        ],
        [
            'id' => '0d8a9e49-d6a5-11ed-962c-0c7a158e4469',
            'key_name' => 'liqpay',
            'live_values' => '{"gateway":"liqpay","mode":"live","status":0,"private_key":"","public_key":""}',
            'test_values' => '{"gateway":"liqpay","mode":"live","status":0,"private_key":"","public_key":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Liqpay","gateway_image":null}'
        ],
        [
            'id' => '101befdf-d44b-11ed-8564-0c7a158e4469',
            'key_name' => 'paypal',
            'live_values' => '{"gateway":"paypal","mode":"live","status":"0","client_id":"","client_secret":""}',
            'test_values' => '{"gateway":"paypal","mode":"live","status":"0","client_id":"","client_secret":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Paypal","gateway_image":null}'
        ],
        [
            'id' => '133d9647-cabb-11ed-8fec-0c7a158e4469',
            'key_name' => 'hyper_pay',
            'live_values' => '{"gateway":"hyper_pay","mode":"test","status":"0","entity_id":"data","access_code":"data"}',
            'test_values' => '{"gateway":"hyper_pay","mode":"test","status":"0","entity_id":"data","access_code":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '1821029f-d776-11ed-96f4-0c7a158e4469',
            'key_name' => 'msg91',
            'live_values' => '{"gateway":"msg91","mode":"live","status":"0","template_id":"data","auth_key":"data"}',
            'test_values' => '{"gateway":"msg91","mode":"live","status":"0","template_id":"data","auth_key":"data"}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '18210f2b-d776-11ed-96f4-0c7a158e4469',
            'key_name' => 'nexmo',
            'live_values' => '{"gateway":"nexmo","mode":"live","status":"0","api_key":"","api_secret":"","token":"","from":"","otp_template":""}',
            'test_values' => '{"gateway":"nexmo","mode":"live","status":"0","api_key":"","api_secret":"","token":"","from":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '18fbb21f-d6ad-11ed-962c-0c7a158e4469',
            'key_name' => 'foloosi',
            'live_values' => '{"gateway":"foloosi","mode":"test","status":"0","merchant_key":"data"}',
            'test_values' => '{"gateway":"foloosi","mode":"test","status":"0","merchant_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '2767d142-d6a1-11ed-962c-0c7a158e4469',
            'key_name' => 'paytm',
            'live_values' => '{"gateway":"paytm","mode":"live","status":0,"merchant_key":"","merchant_id":"","merchant_website_link":""}',
            'test_values' => '{"gateway":"paytm","mode":"live","status":0,"merchant_key":"","merchant_id":"","merchant_website_link":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Paytm","gateway_image":null}'
        ],
        [
            'id' => '3201d2e6-c937-11ed-a424-0c7a158e4469',
            'key_name' => 'amazon_pay',
            'live_values' => '{"gateway":"amazon_pay","mode":"test","status":"0","pass_phrase":"data","access_code":"data","merchant_identifier":"data"}',
            'test_values' => '{"gateway":"amazon_pay","mode":"test","status":"0","pass_phrase":"data","access_code":"data","merchant_identifier":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '33a90207-7315-4bfe-a9af-d16049cc0b7c',
            'key_name' => 'cashfree',
            'live_values' => '"{\"gateway\":\"cashfree\",\"mode\":\"test\",\"status\":0,\"client_id\":\"\",\"client_secret\":\"\"}"',
            'test_values' => '"{\"gateway\":\"cashfree\",\"mode\":\"test\",\"status\":0,\"client_id\":\"\",\"client_secret\":\"\"}"',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '4593b25c-d6a1-11ed-962c-0c7a158e4469',
            'key_name' => 'paytabs',
            'live_values' => '{"gateway":"paytabs","mode":"live","status":0,"profile_id":"","server_key":"","base_url":"https:\/\/secure-egypt.paytabs.com\/"}',
            'test_values' => '{"gateway":"paytabs","mode":"live","status":0,"profile_id":"","server_key":"","base_url":"https:\/\/secure-egypt.paytabs.com\/"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Paytabs","gateway_image":null}'
        ],
        [
            'id' => '4e9b8dfb-e7d1-11ed-a559-0c7a158e4469',
            'key_name' => 'bkash',
            'live_values' => '{"gateway":"bkash","mode":"live","status":"0","app_key":"","app_secret":"","username":"","password":""}',
            'test_values' => '{"gateway":"bkash","mode":"live","status":"0","app_key":"","app_secret":"","username":"","password":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Bkash","gateway_image":null}'
        ],
        [
            'id' => '544a24a4-c872-11ed-ac7a-0c7a158e4469',
            'key_name' => 'fatoorah',
            'live_values' => '{"gateway":"fatoorah","mode":"test","status":"0","api_key":"data"}',
            'test_values' => '{"gateway":"fatoorah","mode":"test","status":"0","api_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '58c1bc8a-d6ac-11ed-962c-0c7a158e4469',
            'key_name' => 'ccavenue',
            'live_values' => '{"gateway":"ccavenue","mode":"test","status":"0","merchant_id":"data","working_key":"data","access_code":"data"}',
            'test_values' => '{"gateway":"ccavenue","mode":"test","status":"0","merchant_id":"data","working_key":"data","access_code":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":"2023-04-13-643783f01d386.png"}'
        ],
        [
            'id' => '5e2d2ef9-d6ab-11ed-962c-0c7a158e4469',
            'key_name' => 'thawani',
            'live_values' => '{"gateway":"thawani","mode":"test","status":"0","public_key":"data","private_key":"data"}',
            'test_values' => '{"gateway":"thawani","mode":"test","status":"0","public_key":"data","private_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":"2023-04-13-64378f9856f29.png"}'
        ],
        [
            'id' => '60cc83cc-d5b9-11ed-b56f-0c7a158e4469',
            'key_name' => 'sixcash',
            'live_values' => '{"gateway":"sixcash","mode":"test","status":"0","public_key":"data","secret_key":"data","merchant_number":"data","base_url":"data"}',
            'test_values' => '{"gateway":"sixcash","mode":"test","status":"0","public_key":"data","secret_key":"data","merchant_number":"data","base_url":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":"2023-04-12-6436774e77ff9.png"}'
        ],
        [
            'id' => '68579846-d8e8-11ed-8249-0c7a158e4469',
            'key_name' => 'alphanet_sms',
            'live_values' => '{"gateway":"alphanet_sms","mode":"live","status":0,"api_key":"","otp_template":""}',
            'test_values' => '{"gateway":"alphanet_sms","mode":"live","status":0,"api_key":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '6857a2e8-d8e8-11ed-8249-0c7a158e4469',
            'key_name' => 'sms_to',
            'live_values' => '{"gateway":"sms_to","mode":"live","status":0,"api_key":"","sender_id":"","otp_template":""}',
            'test_values' => '{"gateway":"sms_to","mode":"live","status":0,"api_key":"","sender_id":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '74c30c00-d6a6-11ed-962c-0c7a158e4469',
            'key_name' => 'hubtel',
            'live_values' => '{"gateway":"hubtel","mode":"test","status":"0","account_number":"data","api_id":"data","api_key":"data"}',
            'test_values' => '{"gateway":"hubtel","mode":"test","status":"0","account_number":"data","api_id":"data","api_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '74e46b0a-d6aa-11ed-962c-0c7a158e4469',
            'key_name' => 'tap',
            'live_values' => '{"gateway":"tap","mode":"test","status":"0","secret_key":"data"}',
            'test_values' => '{"gateway":"tap","mode":"test","status":"0","secret_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '761ca96c-d1eb-11ed-87ca-0c7a158e4469',
            'key_name' => 'swish',
            'live_values' => '{"gateway":"swish","mode":"test","status":"0","number":"data"}',
            'test_values' => '{"gateway":"swish","mode":"test","status":"0","number":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '7b1c3c5f-d2bd-11ed-b485-0c7a158e4469',
            'key_name' => 'payfast',
            'live_values' => '{"gateway":"payfast","mode":"test","status":"0","merchant_id":"data","secured_key":"data"}',
            'test_values' => '{"gateway":"payfast","mode":"test","status":"0","merchant_id":"data","secured_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '8592417b-d1d1-11ed-a984-0c7a158e4469',
            'key_name' => 'esewa',
            'live_values' => '{"gateway":"esewa","mode":"test","status":"0","merchantCode":"data"}',
            'test_values' => '{"gateway":"esewa","mode":"test","status":"0","merchantCode":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => '888e7b84-27b3-497d-a5ef-cd69d65a798e',
            'key_name' => 'instamojo',
            'live_values' => '"{\"gateway\":\"instamojo\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"\",\"client_secret\":\"\"}"',
            'test_values' => '"{\"gateway\":\"instamojo\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"\",\"client_secret\":\"\"}"',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '9162a1dc-cdf1-11ed-affe-0c7a158e4469',
            'key_name' => 'viva_wallet',
            'live_values' => '{"gateway":"viva_wallet","mode":"test","status":"0","client_id": "","client_secret": "", "source_code":""} ',
            'test_values' => '{"gateway":"viva_wallet","mode":"test","status":"0","client_id": "","client_secret": "", "source_code":""} ',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => '998ccc62-d6a0-11ed-962c-0c7a158e4469',
            'key_name' => 'stripe',
            'live_values' => '{"gateway":"stripe","mode":"live","status":"0","api_key":null,"published_key":null}',
            'test_values' => '{"gateway":"stripe","mode":"live","status":"0","api_key":null,"published_key":null}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Stripe","gateway_image":null}'
        ],
        [
            'id' => 'a3313755-c95d-11ed-b1db-0c7a158e4469',
            'key_name' => 'iyzi_pay',
            'live_values' => '{"gateway":"iyzi_pay","mode":"test","status":"0","api_key":"data","secret_key":"data","base_url":"data"}',
            'test_values' => '{"gateway":"iyzi_pay","mode":"test","status":"0","api_key":"data","secret_key":"data","base_url":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => 'a76c8993-d299-11ed-b485-0c7a158e4469',
            'key_name' => 'momo',
            'live_values' => '{"gateway":"momo","mode":"live","status":"0","api_key":"data","api_user":"data","subscription_key":"data"}',
            'test_values' => '{"gateway":"momo","mode":"live","status":"0","api_key":"data","api_user":"data","subscription_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => 'a8608119-cc76-11ed-9bca-0c7a158e4469',
            'key_name' => 'moncash',
            'live_values' => '{"gateway":"moncash","mode":"test","status":"0","client_id":"data","secret_key":"data"}',
            'test_values' => '{"gateway":"moncash","mode":"test","status":"0","client_id":"data","secret_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => 'ad5af1c1-d6a2-11ed-962c-0c7a158e4469',
            'key_name' => 'razor_pay',
            'live_values' => '{"gateway":"razor_pay","mode":"live","status":"0","api_key":null,"api_secret":null}',
            'test_values' => '{"gateway":"razor_pay","mode":"live","status":"0","api_key":null,"api_secret":null}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Razor pay","gateway_image":null}'
        ],
        [
            'id' => 'ad5b02a0-d6a2-11ed-962c-0c7a158e4469',
            'key_name' => 'senang_pay',
            'live_values' => '{"gateway":"senang_pay","mode":"live","status":"0","callback_url":null,"secret_key":null,"merchant_id":null}',
            'test_values' => '{"gateway":"senang_pay","mode":"live","status":"0","callback_url":null,"secret_key":null,"merchant_id":null}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Senang pay","gateway_image":null}'
        ],
        [
            'id' => 'b043c880-874b-4ee7-b945-b19e3bb2cabc',
            'key_name' => 'phonepe',
            'live_values' => '"{\"gateway\":\"phonepe\",\"mode\":\"test\",\"status\":0,\"merchant_id\":\"\",\"salt_Key\":\"\",\"salt_index\":\"\"}"',
            'test_values' => '"{\"gateway\":\"phonepe\",\"mode\":\"test\",\"status\":0,\"merchant_id\":\"\",\"salt_Key\":\"\",\"salt_index\":\"\"}"',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'b6c333f6-d8e9-11ed-8249-0c7a158e4469',
            'key_name' => 'akandit_sms',
            'live_values' => '{"gateway":"akandit_sms","mode":"live","status":0,"username":"","password":"","otp_template":""}',
            'test_values' => '{"gateway":"akandit_sms","mode":"live","status":0,"username":"","password":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'b6c33c87-d8e9-11ed-8249-0c7a158e4469',
            'key_name' => 'global_sms',
            'live_values' => '{"gateway":"global_sms","mode":"live","status":0,"user_name":"","password":"","from":"","otp_template":""}',
            'test_values' => '{"gateway":"global_sms","mode":"live","status":0,"user_name":"","password":"","from":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'b8992bd4-d6a0-11ed-962c-0c7a158e4469',
            'key_name' => 'paymob_accept',
            'live_values' => '{"gateway":"paymob_accept","mode":"live","status":"0","callback_url":null,"api_key":"","iframe_id":"","integration_id":"","hmac":""}',
            'test_values' => '{"gateway":"paymob_accept","mode":"live","status":"0","callback_url":null,"api_key":"","iframe_id":"","integration_id":"","hmac":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Paymob accept","gateway_image":null}'
        ],
        [
            'id' => 'c41c0dcd-d119-11ed-9f67-0c7a158e4469',
            'key_name' => 'maxicash',
            'live_values' => '{"gateway":"maxicash","mode":"test","status":"0","merchantId":"data","merchantPassword":"data"}',
            'test_values' => '{"gateway":"maxicash","mode":"test","status":"0","merchantId":"data","merchantPassword":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => 'c9249d17-cd60-11ed-b879-0c7a158e4469',
            'key_name' => 'pvit',
            'live_values' => '{"gateway":"pvit","mode":"test","status":"0","mc_tel_merchant": "","access_token": "", "mc_merchant_code": ""}',
            'test_values' => '{"gateway":"pvit","mode":"test","status":"0","mc_tel_merchant": "","access_token": "", "mc_merchant_code": ""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'cb0081ce-d775-11ed-96f4-0c7a158e4469',
            'key_name' => 'releans',
            'live_values' => '{"gateway":"releans","mode":"live","status":0,"api_key":"","from":"","otp_template":""}',
            'test_values' => '{"gateway":"releans","mode":"live","status":0,"api_key":"","from":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'd4f3f5f1-d6a0-11ed-962c-0c7a158e4469',
            'key_name' => 'flutterwave',
            'live_values' => '{"gateway":"flutterwave","mode":"live","status":0,"secret_key":"","public_key":"","hash":""}',
            'test_values' => '{"gateway":"flutterwave","mode":"live","status":0,"secret_key":"","public_key":"","hash":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Flutterwave","gateway_image":null}'
        ],
        [
            'id' => 'd822f1a5-c864-11ed-ac7a-0c7a158e4469',
            'key_name' => 'paystack',
            'live_values' => '{"gateway":"paystack","mode":"live","status":"0","callback_url":"https:\/\/api.paystack.co","public_key":null,"secret_key":null,"merchant_email":null}',
            'test_values' => '{"gateway":"paystack","mode":"live","status":"0","callback_url":"https:\/\/api.paystack.co","public_key":null,"secret_key":null,"merchant_email":null}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Paystack","gateway_image":null}'
        ],
        [
            'id' => 'daec8d59-c893-11ed-ac7a-0c7a158e4469',
            'key_name' => 'xendit',
            'live_values' => '{"gateway":"xendit","mode":"test","status":"0","api_key":"data"}',
            'test_values' => '{"gateway":"xendit","mode":"test","status":"0","api_key":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => 'dc0f5fc9-d6a5-11ed-962c-0c7a158e4469',
            'key_name' => 'worldpay',
            'live_values' => '{"gateway":"worldpay","mode":"test","status":"0","OrgUnitId":"data","jwt_issuer":"data","mac":"data","merchantCode":"data","xml_password":"data"}',
            'test_values' => '{"gateway":"worldpay","mode":"test","status":"0","OrgUnitId":"data","jwt_issuer":"data","mac":"data","merchantCode":"data","xml_password":"data"}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":null,"gateway_image":""}'
        ],
        [
            'id' => 'e0450278-d8eb-11ed-8249-0c7a158e4469',
            'key_name' => 'signal_wire',
            'live_values' => '{"gateway":"signal_wire","mode":"live","status":0,"project_id":"","token":"","space_url":"","from":"","otp_template":""}',
            'test_values' => '{"gateway":"signal_wire","mode":"live","status":0,"project_id":"","token":"","space_url":"","from":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'e0450b40-d8eb-11ed-8249-0c7a158e4469',
            'key_name' => 'paradox',
            'live_values' => '{"gateway":"paradox","mode":"live","status":"0","api_key":"","sender_id":""}',
            'test_values' => '{"gateway":"paradox","mode":"live","status":"0","api_key":"","sender_id":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'ea346efe-cdda-11ed-affe-0c7a158e4469',
            'key_name' => 'ssl_commerz',
            'live_values' => '{"gateway":"ssl_commerz","mode":"live","status":"0","store_id":"","store_password":""}',
            'test_values' => '{"gateway":"ssl_commerz","mode":"live","status":"0","store_id":"","store_password":""}',
            'settings_type' => 'payment_config',
            'mode' => 'test',
            'is_active' => '0',
            'additional_data' => '{"gateway_title":"Ssl commerz","gateway_image":null}'
        ],
        [
            'id' => 'eed88336-d8ec-11ed-8249-0c7a158e4469',
            'key_name' => 'hubtel',
            'live_values' => '{"gateway":"hubtel","mode":"live","status":0,"sender_id":"","client_id":"","client_secret":"","otp_template":""}',
            'test_values' => '{"gateway":"hubtel","mode":"live","status":0,"sender_id":"","client_id":"","client_secret":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'f149c546-d8ea-11ed-8249-0c7a158e4469',
            'key_name' => 'viatech',
            'live_values' => '{"gateway":"viatech","mode":"live","status":0,"api_url":"","api_key":"","sender_id":"","otp_template":""}',
            'test_values' => '{"gateway":"viatech","mode":"live","status":0,"api_url":"","api_key":"","sender_id":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ],
        [
            'id' => 'f149cd9c-d8ea-11ed-8249-0c7a158e4469',
            'key_name' => '019_sms',
            'live_values' => '{"gateway":"019_sms","mode":"live","status":0,"password":"","username":"","username_for_token":"","sender":"","otp_template":""}',
            'test_values' => '{"gateway":"019_sms","mode":"live","status":0,"password":"","username":"","username_for_token":"","sender":"","otp_template":""}',
            'settings_type' => 'sms_config',
            'mode' => 'live',
            'is_active' => '0',
            'additional_data' => ''
        ]
    ];

    protected $currencies =
    [
        [
            'name' => 'USD',
            'symbol' => '$',
            'code' => 'USD',
            'exchange_rate' => '1',
            'status' => '1'
        ],
        [
            'name' => 'BDT',
            'symbol' => '৳',
            'code' => 'BDT',
            'exchange_rate' => '84',
            'status' => '1'
        ],
        [
            'name' => 'Indian Rupi',
            'symbol' => '₹',
            'code' => 'INR',
            'exchange_rate' => '60',
            'status' => '1'
        ],
        [
            'name' => 'Euro',
            'symbol' => '€',
            'code' => 'EUR',
            'exchange_rate' => '100',
            'status' => '1'
        ],
        [
            'name' => 'YEN',
            'symbol' => '¥',
            'code' => 'JPY',
            'exchange_rate' => '110',
            'status' => '1'
        ],
        [
            'name' => 'Ringgit',
            'symbol' => 'RM',
            'code' => 'MYR',
            'exchange_rate' => '4.16',
            'status' => '1'
        ],
        [
            'name' => 'Rand',
            'symbol' => 'R',
            'code' => 'ZAR',
            'exchange_rate' => '14.26',
            'status' => '1'
        ]
    ];
    protected $colors =
    [
        [
            'name' => 'IndianRed',
            'code' => '#CD5C5C'
        ],
        [
            'name' => 'LightCoral',
            'code' => '#F08080'
        ],
        [
            'name' => 'Salmon',
            'code' => '#FA8072'
        ],
        [
            'name' => 'DarkSalmon',
            'code' => '#E9967A'
        ],
        [
            'name' => 'LightSalmon',
            'code' => '#FFA07A'
        ],
        [
            'name' => 'Crimson',
            'code' => '#DC143C'
        ],
        [
            'name' => 'Red',
            'code' => '#FF0000'
        ],
        [
            'name' => 'FireBrick',
            'code' => '#B22222'
        ],
        [
            'name' => 'DarkRed',
            'code' => '#8B0000'
        ],
        [
            'name' => 'Pink',
            'code' => '#FFC0CB'
        ],
        [
            'name' => 'LightPink',
            'code' => '#FFB6C1'
        ],
        [
            'name' => 'HotPink',
            'code' => '#FF69B4'
        ],
        [
            'name' => 'DeepPink',
            'code' => '#FF1493'
        ],
        [
            'name' => 'MediumVioletRed',
            'code' => '#C71585'
        ],
        [
            'name' => 'PaleVioletRed',
            'code' => '#DB7093'
        ],
        [
            'name' => 'Coral',
            'code' => '#FF7F50'
        ],
        [
            'name' => 'Tomato',
            'code' => '#FF6347'
        ],
        [
            'name' => 'OrangeRed',
            'code' => '#FF4500'
        ],
        [
            'name' => 'DarkOrange',
            'code' => '#FF8C00'
        ],
        [
            'name' => 'Orange',
            'code' => '#FFA500'
        ],
        [
            'name' => 'Gold',
            'code' => '#FFD700'
        ],
        [
            'name' => 'Yellow',
            'code' => '#FFFF00'
        ],
        [
            'name' => 'LightYellow',
            'code' => '#FFFFE0'
        ],
        [
            'name' => 'LemonChiffon',
            'code' => '#FFFACD'
        ],
        [
            'name' => 'LightGoldenrodYellow',
            'code' => '#FAFAD2'
        ],
        [
            'name' => 'PapayaWhip',
            'code' => '#FFEFD5'
        ],
        [
            'name' => 'Moccasin',
            'code' => '#FFE4B5'
        ],
        [
            'name' => 'PeachPuff',
            'code' => '#FFDAB9'
        ],
        [
            'name' => 'PaleGoldenrod',
            'code' => '#EEE8AA'
        ],
        [
            'name' => 'Khaki',
            'code' => '#F0E68C'
        ],
        [
            'name' => 'DarkKhaki',
            'code' => '#BDB76B'
        ],
        [
            'name' => 'Lavender',
            'code' => '#E6E6FA'
        ],
        [
            'name' => 'Thistle',
            'code' => '#D8BFD8'
        ],
        [
            'name' => 'Plum',
            'code' => '#DDA0DD'
        ],
        [
            'name' => 'Violet',
            'code' => '#EE82EE'
        ],
        [
            'name' => 'Orchid',
            'code' => '#DA70D6'
        ],
        [
            'name' => 'Magenta',
            'code' => '#FF00FF'
        ],
        [
            'name' => 'MediumOrchid',
            'code' => '#BA55D3'
        ],
        [
            'name' => 'MediumPurple',
            'code' => '#9370DB'
        ],
        [
            'name' => 'Amethyst',
            'code' => '#9966CC'
        ],
        [
            'name' => 'BlueViolet',
            'code' => '#8A2BE2'
        ],
        [
            'name' => 'DarkViolet',
            'code' => '#9400D3'
        ],
        [
            'name' => 'DarkOrchid',
            'code' => '#9932CC'
        ],
        [
            'name' => 'DarkMagenta',
            'code' => '#8B008B'
        ],
        [
            'name' => 'Purple',
            'code' => '#800080'
        ],
        [
            'name' => 'Indigo',
            'code' => '#4B0082'
        ],
        [
            'name' => 'SlateBlue',
            'code' => '#6A5ACD'
        ],
        [
            'name' => 'DarkSlateBlue',
            'code' => '#483D8B'
        ],
        [
            'name' => 'MediumSlateBlue',
            'code' => '#7B68EE'
        ],
        [
            'name' => 'GreenYellow',
            'code' => '#ADFF2F'
        ],
        [
            'name' => 'Chartreuse',
            'code' => '#7FFF00'
        ],
        [
            'name' => 'LawnGreen',
            'code' => '#7CFC00'
        ],
        [
            'name' => 'Lime',
            'code' => '#00FF00'
        ],
        [
            'name' => 'LimeGreen',
            'code' => '#32CD32'
        ],
        [
            'name' => 'PaleGreen',
            'code' => '#98FB98'
        ],
        [
            'name' => 'LightGreen',
            'code' => '#90EE90'
        ],
        [
            'name' => 'MediumSpringGreen',
            'code' => '#00FA9A'
        ],
        [
            'name' => 'SpringGreen',
            'code' => '#00FF7F'
        ],
        [
            'name' => 'MediumSeaGreen',
            'code' => '#3CB371'
        ],
        [
            'name' => 'SeaGreen',
            'code' => '#2E8B57'
        ],
        [
            'name' => 'ForestGreen',
            'code' => '#228B22'
        ],
        [
            'name' => 'Green',
            'code' => '#008000'
        ],
        [
            'name' => 'DarkGreen',
            'code' => '#006400'
        ],
        [
            'name' => 'YellowGreen',
            'code' => '#9ACD32'
        ],
        [
            'name' => 'OliveDrab',
            'code' => '#6B8E23'
        ],
        [
            'name' => 'Olive',
            'code' => '#808000'
        ],
        [
            'name' => 'DarkOliveGreen',
            'code' => '#556B2F'
        ],
        [
            'name' => 'MediumAquamarine',
            'code' => '#66CDAA'
        ],
        [
            'name' => 'DarkSeaGreen',
            'code' => '#8FBC8F'
        ],
        [
            'name' => 'LightSeaGreen',
            'code' => '#20B2AA'
        ],
        [
            'name' => 'DarkCyan',
            'code' => '#008B8B'
        ],
        [
            'name' => 'Teal',
            'code' => '#008080'
        ],
        [
            'name' => 'Aqua',
            'code' => '#00FFFF'
        ],
        [
            'name' => 'LightCyan',
            'code' => '#E0FFFF'
        ],
        [
            'name' => 'PaleTurquoise',
            'code' => '#AFEEEE'
        ],
        [
            'name' => 'Aquamarine',
            'code' => '#7FFFD4'
        ],
        [
            'name' => 'Turquoise',
            'code' => '#40E0D0'
        ],
        [
            'name' => 'MediumTurquoise',
            'code' => '#48D1CC'
        ],
        [
            'name' => 'DarkTurquoise',
            'code' => '#00CED1'
        ],
        [
            'name' => 'CadetBlue',
            'code' => '#5F9EA0'
        ],
        [
            'name' => 'SteelBlue',
            'code' => '#4682B4'
        ],
        [
            'name' => 'LightSteelBlue',
            'code' => '#B0C4DE'
        ],
        [
            'name' => 'PowderBlue',
            'code' => '#B0E0E6'
        ],
        [
            'name' => 'LightBlue',
            'code' => '#ADD8E6'
        ],
        [
            'name' => 'SkyBlue',
            'code' => '#87CEEB'
        ],
        [
            'name' => 'LightSkyBlue',
            'code' => '#87CEFA'
        ],
        [
            'name' => 'DeepSkyBlue',
            'code' => '#00BFFF'
        ],
        [
            'name' => 'DodgerBlue',
            'code' => '#1E90FF'
        ],
        [
            'name' => 'CornflowerBlue',
            'code' => '#6495ED'
        ],
        [
            'name' => 'RoyalBlue',
            'code' => '#4169E1'
        ],
        [
            'name' => 'Blue',
            'code' => '#0000FF'
        ],
        [
            'name' => 'MediumBlue',
            'code' => '#0000CD'
        ],
        [
            'name' => 'DarkBlue',
            'code' => '#00008B'
        ],
        [
            'name' => 'Navy',
            'code' => '#000080'
        ],
        [
            'name' => 'MidnightBlue',
            'code' => '#191970'
        ],
        [
            'name' => 'Cornsilk',
            'code' => '#FFF8DC'
        ],
        [
            'name' => 'BlanchedAlmond',
            'code' => '#FFEBCD'
        ],
        [
            'name' => 'Bisque',
            'code' => '#FFE4C4'
        ],
        [
            'name' => 'NavajoWhite',
            'code' => '#FFDEAD'
        ],
        [
            'name' => 'Wheat',
            'code' => '#F5DEB3'
        ],
        [
            'name' => 'BurlyWood',
            'code' => '#DEB887'
        ],
        [
            'name' => 'Tan',
            'code' => '#D2B48C'
        ],
        [
            'name' => 'RosyBrown',
            'code' => '#BC8F8F'
        ],
        [
            'name' => 'SandyBrown',
            'code' => '#F4A460'
        ],
        [
            'name' => 'Goldenrod',
            'code' => '#DAA520'
        ],
        [
            'name' => 'DarkGoldenrod',
            'code' => '#B8860B'
        ],
        [
            'name' => 'Peru',
            'code' => '#CD853F'
        ],
        [
            'name' => 'Chocolate',
            'code' => '#D2691E'
        ],
        [
            'name' => 'SaddleBrown',
            'code' => '#8B4513'
        ],
        [
            'name' => 'Sienna',
            'code' => '#A0522D'
        ],
        [
            'name' => 'Brown',
            'code' => '#A52A2A'
        ],
        [
            'name' => 'Maroon',
            'code' => '#800000'
        ],
        [
            'name' => 'White',
            'code' => '#FFFFFF'
        ],
        [
            'name' => 'Snow',
            'code' => '#FFFAFA'
        ],
        [
            'name' => 'Honeydew',
            'code' => '#F0FFF0'
        ],
        [
            'name' => 'MintCream',
            'code' => '#F5FFFA'
        ],
        [
            'name' => 'Azure',
            'code' => '#F0FFFF'
        ],
        [
            'name' => 'AliceBlue',
            'code' => '#F0F8FF'
        ],
        [
            'name' => 'GhostWhite',
            'code' => '#F8F8FF'
        ],
        [
            'name' => 'WhiteSmoke',
            'code' => '#F5F5F5'
        ],
        [
            'name' => 'Seashell',
            'code' => '#FFF5EE'
        ],
        [
            'name' => 'Beige',
            'code' => '#F5F5DC'
        ],
        [
            'name' => 'OldLace',
            'code' => '#FDF5E6'
        ],
        [
            'name' => 'FloralWhite',
            'code' => '#FFFAF0'
        ],
        [
            'name' => 'Ivory',
            'code' => '#FFFFF0'
        ],
        [
            'name' => 'AntiqueWhite',
            'code' => '#FAEBD7'
        ],
        [
            'name' => 'Linen',
            'code' => '#FAF0E6'
        ],
        [
            'name' => 'LavenderBlush',
            'code' => '#FFF0F5'
        ],
        [
            'name' => 'MistyRose',
            'code' => '#FFE4E1'
        ],
        [
            'name' => 'Gainsboro',
            'code' => '#DCDCDC'
        ],
        [
            'name' => 'LightGrey',
            'code' => '#D3D3D3'
        ],
        [
            'name' => 'Silver',
            'code' => '#C0C0C0'
        ],
        [
            'name' => 'DarkGray',
            'code' => '#A9A9A9'
        ],
        [
            'name' => 'Gray',
            'code' => '#808080'
        ],
        [
            'name' => 'DimGray',
            'code' => '#696969'
        ],
        [
            'name' => 'LightSlateGray',
            'code' => '#778899'
        ],
        [
            'name' => 'SlateGray',
            'code' => '#708090'
        ],
        [
            'name' => 'DarkSlateGray',
            'code' => '#2F4F4F'
        ],
        [
            'name' => 'Black',
            'code' => '#000000'
        ],
    ];
    protected $notification_messages =
    [
        [
            'user_type' => 'customer',
            'key' => 'order_pending_message',
            'message' => 'order pen message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_confirmation_message',
            'message' => 'Order con Message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_processing_message',
            'message' => 'Order pro Message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'out_for_delivery_message',
            'message' => 'Order ouut Message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_delivered_message',
            'message' => 'Order del Message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_returned_message',
            'message' => 'Order hh Message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_failed_message',
            'message' => 'Order fa Message',
            'status' => '0'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_canceled',
            'message' => '',
            'status' => '0'
        ],
        [
            'user_type' => 'customer',
            'key' => 'order_refunded_message',
            'message' => 'customize your order refunded message message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'refund_request_canceled_message',
            'message' => 'customize your refund request canceled message message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'message_from_delivery_man',
            'message' => 'customize your message from delivery man message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'message_from_seller',
            'message' => 'customize your message from seller message',
            'status' => '1'
        ],
        [
            'user_type' => 'customer',
            'key' => 'fund_added_by_admin_message',
            'message' => 'customize your fund added by admin message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'new_order_message',
            'message' => 'customize your new order message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'refund_request_message',
            'message' => 'customize your refund request message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'order_edit_message',
            'message' => 'customize your order edit message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'withdraw_request_status_message',
            'message' => 'customize your withdraw request status message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'message_from_customer',
            'message' => 'customize your message from customer message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'delivery_man_assign_by_admin_message',
            'message' => 'customize your delivery man assign by admin message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'order_delivered_message',
            'message' => 'customize your order delivered message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'order_canceled',
            'message' => 'customize your order canceled message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'order_refunded_message',
            'message' => 'customize your order refunded message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'refund_request_canceled_message',
            'message' => 'customize your refund request canceled message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'refund_request_status_changed_by_admin',
            'message' => 'customize your refund request status changed by admin message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'new_order_assigned_message',
            'message' => '',
            'status' => '0'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'expected_delivery_date',
            'message' => '',
            'status' => '0'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'delivery_man_charge',
            'message' => 'customize your delivery man charge message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'order_canceled',
            'message' => 'customize your order canceled message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'order_rescheduled_message',
            'message' => 'customize your order rescheduled message message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'order_edit_message',
            'message' => 'customize your order edit message message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'message_from_seller',
            'message' => 'customize your message from seller message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'message_from_admin',
            'message' => 'customize your message from admin message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'message_from_customer',
            'message' => 'customize your message from customer message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'cash_collect_by_admin_message',
            'message' => 'customize your cash collect by admin message message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'cash_collect_by_seller_message',
            'message' => 'customize your cash collect by seller message message',
            'status' => '1'
        ],
        [
            'user_type' => 'delivery_man',
            'key' => 'withdraw_request_status_message',
            'message' => 'customize your withdraw request status message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'product_request_approved_message',
            'message' => 'customize your product request approved message message',
            'status' => '1'
        ],
        [
            'user_type' => 'seller',
            'key' => 'product_request_rejected_message',
            'message' => 'customize your product request rejected message message',
            'status' => '1'
        ]
    ];
    protected $search_functions =
    [
        [
            'key' => 'Dashboard',
            'url' => 'admin/dashboard',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Order All',
            'url' => 'admin/orders/list/all',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Order Pending',
            'url' => 'admin/orders/list/pending',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Order Processed',
            'url' => 'admin/orders/list/processed',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Order Delivered',
            'url' => 'admin/orders/list/delivered',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Order Returned',
            'url' => 'admin/orders/list/returned',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Order Failed',
            'url' => 'admin/orders/list/failed',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Brand Add',
            'url' => 'admin/brand/add-new',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Brand List',
            'url' => 'admin/brand/list',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Banner',
            'url' => 'admin/banner/list',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Category',
            'url' => 'admin/category/view',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Sub Category',
            'url' => 'admin/category/sub-category/view',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Sub sub category',
            'url' => 'admin/category/sub-sub-category/view',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Attribute',
            'url' => 'admin/attribute/view',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Product',
            'url' => 'admin/product/list',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Coupon',
            'url' => 'admin/coupon/add-new',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Custom Role',
            'url' => 'admin/custom-role/create',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Employee',
            'url' => 'admin/employee/add-new',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Seller',
            'url' => 'admin/sellers/seller-list',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Contacts',
            'url' => 'admin/contact/list',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Flash Deal',
            'url' => 'admin/deal/flash',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Deal of the day',
            'url' => 'admin/deal/day',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Language',
            'url' => 'admin/business-settings/language',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Mail',
            'url' => 'admin/business-settings/mail',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Shipping method',
            'url' => 'admin/business-settings/shipping-method/add',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Currency',
            'url' => 'admin/currency/view',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Payment method',
            'url' => 'admin/business-settings/payment-method',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'SMS Gateway',
            'url' => 'admin/business-settings/sms-gateway',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Support Ticket',
            'url' => 'admin/support-ticket/view',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'FAQ',
            'url' => 'admin/helpTopic/list',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'About Us',
            'url' => 'admin/business-settings/about-us',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Terms and Conditions',
            'url' => 'admin/business-settings/terms-condition',
            'visible_for' => 'admin'
        ],
        [
            'key' => 'Web Config',
            'url' => 'admin/business-settings/web-config',
            'visible_for' => 'admin'
        ]
    ];
    protected $social_medias =
    [
        [
            'name' => 'twitter',
            'link' => 'https://www.w3schools.com/howto/howto_css_table_responsive.asp',
            'icon' => 'fa fa-twitter',
            'active_status' => '1',
            'status' => '1'
        ],
        [
            'name' => 'linkedin',
            'link' => 'https://linkedin.com/',
            'icon' => 'fa fa-linkedin',
            'active_status' => '1',
            'status' => '1'
        ],
        [
            'name' => 'google-plus',
            'link' => 'https://google-plus.com/',
            'icon' => 'fa fa-google-plus-square',
            'active_status' => '1',
            'status' => '1'
        ],
        [
            'name' => 'pinterest',
            'link' => 'https://pinterest.com/',
            'icon' => 'fa fa-pinterest',
            'active_status' => '1',
            'status' => '1'
        ],
        [
            'name' => 'instagram',
            'link' => 'https://instagram.com/',
            'icon' => 'fa fa-instagram',
            'active_status' => '1',
            'status' => '1'
        ],
        [
            'name' => 'facebook',
            'link' => 'https://facebook.com',
            'icon' => 'fa fa-facebook',
            'active_status' => '1',
            'status' => '1'
        ]
    ];
    protected $users =
    [
        [
            'id' => '0',
            'name' => 'walking customer',
            'f_name' => 'walking',
            'l_name' => 'customer',
            'password' => ' ',
            'phone' => '00000000000',
            'image' => 'def.png',
            'email' => 'walking@customer.com',
        ]
    ];

    protected $email_templates =
    [
        [
            'template_name' => 'order-received',
            'user_type' => 'admin',
            'template_design_name' => 'order-received',
            'title' => 'New Order Received',
            'body' => '<p><b>Hi {adminName},</b></p><p>We have sent you this email to notify that you have a new order.You will be able to see your orders after login to your panel.</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["icon", "product_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'order-place',
            'user_type' => 'customer',
            'template_design_name' => 'order-place',
            'title' => 'Order # {orderId} Has Been Placed Successfully!',
            'body' => '<p><b>Hi {userName},</b></p><p>Your order from {shopName} has been placed to know the current status of your order click track order</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["icon", "product_information", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'registration-verification',
            'user_type' => 'customer',
            'template_design_name' => 'registration-verification',
            'title' => 'Registration Verification',
            'body' => '<p><b>Hi {userName},</b></p><p>Your verification code is</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'registration-from-pos',
            'user_type' => 'customer',
            'template_design_name' => 'registration-from-pos',
            'title' => 'Registration Complete',
            'body' => '<p><b>Hi {userName},</b></p><p>Thank you for joining  Shop.If you want to become a registered customer then reset your password below by using this email. Then you’ll be able to explore the website and app as a registered customer.</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_url", "button_content_status", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'account-block',
            'user_type' => 'customer',
            'template_design_name' => 'account-block',
            'title' => 'Account Blocked',
            'body' => '<div><b>Hi {userName},</b></div><div><b><br></b></div><div>Your account has been blocked due to suspicious activity by the admin .To resolve this issue please contact with admin or support center. We apologize for any inconvenience caused.</div><div><br></div><div>Meanwhile, click here to visit theshop website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'account-unblock',
            'user_type' => 'customer',
            'template_design_name' => 'account-unblock',
            'title' => 'Account Unblocked',
            'body' => '<div><b>Hi {userName},</b></div><div><b><br></b></div><div>Your account has been successfully unblocked. We appreciate your cooperation in resolving this issue. Thank you for your understanding and patience. </div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'digital-product-download',
            'user_type' => 'customer',
            'template_design_name' => 'digital-product-download',
            'title' => 'Congratulations',
            'body' => '<p>Thank you for choosing  shop! Your digital product is ready for download. To download your product use your email <b>{emailId}</b> and order # {orderId} below.</b><br></p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'digital-product-otp',
            'user_type' => 'customer',
            'template_design_name' => 'digital-product-otp',
            'title' => 'Digital Product Download OTP Verification',
            'body' => '<p><b>Hi {userName},</b></p><p>Your verification code is</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'add-fund-to-wallet',
            'user_type' => 'customer',
            'template_design_name' => 'add-fund-to-wallet',
            'title' => 'Transaction Successful',
            'body' => '<div style=\"text-align: center; \">Amount successfully credited to your wallet .</div><div style=\"text-align: center; \"><br></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'registration',
            'user_type' => 'vendor',
            'template_design_name' => 'registration',
            'title' => 'Registration Complete',
            'body' => '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Congratulation! Your registration request has been send to admin successfully! Please wait until admin reviewal. </div><div><br></div><div>meanwhile click here to visit the  Shop Website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'registration-approved',
            'user_type' => 'vendor',
            'template_design_name' => 'registration-approved',
            'title' => 'Registration Approved',
            'body' => '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your registration request has been approved by admin. Now you can complete your store setting and start selling your product on  Shop. </div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'registration-denied',
            'user_type' => 'vendor',
            'template_design_name' => 'registration-denied',
            'title' => 'Registration Denied',
            'body' => '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your registration request has been denied by admin. Please contact with admin or support center if you have any queries.</div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'account-suspended',
            'user_type' => 'vendor',
            'template_design_name' => 'account-suspended',
            'title' => 'Account Suspended',
            'body' => '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your account access has been suspended by admin.From now you can access your app and panel again Please contact us for any queries we’re always happy to help.</div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'account-activation',
            'user_type' => 'vendor',
            'template_design_name' => 'account-activation',
            'title' => 'Account Activation',
            'body' => '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your account suspension has been revoked by admin. From now you can access your app and panel again Please contact us for any queries we’re always happy to help.</div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\"#0000ff\"> <a href=\"https://dokankholo.com\" target=\"_blank\">https://dokankholo.com</a></font></div>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'forgot-password',
            'user_type' => 'vendor',
            'template_design_name' => 'forgot-password',
            'title' => 'Change Password Request',
            'body' => '<p><b>Hi {vendorName},</b></p><p>Please click the link below to change your password.</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'order-received',
            'user_type' => 'vendor',
            'template_design_name' => 'order-received',
            'title' => 'New Order Received',
            'body' => '<p><b>Hi {vendorName},</b></p><p>We have sent you this email to notify that you have a new order.You will be able to see your orders after login to your panel.</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["icon", "product_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ],
        [
            'template_name' => 'reset-password-verification',
            'user_type' => 'delivery-man',
            'template_design_name' => 'reset-password-verification',
            'title' => 'OTP Verification For Password Reset',
            'body' => '<p><b>Hi {deliveryManName},</b></p><p>Your verification code is</p>',
            'banner_image' => '',
            'image' => '',
            'logo' => '',
            'button_name' => '',
            'button_url' => '',
            'footer_text' => 'Please contact us for any queries, we are always happy to help.',
            'copyright_text' => 'Copyright 2025 . All right reserved.',
            'pages' => NULL,
            'social_media' => NULL,
            'hide_field' => '["product_information", "order_information", "button_content", "banner_image"]',
            'button_content_status' => '1',
            'product_information_status' => '1',
            'order_information_status' => '1',
            'status' => '1'
        ]

    ];

    protected $help_topics =
    [
        [
            'type' => 'vendor_registration',
            'question' => 'How do I register as a seller?',
            'answer' => 'To register, click on the "Sign Up" button, fill in your details, and verify your account via email.',
            'ranking' => '1',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'What are the fees for selling?',
            'answer' => 'Our platform charges a small commission on each sale. There are no upfront listing fees.',
            'ranking' => '2',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'How do I upload products?',
            'answer' => 'Log in to your seller account, go to the "Upload Products" section, and fill in the product details and images.',
            'ranking' => '3',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'How do I handle customer inquiries?',
            'answer' => "You can manage customer inquiries directly through our platform's messaging system, ensuring quick and efficient communication.",
            'ranking' => '4',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'How do I register as a seller?',
            'answer' => 'To register, click on the "Sign Up" button, fill in your details, and verify your account via email.',
            'ranking' => '1',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'What are the fees for selling?',
            'answer' => 'Our platform charges a small commission on each sale. There are no upfront listing fees.',
            'ranking' => '2',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'How do I upload products?',
            'answer' => 'Log in to your seller account, go to the "Upload Products" section, and fill in the product details and images.',
            'ranking' => '3',
            'status' => '1'
        ],
        [
            'type' => 'vendor_registration',
            'question' => 'How do I handle customer inquiries?',
            'answer' => "You can manage customer inquiries directly through our platform's messaging system, ensuring quick and efficient communication.",
            'ranking' => '4',
            'status' => '1'
        ]
    ];
}
