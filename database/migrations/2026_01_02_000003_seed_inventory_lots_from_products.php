<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            DB::table('products')
                ->select(['id', 'current_stock', 'purchase_price'])
                ->where('current_stock', '>', 0)
                ->orderBy('id')
                ->chunkById(500, function ($products) {
                    $now = now();
                    $payload = [];
                    foreach ($products as $product) {
                        $payload[] = [
                            'product_id' => $product->id,
                            'source_type' => 'bootstrap',
                            'source_id' => $product->id,
                            'quantity_received' => $product->current_stock,
                            'quantity_available' => $product->current_stock,
                            'unit_purchase_price' => $product->purchase_price ?? 0,
                            'currency' => null,
                            'lot_number' => 'BOOTSTRAP-' . $product->id,
                            'purchased_at' => $now,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }

                    if (!empty($payload)) {
                        DB::table('inventory_lots')->insert($payload);
                    }
                });
        });
    }

    public function down(): void
    {
        DB::table('inventory_lots')
            ->where('source_type', 'bootstrap')
            ->delete();
    }
};
