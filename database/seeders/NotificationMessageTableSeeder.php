<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NotificationMessageTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('notification_messages')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'user_type' => 'customer',
                'key' => 'order_pending_message',
                'message' => 'order pen message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              1 => 
              array (
                'id' => 2,
                'user_type' => 'customer',
                'key' => 'order_confirmation_message',
                'message' => 'Order con Message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              2 => 
              array (
                'id' => 3,
                'user_type' => 'customer',
                'key' => 'order_processing_message',
                'message' => 'Order pro Message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              3 => 
              array (
                'id' => 4,
                'user_type' => 'customer',
                'key' => 'out_for_delivery_message',
                'message' => 'Order ouut Message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              4 => 
              array (
                'id' => 5,
                'user_type' => 'customer',
                'key' => 'order_delivered_message',
                'message' => 'Order del Message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              5 => 
              array (
                'id' => 6,
                'user_type' => 'customer',
                'key' => 'order_returned_message',
                'message' => 'Order hh Message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              6 => 
              array (
                'id' => 7,
                'user_type' => 'customer',
                'key' => 'order_failed_message',
                'message' => 'Order fa Message',
                'status' => 0,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2024-10-27 14:14:24',
              ),
              7 => 
              array (
                'id' => 8,
                'user_type' => 'customer',
                'key' => 'order_canceled',
                'message' => '',
                'status' => 0,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              8 => 
              array (
                'id' => 9,
                'user_type' => 'customer',
                'key' => 'order_refunded_message',
                'message' => 'customize your order refunded message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              9 => 
              array (
                'id' => 10,
                'user_type' => 'customer',
                'key' => 'refund_request_canceled_message',
                'message' => 'customize your refund request canceled message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              10 => 
              array (
                'id' => 11,
                'user_type' => 'customer',
                'key' => 'message_from_delivery_man',
                'message' => 'customize your message from delivery man message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              11 => 
              array (
                'id' => 12,
                'user_type' => 'customer',
                'key' => 'message_from_seller',
                'message' => 'customize your message from seller message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              12 => 
              array (
                'id' => 13,
                'user_type' => 'customer',
                'key' => 'fund_added_by_admin_message',
                'message' => 'customize your fund added by admin message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              13 => 
              array (
                'id' => 14,
                'user_type' => 'seller',
                'key' => 'new_order_message',
                'message' => 'customize your new order message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              14 => 
              array (
                'id' => 15,
                'user_type' => 'seller',
                'key' => 'refund_request_message',
                'message' => 'customize your refund request message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              15 => 
              array (
                'id' => 16,
                'user_type' => 'seller',
                'key' => 'order_edit_message',
                'message' => 'customize your order edit message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              16 => 
              array (
                'id' => 17,
                'user_type' => 'seller',
                'key' => 'withdraw_request_status_message',
                'message' => 'customize your withdraw request status message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              17 => 
              array (
                'id' => 18,
                'user_type' => 'seller',
                'key' => 'message_from_customer',
                'message' => 'customize your message from customer message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              18 => 
              array (
                'id' => 19,
                'user_type' => 'seller',
                'key' => 'delivery_man_assign_by_admin_message',
                'message' => 'customize your delivery man assign by admin message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              19 => 
              array (
                'id' => 20,
                'user_type' => 'seller',
                'key' => 'order_delivered_message',
                'message' => 'customize your order delivered message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              20 => 
              array (
                'id' => 21,
                'user_type' => 'seller',
                'key' => 'order_canceled',
                'message' => 'customize your order canceled message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              21 => 
              array (
                'id' => 22,
                'user_type' => 'seller',
                'key' => 'order_refunded_message',
                'message' => 'customize your order refunded message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              22 => 
              array (
                'id' => 23,
                'user_type' => 'seller',
                'key' => 'refund_request_canceled_message',
                'message' => 'customize your refund request canceled message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              23 => 
              array (
                'id' => 24,
                'user_type' => 'seller',
                'key' => 'refund_request_status_changed_by_admin',
                'message' => 'customize your refund request status changed by admin message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              24 => 
              array (
                'id' => 25,
                'user_type' => 'delivery_man',
                'key' => 'new_order_assigned_message',
                'message' => '',
                'status' => 0,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              25 => 
              array (
                'id' => 26,
                'user_type' => 'delivery_man',
                'key' => 'expected_delivery_date',
                'message' => '',
                'status' => 0,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              26 => 
              array (
                'id' => 27,
                'user_type' => 'delivery_man',
                'key' => 'delivery_man_charge',
                'message' => 'customize your delivery man charge message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              27 => 
              array (
                'id' => 28,
                'user_type' => 'delivery_man',
                'key' => 'order_canceled',
                'message' => 'customize your order canceled message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              28 => 
              array (
                'id' => 29,
                'user_type' => 'delivery_man',
                'key' => 'order_rescheduled_message',
                'message' => 'customize your order rescheduled message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              29 => 
              array (
                'id' => 30,
                'user_type' => 'delivery_man',
                'key' => 'order_edit_message',
                'message' => 'customize your order edit message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              30 => 
              array (
                'id' => 31,
                'user_type' => 'delivery_man',
                'key' => 'message_from_seller',
                'message' => 'customize your message from seller message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              31 => 
              array (
                'id' => 32,
                'user_type' => 'delivery_man',
                'key' => 'message_from_admin',
                'message' => 'customize your message from admin message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              32 => 
              array (
                'id' => 33,
                'user_type' => 'delivery_man',
                'key' => 'message_from_customer',
                'message' => 'customize your message from customer message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              33 => 
              array (
                'id' => 34,
                'user_type' => 'delivery_man',
                'key' => 'cash_collect_by_admin_message',
                'message' => 'customize your cash collect by admin message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              34 => 
              array (
                'id' => 35,
                'user_type' => 'delivery_man',
                'key' => 'cash_collect_by_seller_message',
                'message' => 'customize your cash collect by seller message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              35 => 
              array (
                'id' => 36,
                'user_type' => 'delivery_man',
                'key' => 'withdraw_request_status_message',
                'message' => 'customize your withdraw request status message message',
                'status' => 1,
                'created_at' => '2023-10-30 17:02:55',
                'updated_at' => '2023-10-30 17:02:55',
              ),
              36 => 
              array (
                'id' => 37,
                'user_type' => 'seller',
                'key' => 'product_request_approved_message',
                'message' => 'customize your product request approved message message',
                'status' => 1,
                'created_at' => '2024-02-19 14:35:38',
                'updated_at' => '2024-02-19 14:35:38',
              ),
              37 => 
              array (
                'id' => 38,
                'user_type' => 'seller',
                'key' => 'product_request_rejected_message',
                'message' => 'customize your product request rejected message message',
                'status' => 1,
                'created_at' => '2024-02-19 14:35:38',
                'updated_at' => '2024-02-19 14:35:38',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('notification_messages')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
