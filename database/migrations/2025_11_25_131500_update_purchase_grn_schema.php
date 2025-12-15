<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchase_grns', function (Blueprint $table) {
            $table->timestamp('reviewed_at')->nullable()->after('status');
            $table->timestamp('approved_at')->nullable()->after('reviewed_at');
            $table->timestamp('delivered_at')->nullable()->after('approved_at');
            $table->decimal('inspection_score', 5, 2)->nullable()->after('delivered_at');
            $table->string('carrier', 120)->nullable()->after('inspection_score');
            $table->string('return_reference', 120)->nullable()->after('carrier');
            $table->unsignedInteger('attachments_count')->default(0)->after('return_reference');
            $table->string('inventory_sync_status', 30)->default('pending')->after('attachments_count');
            $table->json('inventory_sync_payload')->nullable()->after('inventory_sync_status');
            $table->timestamp('inventory_synced_at')->nullable()->after('inventory_sync_payload');
        });

        Schema::table('purchase_grn_items', function (Blueprint $table) {
            $table->string('uom', 32)->nullable()->after('order_item_id');
            $table->decimal('accepted_qty', 18, 4)->default(0)->after('received_qty');
            $table->string('storage_location', 120)->nullable()->after('rejected_qty');
            $table->json('serial_numbers')->nullable()->after('storage_location');
            $table->json('metadata')->nullable()->after('serial_numbers');
            $table->text('inspection_notes')->nullable()->after('metadata');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->string('receiving_status', 30)->default('not_received')->after('status');
            $table->decimal('received_percent', 5, 2)->default(0)->after('receiving_status');
            $table->timestamp('last_receipt_at')->nullable()->after('sent_at');
        });

        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->decimal('outstanding_qty', 18, 4)->default(0)->after('received_qty');
        });

        Schema::create('purchase_grn_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grn_id')->constrained('purchase_grns')->cascadeOnDelete();
            $table->string('event_type', 60);
            $table->json('payload')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();

            $table->index(['grn_id', 'event_type']);
        });

        Schema::create('purchase_grn_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grn_id')->constrained('purchase_grns')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('purchase_orders')->cascadeOnDelete();
            $table->foreignId('vendor_id')->constrained('purchase_vendors')->cascadeOnDelete();
            $table->foreignId('initiated_by')->constrained('admins')->cascadeOnDelete();
            $table->string('status', 30)->default('draft');
            $table->string('carrier', 120)->nullable();
            $table->string('tracking_number', 120)->nullable();
            $table->text('return_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('purchase_grn_return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('return_id')->constrained('purchase_grn_returns')->cascadeOnDelete();
            $table->foreignId('grn_item_id')->constrained('purchase_grn_items')->cascadeOnDelete();
            $table->decimal('return_qty', 18, 4);
            $table->string('disposition', 30)->default('vendor');
            $table->string('restock_decision', 30)->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        DB::table('purchase_order_items')->update([
            'outstanding_qty' => DB::raw('(CASE WHEN quantity > received_qty THEN quantity - received_qty ELSE 0 END)')
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_grn_return_items');
        Schema::dropIfExists('purchase_grn_returns');
        Schema::dropIfExists('purchase_grn_events');

        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->dropColumn('outstanding_qty');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn(['receiving_status', 'received_percent', 'last_receipt_at']);
        });

        Schema::table('purchase_grn_items', function (Blueprint $table) {
            $table->dropColumn(['uom', 'accepted_qty', 'storage_location', 'serial_numbers', 'metadata', 'inspection_notes']);
        });

        Schema::table('purchase_grns', function (Blueprint $table) {
            $table->dropColumn([
                'reviewed_at',
                'approved_at',
                'delivered_at',
                'inspection_score',
                'carrier',
                'return_reference',
                'attachments_count',
                'inventory_sync_status',
                'inventory_sync_payload',
                'inventory_synced_at',
            ]);
        });
    }
};
