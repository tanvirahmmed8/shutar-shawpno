<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PurchasePermissionSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('admin_roles')) {
            return;
        }

        $moduleKey = config('purchase.module_key', 'purchase_management');
        if (!$moduleKey) {
            return;
        }

        $roles = DB::table('admin_roles')->get();
        foreach ($roles as $role) {
            $accessList = $role->module_access ? json_decode($role->module_access, true) : [];
            if (!is_array($accessList)) {
                $accessList = [];
            }

            if ((int) $role->id === 1 && !in_array($moduleKey, $accessList, true)) {
                $accessList[] = $moduleKey;
                DB::table('admin_roles')->where('id', $role->id)->update([
                    'module_access' => json_encode(array_values(array_unique($accessList))),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
