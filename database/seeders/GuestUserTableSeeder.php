<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GuestUserTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('guest_users')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 => 
              array (
                'id' => 1,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-02-19 14:35:50',
                'updated_at' => NULL,
              ),
              1 => 
              array (
                'id' => 2,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-03-27 09:10:49',
                'updated_at' => NULL,
              ),
              2 => 
              array (
                'id' => 3,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-03-27 09:12:35',
                'updated_at' => NULL,
              ),
              3 => 
              array (
                'id' => 4,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-05-18 16:57:05',
                'updated_at' => NULL,
              ),
              4 => 
              array (
                'id' => 5,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-09-24 13:51:36',
                'updated_at' => '2024-09-24 13:51:36',
              ),
              5 => 
              array (
                'id' => 6,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-09-24 13:52:19',
                'updated_at' => '2024-09-24 13:52:19',
              ),
              6 => 
              array (
                'id' => 7,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-10-27 14:14:28',
                'updated_at' => '2024-10-27 14:14:28',
              ),
              7 => 
              array (
                'id' => 8,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2024-12-21 12:51:41',
                'updated_at' => '2024-12-21 12:51:41',
              ),
              8 => 
              array (
                'id' => 9,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2025-02-18 22:25:13',
                'updated_at' => '2025-02-18 22:25:13',
              ),
              9 => 
              array (
                'id' => 10,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2025-02-19 16:23:54',
                'updated_at' => '2025-02-19 16:23:54',
              ),
              10 => 
              array (
                'id' => 11,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2025-05-07 12:05:20',
                'updated_at' => '2025-05-07 12:05:20',
              ),
              11 => 
              array (
                'id' => 12,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2025-08-24 17:51:06',
                'updated_at' => '2025-08-24 17:51:06',
              ),
              12 => 
              array (
                'id' => 13,
                'ip_address' => '::1',
                'fcm_token' => NULL,
                'created_at' => '2025-09-17 16:06:23',
                'updated_at' => '2025-09-17 16:06:23',
              ),
              13 => 
              array (
                'id' => 14,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-10-03 09:01:22',
                'updated_at' => '2025-10-03 09:01:22',
              ),
              14 => 
              array (
                'id' => 15,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-10-03 09:03:47',
                'updated_at' => '2025-10-03 09:03:47',
              ),
              15 => 
              array (
                'id' => 16,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-10-03 18:20:58',
                'updated_at' => '2025-10-03 18:20:58',
              ),
              16 => 
              array (
                'id' => 17,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-10-31 20:22:37',
                'updated_at' => '2025-10-31 20:22:37',
              ),
              17 => 
              array (
                'id' => 18,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-04 06:40:06',
                'updated_at' => '2025-11-04 06:40:06',
              ),
              18 => 
              array (
                'id' => 19,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-04 08:34:57',
                'updated_at' => '2025-11-04 08:34:57',
              ),
              19 => 
              array (
                'id' => 20,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-04 11:36:52',
                'updated_at' => '2025-11-04 11:36:52',
              ),
              20 => 
              array (
                'id' => 21,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-24 09:57:43',
                'updated_at' => '2025-11-24 09:57:43',
              ),
              21 => 
              array (
                'id' => 22,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-27 06:18:49',
                'updated_at' => '2025-11-27 06:18:49',
              ),
              22 => 
              array (
                'id' => 23,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-28 05:36:10',
                'updated_at' => '2025-11-28 05:36:10',
              ),
              23 => 
              array (
                'id' => 24,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-11-28 18:27:49',
                'updated_at' => '2025-11-28 18:27:49',
              ),
              24 => 
              array (
                'id' => 25,
                'ip_address' => '59.153.103.137',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 22:59:13',
                'updated_at' => '2025-12-15 22:59:13',
              ),
              25 => 
              array (
                'id' => 26,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:00:02',
                'updated_at' => '2025-12-15 23:00:02',
              ),
              26 => 
              array (
                'id' => 27,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:00:02',
                'updated_at' => '2025-12-15 23:00:02',
              ),
              27 => 
              array (
                'id' => 28,
                'ip_address' => '59.153.103.137',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:00:39',
                'updated_at' => '2025-12-15 23:00:39',
              ),
              28 => 
              array (
                'id' => 29,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:01:25',
                'updated_at' => '2025-12-15 23:01:25',
              ),
              29 => 
              array (
                'id' => 30,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:01:25',
                'updated_at' => '2025-12-15 23:01:25',
              ),
              30 => 
              array (
                'id' => 31,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:03:18',
                'updated_at' => '2025-12-15 23:03:18',
              ),
              31 => 
              array (
                'id' => 32,
                'ip_address' => '146.70.185.32',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:03:18',
                'updated_at' => '2025-12-15 23:03:18',
              ),
              32 => 
              array (
                'id' => 33,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:03:19',
                'updated_at' => '2025-12-15 23:03:19',
              ),
              33 => 
              array (
                'id' => 34,
                'ip_address' => '34.123.170.104',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:03:21',
                'updated_at' => '2025-12-15 23:03:21',
              ),
              34 => 
              array (
                'id' => 35,
                'ip_address' => '146.70.185.32',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:03:33',
                'updated_at' => '2025-12-15 23:03:33',
              ),
              35 => 
              array (
                'id' => 36,
                'ip_address' => '205.169.39.58',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:03:41',
                'updated_at' => '2025-12-15 23:03:41',
              ),
              36 => 
              array (
                'id' => 37,
                'ip_address' => '3.233.59.216',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:04:03',
                'updated_at' => '2025-12-15 23:04:03',
              ),
              37 => 
              array (
                'id' => 38,
                'ip_address' => '172.111.15.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:04:42',
                'updated_at' => '2025-12-15 23:04:42',
              ),
              38 => 
              array (
                'id' => 39,
                'ip_address' => '128.192.12.120',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:05:59',
                'updated_at' => '2025-12-15 23:05:59',
              ),
              39 => 
              array (
                'id' => 40,
                'ip_address' => '45.148.107.251',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:05:59',
                'updated_at' => '2025-12-15 23:05:59',
              ),
              40 => 
              array (
                'id' => 41,
                'ip_address' => '103.196.9.11',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:07:02',
                'updated_at' => '2025-12-15 23:07:02',
              ),
              41 => 
              array (
                'id' => 42,
                'ip_address' => '103.4.250.119',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:07:02',
                'updated_at' => '2025-12-15 23:07:02',
              ),
              42 => 
              array (
                'id' => 43,
                'ip_address' => '205.169.39.119',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:15:37',
                'updated_at' => '2025-12-15 23:15:37',
              ),
              43 => 
              array (
                'id' => 44,
                'ip_address' => '205.169.39.119',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:16:30',
                'updated_at' => '2025-12-15 23:16:30',
              ),
              44 => 
              array (
                'id' => 45,
                'ip_address' => '192.175.111.249',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:31:53',
                'updated_at' => '2025-12-15 23:31:53',
              ),
              45 => 
              array (
                'id' => 46,
                'ip_address' => '64.15.129.109',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:31:56',
                'updated_at' => '2025-12-15 23:31:56',
              ),
              46 => 
              array (
                'id' => 47,
                'ip_address' => '192.175.111.246',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:32:13',
                'updated_at' => '2025-12-15 23:32:13',
              ),
              47 => 
              array (
                'id' => 48,
                'ip_address' => '192.175.111.229',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:32:15',
                'updated_at' => '2025-12-15 23:32:15',
              ),
              48 => 
              array (
                'id' => 49,
                'ip_address' => '64.15.129.103',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:32:17',
                'updated_at' => '2025-12-15 23:32:17',
              ),
              49 => 
              array (
                'id' => 50,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:54:32',
                'updated_at' => '2025-12-15 23:54:32',
              ),
              50 => 
              array (
                'id' => 51,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:54:33',
                'updated_at' => '2025-12-15 23:54:33',
              ),
              51 => 
              array (
                'id' => 52,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:54:38',
                'updated_at' => '2025-12-15 23:54:38',
              ),
              52 => 
              array (
                'id' => 53,
                'ip_address' => '65.87.7.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:54:38',
                'updated_at' => '2025-12-15 23:54:38',
              ),
              53 => 
              array (
                'id' => 54,
                'ip_address' => '35.92.157.5',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:55:02',
                'updated_at' => '2025-12-15 23:55:02',
              ),
              54 => 
              array (
                'id' => 55,
                'ip_address' => '35.92.157.5',
                'fcm_token' => NULL,
                'created_at' => '2025-12-15 23:55:02',
                'updated_at' => '2025-12-15 23:55:02',
              ),
              55 => 
              array (
                'id' => 56,
                'ip_address' => '34.28.17.131',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:02:55',
                'updated_at' => '2025-12-16 00:02:55',
              ),
              56 => 
              array (
                'id' => 57,
                'ip_address' => '34.34.49.206',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:05:51',
                'updated_at' => '2025-12-16 00:05:51',
              ),
              57 => 
              array (
                'id' => 58,
                'ip_address' => '34.221.253.152',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:08:02',
                'updated_at' => '2025-12-16 00:08:02',
              ),
              58 => 
              array (
                'id' => 59,
                'ip_address' => '34.221.253.152',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:08:10',
                'updated_at' => '2025-12-16 00:08:10',
              ),
              59 => 
              array (
                'id' => 60,
                'ip_address' => '205.169.39.50',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:23:46',
                'updated_at' => '2025-12-16 00:23:46',
              ),
              60 => 
              array (
                'id' => 61,
                'ip_address' => '66.132.153.115',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:45:07',
                'updated_at' => '2025-12-16 00:45:07',
              ),
              61 => 
              array (
                'id' => 62,
                'ip_address' => '66.132.153.115',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:45:27',
                'updated_at' => '2025-12-16 00:45:27',
              ),
              62 => 
              array (
                'id' => 63,
                'ip_address' => '91.84.74.250',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:53:40',
                'updated_at' => '2025-12-16 00:53:40',
              ),
              63 => 
              array (
                'id' => 64,
                'ip_address' => '74.7.241.20',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:54:29',
                'updated_at' => '2025-12-16 00:54:29',
              ),
              64 => 
              array (
                'id' => 65,
                'ip_address' => '57.131.35.166',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 00:59:51',
                'updated_at' => '2025-12-16 00:59:51',
              ),
              65 => 
              array (
                'id' => 66,
                'ip_address' => '34.220.176.138',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 01:11:52',
                'updated_at' => '2025-12-16 01:11:52',
              ),
              66 => 
              array (
                'id' => 67,
                'ip_address' => '34.220.176.138',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 01:12:02',
                'updated_at' => '2025-12-16 01:12:02',
              ),
              67 => 
              array (
                'id' => 68,
                'ip_address' => '54.247.57.72',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 01:58:40',
                'updated_at' => '2025-12-16 01:58:40',
              ),
              68 => 
              array (
                'id' => 69,
                'ip_address' => '54.247.57.72',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 01:58:42',
                'updated_at' => '2025-12-16 01:58:42',
              ),
              69 => 
              array (
                'id' => 70,
                'ip_address' => '54.247.57.72',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 01:58:50',
                'updated_at' => '2025-12-16 01:58:50',
              ),
              70 => 
              array (
                'id' => 71,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 02:19:58',
                'updated_at' => '2025-12-16 02:19:58',
              ),
              71 => 
              array (
                'id' => 72,
                'ip_address' => '193.19.82.13',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 02:29:42',
                'updated_at' => '2025-12-16 02:29:42',
              ),
              72 => 
              array (
                'id' => 73,
                'ip_address' => '193.19.82.13',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 02:29:58',
                'updated_at' => '2025-12-16 02:29:58',
              ),
              73 => 
              array (
                'id' => 74,
                'ip_address' => '149.57.180.79',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 02:54:02',
                'updated_at' => '2025-12-16 02:54:02',
              ),
              74 => 
              array (
                'id' => 75,
                'ip_address' => '149.57.180.141',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 04:18:51',
                'updated_at' => '2025-12-16 04:18:51',
              ),
              75 => 
              array (
                'id' => 76,
                'ip_address' => '23.27.145.155',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 04:44:04',
                'updated_at' => '2025-12-16 04:44:04',
              ),
              76 => 
              array (
                'id' => 77,
                'ip_address' => '23.27.145.155',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 06:46:54',
                'updated_at' => '2025-12-16 06:46:54',
              ),
              77 => 
              array (
                'id' => 78,
                'ip_address' => '91.84.74.250',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 07:16:11',
                'updated_at' => '2025-12-16 07:16:11',
              ),
              78 => 
              array (
                'id' => 79,
                'ip_address' => '23.159.216.216',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 09:19:52',
                'updated_at' => '2025-12-16 09:19:52',
              ),
              79 => 
              array (
                'id' => 80,
                'ip_address' => '91.84.74.250',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 11:51:18',
                'updated_at' => '2025-12-16 11:51:18',
              ),
              80 => 
              array (
                'id' => 81,
                'ip_address' => '34.143.217.236',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:03:35',
                'updated_at' => '2025-12-16 12:03:35',
              ),
              81 => 
              array (
                'id' => 82,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:32:21',
                'updated_at' => '2025-12-16 12:32:21',
              ),
              82 => 
              array (
                'id' => 83,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:32:22',
                'updated_at' => '2025-12-16 12:32:22',
              ),
              83 => 
              array (
                'id' => 84,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:32:39',
                'updated_at' => '2025-12-16 12:32:39',
              ),
              84 => 
              array (
                'id' => 85,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:33:26',
                'updated_at' => '2025-12-16 12:33:26',
              ),
              85 => 
              array (
                'id' => 86,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:34:00',
                'updated_at' => '2025-12-16 12:34:00',
              ),
              86 => 
              array (
                'id' => 87,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:34:19',
                'updated_at' => '2025-12-16 12:34:19',
              ),
              87 => 
              array (
                'id' => 88,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:34:40',
                'updated_at' => '2025-12-16 12:34:40',
              ),
              88 => 
              array (
                'id' => 89,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:34:40',
                'updated_at' => '2025-12-16 12:34:40',
              ),
              89 => 
              array (
                'id' => 90,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:35:31',
                'updated_at' => '2025-12-16 12:35:31',
              ),
              90 => 
              array (
                'id' => 91,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:38:34',
                'updated_at' => '2025-12-16 12:38:34',
              ),
              91 => 
              array (
                'id' => 92,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:39:26',
                'updated_at' => '2025-12-16 12:39:26',
              ),
              92 => 
              array (
                'id' => 93,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 12:39:27',
                'updated_at' => '2025-12-16 12:39:27',
              ),
              93 => 
              array (
                'id' => 94,
                'ip_address' => '3.88.20.10',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 14:22:08',
                'updated_at' => '2025-12-16 14:22:08',
              ),
              94 => 
              array (
                'id' => 95,
                'ip_address' => '195.178.110.201',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 17:29:18',
                'updated_at' => '2025-12-16 17:29:18',
              ),
              95 => 
              array (
                'id' => 96,
                'ip_address' => '216.73.216.164',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 20:01:29',
                'updated_at' => '2025-12-16 20:01:29',
              ),
              96 => 
              array (
                'id' => 97,
                'ip_address' => '34.168.82.50',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 21:00:28',
                'updated_at' => '2025-12-16 21:00:28',
              ),
              97 => 
              array (
                'id' => 98,
                'ip_address' => '87.236.176.148',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 23:47:37',
                'updated_at' => '2025-12-16 23:47:37',
              ),
              98 => 
              array (
                'id' => 99,
                'ip_address' => '91.84.74.250',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 23:49:26',
                'updated_at' => '2025-12-16 23:49:26',
              ),
              99 => 
              array (
                'id' => 100,
                'ip_address' => '87.236.176.106',
                'fcm_token' => NULL,
                'created_at' => '2025-12-16 23:54:54',
                'updated_at' => '2025-12-16 23:54:54',
              ),
              100 => 
              array (
                'id' => 101,
                'ip_address' => '146.190.26.31',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 00:32:13',
                'updated_at' => '2025-12-17 00:32:13',
              ),
              101 => 
              array (
                'id' => 102,
                'ip_address' => '34.221.21.250',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 02:05:52',
                'updated_at' => '2025-12-17 02:05:52',
              ),
              102 => 
              array (
                'id' => 103,
                'ip_address' => '23.27.145.102',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 02:48:56',
                'updated_at' => '2025-12-17 02:48:56',
              ),
              103 => 
              array (
                'id' => 104,
                'ip_address' => '51.89.23.223',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 03:38:51',
                'updated_at' => '2025-12-17 03:38:51',
              ),
              104 => 
              array (
                'id' => 105,
                'ip_address' => '23.27.145.173',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 04:33:25',
                'updated_at' => '2025-12-17 04:33:25',
              ),
              105 => 
              array (
                'id' => 106,
                'ip_address' => '23.27.145.80',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 05:05:24',
                'updated_at' => '2025-12-17 05:05:24',
              ),
              106 => 
              array (
                'id' => 107,
                'ip_address' => '34.143.244.218',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 08:55:29',
                'updated_at' => '2025-12-17 08:55:29',
              ),
              107 => 
              array (
                'id' => 108,
                'ip_address' => '151.80.144.77',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 09:04:23',
                'updated_at' => '2025-12-17 09:04:23',
              ),
              108 => 
              array (
                'id' => 109,
                'ip_address' => '185.177.72.8',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 09:25:56',
                'updated_at' => '2025-12-17 09:25:56',
              ),
              109 => 
              array (
                'id' => 110,
                'ip_address' => '104.252.191.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 09:46:44',
                'updated_at' => '2025-12-17 09:46:44',
              ),
              110 => 
              array (
                'id' => 111,
                'ip_address' => '154.28.229.115',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 09:46:45',
                'updated_at' => '2025-12-17 09:46:45',
              ),
              111 => 
              array (
                'id' => 112,
                'ip_address' => '104.252.191.112',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 09:46:53',
                'updated_at' => '2025-12-17 09:46:53',
              ),
              112 => 
              array (
                'id' => 113,
                'ip_address' => '103.4.251.50',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 10:42:27',
                'updated_at' => '2025-12-17 10:42:27',
              ),
              113 => 
              array (
                'id' => 114,
                'ip_address' => '104.252.191.215',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 10:42:27',
                'updated_at' => '2025-12-17 10:42:27',
              ),
              114 => 
              array (
                'id' => 115,
                'ip_address' => '104.252.191.166',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 10:57:09',
                'updated_at' => '2025-12-17 10:57:09',
              ),
              115 => 
              array (
                'id' => 116,
                'ip_address' => '107.172.195.20',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 10:57:11',
                'updated_at' => '2025-12-17 10:57:11',
              ),
              116 => 
              array (
                'id' => 117,
                'ip_address' => '107.172.195.20',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 10:57:18',
                'updated_at' => '2025-12-17 10:57:18',
              ),
              117 => 
              array (
                'id' => 118,
                'ip_address' => '18.132.190.207',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 14:15:55',
                'updated_at' => '2025-12-17 14:15:55',
              ),
              118 => 
              array (
                'id' => 119,
                'ip_address' => '104.252.191.243',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 21:34:28',
                'updated_at' => '2025-12-17 21:34:28',
              ),
              119 => 
              array (
                'id' => 120,
                'ip_address' => '107.172.195.124',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 21:34:28',
                'updated_at' => '2025-12-17 21:34:28',
              ),
              120 => 
              array (
                'id' => 121,
                'ip_address' => '107.172.195.124',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 21:34:43',
                'updated_at' => '2025-12-17 21:34:43',
              ),
              121 => 
              array (
                'id' => 122,
                'ip_address' => '59.153.103.137',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 21:35:52',
                'updated_at' => '2025-12-17 21:35:52',
              ),
              122 => 
              array (
                'id' => 123,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-12-17 16:03:33',
                'updated_at' => '2025-12-17 16:03:33',
              ),
              123 => 
              array (
                'id' => 124,
                'ip_address' => '127.0.0.1',
                'fcm_token' => NULL,
                'created_at' => '2025-12-20 06:29:26',
                'updated_at' => '2025-12-20 06:29:26',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('guest_users')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
