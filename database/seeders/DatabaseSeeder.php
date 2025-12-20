<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AddonSettingTableSeeder::class,
            AdminRoleTableSeeder::class,
            AdminTableSeeder::class,
            AdminWalletTableSeeder::class,
            AttributeTableSeeder::class,
            BannerTableSeeder::class,
            BusinessSettingTableSeeder::class,
            CategoryShippingCostTableSeeder::class,
            CategoryTableSeeder::class,
            ColorTableSeeder::class,
            CurrencyTableSeeder::class,
            DeliveryManTableSeeder::class,
            EmailTemplateTableSeeder::class,
            ErrorLogTableSeeder::class,
            FinanceAccountTableSeeder::class,
            FinanceExpenseTableSeeder::class,
            FinanceFiscalPeriodTableSeeder::class,
            GuestUserTableSeeder::class,
            HelpTopicTableSeeder::class,
            LoginSetupTableSeeder::class,
            MigrationTableSeeder::class,
            NotificationMessageTableSeeder::class,
            OauthAccessTokenTableSeeder::class,
            OauthClientTableSeeder::class,
            OauthPersonalAccessClientTableSeeder::class,
            ProductSeoTableSeeder::class,
            ProductTableSeeder::class,
            SearchFunctionTableSeeder::class,
            SellerTableSeeder::class,
            ShippingMethodTableSeeder::class,
            ShippingTypeTableSeeder::class,
            SocialMediaTableSeeder::class,
            StorageTableSeeder::class,
            UserTableSeeder::class,
            VendorRegistrationReasonTableSeeder::class,
        ]);
    }
}
