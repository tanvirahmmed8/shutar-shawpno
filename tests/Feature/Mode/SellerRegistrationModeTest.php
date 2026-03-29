<?php

namespace Tests\Feature\Mode;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SellerRegistrationModeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        if (!defined('VIEW_FILE_NAMES')) {
            define('VIEW_FILE_NAMES', [
                'seller_registration' => 'testing.seller-registration',
            ]);
        }

        $this->setBusinessSetting('language', [
            ['code' => 'en', 'default' => true, 'direction' => 'ltr'],
        ]);
    }

    public function test_vendor_registration_route_is_blocked_when_seller_registration_is_disabled(): void
    {
        $this->setBusinessSetting('business_mode', 'multi');
        $this->setBusinessSetting('seller_registration', 0);

        $response = $this->get('/vendor/auth/registration/index');

        $response->assertRedirect('/');
    }

    public function test_vendor_registration_route_is_accessible_when_multi_mode_and_seller_registration_enabled(): void
    {
        $this->setBusinessSetting('business_mode', 'multi');
        $this->setBusinessSetting('seller_registration', 1);

        $this->setBusinessSetting('vendor_registration_header', [
            'title' => 'Register as vendor',
            'sub_title' => 'Create your own store',
            'image' => '',
        ]);
        $this->setBusinessSetting('vendor_registration_sell_with_us', [
            'enabled' => true,
            'title' => 'Why sell with us',
            'sub_title' => 'Grow your business with us',
            'image' => '',
        ]);
        $this->setBusinessSetting('download_vendor_app', [
            'enabled' => false,
            'title' => 'Download app',
            'sub_title' => 'Manage your shop on the go',
            'image' => '',
            'download_google_app' => '',
            'download_google_app_status' => 0,
            'download_apple_app' => '',
            'download_apple_app_status' => 0,
        ]);
        $this->setBusinessSetting('business_process_main_section', [
            'title' => 'Process',
            'sub_title' => 'Three easy steps',
        ]);
        $this->setBusinessSetting('business_process_step', [[
            'title' => 'Step 1',
            'description' => 'Register your store',
            'image' => '',
        ]]);

        $response = $this->get('/vendor/auth/registration/index');

        $response->assertOk();
    }

    private function setBusinessSetting(string $type, mixed $value): void
    {
        DB::table('business_settings')->updateOrInsert(
            ['type' => $type],
            [
                'value' => is_string($value) ? $value : json_encode($value),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Cache::flush();
    }
}
