<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ErrorLogTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('error_logs')->truncate();
        $chunks = [];
        $chunks[] =
            array (
              0 =>
              array (
                'id' => 90,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/themes/default/public/addon/default-theme.png',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:06',
                'updated_at' => '2025-12-15 23:45:06',
              ),
              1 =>
              array (
                'id' => 91,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/js/lightbox.min.map',
                'hit_counts' => 3,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:17',
                'updated_at' => '2025-12-16 00:56:28',
              ),
              2 =>
              array (
                'id' => 92,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/sm/f07d8d7b2652873f485707eab4f3d300bf1f6f3b42912e189c8933b1b9b3dfde.map',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:17',
                'updated_at' => '2025-12-15 23:50:00',
              ),
              3 =>
              array (
                'id' => 93,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/back-end/js/bootstrap.bundle.min.js.map',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:17',
                'updated_at' => '2025-12-15 23:50:00',
              ),
              4 =>
              array (
                'id' => 94,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/back-end/js/toastr.js.map',
                'hit_counts' => 3,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:17',
                'updated_at' => '2025-12-16 00:58:00',
              ),
              5 =>
              array (
                'id' => 95,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/back-end/css/style.css.map',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:17',
                'updated_at' => '2025-12-15 23:50:00',
              ),
              6 =>
              array (
                'id' => 96,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/back-end/img/system-setup.png',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:45:25',
                'updated_at' => '2025-12-15 23:45:25',
              ),
              7 =>
              array (
                'id' => 97,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_next',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-15 23:54:34',
                'updated_at' => '2025-12-15 23:54:39',
              ),
              8 =>
              array (
                'id' => 98,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/css/support_parent.css',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:55:07',
                'updated_at' => '2025-12-16 00:55:07',
              ),
              9 =>
              array (
                'id' => 99,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/js/lkk_ch.js',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:55:33',
                'updated_at' => '2025-12-16 00:55:33',
              ),
              10 =>
              array (
                'id' => 100,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/js/twint_ch.js',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:55:41',
                'updated_at' => '2025-12-16 00:55:41',
              ),
              11 =>
              array (
                'id' => 101,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/js/\'%20+%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20n.src%20+%20%20%20%',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:57:59',
                'updated_at' => '2025-12-16 00:57:59',
              ),
              12 =>
              array (
                'id' => 102,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/firebase/firebase.js.map',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:59:09',
                'updated_at' => '2025-12-16 00:59:09',
              ),
              13 =>
              array (
                'id' => 103,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/fonts/fontawesome-webfont.woff?v=4.7.0',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:59:24',
                'updated_at' => '2025-12-16 00:59:24',
              ),
              14 =>
              array (
                'id' => 104,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js.map',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:59:25',
                'updated_at' => '2025-12-16 00:59:25',
              ),
              15 =>
              array (
                'id' => 105,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/drift-zoom/dist/Drift.min.js.map',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:59:28',
                'updated_at' => '2025-12-16 00:59:28',
              ),
              16 =>
              array (
                'id' => 106,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js.map',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 00:59:28',
                'updated_at' => '2025-12-16 00:59:28',
              ),
              17 =>
              array (
                'id' => 107,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/tiny-slider/dist/sourcemaps/tiny-slider.js.map',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:00:11',
                'updated_at' => '2025-12-16 01:00:11',
              ),
              18 =>
              array (
                'id' => 108,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/lightgallery.js/dist/js/\'+d+\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:00:14',
                'updated_at' => '2025-12-16 01:00:14',
              ),
              19 =>
              array (
                'id' => 109,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/vendor/lightgallery.js/dist/js/\'+a+\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:00:15',
                'updated_at' => '2025-12-16 01:00:15',
              ),
              20 =>
              array (
                'id' => 110,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20e.xdebug_link.url%20+%20\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:43',
                'updated_at' => '2025-12-16 01:01:43',
              ),
              21 =>
              array (
                'id' => 111,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20value.xdebug_link.url%20+%20\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:43',
                'updated_at' => '2025-12-16 01:01:43',
              ),
              22 =>
              array (
                'id' => 112,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20values.xdebug_link.url%20+%20\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:44',
                'updated_at' => '2025-12-16 01:01:44',
              ),
              23 =>
              array (
                'id' => 113,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20tpl.xdebug_link.url%20+%20\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:45',
                'updated_at' => '2025-12-16 01:01:45',
              ),
              24 =>
              array (
                'id' => 114,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20stmt.xdebug_link.url%20+%20\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:45',
                'updated_at' => '2025-12-16 01:01:45',
              ),
              25 =>
              array (
                'id' => 115,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_debugbar/assets/\'+%20tpl.editorLink%20+\'',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:46',
                'updated_at' => '2025-12-16 01:01:46',
              ),
              26 =>
              array (
                'id' => 116,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/front-end/css/owl.video.play.png',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:01:56',
                'updated_at' => '2025-12-16 01:01:56',
              ),
              27 =>
              array (
                'id' => 117,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/.git/config',
                'hit_counts' => 7,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 01:23:58',
                'updated_at' => '2025-12-17 14:15:53',
              ),
              28 =>
              array (
                'id' => 118,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/.env',
                'hit_counts' => 3,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 10:37:53',
                'updated_at' => '2025-12-17 11:32:11',
              ),
              29 =>
              array (
                'id' => 119,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/wordpress',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 12:03:38',
                'updated_at' => '2025-12-17 08:55:31',
              ),
              30 =>
              array (
                'id' => 120,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/apps',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 14:22:10',
                'updated_at' => '2025-12-16 14:22:10',
              ),
              31 =>
              array (
                'id' => 121,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/api/action',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 14:22:11',
                'updated_at' => '2025-12-16 14:22:11',
              ),
              32 =>
              array (
                'id' => 122,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/api/actions',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 14:22:11',
                'updated_at' => '2025-12-16 14:22:11',
              ),
              33 =>
              array (
                'id' => 123,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/_next/data',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 14:22:12',
                'updated_at' => '2025-12-16 14:22:12',
              ),
              34 =>
              array (
                'id' => 124,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/backend/.env',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:14',
                'updated_at' => '2025-12-16 17:30:14',
              ),
              35 =>
              array (
                'id' => 125,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/admin/.env',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:15',
                'updated_at' => '2025-12-16 17:30:15',
              ),
              36 =>
              array (
                'id' => 126,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/.env.save',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:17',
                'updated_at' => '2025-12-16 17:30:17',
              ),
              37 =>
              array (
                'id' => 127,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/.env.bak',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:18',
                'updated_at' => '2025-12-16 17:30:18',
              ),
              38 =>
              array (
                'id' => 128,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/.git/logs/HEAD',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:19',
                'updated_at' => '2025-12-16 17:30:19',
              ),
              39 =>
              array (
                'id' => 129,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/config.json',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:20',
                'updated_at' => '2025-12-16 17:30:20',
              ),
              40 =>
              array (
                'id' => 130,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/config.js',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:21',
                'updated_at' => '2025-12-16 17:30:21',
              ),
              41 =>
              array (
                'id' => 131,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/aws-config.js',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:22',
                'updated_at' => '2025-12-16 17:30:22',
              ),
              42 =>
              array (
                'id' => 132,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/aws.config.js',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:23',
                'updated_at' => '2025-12-16 17:30:23',
              ),
              43 =>
              array (
                'id' => 133,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/.npmrc',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:30:24',
                'updated_at' => '2025-12-16 17:30:24',
              ),
              44 =>
              array (
                'id' => 134,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:31:54',
                'updated_at' => '2025-12-16 17:31:54',
              ),
              45 =>
              array (
                'id' => 135,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/www.gstatic.com/firebasejs/8.3.2/firebase-auth.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:31:54',
                'updated_at' => '2025-12-16 17:31:54',
              ),
              46 =>
              array (
                'id' => 136,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/js/sweet_alert.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:31:54',
                'updated_at' => '2025-12-16 17:31:54',
              ),
              47 =>
              array (
                'id' => 137,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/js/custom.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:31:54',
                'updated_at' => '2025-12-16 17:31:54',
              ),
              48 =>
              array (
                'id' => 138,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/js/lightbox.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:14',
                'updated_at' => '2025-12-16 17:32:14',
              ),
              49 =>
              array (
                'id' => 139,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:40',
                'updated_at' => '2025-12-16 17:32:40',
              ),
              50 =>
              array (
                'id' => 140,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/simplebar/dist/simplebar.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:40',
                'updated_at' => '2025-12-16 17:32:40',
              ),
              51 =>
              array (
                'id' => 141,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/js/home.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:40',
                'updated_at' => '2025-12-16 17:32:40',
              ),
              52 =>
              array (
                'id' => 142,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/www.gstatic.com/firebasejs/8.3.2/firebase-app.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:40',
                'updated_at' => '2025-12-16 17:32:40',
              ),
              53 =>
              array (
                'id' => 143,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/firebase/firebase.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:40',
                'updated_at' => '2025-12-16 17:32:40',
              ),
              54 =>
              array (
                'id' => 144,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/back-end/js/toastr.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:40',
                'updated_at' => '2025-12-16 17:32:40',
              ),
              55 =>
              array (
                'id' => 145,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/js/theme.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              56 =>
              array (
                'id' => 146,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              57 =>
              array (
                'id' => 147,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              58 =>
              array (
                'id' => 148,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              59 =>
              array (
                'id' => 149,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/js/slick.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              60 =>
              array (
                'id' => 150,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/\'/_debugbar/assets/javascript?v=1763541085%27',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              61 =>
              array (
                'id' => 151,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              62 =>
              array (
                'id' => 152,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:41',
                'updated_at' => '2025-12-16 17:32:41',
              ),
              63 =>
              array (
                'id' => 153,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/js/owl.carousel.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:42',
                'updated_at' => '2025-12-16 17:32:42',
              ),
              64 =>
              array (
                'id' => 154,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/drift-zoom/dist/Drift.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:42',
                'updated_at' => '2025-12-16 17:32:42',
              ),
              65 =>
              array (
                'id' => 155,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/site-assets/front-end/vendor/lg-video.js/dist/lg-video.min.js%22',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-16 17:32:42',
                'updated_at' => '2025-12-16 17:32:42',
              ),
              66 =>
              array (
                'id' => 156,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/back-end/js/toastr.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:17',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              67 =>
              array (
                'id' => 157,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/lg-video.js/dist/lg-video.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              68 =>
              array (
                'id' => 158,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/js/theme.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              69 =>
              array (
                'id' => 159,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/js/lightbox.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              70 =>
              array (
                'id' => 160,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/js/slick.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:53',
              ),
              71 =>
              array (
                'id' => 161,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              72 =>
              array (
                'id' => 162,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:53',
              ),
              73 =>
              array (
                'id' => 163,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/js/custom.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:18',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              74 =>
              array (
                'id' => 164,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:19',
                'updated_at' => '2025-12-17 09:26:56',
              ),
              75 =>
              array (
                'id' => 165,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/lightgallery.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:19',
                'updated_at' => '2025-12-17 09:26:56',
              ),
              76 =>
              array (
                'id' => 166,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/js/owl.carousel.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:19',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              77 =>
              array (
                'id' => 167,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:19',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              78 =>
              array (
                'id' => 168,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/simplebar/dist/simplebar.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:19',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              79 =>
              array (
                'id' => 169,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/drift-zoom/dist/Drift.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              80 =>
              array (
                'id' => 170,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/js/home.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:56',
              ),
              81 =>
              array (
                'id' => 171,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/js/sweet_alert.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:53',
              ),
              82 =>
              array (
                'id' => 172,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/firebase/firebase.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              83 =>
              array (
                'id' => 173,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//www.gstatic.com/firebasejs/8.3.2/firebase-app.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              84 =>
              array (
                'id' => 174,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/firebase-messaging-sw.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              85 =>
              array (
                'id' => 175,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              86 =>
              array (
                'id' => 176,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:54',
              ),
              87 =>
              array (
                'id' => 177,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//www.gstatic.com/firebasejs/8.3.2/firebase-auth.js',
                'hit_counts' => 2,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:20',
                'updated_at' => '2025-12-17 09:26:56',
              ),
              88 =>
              array (
                'id' => 178,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/site-assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 09:26:55',
                'updated_at' => '2025-12-17 09:26:55',
              ),
              89 =>
              array (
                'id' => 179,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/site-assets/back-end/img/icons/product-upload-icon.svg-dummy',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 21:20:32',
                'updated_at' => '2025-12-17 21:20:32',
              ),
              90 =>
              array (
                'id' => 180,
                'status_code' => 404,
                'url' => 'https://beta.shutarshawpno.com/admin/products/dummy',
                'hit_counts' => 1,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 21:20:32',
                'updated_at' => '2025-12-17 21:20:32',
              ),
              91 =>
              array (
                'id' => 181,
                'status_code' => 404,
                'url' => 'http://localhost:8000/.well-known/appspecific/com.chrome.devtools.json',
                'hit_counts' => 19,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:14:05',
                'updated_at' => '2025-12-17 17:39:42',
              ),
              92 =>
              array (
                'id' => 182,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/vendor/tiny-slider/dist/sourcemaps/tiny-slider.css.map',
                'hit_counts' => 19,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:14:05',
                'updated_at' => '2025-12-17 17:39:55',
              ),
              93 =>
              array (
                'id' => 183,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/css/theme.min.css.map',
                'hit_counts' => 16,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:14:58',
                'updated_at' => '2025-12-17 17:38:17',
              ),
              94 =>
              array (
                'id' => 184,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/css/style.css.map',
                'hit_counts' => 15,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:00',
                'updated_at' => '2025-12-17 17:39:57',
              ),
              95 =>
              array (
                'id' => 185,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:01',
                'updated_at' => '2025-12-17 17:39:44',
              ),
              96 =>
              array (
                'id' => 186,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:03',
                'updated_at' => '2025-12-17 17:39:46',
              ),
              97 =>
              array (
                'id' => 187,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/vendor/tiny-slider/dist/sourcemaps/tiny-slider.js.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:06',
                'updated_at' => '2025-12-17 17:39:47',
              ),
              98 =>
              array (
                'id' => 188,
                'status_code' => 404,
                'url' => 'http://localhost:8000/js/lightbox.min.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:07',
                'updated_at' => '2025-12-17 17:39:49',
              ),
              99 =>
              array (
                'id' => 189,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/vendor/drift-zoom/dist/Drift.min.js.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:09',
                'updated_at' => '2025-12-17 17:39:50',
              ),
              100 =>
              array (
                'id' => 190,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/back-end/js/toastr.js.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:10',
                'updated_at' => '2025-12-17 17:39:52',
              ),
              101 =>
              array (
                'id' => 191,
                'status_code' => 404,
                'url' => 'http://localhost:8000/site-assets/front-end/vendor/firebase/firebase.js.map',
                'hit_counts' => 18,
                'redirect_url' => NULL,
                'redirect_status' => NULL,
                'created_at' => '2025-12-17 16:15:11',
                'updated_at' => '2025-12-17 17:39:54',
              ),
            );
        foreach ($chunks as $rows) {
            DB::table('error_logs')->insert($rows);
        }

        Schema::enableForeignKeyConstraints();
    }
}
