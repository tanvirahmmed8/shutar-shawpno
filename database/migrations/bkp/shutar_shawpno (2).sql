-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2025 at 05:11 PM
-- Server version: 8.2.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shutar_shawpno`
--

-- --------------------------------------------------------

--
-- Table structure for table `addon_settings`
--

DROP TABLE IF EXISTS `addon_settings`;
CREATE TABLE IF NOT EXISTS `addon_settings` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live_values` longtext COLLATE utf8mb4_unicode_ci,
  `test_values` longtext COLLATE utf8mb4_unicode_ci,
  `settings_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'live',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `additional_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`),
  KEY `payment_settings_id_index` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addon_settings`
--

INSERT INTO `addon_settings` (`id`, `key_name`, `live_values`, `test_values`, `settings_type`, `mode`, `is_active`, `created_at`, `updated_at`, `additional_data`) VALUES
('070c6bbd-d777-11ed-96f4-0c7a158e4469', 'twilio', '{\"gateway\":\"twilio\",\"mode\":\"live\",\"status\":\"0\",\"sid\":\"data\",\"messaging_service_sid\":\"data\",\"token\":\"data\",\"from\":\"data\",\"otp_template\":\"data\"}', '{\"gateway\":\"twilio\",\"mode\":\"live\",\"status\":\"0\",\"sid\":\"data\",\"messaging_service_sid\":\"data\",\"token\":\"data\",\"from\":\"data\",\"otp_template\":\"data\"}', 'sms_config', 'live', 0, NULL, '2023-08-12 07:01:29', ''),
('070c766c-d777-11ed-96f4-0c7a158e4469', '2factor', '{\"gateway\":\"2factor\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\"}', '{\"gateway\":\"2factor\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\"}', 'sms_config', 'live', 0, NULL, '2023-08-12 07:01:36', ''),
('0d8a9308-d6a5-11ed-962c-0c7a158e4469', 'mercadopago', '{\"gateway\":\"mercadopago\",\"mode\":\"live\",\"status\":0,\"access_token\":\"\",\"public_key\":\"\"}', '{\"gateway\":\"mercadopago\",\"mode\":\"live\",\"status\":0,\"access_token\":\"\",\"public_key\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-27 11:57:11', '{\"gateway_title\":\"Mercadopago\",\"gateway_image\":null}'),
('0d8a9e49-d6a5-11ed-962c-0c7a158e4469', 'liqpay', '{\"gateway\":\"liqpay\",\"mode\":\"live\",\"status\":0,\"private_key\":\"\",\"public_key\":\"\"}', '{\"gateway\":\"liqpay\",\"mode\":\"live\",\"status\":0,\"private_key\":\"\",\"public_key\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:32:31', '{\"gateway_title\":\"Liqpay\",\"gateway_image\":null}'),
('101befdf-d44b-11ed-8564-0c7a158e4469', 'paypal', '{\"gateway\":\"paypal\",\"mode\":\"live\",\"status\":\"0\",\"client_id\":\"\",\"client_secret\":\"\"}', '{\"gateway\":\"paypal\",\"mode\":\"live\",\"status\":\"0\",\"client_id\":\"\",\"client_secret\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 03:41:32', '{\"gateway_title\":\"Paypal\",\"gateway_image\":null}'),
('133d9647-cabb-11ed-8fec-0c7a158e4469', 'hyper_pay', '{\"gateway\":\"hyper_pay\",\"mode\":\"test\",\"status\":\"0\",\"entity_id\":\"data\",\"access_code\":\"data\"}', '{\"gateway\":\"hyper_pay\",\"mode\":\"test\",\"status\":\"0\",\"entity_id\":\"data\",\"access_code\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:32:42', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('1821029f-d776-11ed-96f4-0c7a158e4469', 'msg91', '{\"gateway\":\"msg91\",\"mode\":\"live\",\"status\":\"0\",\"template_id\":\"data\",\"auth_key\":\"data\"}', '{\"gateway\":\"msg91\",\"mode\":\"live\",\"status\":\"0\",\"template_id\":\"data\",\"auth_key\":\"data\"}', 'sms_config', 'live', 0, NULL, '2023-08-12 07:01:48', ''),
('18210f2b-d776-11ed-96f4-0c7a158e4469', 'nexmo', '{\"gateway\":\"nexmo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"api_secret\":\"\",\"token\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"nexmo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"api_secret\":\"\",\"token\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, '2023-04-10 02:14:44', ''),
('18fbb21f-d6ad-11ed-962c-0c7a158e4469', 'foloosi', '{\"gateway\":\"foloosi\",\"mode\":\"test\",\"status\":\"0\",\"merchant_key\":\"data\"}', '{\"gateway\":\"foloosi\",\"mode\":\"test\",\"status\":\"0\",\"merchant_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:34:33', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('2767d142-d6a1-11ed-962c-0c7a158e4469', 'paytm', '{\"gateway\":\"paytm\",\"mode\":\"live\",\"status\":0,\"merchant_key\":\"\",\"merchant_id\":\"\",\"merchant_website_link\":\"\"}', '{\"gateway\":\"paytm\",\"mode\":\"live\",\"status\":0,\"merchant_key\":\"\",\"merchant_id\":\"\",\"merchant_website_link\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-22 06:30:55', '{\"gateway_title\":\"Paytm\",\"gateway_image\":null}'),
('3201d2e6-c937-11ed-a424-0c7a158e4469', 'amazon_pay', '{\"gateway\":\"amazon_pay\",\"mode\":\"test\",\"status\":\"0\",\"pass_phrase\":\"data\",\"access_code\":\"data\",\"merchant_identifier\":\"data\"}', '{\"gateway\":\"amazon_pay\",\"mode\":\"test\",\"status\":\"0\",\"pass_phrase\":\"data\",\"access_code\":\"data\",\"merchant_identifier\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:36:07', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('33a90207-7315-4bfe-a9af-d16049cc0b7c', 'cashfree', '\"{\\\"gateway\\\":\\\"cashfree\\\",\\\"mode\\\":\\\"test\\\",\\\"status\\\":0,\\\"client_id\\\":\\\"\\\",\\\"client_secret\\\":\\\"\\\"}\"', '\"{\\\"gateway\\\":\\\"cashfree\\\",\\\"mode\\\":\\\"test\\\",\\\"status\\\":0,\\\"client_id\\\":\\\"\\\",\\\"client_secret\\\":\\\"\\\"}\"', 'payment_config', 'test', 0, '2024-12-21 06:51:28', '2024-12-21 06:51:28', ''),
('4593b25c-d6a1-11ed-962c-0c7a158e4469', 'paytabs', '{\"gateway\":\"paytabs\",\"mode\":\"live\",\"status\":0,\"profile_id\":\"\",\"server_key\":\"\",\"base_url\":\"https:\\/\\/secure-egypt.paytabs.com\\/\"}', '{\"gateway\":\"paytabs\",\"mode\":\"live\",\"status\":0,\"profile_id\":\"\",\"server_key\":\"\",\"base_url\":\"https:\\/\\/secure-egypt.paytabs.com\\/\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:34:51', '{\"gateway_title\":\"Paytabs\",\"gateway_image\":null}'),
('4e9b8dfb-e7d1-11ed-a559-0c7a158e4469', 'bkash', '{\"gateway\":\"bkash\",\"mode\":\"live\",\"status\":\"0\",\"app_key\":\"\",\"app_secret\":\"\",\"username\":\"\",\"password\":\"\"}', '{\"gateway\":\"bkash\",\"mode\":\"live\",\"status\":\"0\",\"app_key\":\"\",\"app_secret\":\"\",\"username\":\"\",\"password\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:39:42', '{\"gateway_title\":\"Bkash\",\"gateway_image\":null}'),
('544a24a4-c872-11ed-ac7a-0c7a158e4469', 'fatoorah', '{\"gateway\":\"fatoorah\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', '{\"gateway\":\"fatoorah\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:36:24', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('58c1bc8a-d6ac-11ed-962c-0c7a158e4469', 'ccavenue', '{\"gateway\":\"ccavenue\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"working_key\":\"data\",\"access_code\":\"data\"}', '{\"gateway\":\"ccavenue\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"working_key\":\"data\",\"access_code\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 03:42:38', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-13-643783f01d386.png\"}'),
('5e2d2ef9-d6ab-11ed-962c-0c7a158e4469', 'thawani', '{\"gateway\":\"thawani\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"private_key\":\"data\"}', '{\"gateway\":\"thawani\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"private_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:50:40', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-13-64378f9856f29.png\"}'),
('60cc83cc-d5b9-11ed-b56f-0c7a158e4469', 'sixcash', '{\"gateway\":\"sixcash\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"secret_key\":\"data\",\"merchant_number\":\"data\",\"base_url\":\"data\"}', '{\"gateway\":\"sixcash\",\"mode\":\"test\",\"status\":\"0\",\"public_key\":\"data\",\"secret_key\":\"data\",\"merchant_number\":\"data\",\"base_url\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:16:17', '{\"gateway_title\":null,\"gateway_image\":\"2023-04-12-6436774e77ff9.png\"}'),
('68579846-d8e8-11ed-8249-0c7a158e4469', 'alphanet_sms', '{\"gateway\":\"alphanet_sms\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"alphanet_sms\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('6857a2e8-d8e8-11ed-8249-0c7a158e4469', 'sms_to', '{\"gateway\":\"sms_to\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"sms_to\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('74c30c00-d6a6-11ed-962c-0c7a158e4469', 'hubtel', '{\"gateway\":\"hubtel\",\"mode\":\"test\",\"status\":\"0\",\"account_number\":\"data\",\"api_id\":\"data\",\"api_key\":\"data\"}', '{\"gateway\":\"hubtel\",\"mode\":\"test\",\"status\":\"0\",\"account_number\":\"data\",\"api_id\":\"data\",\"api_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:37:43', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('74e46b0a-d6aa-11ed-962c-0c7a158e4469', 'tap', '{\"gateway\":\"tap\",\"mode\":\"test\",\"status\":\"0\",\"secret_key\":\"data\"}', '{\"gateway\":\"tap\",\"mode\":\"test\",\"status\":\"0\",\"secret_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:50:09', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('761ca96c-d1eb-11ed-87ca-0c7a158e4469', 'swish', '{\"gateway\":\"swish\",\"mode\":\"test\",\"status\":\"0\",\"number\":\"data\"}', '{\"gateway\":\"swish\",\"mode\":\"test\",\"status\":\"0\",\"number\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:17:02', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('7b1c3c5f-d2bd-11ed-b485-0c7a158e4469', 'payfast', '{\"gateway\":\"payfast\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"secured_key\":\"data\"}', '{\"gateway\":\"payfast\",\"mode\":\"test\",\"status\":\"0\",\"merchant_id\":\"data\",\"secured_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:18:13', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('8592417b-d1d1-11ed-a984-0c7a158e4469', 'esewa', '{\"gateway\":\"esewa\",\"mode\":\"test\",\"status\":\"0\",\"merchantCode\":\"data\"}', '{\"gateway\":\"esewa\",\"mode\":\"test\",\"status\":\"0\",\"merchantCode\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:17:38', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('888e7b84-27b3-497d-a5ef-cd69d65a798e', 'instamojo', '\"{\\\"gateway\\\":\\\"instamojo\\\",\\\"mode\\\":\\\"test\\\",\\\"status\\\":\\\"0\\\",\\\"client_id\\\":\\\"\\\",\\\"client_secret\\\":\\\"\\\"}\"', '\"{\\\"gateway\\\":\\\"instamojo\\\",\\\"mode\\\":\\\"test\\\",\\\"status\\\":\\\"0\\\",\\\"client_id\\\":\\\"\\\",\\\"client_secret\\\":\\\"\\\"}\"', 'payment_config', 'test', 0, '2024-12-21 06:51:28', '2024-12-21 06:51:28', ''),
('9162a1dc-cdf1-11ed-affe-0c7a158e4469', 'viva_wallet', '{\"gateway\":\"viva_wallet\",\"mode\":\"test\",\"status\":\"0\",\"client_id\": \"\",\"client_secret\": \"\", \"source_code\":\"\"} ', '{\"gateway\":\"viva_wallet\",\"mode\":\"test\",\"status\":\"0\",\"client_id\": \"\",\"client_secret\": \"\", \"source_code\":\"\"} ', 'payment_config', 'test', 0, NULL, NULL, ''),
('998ccc62-d6a0-11ed-962c-0c7a158e4469', 'stripe', '{\"gateway\":\"stripe\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":null,\"published_key\":null}', '{\"gateway\":\"stripe\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":null,\"published_key\":null}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:18:55', '{\"gateway_title\":\"Stripe\",\"gateway_image\":null}'),
('a3313755-c95d-11ed-b1db-0c7a158e4469', 'iyzi_pay', '{\"gateway\":\"iyzi_pay\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\",\"secret_key\":\"data\",\"base_url\":\"data\"}', '{\"gateway\":\"iyzi_pay\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\",\"secret_key\":\"data\",\"base_url\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:20:02', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('a76c8993-d299-11ed-b485-0c7a158e4469', 'momo', '{\"gateway\":\"momo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\",\"api_user\":\"data\",\"subscription_key\":\"data\"}', '{\"gateway\":\"momo\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"data\",\"api_user\":\"data\",\"subscription_key\":\"data\"}', 'payment_config', 'live', 0, NULL, '2023-08-30 04:19:28', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('a8608119-cc76-11ed-9bca-0c7a158e4469', 'moncash', '{\"gateway\":\"moncash\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"data\",\"secret_key\":\"data\"}', '{\"gateway\":\"moncash\",\"mode\":\"test\",\"status\":\"0\",\"client_id\":\"data\",\"secret_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:47:34', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('ad5af1c1-d6a2-11ed-962c-0c7a158e4469', 'razor_pay', '{\"gateway\":\"razor_pay\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":null,\"api_secret\":null}', '{\"gateway\":\"razor_pay\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":null,\"api_secret\":null}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:47:00', '{\"gateway_title\":\"Razor pay\",\"gateway_image\":null}'),
('ad5b02a0-d6a2-11ed-962c-0c7a158e4469', 'senang_pay', '{\"gateway\":\"senang_pay\",\"mode\":\"live\",\"status\":\"0\",\"callback_url\":null,\"secret_key\":null,\"merchant_id\":null}', '{\"gateway\":\"senang_pay\",\"mode\":\"live\",\"status\":\"0\",\"callback_url\":null,\"secret_key\":null,\"merchant_id\":null}', 'payment_config', 'test', 0, NULL, '2023-08-27 09:58:57', '{\"gateway_title\":\"Senang pay\",\"gateway_image\":null}'),
('b043c880-874b-4ee7-b945-b19e3bb2cabc', 'phonepe', '\"{\\\"gateway\\\":\\\"phonepe\\\",\\\"mode\\\":\\\"test\\\",\\\"status\\\":0,\\\"merchant_id\\\":\\\"\\\",\\\"salt_Key\\\":\\\"\\\",\\\"salt_index\\\":\\\"\\\"}\"', '\"{\\\"gateway\\\":\\\"phonepe\\\",\\\"mode\\\":\\\"test\\\",\\\"status\\\":0,\\\"merchant_id\\\":\\\"\\\",\\\"salt_Key\\\":\\\"\\\",\\\"salt_index\\\":\\\"\\\"}\"', 'payment_config', 'test', 0, '2024-12-21 06:51:28', '2024-12-21 06:51:28', ''),
('b6c333f6-d8e9-11ed-8249-0c7a158e4469', 'akandit_sms', '{\"gateway\":\"akandit_sms\",\"mode\":\"live\",\"status\":0,\"username\":\"\",\"password\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"akandit_sms\",\"mode\":\"live\",\"status\":0,\"username\":\"\",\"password\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('b6c33c87-d8e9-11ed-8249-0c7a158e4469', 'global_sms', '{\"gateway\":\"global_sms\",\"mode\":\"live\",\"status\":0,\"user_name\":\"\",\"password\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"global_sms\",\"mode\":\"live\",\"status\":0,\"user_name\":\"\",\"password\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('b8992bd4-d6a0-11ed-962c-0c7a158e4469', 'paymob_accept', '{\"gateway\":\"paymob_accept\",\"mode\":\"live\",\"status\":\"0\",\"callback_url\":null,\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\",\"hmac\":\"\"}', '{\"gateway\":\"paymob_accept\",\"mode\":\"live\",\"status\":\"0\",\"callback_url\":null,\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\",\"hmac\":\"\"}', 'payment_config', 'test', 0, NULL, NULL, '{\"gateway_title\":\"Paymob accept\",\"gateway_image\":null}'),
('c41c0dcd-d119-11ed-9f67-0c7a158e4469', 'maxicash', '{\"gateway\":\"maxicash\",\"mode\":\"test\",\"status\":\"0\",\"merchantId\":\"data\",\"merchantPassword\":\"data\"}', '{\"gateway\":\"maxicash\",\"mode\":\"test\",\"status\":\"0\",\"merchantId\":\"data\",\"merchantPassword\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:49:15', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('c9249d17-cd60-11ed-b879-0c7a158e4469', 'pvit', '{\"gateway\":\"pvit\",\"mode\":\"test\",\"status\":\"0\",\"mc_tel_merchant\": \"\",\"access_token\": \"\", \"mc_merchant_code\": \"\"}', '{\"gateway\":\"pvit\",\"mode\":\"test\",\"status\":\"0\",\"mc_tel_merchant\": \"\",\"access_token\": \"\", \"mc_merchant_code\": \"\"}', 'payment_config', 'test', 0, NULL, NULL, ''),
('cb0081ce-d775-11ed-96f4-0c7a158e4469', 'releans', '{\"gateway\":\"releans\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"releans\",\"mode\":\"live\",\"status\":0,\"api_key\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, '2023-04-10 02:14:44', ''),
('d4f3f5f1-d6a0-11ed-962c-0c7a158e4469', 'flutterwave', '{\"gateway\":\"flutterwave\",\"mode\":\"live\",\"status\":0,\"secret_key\":\"\",\"public_key\":\"\",\"hash\":\"\"}', '{\"gateway\":\"flutterwave\",\"mode\":\"live\",\"status\":0,\"secret_key\":\"\",\"public_key\":\"\",\"hash\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:41:03', '{\"gateway_title\":\"Flutterwave\",\"gateway_image\":null}'),
('d822f1a5-c864-11ed-ac7a-0c7a158e4469', 'paystack', '{\"gateway\":\"paystack\",\"mode\":\"live\",\"status\":\"0\",\"callback_url\":\"https:\\/\\/api.paystack.co\",\"public_key\":null,\"secret_key\":null,\"merchant_email\":null}', '{\"gateway\":\"paystack\",\"mode\":\"live\",\"status\":\"0\",\"callback_url\":\"https:\\/\\/api.paystack.co\",\"public_key\":null,\"secret_key\":null,\"merchant_email\":null}', 'payment_config', 'test', 0, NULL, '2023-08-30 04:20:45', '{\"gateway_title\":\"Paystack\",\"gateway_image\":null}'),
('daec8d59-c893-11ed-ac7a-0c7a158e4469', 'xendit', '{\"gateway\":\"xendit\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', '{\"gateway\":\"xendit\",\"mode\":\"test\",\"status\":\"0\",\"api_key\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:35:46', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('dc0f5fc9-d6a5-11ed-962c-0c7a158e4469', 'worldpay', '{\"gateway\":\"worldpay\",\"mode\":\"test\",\"status\":\"0\",\"OrgUnitId\":\"data\",\"jwt_issuer\":\"data\",\"mac\":\"data\",\"merchantCode\":\"data\",\"xml_password\":\"data\"}', '{\"gateway\":\"worldpay\",\"mode\":\"test\",\"status\":\"0\",\"OrgUnitId\":\"data\",\"jwt_issuer\":\"data\",\"mac\":\"data\",\"merchantCode\":\"data\",\"xml_password\":\"data\"}', 'payment_config', 'test', 0, NULL, '2023-08-12 06:35:26', '{\"gateway_title\":null,\"gateway_image\":\"\"}'),
('e0450278-d8eb-11ed-8249-0c7a158e4469', 'signal_wire', '{\"gateway\":\"signal_wire\",\"mode\":\"live\",\"status\":0,\"project_id\":\"\",\"token\":\"\",\"space_url\":\"\",\"from\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"signal_wire\",\"mode\":\"live\",\"status\":0,\"project_id\":\"\",\"token\":\"\",\"space_url\":\"\",\"from\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('e0450b40-d8eb-11ed-8249-0c7a158e4469', 'paradox', '{\"gateway\":\"paradox\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"sender_id\":\"\"}', '{\"gateway\":\"paradox\",\"mode\":\"live\",\"status\":\"0\",\"api_key\":\"\",\"sender_id\":\"\"}', 'sms_config', 'live', 0, NULL, '2023-09-10 01:14:01', ''),
('ea346efe-cdda-11ed-affe-0c7a158e4469', 'ssl_commerz', '{\"gateway\":\"ssl_commerz\",\"mode\":\"live\",\"status\":\"0\",\"store_id\":\"\",\"store_password\":\"\"}', '{\"gateway\":\"ssl_commerz\",\"mode\":\"live\",\"status\":\"0\",\"store_id\":\"\",\"store_password\":\"\"}', 'payment_config', 'test', 0, NULL, '2023-08-30 03:43:49', '{\"gateway_title\":\"Ssl commerz\",\"gateway_image\":null}'),
('eed88336-d8ec-11ed-8249-0c7a158e4469', 'hubtel', '{\"gateway\":\"hubtel\",\"mode\":\"live\",\"status\":0,\"sender_id\":\"\",\"client_id\":\"\",\"client_secret\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"hubtel\",\"mode\":\"live\",\"status\":0,\"sender_id\":\"\",\"client_id\":\"\",\"client_secret\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('f149c546-d8ea-11ed-8249-0c7a158e4469', 'viatech', '{\"gateway\":\"viatech\",\"mode\":\"live\",\"status\":0,\"api_url\":\"\",\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"viatech\",\"mode\":\"live\",\"status\":0,\"api_url\":\"\",\"api_key\":\"\",\"sender_id\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, ''),
('f149cd9c-d8ea-11ed-8249-0c7a158e4469', '019_sms', '{\"gateway\":\"019_sms\",\"mode\":\"live\",\"status\":0,\"password\":\"\",\"username\":\"\",\"username_for_token\":\"\",\"sender\":\"\",\"otp_template\":\"\"}', '{\"gateway\":\"019_sms\",\"mode\":\"live\",\"status\":0,\"password\":\"\",\"username\":\"\",\"username_for_token\":\"\",\"sender\":\"\",\"otp_template\":\"\"}', 'sms_config', 'live', 0, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `add_fund_bonus_categories`
--

DROP TABLE IF EXISTS `add_fund_bonus_categories`;
CREATE TABLE IF NOT EXISTS `add_fund_bonus_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `bonus_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_amount` double(14,2) NOT NULL DEFAULT '0.00',
  `min_add_money_amount` double(14,2) NOT NULL DEFAULT '0.00',
  `max_bonus_amount` double(14,2) NOT NULL DEFAULT '0.00',
  `start_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_role_id` bigint NOT NULL DEFAULT '2',
  `image` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'def.png',
  `identify_image` text COLLATE utf8mb4_unicode_ci,
  `identify_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identify_number` int DEFAULT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `phone`, `admin_role_id`, `image`, `identify_image`, `identify_type`, `identify_number`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Master Admin', '01759412381', 1, 'def.png', NULL, NULL, NULL, 'admin@admin.com', NULL, '$2y$10$EgHgGXqrqSnQmy4U4QQ0Puo1UprR2F8HFb.jrcGPeRE5KLKF8IKj.', '4JQmDXW1la', '2025-02-17 17:23:11', '2025-02-17 17:23:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_access` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `module_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', '[\"purchase_management\"]', 1, NULL, '2025-11-27 00:50:20'),
(2, 'Employee', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallets`
--

DROP TABLE IF EXISTS `admin_wallets`;
CREATE TABLE IF NOT EXISTS `admin_wallets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint DEFAULT NULL,
  `inhouse_earning` double NOT NULL DEFAULT '0',
  `withdrawn` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission_earned` double(8,2) NOT NULL DEFAULT '0.00',
  `delivery_charge_earned` double(8,2) NOT NULL DEFAULT '0.00',
  `pending_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `total_tax_collected` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_wallets`
--

INSERT INTO `admin_wallets` (`id`, `admin_id`, `inhouse_earning`, `withdrawn`, `created_at`, `updated_at`, `commission_earned`, `delivery_charge_earned`, `pending_amount`, `total_tax_collected`) VALUES
(1, 1, 0, 0, NULL, NULL, 0.00, 0.00, 0.00, 0.00),
(2, 1, 0, 0, '2025-02-17 17:23:11', '2025-02-17 17:23:11', 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `admin_wallet_histories`
--

DROP TABLE IF EXISTS `admin_wallet_histories`;
CREATE TABLE IF NOT EXISTS `admin_wallet_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `order_id` bigint DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `analytic_scripts`
--

DROP TABLE IF EXISTS `analytic_scripts`;
CREATE TABLE IF NOT EXISTS `analytic_scripts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script_id` text COLLATE utf8mb4_unicode_ci,
  `script` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2025-11-24 04:03:35', '2025-11-24 04:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `published` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource_id` bigint DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `photo`, `banner_type`, `theme`, `published`, `created_at`, `updated_at`, `url`, `resource_type`, `resource_id`, `title`, `sub_title`, `button_text`, `background_color`) VALUES
(1, '2025-11-28-69294d4db2f10.webp', 'Main Banner', 'default', 1, '2025-11-28 01:20:45', '2025-11-28 01:21:05', 'https://abc.com', 'product', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing_addresses`
--

DROP TABLE IF EXISTS `billing_addresses`;
CREATE TABLE IF NOT EXISTS `billing_addresses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `contact_person_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'def.png',
  `image_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `image_alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

DROP TABLE IF EXISTS `business_settings`;
CREATE TABLE IF NOT EXISTS `business_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'system_default_currency', '2', '2020-10-11 07:43:44', '2025-12-15 17:08:08'),
(2, 'language', '[{\"id\":\"1\",\"name\":\"english\",\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true}]', '2020-10-11 07:53:02', '2025-12-15 17:08:08'),
(3, 'mail_config', '{\"status\":0,\"name\":\"demo\",\"host\":\"mail.demo.com\",\"driver\":\"SMTP\",\"port\":\"587\",\"username\":\"info@demo.com\",\"email_id\":\"info@demo.com\",\"encryption\":\"TLS\",\"password\":\"demo\"}', '2020-10-12 10:29:18', '2021-07-06 12:32:01'),
(4, 'cash_on_delivery', '{\"status\":\"1\"}', NULL, '2021-05-25 21:21:15'),
(6, 'ssl_commerz_payment', '{\"status\":\"0\",\"environment\":\"sandbox\",\"store_id\":\"\",\"store_password\":\"\"}', '2020-11-09 08:36:51', '2023-01-10 05:51:56'),
(10, 'company_phone', '000000000', NULL, '2025-12-15 17:08:08'),
(11, 'company_name', 'Shutar Shawpno', NULL, '2025-12-15 17:08:08'),
(12, 'company_web_logo', '{\"image_name\":\"2025-12-15-69404078de1fa.webp\",\"storage\":\"public\"}', NULL, '2025-12-15 17:08:08'),
(13, 'company_mobile_logo', '2021-02-20-6030c88c91911.png', NULL, '2021-02-20 14:30:04'),
(14, 'terms_condition', '\n        terms and conditions\n\n        ', NULL, '2021-06-11 01:51:36'),
(15, 'about_us', '\n        this is about us page. hello and hi from about page description..\n\n        ', NULL, '2021-06-11 01:42:53'),
(16, 'sms_nexmo', '{\"status\":\"0\",\"nexmo_key\":\"custo5cc042f7abf4c\",\"nexmo_secret\":\"custo5cc042f7abf4c@ssl\"}', NULL, NULL),
(17, 'company_email', 'Copy@ShutarShawpno.com', NULL, '2025-12-15 17:08:08'),
(18, 'colors', '{\"primary\":\"#bca473\",\"secondary\":\"#000000\",\"primary_light\":\"#CFDFFB\"}', '2020-10-11 13:53:02', '2025-12-15 17:08:08'),
(19, 'company_footer_logo', '{\"image_name\":\"2025-12-15-69403f8cbf0c3.webp\",\"storage\":\"public\"}', NULL, '2025-12-15 17:04:12'),
(20, 'company_copyright_text', 'CopyRight ShutarShawpno@2024', NULL, '2025-12-15 17:08:08'),
(21, 'download_app_apple_stroe', '{\"status\":0,\"link\":\"https:\\/\\/www.target.com\\/s\\/apple+store++now?ref=tgt_adv_XS000000&AFID=msn&fndsrc=tgtao&DFA=71700000012505188&CPNG=Electronics_Portable+Computers&adgroup=Portable+Computers&LID=700000001176246&LNM=apple+store+near+me+now&MT=b&network=s&device=c&location=12&targetid=kwd-81913773633608:loc-12&ds_rl=1246978&ds_rl=1248099&gclsrc=ds\"}', NULL, '2025-12-15 17:08:08'),
(22, 'download_app_google_stroe', '{\"status\":0,\"link\":\"https:\\/\\/play.google.com\\/store?hl=en_US&gl=US\"}', NULL, '2025-12-15 17:08:08'),
(23, 'company_fav_icon', '2021-03-02-603df1634614f.png', '2020-10-11 13:53:02', '2021-03-02 14:03:48'),
(24, 'fcm_topic', '0', NULL, NULL),
(25, 'fcm_project_id', '0', NULL, NULL),
(26, 'push_notification_key', 'Put your firebase server key here.', NULL, NULL),
(27, 'order_pending_message', '{\"status\":\"1\",\"message\":\"order pen message\"}', NULL, NULL),
(28, 'order_confirmation_msg', '{\"status\":\"1\",\"message\":\"Order con Message\"}', NULL, NULL),
(29, 'order_processing_message', '{\"status\":\"1\",\"message\":\"Order pro Message\"}', NULL, NULL),
(30, 'out_for_delivery_message', '{\"status\":\"1\",\"message\":\"Order ouut Message\"}', NULL, NULL),
(31, 'order_delivered_message', '{\"status\":\"1\",\"message\":\"Order del Message\"}', NULL, NULL),
(33, 'sales_commission', '0', NULL, '2021-06-11 18:13:13'),
(34, 'seller_registration', '1', NULL, '2021-06-04 21:02:48'),
(35, 'pnc_language', '[\"en\"]', NULL, NULL),
(36, 'order_returned_message', '{\"status\":\"1\",\"message\":\"Order hh Message\"}', NULL, NULL),
(37, 'order_failed_message', '{\"status\":null,\"message\":\"Order fa Message\"}', NULL, NULL),
(40, 'delivery_boy_assign_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(41, 'delivery_boy_start_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(42, 'delivery_boy_delivered_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(43, 'terms_and_conditions', 'my terms and conditions', NULL, NULL),
(44, 'minimum_order_value', '1', NULL, NULL),
(45, 'privacy_policy', 'my privacy policy', NULL, '2021-07-06 11:09:07'),
(48, 'currency_model', 'single_currency', NULL, NULL),
(49, 'social_login', '[{\"login_medium\":\"google\",\"client_id\":\"\",\"client_secret\":\"\",\"status\":1},{\"login_medium\":\"facebook\",\"client_id\":\"\",\"client_secret\":\"\",\"status\":1}]', NULL, '2024-10-27 08:14:24'),
(50, 'digital_payment', '{\"status\":\"1\"}', NULL, NULL),
(51, 'phone_verification', '', NULL, '2025-12-15 17:08:08'),
(52, 'email_verification', '', NULL, '2025-12-15 17:08:08'),
(53, 'order_verification', '0', NULL, '2025-02-19 11:28:31'),
(54, 'country_code', 'AF', NULL, '2025-12-15 17:08:08'),
(55, 'pagination_limit', '10', NULL, '2025-12-15 17:08:08'),
(56, 'shipping_method', 'inhouse_shipping', NULL, NULL),
(59, 'forgot_password_verification', 'email', NULL, NULL),
(61, 'stock_limit', '10', NULL, '2025-12-15 17:28:36'),
(64, 'announcement', '{\"status\":null,\"color\":null,\"text_color\":null,\"announcement\":null}', NULL, NULL),
(65, 'fawry_pay', '{\"status\":0,\"merchant_code\":\"\",\"security_key\":\"\"}', NULL, '2022-01-18 09:46:30'),
(66, 'recaptcha', '{\"status\":0,\"site_key\":\"\",\"secret_key\":\"\"}', NULL, '2022-01-18 09:46:30'),
(67, 'seller_pos', '0', NULL, NULL),
(70, 'refund_day_limit', '0', NULL, '2025-02-19 11:28:31'),
(71, 'business_mode', '', NULL, '2025-12-15 17:08:08'),
(72, 'mail_config_sendgrid', '{\"status\":0,\"name\":\"\",\"host\":\"\",\"driver\":\"\",\"port\":\"\",\"username\":\"\",\"email_id\":\"\",\"encryption\":\"\",\"password\":\"\"}', NULL, NULL),
(73, 'decimal_point_settings', '2', NULL, '2025-12-15 17:08:08'),
(74, 'shop_address', 'vvbv', NULL, '2025-12-15 17:08:08'),
(75, 'billing_input_by_customer', '1', NULL, '2025-02-19 11:28:30'),
(76, 'wallet_status', '0', NULL, NULL),
(77, 'loyalty_point_status', '0', NULL, NULL),
(78, 'wallet_add_refund', '0', NULL, NULL),
(79, 'loyalty_point_exchange_rate', '0', NULL, NULL),
(80, 'loyalty_point_item_purchase_point', '0', NULL, NULL),
(81, 'loyalty_point_minimum_point', '0', NULL, NULL),
(82, 'minimum_order_limit', '1', NULL, NULL),
(83, 'product_brand', '0', NULL, '2025-12-15 17:28:36'),
(84, 'digital_product', '1', NULL, '2025-12-15 17:28:36'),
(85, 'delivery_boy_expected_delivery_date_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(86, 'order_canceled', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(87, 'refund-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 06:25:36'),
(88, 'return-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 06:25:36'),
(89, 'cancellation-policy', '{\"status\":1,\"content\":\"\"}', NULL, '2023-03-04 06:25:36'),
(90, 'offline_payment', '{\"status\":0}', NULL, '2023-03-04 06:25:36'),
(91, 'temporary_close', '{\"status\":0}', NULL, '2025-02-19 11:36:41'),
(92, 'vacation_add', '{\"status\":0,\"vacation_start_date\":null,\"vacation_end_date\":null,\"vacation_note\":null}', NULL, '2023-03-04 06:25:36'),
(93, 'cookie_setting', '{\"status\":0,\"cookie_text\":null}', NULL, '2023-03-04 06:25:36'),
(94, 'maximum_otp_hit', '0', NULL, '2023-06-13 13:04:49'),
(95, 'otp_resend_time', '0', NULL, '2023-06-13 13:04:49'),
(96, 'temporary_block_time', '0', NULL, '2023-06-13 13:04:49'),
(97, 'maximum_login_hit', '0', NULL, '2023-06-13 13:04:49'),
(98, 'temporary_login_block_time', '0', NULL, '2023-06-13 13:04:49'),
(104, 'apple_login', '[{\"login_medium\":\"apple\",\"client_id\":\"\",\"client_secret\":\"\",\"status\":1,\"team_id\":\"\",\"key_id\":\"\",\"service_file\":\"\",\"redirect_url\":\"\"}]', NULL, '2024-10-27 08:14:24'),
(105, 'ref_earning_status', '0', NULL, '2023-10-13 05:34:53'),
(106, 'ref_earning_exchange_rate', '0', NULL, '2023-10-13 05:34:53'),
(107, 'guest_checkout', '0', NULL, '2025-02-19 11:28:31'),
(108, 'minimum_order_amount', '0', NULL, '2025-02-19 11:36:09'),
(109, 'minimum_order_amount_by_seller', '0', NULL, '2023-10-13 11:34:53'),
(110, 'minimum_order_amount_status', '0', NULL, '2025-02-19 11:28:30'),
(111, 'admin_login_url', 'admin', NULL, '2023-10-13 11:34:53'),
(112, 'employee_login_url', 'employee', NULL, '2023-10-13 11:34:53'),
(113, 'free_delivery_status', '0', NULL, '2025-02-19 11:28:31'),
(114, 'free_delivery_responsibility', 'admin', NULL, '2025-02-19 11:28:31'),
(115, 'free_delivery_over_amount', '0', NULL, '2025-02-19 11:36:09'),
(116, 'free_delivery_over_amount_seller', '0', NULL, '2025-02-19 11:28:31'),
(117, 'add_funds_to_wallet', '0', NULL, '2023-10-13 11:34:53'),
(118, 'minimum_add_fund_amount', '0', NULL, '2023-10-13 11:34:53'),
(119, 'maximum_add_fund_amount', '0', NULL, '2023-10-13 11:34:53'),
(120, 'user_app_version_control', '{\"for_android\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"},\"for_ios\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"}}', NULL, '2023-10-13 11:34:53'),
(121, 'seller_app_version_control', '{\"for_android\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"},\"for_ios\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"}}', NULL, '2023-10-13 11:34:53'),
(122, 'delivery_man_app_version_control', '{\"for_android\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"},\"for_ios\":{\"status\":1,\"version\":\"14.1\",\"link\":\"\"}}', NULL, '2023-10-13 11:34:53'),
(123, 'whatsapp', '{\"status\":1,\"phone\":\"00000000000\"}', NULL, '2023-10-13 11:34:53'),
(124, 'currency_symbol_position', 'left', NULL, '2025-12-15 17:08:08'),
(148, 'company_reliability', '[{\"item\":\"delivery_info\",\"title\":\"Fast Delivery all across the country\",\"image\":\"\",\"status\":1},{\"item\":\"safe_payment\",\"title\":\"Safe Payment\",\"image\":\"\",\"status\":1},{\"item\":\"return_policy\",\"title\":\"7 Days Return Policy\",\"image\":\"\",\"status\":1},{\"item\":\"authentic_product\",\"title\":\"100% Authentic Products\",\"image\":\"\",\"status\":1}]', NULL, NULL),
(149, 'react_setup', '{\"status\":0,\"react_license_code\":\"\",\"react_domain\":\"\",\"react_platform\":\"\"}', NULL, '2024-01-09 04:05:15'),
(150, 'app_activation', '{\"software_id\":\"\",\"is_active\":0}', NULL, '2024-01-09 04:05:15'),
(151, 'shop_banner', '{\"image_name\":\"2025-12-15-6940471caa871.webp\",\"storage\":\"public\"}', NULL, '2025-12-15 17:36:28'),
(152, 'map_api_status', '1', NULL, '2024-03-27 03:12:32'),
(153, 'vendor_registration_header', '{\"title\":\"Vendor Registration\",\"sub_title\":\"Create your own store.Already have store?\",\"image\":\"\"}', NULL, NULL),
(154, 'vendor_registration_sell_with_us', '{\"title\":\"Why Sell With Us\",\"sub_title\":\"Boost your sales! Join us for a seamless, profitable experience with vast buyer reach and top-notch support. Sell smarter today!\",\"image\":\"\"}', NULL, NULL),
(155, 'download_vendor_app', '{\"title\":\"Download Free Vendor App\",\"sub_title\":\"Download our free seller app and start reaching millions of buyers on the go! Easy setup, manage listings, and boost sales anywhere.\",\"image\":null,\"download_google_app\":null,\"download_google_app_status\":0,\"download_apple_app\":null,\"download_apple_app_status\":0}', NULL, NULL),
(156, 'business_process_main_section', '{\"title\":\"3 Easy Steps To Start Selling\",\"sub_title\":\"Start selling quickly! Register, upload your products with detailed info and images, and reach millions of buyers instantly.\",\"image\":\"\"}', NULL, NULL),
(157, 'business_process_step', '[{\"title\":\"Get Registered\",\"description\":\"Sign up easily and create your seller account in just a few minutes. It fast and simple to get started.\",\"image\":\"\"},{\"title\":\"Upload Products\",\"description\":\"List your products with detailed descriptions and high-quality images to attract more buyers effortlessly.\",\"image\":\"\"},{\"title\":\"Start Selling\",\"description\":\"Go live and start reaching millions of potential buyers immediately. Watch your sales grow with our vast audience.\",\"image\":\"\"}]', NULL, NULL),
(158, 'brand_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(159, 'category_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(160, 'vendor_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(161, 'flash_deal_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(162, 'featured_product_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(163, 'feature_deal_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(164, 'new_arrival_product_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(165, 'top_vendor_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(166, 'category_wise_product_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(167, 'top_rated_product_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(168, 'best_selling_product_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(169, 'searched_product_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(170, 'vendor_product_list_priority', '0', '2024-05-18 10:57:03', '2024-05-18 10:57:03'),
(171, 'storage_connection_type', 'public', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(172, 'google_search_console_code', '0', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(173, 'bing_webmaster_code', '0', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(174, 'baidu_webmaster_code', '0', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(175, 'yandex_webmaster_code', '0', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(176, 'firebase_otp_verification', '{\"status\":0,\"web_api_key\":\"\"}', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(177, 'maintenance_system_setup', '{\"user_app\":0,\"user_website\":0,\"vendor_app\":0,\"deliveryman_app\":0,\"vendor_panel\":0}', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(178, 'maintenance_duration_setup', '{\"maintenance_duration\":\"until_change\",\"start_date\":null,\"end_date\":null}', NULL, NULL),
(179, 'maintenance_message_setup', '{\"business_number\":1,\"business_email\":1,\"maintenance_message\":\"We are Working On Something Special\",\"message_body\":\"We apologize for any inconvenience. For immediate assistance, please contact with our support team\"}', NULL, NULL),
(180, 'shipping-policy', '{\"status\":0,\"content\":\"\"}', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(181, 'vendor_forgot_password_method', 'phone', '2024-10-27 08:14:24', '2024-10-27 08:14:24'),
(182, 'deliveryman_forgot_password_method', 'phone', '2024-10-27 08:14:24', '2024-10-27 08:14:24'),
(183, 'timezone', 'UTC', NULL, '2025-12-15 17:08:08'),
(184, 'default_location', '{\"lat\":\"-33.8688\",\"lng\":\"151.2195\"}', NULL, '2025-12-15 17:08:08'),
(185, 'invoice_settings', '{\"terms_and_condition\":null,\"business_identity\":null,\"business_identity_value\":null,\"image\":{\"image_name\":\"2025-11-28-692953f5a1498.webp\",\"storage\":\"public\"}}', NULL, '2025-11-28 01:49:09'),
(186, 'web_theme', 'default', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint DEFAULT NULL,
  `cart_group_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `product_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'physical',
  `digital_product_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choices` text COLLATE utf8mb4_unicode_ci,
  `variations` text COLLATE utf8mb4_unicode_ci,
  `variant` text COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL DEFAULT '1',
  `price` double NOT NULL DEFAULT '1',
  `tax` double NOT NULL DEFAULT '1',
  `discount` double NOT NULL DEFAULT '1',
  `tax_model` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclude',
  `is_checked` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_id` bigint DEFAULT NULL,
  `seller_is` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` double(8,2) DEFAULT NULL,
  `shipping_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_shippings`
--

DROP TABLE IF EXISTS `cart_shippings`;
CREATE TABLE IF NOT EXISTS `cart_shippings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `cart_group_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method_id` bigint DEFAULT NULL,
  `shipping_cost` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `parent_id` int NOT NULL,
  `position` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `icon_storage_type`, `parent_id`, `position`, `created_at`, `updated_at`, `home_status`, `priority`) VALUES
(1, 'Jamdani Saree', 'jamdani-saree', '2025-12-17-6942d0f57a274.webp', 'public', 0, 0, '2025-12-15 17:09:37', '2025-12-17 15:49:09', 0, 0),
(2, 'Banarasi Saree', 'banarasi-saree', '2025-12-17-6942d0e31019f.webp', 'public', 0, 0, '2025-12-15 17:10:03', '2025-12-17 15:48:51', 0, 1),
(3, 'Cotton Saree', 'cotton-saree', '2025-12-17-6942d0da85b67.webp', 'public', 0, 0, '2025-12-15 17:11:03', '2025-12-17 15:48:42', 0, 2),
(4, 'Party Saree', 'party-saree', '2025-12-17-6942d0cf68abd.webp', 'public', 0, 0, '2025-12-15 17:11:46', '2025-12-17 15:48:31', 0, 3),
(5, 'Batik Saree', 'batik-saree', '2025-12-17-6942d0bf6a1cb.webp', 'public', 0, 0, '2025-12-15 17:12:23', '2025-12-17 15:48:15', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category_shipping_costs`
--

DROP TABLE IF EXISTS `category_shipping_costs`;
CREATE TABLE IF NOT EXISTS `category_shipping_costs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` int UNSIGNED DEFAULT NULL,
  `cost` double(8,2) DEFAULT NULL,
  `multiply_qty` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_shipping_costs`
--

INSERT INTO `category_shipping_costs` (`id`, `seller_id`, `category_id`, `cost`, `multiply_qty`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 0.00, NULL, '2025-12-17 15:51:34', '2025-12-17 15:51:34'),
(2, 0, 2, 0.00, NULL, '2025-12-17 15:51:34', '2025-12-17 15:51:34'),
(3, 0, 3, 0.00, NULL, '2025-12-17 15:51:34', '2025-12-17 15:51:34'),
(4, 0, 4, 0.00, NULL, '2025-12-17 15:51:34', '2025-12-17 15:51:34'),
(5, 0, 5, 0.00, NULL, '2025-12-17 15:51:34', '2025-12-17 15:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `chattings`
--

DROP TABLE IF EXISTS `chattings`;
CREATE TABLE IF NOT EXISTS `chattings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `seller_id` bigint DEFAULT NULL,
  `admin_id` bigint DEFAULT NULL,
  `delivery_man_id` bigint DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `attachment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `sent_by_customer` tinyint(1) NOT NULL DEFAULT '0',
  `sent_by_seller` tinyint(1) NOT NULL DEFAULT '0',
  `sent_by_admin` tinyint(1) DEFAULT NULL,
  `sent_by_delivery_man` tinyint(1) DEFAULT NULL,
  `seen_by_customer` tinyint(1) NOT NULL DEFAULT '1',
  `seen_by_seller` tinyint(1) NOT NULL DEFAULT '1',
  `seen_by_admin` tinyint(1) DEFAULT NULL,
  `seen_by_delivery_man` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `notification_receiver` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'admin, seller, customer, deliveryman',
  `seen_notification` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'IndianRed', '#CD5C5C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(2, 'LightCoral', '#F08080', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(3, 'Salmon', '#FA8072', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(4, 'DarkSalmon', '#E9967A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(5, 'LightSalmon', '#FFA07A', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(6, 'Crimson', '#DC143C', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(7, 'Red', '#FF0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(8, 'FireBrick', '#B22222', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(9, 'DarkRed', '#8B0000', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(10, 'Pink', '#FFC0CB', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(11, 'LightPink', '#FFB6C1', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(12, 'HotPink', '#FF69B4', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(13, 'DeepPink', '#FF1493', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(14, 'MediumVioletRed', '#C71585', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(15, 'PaleVioletRed', '#DB7093', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(17, 'Coral', '#FF7F50', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(18, 'Tomato', '#FF6347', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(19, 'OrangeRed', '#FF4500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(20, 'DarkOrange', '#FF8C00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(21, 'Orange', '#FFA500', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(22, 'Gold', '#FFD700', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(23, 'Yellow', '#FFFF00', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(24, 'LightYellow', '#FFFFE0', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(25, 'LemonChiffon', '#FFFACD', '2018-11-05 02:12:26', '2018-11-05 02:12:26'),
(26, 'LightGoldenrodYellow', '#FAFAD2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(27, 'PapayaWhip', '#FFEFD5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(28, 'Moccasin', '#FFE4B5', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(29, 'PeachPuff', '#FFDAB9', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(30, 'PaleGoldenrod', '#EEE8AA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(31, 'Khaki', '#F0E68C', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(32, 'DarkKhaki', '#BDB76B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(33, 'Lavender', '#E6E6FA', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(34, 'Thistle', '#D8BFD8', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(35, 'Plum', '#DDA0DD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(36, 'Violet', '#EE82EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(37, 'Orchid', '#DA70D6', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(39, 'Magenta', '#FF00FF', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(40, 'MediumOrchid', '#BA55D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(41, 'MediumPurple', '#9370DB', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(42, 'Amethyst', '#9966CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(43, 'BlueViolet', '#8A2BE2', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(44, 'DarkViolet', '#9400D3', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(45, 'DarkOrchid', '#9932CC', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(46, 'DarkMagenta', '#8B008B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(47, 'Purple', '#800080', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(48, 'Indigo', '#4B0082', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(49, 'SlateBlue', '#6A5ACD', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(50, 'DarkSlateBlue', '#483D8B', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(51, 'MediumSlateBlue', '#7B68EE', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(52, 'GreenYellow', '#ADFF2F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(53, 'Chartreuse', '#7FFF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(54, 'LawnGreen', '#7CFC00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(55, 'Lime', '#00FF00', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(56, 'LimeGreen', '#32CD32', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(57, 'PaleGreen', '#98FB98', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(58, 'LightGreen', '#90EE90', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(59, 'MediumSpringGreen', '#00FA9A', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(60, 'SpringGreen', '#00FF7F', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(61, 'MediumSeaGreen', '#3CB371', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(62, 'SeaGreen', '#2E8B57', '2018-11-05 02:12:27', '2018-11-05 02:12:27'),
(63, 'ForestGreen', '#228B22', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(64, 'Green', '#008000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(65, 'DarkGreen', '#006400', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(66, 'YellowGreen', '#9ACD32', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(67, 'OliveDrab', '#6B8E23', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(68, 'Olive', '#808000', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(69, 'DarkOliveGreen', '#556B2F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(70, 'MediumAquamarine', '#66CDAA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(71, 'DarkSeaGreen', '#8FBC8F', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(72, 'LightSeaGreen', '#20B2AA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(73, 'DarkCyan', '#008B8B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(74, 'Teal', '#008080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(75, 'Aqua', '#00FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(77, 'LightCyan', '#E0FFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(78, 'PaleTurquoise', '#AFEEEE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(79, 'Aquamarine', '#7FFFD4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(80, 'Turquoise', '#40E0D0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(81, 'MediumTurquoise', '#48D1CC', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(82, 'DarkTurquoise', '#00CED1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(83, 'CadetBlue', '#5F9EA0', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(84, 'SteelBlue', '#4682B4', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(85, 'LightSteelBlue', '#B0C4DE', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(86, 'PowderBlue', '#B0E0E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(87, 'LightBlue', '#ADD8E6', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(88, 'SkyBlue', '#87CEEB', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(89, 'LightSkyBlue', '#87CEFA', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(90, 'DeepSkyBlue', '#00BFFF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(91, 'DodgerBlue', '#1E90FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(92, 'CornflowerBlue', '#6495ED', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(94, 'RoyalBlue', '#4169E1', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(95, 'Blue', '#0000FF', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(96, 'MediumBlue', '#0000CD', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(97, 'DarkBlue', '#00008B', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(98, 'Navy', '#000080', '2018-11-05 02:12:28', '2018-11-05 02:12:28'),
(99, 'MidnightBlue', '#191970', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(100, 'Cornsilk', '#FFF8DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(101, 'BlanchedAlmond', '#FFEBCD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(102, 'Bisque', '#FFE4C4', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(103, 'NavajoWhite', '#FFDEAD', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(104, 'Wheat', '#F5DEB3', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(105, 'BurlyWood', '#DEB887', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(106, 'Tan', '#D2B48C', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(107, 'RosyBrown', '#BC8F8F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(108, 'SandyBrown', '#F4A460', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(109, 'Goldenrod', '#DAA520', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(110, 'DarkGoldenrod', '#B8860B', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(111, 'Peru', '#CD853F', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(112, 'Chocolate', '#D2691E', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(113, 'SaddleBrown', '#8B4513', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(114, 'Sienna', '#A0522D', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(115, 'Brown', '#A52A2A', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(116, 'Maroon', '#800000', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(117, 'White', '#FFFFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(118, 'Snow', '#FFFAFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(119, 'Honeydew', '#F0FFF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(120, 'MintCream', '#F5FFFA', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(121, 'Azure', '#F0FFFF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(122, 'AliceBlue', '#F0F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(123, 'GhostWhite', '#F8F8FF', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(124, 'WhiteSmoke', '#F5F5F5', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(125, 'Seashell', '#FFF5EE', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(126, 'Beige', '#F5F5DC', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(127, 'OldLace', '#FDF5E6', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(128, 'FloralWhite', '#FFFAF0', '2018-11-05 02:12:29', '2018-11-05 02:12:29'),
(129, 'Ivory', '#FFFFF0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(130, 'AntiqueWhite', '#FAEBD7', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(131, 'Linen', '#FAF0E6', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(132, 'LavenderBlush', '#FFF0F5', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(133, 'MistyRose', '#FFE4E1', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(134, 'Gainsboro', '#DCDCDC', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(135, 'LightGrey', '#D3D3D3', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(136, 'Silver', '#C0C0C0', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(137, 'DarkGray', '#A9A9A9', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(138, 'Gray', '#808080', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(139, 'DimGray', '#696969', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(140, 'LightSlateGray', '#778899', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(141, 'SlateGray', '#708090', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(142, 'DarkSlateGray', '#2F4F4F', '2018-11-05 02:12:30', '2018-11-05 02:12:30'),
(143, 'Black', '#000000', '2018-11-05 02:12:30', '2018-11-05 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `feedback` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reply` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `coupon_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_bearer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inhouse',
  `seller_id` bigint DEFAULT NULL COMMENT 'NULL=in-house, 0=all seller',
  `customer_id` bigint DEFAULT NULL COMMENT '0 = all customer',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `min_purchase` decimal(8,2) NOT NULL DEFAULT '0.00',
  `max_discount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `limit` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `code`, `exchange_rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 'USD', '1', 1, NULL, '2021-06-27 13:39:37'),
(2, 'BDT', '৳', 'BDT', '84', 1, NULL, '2021-07-06 11:52:58'),
(3, 'Indian Rupi', '₹', 'INR', '60', 1, '2020-10-15 17:23:04', '2021-06-04 18:26:38'),
(4, 'Euro', '€', 'EUR', '100', 1, '2021-05-25 21:00:23', '2021-06-04 18:25:29'),
(5, 'YEN', '¥', 'JPY', '110', 1, '2021-06-10 22:08:31', '2021-06-26 14:21:10'),
(6, 'Ringgit', 'RM', 'MYR', '4.16', 1, '2021-07-03 11:08:33', '2021-07-03 11:10:37'),
(7, 'Rand', 'R', 'ZAR', '14.26', 1, '2021-07-03 11:12:38', '2021-07-03 11:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `customer_wallets`
--

DROP TABLE IF EXISTS `customer_wallets`;
CREATE TABLE IF NOT EXISTS `customer_wallets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint DEFAULT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `royality_points` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_wallet_histories`
--

DROP TABLE IF EXISTS `customer_wallet_histories`;
CREATE TABLE IF NOT EXISTS `customer_wallet_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint DEFAULT NULL,
  `transaction_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `transaction_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_method` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deal_of_the_days`
--

DROP TABLE IF EXISTS `deal_of_the_days`;
CREATE TABLE IF NOT EXISTS `deal_of_the_days` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_type` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'amount',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_notifications`
--

DROP TABLE IF EXISTS `deliveryman_notifications`;
CREATE TABLE IF NOT EXISTS `deliveryman_notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_man_id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryman_wallets`
--

DROP TABLE IF EXISTS `deliveryman_wallets`;
CREATE TABLE IF NOT EXISTS `deliveryman_wallets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_man_id` bigint NOT NULL,
  `current_balance` decimal(50,2) NOT NULL DEFAULT '0.00',
  `cash_in_hand` decimal(50,2) NOT NULL DEFAULT '0.00',
  `pending_withdraw` decimal(50,2) NOT NULL DEFAULT '0.00',
  `total_withdraw` decimal(50,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_country_codes`
--

DROP TABLE IF EXISTS `delivery_country_codes`;
CREATE TABLE IF NOT EXISTS `delivery_country_codes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_histories`
--

DROP TABLE IF EXISTS `delivery_histories`;
CREATE TABLE IF NOT EXISTS `delivery_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint DEFAULT NULL,
  `deliveryman_id` bigint DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_man_transactions`
--

DROP TABLE IF EXISTS `delivery_man_transactions`;
CREATE TABLE IF NOT EXISTS `delivery_man_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `delivery_man_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` decimal(50,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(50,2) NOT NULL DEFAULT '0.00',
  `transaction_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_men`
--

DROP TABLE IF EXISTS `delivery_men`;
CREATE TABLE IF NOT EXISTS `delivery_men` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint DEFAULT NULL,
  `f_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `country_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_online` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6yIRXJRRfp78qJsAoKZZ6TTqhzuNJ3TcdvPBmk6n',
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_men`
--

INSERT INTO `delivery_men` (`id`, `seller_id`, `f_name`, `l_name`, `address`, `country_code`, `phone`, `email`, `identity_number`, `identity_type`, `identity_image`, `image`, `password`, `bank_name`, `branch`, `account_no`, `holder_name`, `is_active`, `is_online`, `created_at`, `updated_at`, `auth_token`, `fcm_token`, `app_language`) VALUES
(1, 0, 'Maggy Barrett', 'Hadassah Heath', 'Ut non obcaecati nul', '+677', '+1 (995) 382-9383', 'torifojula@mailinator.com', '329', 'company_id', '[{\"image_name\":\"2025-09-17-68cae00d02c3c.webp\",\"storage\":\"public\"}]', '2025-09-17-68cae00d2e6ad.webp', '$2y$10$q5TlCknOJhaNdAKdwzL62.cqt0rqg/zK1eU.nryJrILlPEx4jGEDC', NULL, NULL, NULL, NULL, 1, 1, '2025-09-17 10:21:33', '2025-09-17 10:21:33', '6yIRXJRRfp78qJsAoKZZ6TTqhzuNJ3TcdvPBmk6n', NULL, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zip_codes`
--

DROP TABLE IF EXISTS `delivery_zip_codes`;
CREATE TABLE IF NOT EXISTS `delivery_zip_codes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_product_authors`
--

DROP TABLE IF EXISTS `digital_product_authors`;
CREATE TABLE IF NOT EXISTS `digital_product_authors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_product_otp_verifications`
--

DROP TABLE IF EXISTS `digital_product_otp_verifications`;
CREATE TABLE IF NOT EXISTS `digital_product_otp_verifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_details_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_hit_count` tinyint NOT NULL DEFAULT '0',
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_product_publishing_houses`
--

DROP TABLE IF EXISTS `digital_product_publishing_houses`;
CREATE TABLE IF NOT EXISTS `digital_product_publishing_houses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `publishing_house_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `digital_product_variations`
--

DROP TABLE IF EXISTS `digital_product_variations`;
CREATE TABLE IF NOT EXISTS `digital_product_variations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `variant_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(24,8) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `template_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_design_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `banner_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `social_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `hide_field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `button_content_status` tinyint NOT NULL DEFAULT '1',
  `product_information_status` tinyint NOT NULL DEFAULT '1',
  `order_information_status` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_name`, `user_type`, `template_design_name`, `title`, `body`, `banner_image`, `image`, `logo`, `button_name`, `button_url`, `footer_text`, `copyright_text`, `pages`, `social_media`, `hide_field`, `button_content_status`, `product_information_status`, `order_information_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'order-received', 'admin', 'order-received', 'New Order Received', '<p><b>Hi {adminName},</b></p><p>We have sent you this email to notify that you have a new order.You will be able to see your orders after login to your panel.</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"icon\", \"product_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(2, 'order-place', 'customer', 'order-place', 'Order # {orderId} Has Been Placed Successfully!', '<p><b>Hi {userName},</b></p><p>Your order from {shopName} has been placed to know the current status of your order click track order</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"icon\", \"product_information\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(3, 'registration-verification', 'customer', 'registration-verification', 'Registration Verification', '<p><b>Hi {userName},</b></p><p>Your verification code is</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(4, 'registration-from-pos', 'customer', 'registration-from-pos', 'Registration Complete', '<p><b>Hi {userName},</b></p><p>Thank you for joining  Shop.If you want to become a registered customer then reset your password below by using this email. Then you’ll be able to explore the website and app as a registered customer.</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_url\", \"button_content_status\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(5, 'account-block', 'customer', 'account-block', 'Account Blocked', '<div><b>Hi {userName},</b></div><div><b><br></b></div><div>Your account has been blocked due to suspicious activity by the admin .To resolve this issue please contact with admin or support center. We apologize for any inconvenience caused.</div><div><br></div><div>Meanwhile, click here to visit theshop website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(6, 'account-unblock', 'customer', 'account-unblock', 'Account Unblocked', '<div><b>Hi {userName},</b></div><div><b><br></b></div><div>Your account has been successfully unblocked. We appreciate your cooperation in resolving this issue. Thank you for your understanding and patience. </div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(7, 'digital-product-download', 'customer', 'digital-product-download', 'Congratulations', '<p>Thank you for choosing  shop! Your digital product is ready for download. To download your product use your email <b>{emailId}</b> and order # {orderId} below.</b><br></p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(8, 'digital-product-otp', 'customer', 'digital-product-otp', 'Digital Product Download OTP Verification', '<p><b>Hi {userName},</b></p><p>Your verification code is</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:11', '2025-02-17 17:23:11'),
(9, 'add-fund-to-wallet', 'customer', 'add-fund-to-wallet', 'Transaction Successful', '<div style=\\\"text-align: center; \\\">Amount successfully credited to your wallet .</div><div style=\\\"text-align: center; \\\"><br></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(10, 'registration', 'vendor', 'registration', 'Registration Complete', '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Congratulation! Your registration request has been send to admin successfully! Please wait until admin reviewal. </div><div><br></div><div>meanwhile click here to visit the  Shop Website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(11, 'registration-approved', 'vendor', 'registration-approved', 'Registration Approved', '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your registration request has been approved by admin. Now you can complete your store setting and start selling your product on  Shop. </div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(12, 'registration-denied', 'vendor', 'registration-denied', 'Registration Denied', '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your registration request has been denied by admin. Please contact with admin or support center if you have any queries.</div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(13, 'account-suspended', 'vendor', 'account-suspended', 'Account Suspended', '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your account access has been suspended by admin.From now you can access your app and panel again Please contact us for any queries we’re always happy to help.</div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(14, 'account-activation', 'vendor', 'account-activation', 'Account Activation', '<div><b>Hi {vendorName},</b></div><div><b><br></b></div><div>Your account suspension has been revoked by admin. From now you can access your app and panel again Please contact us for any queries we’re always happy to help.</div><div><br></div><div>Meanwhile, click here to visit the shop website</div><div><font color=\\\"#0000ff\\\"> <a href=\\\"https://dokankholo.com\\\" target=\\\"_blank\\\">https://dokankholo.com</a></font></div>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(15, 'forgot-password', 'vendor', 'forgot-password', 'Change Password Request', '<p><b>Hi {vendorName},</b></p><p>Please click the link below to change your password.</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(16, 'order-received', 'vendor', 'order-received', 'New Order Received', '<p><b>Hi {vendorName},</b></p><p>We have sent you this email to notify that you have a new order.You will be able to see your orders after login to your panel.</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"icon\", \"product_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12'),
(17, 'reset-password-verification', 'delivery-man', 'reset-password-verification', 'OTP Verification For Password Reset', '<p><b>Hi {deliveryManName},</b></p><p>Your verification code is</p>', '', '', '', '', '', 'Please contact us for any queries, we are always happy to help.', 'Copyright 2025 . All right reserved.', NULL, NULL, '[\"product_information\", \"order_information\", \"button_content\", \"banner_image\"]', 1, 1, 1, 1, '2025-02-17 17:23:12', '2025-02-17 17:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

DROP TABLE IF EXISTS `emergency_contacts`;
CREATE TABLE IF NOT EXISTS `emergency_contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

DROP TABLE IF EXISTS `error_logs`;
CREATE TABLE IF NOT EXISTS `error_logs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_code` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hit_counts` int NOT NULL DEFAULT '0',
  `redirect_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `error_logs`
--

INSERT INTO `error_logs` (`id`, `status_code`, `url`, `hit_counts`, `redirect_url`, `redirect_status`, `created_at`, `updated_at`) VALUES
(90, 404, 'https://beta.shutarshawpno.com/themes/default/public/addon/default-theme.png', 1, NULL, NULL, '2025-12-15 17:45:06', '2025-12-15 17:45:06'),
(91, 404, 'https://beta.shutarshawpno.com/js/lightbox.min.map', 3, NULL, NULL, '2025-12-15 17:45:17', '2025-12-15 18:56:28'),
(92, 404, 'https://beta.shutarshawpno.com/sm/f07d8d7b2652873f485707eab4f3d300bf1f6f3b42912e189c8933b1b9b3dfde.map', 2, NULL, NULL, '2025-12-15 17:45:17', '2025-12-15 17:50:00'),
(93, 404, 'https://beta.shutarshawpno.com/assets/back-end/js/bootstrap.bundle.min.js.map', 2, NULL, NULL, '2025-12-15 17:45:17', '2025-12-15 17:50:00'),
(94, 404, 'https://beta.shutarshawpno.com/assets/back-end/js/toastr.js.map', 3, NULL, NULL, '2025-12-15 17:45:17', '2025-12-15 18:58:00'),
(95, 404, 'https://beta.shutarshawpno.com/assets/back-end/css/style.css.map', 2, NULL, NULL, '2025-12-15 17:45:17', '2025-12-15 17:50:00'),
(96, 404, 'https://beta.shutarshawpno.com/assets/back-end/img/system-setup.png', 1, NULL, NULL, '2025-12-15 17:45:25', '2025-12-15 17:45:25'),
(97, 404, 'https://beta.shutarshawpno.com/_next', 2, NULL, NULL, '2025-12-15 17:54:34', '2025-12-15 17:54:39'),
(98, 404, 'https://beta.shutarshawpno.com/css/support_parent.css', 1, NULL, NULL, '2025-12-15 18:55:07', '2025-12-15 18:55:07'),
(99, 404, 'https://beta.shutarshawpno.com/js/lkk_ch.js', 1, NULL, NULL, '2025-12-15 18:55:33', '2025-12-15 18:55:33'),
(100, 404, 'https://beta.shutarshawpno.com/js/twint_ch.js', 1, NULL, NULL, '2025-12-15 18:55:41', '2025-12-15 18:55:41'),
(101, 404, 'https://beta.shutarshawpno.com/assets/front-end/js/\'%20+%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20n.src%20+%20%20%20%', 1, NULL, NULL, '2025-12-15 18:57:59', '2025-12-15 18:57:59'),
(102, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/firebase/firebase.js.map', 1, NULL, NULL, '2025-12-15 18:59:09', '2025-12-15 18:59:09'),
(103, 404, 'https://beta.shutarshawpno.com/assets/front-end/fonts/fontawesome-webfont.woff?v=4.7.0', 1, NULL, NULL, '2025-12-15 18:59:24', '2025-12-15 18:59:24'),
(104, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js.map', 1, NULL, NULL, '2025-12-15 18:59:25', '2025-12-15 18:59:25'),
(105, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/drift-zoom/dist/Drift.min.js.map', 1, NULL, NULL, '2025-12-15 18:59:28', '2025-12-15 18:59:28'),
(106, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js.map', 1, NULL, NULL, '2025-12-15 18:59:28', '2025-12-15 18:59:28'),
(107, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/tiny-slider/dist/sourcemaps/tiny-slider.js.map', 1, NULL, NULL, '2025-12-15 19:00:11', '2025-12-15 19:00:11'),
(108, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/lightgallery.js/dist/js/\'+d+\'', 1, NULL, NULL, '2025-12-15 19:00:14', '2025-12-15 19:00:14'),
(109, 404, 'https://beta.shutarshawpno.com/assets/front-end/vendor/lightgallery.js/dist/js/\'+a+\'', 1, NULL, NULL, '2025-12-15 19:00:15', '2025-12-15 19:00:15'),
(110, 404, 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20e.xdebug_link.url%20+%20\'', 1, NULL, NULL, '2025-12-15 19:01:43', '2025-12-15 19:01:43'),
(111, 404, 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20value.xdebug_link.url%20+%20\'', 1, NULL, NULL, '2025-12-15 19:01:43', '2025-12-15 19:01:43'),
(112, 404, 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20values.xdebug_link.url%20+%20\'', 1, NULL, NULL, '2025-12-15 19:01:44', '2025-12-15 19:01:44'),
(113, 404, 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20tpl.xdebug_link.url%20+%20\'', 1, NULL, NULL, '2025-12-15 19:01:45', '2025-12-15 19:01:45'),
(114, 404, 'https://beta.shutarshawpno.com/_debugbar/assets/\'%20+%20stmt.xdebug_link.url%20+%20\'', 1, NULL, NULL, '2025-12-15 19:01:45', '2025-12-15 19:01:45'),
(115, 404, 'https://beta.shutarshawpno.com/_debugbar/assets/\'+%20tpl.editorLink%20+\'', 1, NULL, NULL, '2025-12-15 19:01:46', '2025-12-15 19:01:46'),
(116, 404, 'https://beta.shutarshawpno.com/assets/front-end/css/owl.video.play.png', 1, NULL, NULL, '2025-12-15 19:01:56', '2025-12-15 19:01:56'),
(117, 404, 'https://beta.shutarshawpno.com/.git/config', 7, NULL, NULL, '2025-12-15 19:23:58', '2025-12-17 08:15:53'),
(118, 404, 'https://beta.shutarshawpno.com/.env', 3, NULL, NULL, '2025-12-16 04:37:53', '2025-12-17 05:32:11'),
(119, 404, 'https://beta.shutarshawpno.com/wordpress', 2, NULL, NULL, '2025-12-16 06:03:38', '2025-12-17 02:55:31'),
(120, 404, 'https://beta.shutarshawpno.com/apps', 1, NULL, NULL, '2025-12-16 08:22:10', '2025-12-16 08:22:10'),
(121, 404, 'https://beta.shutarshawpno.com/api/action', 1, NULL, NULL, '2025-12-16 08:22:11', '2025-12-16 08:22:11'),
(122, 404, 'https://beta.shutarshawpno.com/api/actions', 1, NULL, NULL, '2025-12-16 08:22:11', '2025-12-16 08:22:11'),
(123, 404, 'https://beta.shutarshawpno.com/_next/data', 1, NULL, NULL, '2025-12-16 08:22:12', '2025-12-16 08:22:12'),
(124, 404, 'https://beta.shutarshawpno.com/backend/.env', 1, NULL, NULL, '2025-12-16 11:30:14', '2025-12-16 11:30:14'),
(125, 404, 'https://beta.shutarshawpno.com/admin/.env', 1, NULL, NULL, '2025-12-16 11:30:15', '2025-12-16 11:30:15'),
(126, 404, 'https://beta.shutarshawpno.com/.env.save', 1, NULL, NULL, '2025-12-16 11:30:17', '2025-12-16 11:30:17'),
(127, 404, 'https://beta.shutarshawpno.com/.env.bak', 1, NULL, NULL, '2025-12-16 11:30:18', '2025-12-16 11:30:18'),
(128, 404, 'https://beta.shutarshawpno.com/.git/logs/HEAD', 1, NULL, NULL, '2025-12-16 11:30:19', '2025-12-16 11:30:19'),
(129, 404, 'https://beta.shutarshawpno.com/config.json', 1, NULL, NULL, '2025-12-16 11:30:20', '2025-12-16 11:30:20'),
(130, 404, 'https://beta.shutarshawpno.com/config.js', 1, NULL, NULL, '2025-12-16 11:30:21', '2025-12-16 11:30:21'),
(131, 404, 'https://beta.shutarshawpno.com/aws-config.js', 1, NULL, NULL, '2025-12-16 11:30:22', '2025-12-16 11:30:22'),
(132, 404, 'https://beta.shutarshawpno.com/aws.config.js', 1, NULL, NULL, '2025-12-16 11:30:23', '2025-12-16 11:30:23'),
(133, 404, 'https://beta.shutarshawpno.com/.npmrc', 1, NULL, NULL, '2025-12-16 11:30:24', '2025-12-16 11:30:24'),
(134, 404, 'https://beta.shutarshawpno.com/%22https:/www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js%22', 1, NULL, NULL, '2025-12-16 11:31:54', '2025-12-16 11:31:54'),
(135, 404, 'https://beta.shutarshawpno.com/%22https:/www.gstatic.com/firebasejs/8.3.2/firebase-auth.js%22', 1, NULL, NULL, '2025-12-16 11:31:54', '2025-12-16 11:31:54'),
(136, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/js/sweet_alert.js%22', 1, NULL, NULL, '2025-12-16 11:31:54', '2025-12-16 11:31:54'),
(137, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/js/custom.js%22', 1, NULL, NULL, '2025-12-16 11:31:54', '2025-12-16 11:31:54'),
(138, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/js/lightbox.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:14', '2025-12-16 11:32:14'),
(139, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:40', '2025-12-16 11:32:40'),
(140, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/simplebar/dist/simplebar.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:40', '2025-12-16 11:32:40'),
(141, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/js/home.js%22', 1, NULL, NULL, '2025-12-16 11:32:40', '2025-12-16 11:32:40'),
(142, 404, 'https://beta.shutarshawpno.com/%22https:/www.gstatic.com/firebasejs/8.3.2/firebase-app.js%22', 1, NULL, NULL, '2025-12-16 11:32:40', '2025-12-16 11:32:40'),
(143, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/firebase/firebase.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:40', '2025-12-16 11:32:40'),
(144, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/back-end/js/toastr.js%22', 1, NULL, NULL, '2025-12-16 11:32:40', '2025-12-16 11:32:40'),
(145, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/js/theme.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(146, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(147, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(148, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(149, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/js/slick.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(150, 404, 'https://beta.shutarshawpno.com/\'/_debugbar/assets/javascript?v=1763541085%27', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(151, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(152, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js%22', 1, NULL, NULL, '2025-12-16 11:32:41', '2025-12-16 11:32:41'),
(153, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/js/owl.carousel.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:42', '2025-12-16 11:32:42'),
(154, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/drift-zoom/dist/Drift.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:42', '2025-12-16 11:32:42'),
(155, 404, 'https://beta.shutarshawpno.com/%22https:/beta.shutarshawpno.com/assets/front-end/vendor/lg-video.js/dist/lg-video.min.js%22', 1, NULL, NULL, '2025-12-16 11:32:42', '2025-12-16 11:32:42'),
(156, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/back-end/js/toastr.js', 2, NULL, NULL, '2025-12-17 03:26:17', '2025-12-17 03:26:54'),
(157, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/lg-video.js/dist/lg-video.min.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:55'),
(158, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/js/theme.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:54'),
(159, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/js/lightbox.min.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:55'),
(160, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/js/slick.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:53'),
(161, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:55'),
(162, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:53'),
(163, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/js/custom.js', 2, NULL, NULL, '2025-12-17 03:26:18', '2025-12-17 03:26:54'),
(164, 404, 'https://beta.shutarshawpno.com//www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js', 2, NULL, NULL, '2025-12-17 03:26:19', '2025-12-17 03:26:56'),
(165, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/lightgallery.js', 2, NULL, NULL, '2025-12-17 03:26:19', '2025-12-17 03:26:56'),
(166, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/js/owl.carousel.min.js', 2, NULL, NULL, '2025-12-17 03:26:19', '2025-12-17 03:26:54'),
(167, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js', 2, NULL, NULL, '2025-12-17 03:26:19', '2025-12-17 03:26:54'),
(168, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/simplebar/dist/simplebar.min.js', 2, NULL, NULL, '2025-12-17 03:26:19', '2025-12-17 03:26:55'),
(169, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/drift-zoom/dist/Drift.min.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:54'),
(170, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/js/home.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:56'),
(171, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/js/sweet_alert.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:53'),
(172, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/firebase/firebase.min.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:54'),
(173, 404, 'https://beta.shutarshawpno.com//www.gstatic.com/firebasejs/8.3.2/firebase-app.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:55'),
(174, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/firebase-messaging-sw.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:55'),
(175, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:55'),
(176, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:54'),
(177, 404, 'https://beta.shutarshawpno.com//www.gstatic.com/firebasejs/8.3.2/firebase-auth.js', 2, NULL, NULL, '2025-12-17 03:26:20', '2025-12-17 03:26:56'),
(178, 404, 'https://beta.shutarshawpno.com//beta.shutarshawpno.com/assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js', 1, NULL, NULL, '2025-12-17 03:26:55', '2025-12-17 03:26:55'),
(179, 404, 'https://beta.shutarshawpno.com/assets/back-end/img/icons/product-upload-icon.svg-dummy', 1, NULL, NULL, '2025-12-17 15:20:32', '2025-12-17 15:20:32'),
(180, 404, 'https://beta.shutarshawpno.com/admin/products/dummy', 1, NULL, NULL, '2025-12-17 15:20:32', '2025-12-17 15:20:32'),
(181, 404, 'http://localhost:8000/.well-known/appspecific/com.chrome.devtools.json', 19, NULL, NULL, '2025-12-17 10:14:05', '2025-12-17 11:39:42'),
(182, 404, 'http://localhost:8000/assets/front-end/vendor/tiny-slider/dist/sourcemaps/tiny-slider.css.map', 19, NULL, NULL, '2025-12-17 10:14:05', '2025-12-17 11:39:55'),
(183, 404, 'http://localhost:8000/assets/front-end/css/theme.min.css.map', 16, NULL, NULL, '2025-12-17 10:14:58', '2025-12-17 11:38:17'),
(184, 404, 'http://localhost:8000/assets/front-end/css/style.css.map', 15, NULL, NULL, '2025-12-17 10:15:00', '2025-12-17 11:39:57'),
(185, 404, 'http://localhost:8000/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js.map', 18, NULL, NULL, '2025-12-17 10:15:01', '2025-12-17 11:39:44'),
(186, 404, 'http://localhost:8000/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js.map', 18, NULL, NULL, '2025-12-17 10:15:03', '2025-12-17 11:39:46'),
(187, 404, 'http://localhost:8000/assets/front-end/vendor/tiny-slider/dist/sourcemaps/tiny-slider.js.map', 18, NULL, NULL, '2025-12-17 10:15:06', '2025-12-17 11:39:47'),
(188, 404, 'http://localhost:8000/js/lightbox.min.map', 18, NULL, NULL, '2025-12-17 10:15:07', '2025-12-17 11:39:49'),
(189, 404, 'http://localhost:8000/assets/front-end/vendor/drift-zoom/dist/Drift.min.js.map', 18, NULL, NULL, '2025-12-17 10:15:09', '2025-12-17 11:39:50'),
(190, 404, 'http://localhost:8000/assets/back-end/js/toastr.js.map', 18, NULL, NULL, '2025-12-17 10:15:10', '2025-12-17 11:39:52'),
(191, 404, 'http://localhost:8000/assets/front-end/vendor/firebase/firebase.js.map', 18, NULL, NULL, '2025-12-17 10:15:11', '2025-12-17 11:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_deals`
--

DROP TABLE IF EXISTS `feature_deals`;
CREATE TABLE IF NOT EXISTS `feature_deals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_accounts`
--

DROP TABLE IF EXISTS `finance_accounts`;
CREATE TABLE IF NOT EXISTS `finance_accounts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'posting',
  `description` text COLLATE utf8mb4_unicode_ci,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `level` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `is_leaf` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_postable` tinyint(1) NOT NULL DEFAULT '1',
  `currency` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'debit',
  `opening_balance` decimal(24,6) NOT NULL DEFAULT '0.000000',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `finance_accounts_code_unique` (`code`),
  KEY `finance_accounts_created_by_foreign` (`created_by`),
  KEY `finance_accounts_updated_by_foreign` (`updated_by`),
  KEY `finance_accounts_category_is_active_index` (`category`,`is_active`),
  KEY `finance_accounts_parent_id_index` (`parent_id`),
  KEY `finance_accounts_is_postable_balance_type_index` (`is_postable`,`balance_type`)
) ;

--
-- Dumping data for table `finance_accounts`
--

INSERT INTO `finance_accounts` (`id`, `code`, `name`, `category`, `type`, `description`, `parent_id`, `level`, `is_leaf`, `is_active`, `is_postable`, `currency`, `balance_type`, `opening_balance`, `metadata`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '4000', 'Sales Revenue', 'revenue', 'control', NULL, NULL, 1, 0, 1, 0, 'USD', 'credit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(2, '4010', 'Sales Returns', 'revenue', 'posting', NULL, NULL, 1, 1, 1, 1, 'USD', 'debit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(3, '1100', 'Payment Clearing', 'asset', 'control', NULL, NULL, 1, 0, 1, 0, 'USD', 'debit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(4, '2100', 'Vendor Payables', 'liability', 'control', NULL, NULL, 1, 0, 1, 0, 'USD', 'credit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(5, '5000', 'Operating Expenses', 'expense', 'control', NULL, NULL, 1, 0, 1, 0, 'USD', 'debit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(6, '2300', 'Tax Liabilities', 'liability', 'posting', NULL, NULL, 1, 1, 1, 1, 'USD', 'credit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(7, '2400', 'Wallet Liability', 'liability', 'posting', NULL, NULL, 1, 1, 1, 1, 'USD', 'credit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20'),
(8, '2500', 'Deliveryman Payables', 'liability', 'posting', NULL, NULL, 1, 1, 1, 1, 'USD', 'credit', 0.000000, NULL, NULL, NULL, NULL, '2025-11-27 23:18:08', '2025-11-27 23:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `finance_attachments`
--

DROP TABLE IF EXISTS `finance_attachments`;
CREATE TABLE IF NOT EXISTS `finance_attachments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `attachable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachable_id` bigint UNSIGNED NOT NULL,
  `category` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED NOT NULL DEFAULT '0',
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `uploaded_at` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_attachments_attachable_type_attachable_id_index` (`attachable_type`,`attachable_id`),
  KEY `finance_attachments_uploaded_by_foreign` (`uploaded_by`),
  KEY `finance_attachments_attachable_type_category_index` (`attachable_type`,`category`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `finance_expenses`
--

DROP TABLE IF EXISTS `finance_expenses`;
CREATE TABLE IF NOT EXISTS `finance_expenses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` bigint UNSIGNED DEFAULT NULL,
  `category` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payee_type` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payee_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(24,6) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(18,6) NOT NULL DEFAULT '1.000000',
  `expense_date` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `purpose` text COLLATE utf8mb4_unicode_ci,
  `journal_id` bigint UNSIGNED DEFAULT NULL,
  `submitted_by` bigint UNSIGNED DEFAULT NULL,
  `reviewed_by` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `attachment_count` int UNSIGNED NOT NULL DEFAULT '0',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `finance_expenses_expense_number_unique` (`expense_number`),
  KEY `finance_expenses_account_id_foreign` (`account_id`),
  KEY `finance_expenses_journal_id_foreign` (`journal_id`),
  KEY `finance_expenses_submitted_by_foreign` (`submitted_by`),
  KEY `finance_expenses_reviewed_by_foreign` (`reviewed_by`),
  KEY `finance_expenses_approved_by_foreign` (`approved_by`),
  KEY `finance_expenses_status_expense_date_index` (`status`,`expense_date`),
  KEY `finance_expenses_payee_type_payee_id_index` (`payee_type`,`payee_id`)
) ;

--
-- Dumping data for table `finance_expenses`
--

INSERT INTO `finance_expenses` (`id`, `expense_number`, `account_id`, `category`, `payee_type`, `payee_id`, `amount`, `currency`, `exchange_rate`, `expense_date`, `status`, `purpose`, `journal_id`, `submitted_by`, `reviewed_by`, `approved_by`, `approved_at`, `attachment_count`, `metadata`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '278', 6, 'Anim nostrum eligend', 'Non voluptate qui pa', 6, 9.000000, 'MOL', 61.000000, '2010-04-06', 'submitted', 'Unde repellendus Cu', NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, '2025-11-27 00:58:02', '2025-11-27 00:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `finance_fiscal_periods`
--

DROP TABLE IF EXISTS `finance_fiscal_periods`;
CREATE TABLE IF NOT EXISTS `finance_fiscal_periods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiscal_year` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `locked_at` timestamp NULL DEFAULT NULL,
  `locked_by` bigint UNSIGNED DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `finance_fiscal_periods_fiscal_year_name_unique` (`fiscal_year`,`name`),
  KEY `finance_fiscal_periods_locked_by_foreign` (`locked_by`),
  KEY `finance_fiscal_periods_created_by_foreign` (`created_by`),
  KEY `finance_fiscal_periods_updated_by_foreign` (`updated_by`),
  KEY `finance_fiscal_periods_status_start_date_index` (`status`,`start_date`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finance_fiscal_periods`
--

INSERT INTO `finance_fiscal_periods` (`id`, `name`, `fiscal_year`, `start_date`, `end_date`, `status`, `is_locked`, `locked_at`, `locked_by`, `notes`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'FY 2025', '2025', '2025-01-01', '2025-12-31', 'open', 0, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-27 00:50:20', '2025-11-27 00:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `finance_journals`
--

DROP TABLE IF EXISTS `finance_journals`;
CREATE TABLE IF NOT EXISTS `finance_journals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `journal_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fiscal_period_id` bigint UNSIGNED DEFAULT NULL,
  `entry_date` date NOT NULL,
  `source_type` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` bigint UNSIGNED DEFAULT NULL,
  `source_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(18,6) NOT NULL DEFAULT '1.000000',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `category` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `memo` text COLLATE utf8mb4_unicode_ci,
  `line_count` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment_count` int UNSIGNED NOT NULL DEFAULT '0',
  `posted_at` timestamp NULL DEFAULT NULL,
  `posted_by` bigint UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `finance_journals_journal_number_unique` (`journal_number`),
  KEY `finance_journals_posted_by_foreign` (`posted_by`),
  KEY `finance_journals_created_by_foreign` (`created_by`),
  KEY `finance_journals_updated_by_foreign` (`updated_by`),
  KEY `finance_journals_entry_date_status_index` (`entry_date`,`status`),
  KEY `finance_journals_source_type_source_id_index` (`source_type`,`source_id`),
  KEY `finance_journals_fiscal_period_id_index` (`fiscal_period_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_journal_rows`
--

DROP TABLE IF EXISTS `finance_journal_rows`;
CREATE TABLE IF NOT EXISTS `finance_journal_rows` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `journal_id` bigint UNSIGNED NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `line_number` int UNSIGNED NOT NULL,
  `entry_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(24,6) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(18,6) NOT NULL DEFAULT '1.000000',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` bigint UNSIGNED DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_journal_rows_journal_id_line_number_index` (`journal_id`,`line_number`),
  KEY `finance_journal_rows_account_id_index` (`account_id`),
  KEY `finance_journal_rows_reference_type_reference_id_index` (`reference_type`,`reference_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `finance_reconciliations`
--

DROP TABLE IF EXISTS `finance_reconciliations`;
CREATE TABLE IF NOT EXISTS `finance_reconciliations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_id` bigint UNSIGNED NOT NULL,
  `statement_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statement_date` date DEFAULT NULL,
  `import_source` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` decimal(24,6) NOT NULL DEFAULT '0.000000',
  `closing_balance` decimal(24,6) NOT NULL DEFAULT '0.000000',
  `statement_row_count` int UNSIGNED NOT NULL DEFAULT '0',
  `matched_row_count` int UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_reconciliations_created_by_foreign` (`created_by`),
  KEY `finance_reconciliations_updated_by_foreign` (`updated_by`),
  KEY `finance_reconciliations_account_id_status_index` (`account_id`,`status`),
  KEY `finance_reconciliations_statement_date_index` (`statement_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finance_reconciliation_rows`
--

DROP TABLE IF EXISTS `finance_reconciliation_rows`;
CREATE TABLE IF NOT EXISTS `finance_reconciliation_rows` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reconciliation_id` bigint UNSIGNED NOT NULL,
  `transaction_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(24,6) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unmatched',
  `journal_row_id` bigint UNSIGNED DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_reconciliation_rows_reconciliation_id_match_status_index` (`reconciliation_id`,`match_status`),
  KEY `finance_reconciliation_rows_journal_row_id_index` (`journal_row_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `finance_transfers`
--

DROP TABLE IF EXISTS `finance_transfers`;
CREATE TABLE IF NOT EXISTS `finance_transfers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `transfer_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_account_id` bigint UNSIGNED NOT NULL,
  `destination_account_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(24,6) NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(18,6) NOT NULL DEFAULT '1.000000',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `memo` text COLLATE utf8mb4_unicode_ci,
  `journal_id` bigint UNSIGNED DEFAULT NULL,
  `initiated_by` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `initiated_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `attachment_count` int UNSIGNED NOT NULL DEFAULT '0',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `finance_transfers_transfer_number_unique` (`transfer_number`),
  KEY `finance_transfers_source_account_id_foreign` (`source_account_id`),
  KEY `finance_transfers_destination_account_id_foreign` (`destination_account_id`),
  KEY `finance_transfers_journal_id_foreign` (`journal_id`),
  KEY `finance_transfers_initiated_by_foreign` (`initiated_by`),
  KEY `finance_transfers_approved_by_foreign` (`approved_by`),
  KEY `finance_transfers_status_initiated_at_index` (`status`,`initiated_at`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deals`
--

DROP TABLE IF EXISTS `flash_deals`;
CREATE TABLE IF NOT EXISTS `flash_deals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `background_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `deal_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_products`
--

DROP TABLE IF EXISTS `flash_deal_products`;
CREATE TABLE IF NOT EXISTS `flash_deal_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `flash_deal_id` bigint DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_users`
--

DROP TABLE IF EXISTS `guest_users`;
CREATE TABLE IF NOT EXISTS `guest_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest_users`
--

INSERT INTO `guest_users` (`id`, `ip_address`, `fcm_token`, `created_at`, `updated_at`) VALUES
(1, '::1', NULL, '2024-02-19 08:35:50', NULL),
(2, '::1', NULL, '2024-03-27 03:10:49', NULL),
(3, '::1', NULL, '2024-03-27 03:12:35', NULL),
(4, '::1', NULL, '2024-05-18 10:57:05', NULL),
(5, '::1', NULL, '2024-09-24 07:51:36', '2024-09-24 07:51:36'),
(6, '::1', NULL, '2024-09-24 07:52:19', '2024-09-24 07:52:19'),
(7, '::1', NULL, '2024-10-27 08:14:28', '2024-10-27 08:14:28'),
(8, '::1', NULL, '2024-12-21 06:51:41', '2024-12-21 06:51:41'),
(9, '::1', NULL, '2025-02-18 16:25:13', '2025-02-18 16:25:13'),
(10, '::1', NULL, '2025-02-19 10:23:54', '2025-02-19 10:23:54'),
(11, '::1', NULL, '2025-05-07 06:05:20', '2025-05-07 06:05:20'),
(12, '::1', NULL, '2025-08-24 11:51:06', '2025-08-24 11:51:06'),
(13, '::1', NULL, '2025-09-17 10:06:23', '2025-09-17 10:06:23'),
(14, '127.0.0.1', NULL, '2025-10-03 03:01:22', '2025-10-03 03:01:22'),
(15, '127.0.0.1', NULL, '2025-10-03 03:03:47', '2025-10-03 03:03:47'),
(16, '127.0.0.1', NULL, '2025-10-03 12:20:58', '2025-10-03 12:20:58'),
(17, '127.0.0.1', NULL, '2025-10-31 14:22:37', '2025-10-31 14:22:37'),
(18, '127.0.0.1', NULL, '2025-11-04 00:40:06', '2025-11-04 00:40:06'),
(19, '127.0.0.1', NULL, '2025-11-04 02:34:57', '2025-11-04 02:34:57'),
(20, '127.0.0.1', NULL, '2025-11-04 05:36:52', '2025-11-04 05:36:52'),
(21, '127.0.0.1', NULL, '2025-11-24 03:57:43', '2025-11-24 03:57:43'),
(22, '127.0.0.1', NULL, '2025-11-27 00:18:49', '2025-11-27 00:18:49'),
(23, '127.0.0.1', NULL, '2025-11-27 23:36:10', '2025-11-27 23:36:10'),
(24, '127.0.0.1', NULL, '2025-11-28 12:27:49', '2025-11-28 12:27:49'),
(25, '59.153.103.137', NULL, '2025-12-15 16:59:13', '2025-12-15 16:59:13'),
(26, '65.87.7.112', NULL, '2025-12-15 17:00:02', '2025-12-15 17:00:02'),
(27, '65.87.7.112', NULL, '2025-12-15 17:00:02', '2025-12-15 17:00:02'),
(28, '59.153.103.137', NULL, '2025-12-15 17:00:39', '2025-12-15 17:00:39'),
(29, '65.87.7.112', NULL, '2025-12-15 17:01:25', '2025-12-15 17:01:25'),
(30, '65.87.7.112', NULL, '2025-12-15 17:01:25', '2025-12-15 17:01:25'),
(31, '65.87.7.112', NULL, '2025-12-15 17:03:18', '2025-12-15 17:03:18'),
(32, '146.70.185.32', NULL, '2025-12-15 17:03:18', '2025-12-15 17:03:18'),
(33, '65.87.7.112', NULL, '2025-12-15 17:03:19', '2025-12-15 17:03:19'),
(34, '34.123.170.104', NULL, '2025-12-15 17:03:21', '2025-12-15 17:03:21'),
(35, '146.70.185.32', NULL, '2025-12-15 17:03:33', '2025-12-15 17:03:33'),
(36, '205.169.39.58', NULL, '2025-12-15 17:03:41', '2025-12-15 17:03:41'),
(37, '3.233.59.216', NULL, '2025-12-15 17:04:03', '2025-12-15 17:04:03'),
(38, '172.111.15.112', NULL, '2025-12-15 17:04:42', '2025-12-15 17:04:42'),
(39, '128.192.12.120', NULL, '2025-12-15 17:05:59', '2025-12-15 17:05:59'),
(40, '45.148.107.251', NULL, '2025-12-15 17:05:59', '2025-12-15 17:05:59'),
(41, '103.196.9.11', NULL, '2025-12-15 17:07:02', '2025-12-15 17:07:02'),
(42, '103.4.250.119', NULL, '2025-12-15 17:07:02', '2025-12-15 17:07:02'),
(43, '205.169.39.119', NULL, '2025-12-15 17:15:37', '2025-12-15 17:15:37'),
(44, '205.169.39.119', NULL, '2025-12-15 17:16:30', '2025-12-15 17:16:30'),
(45, '192.175.111.249', NULL, '2025-12-15 17:31:53', '2025-12-15 17:31:53'),
(46, '64.15.129.109', NULL, '2025-12-15 17:31:56', '2025-12-15 17:31:56'),
(47, '192.175.111.246', NULL, '2025-12-15 17:32:13', '2025-12-15 17:32:13'),
(48, '192.175.111.229', NULL, '2025-12-15 17:32:15', '2025-12-15 17:32:15'),
(49, '64.15.129.103', NULL, '2025-12-15 17:32:17', '2025-12-15 17:32:17'),
(50, '65.87.7.112', NULL, '2025-12-15 17:54:32', '2025-12-15 17:54:32'),
(51, '65.87.7.112', NULL, '2025-12-15 17:54:33', '2025-12-15 17:54:33'),
(52, '65.87.7.112', NULL, '2025-12-15 17:54:38', '2025-12-15 17:54:38'),
(53, '65.87.7.112', NULL, '2025-12-15 17:54:38', '2025-12-15 17:54:38'),
(54, '35.92.157.5', NULL, '2025-12-15 17:55:02', '2025-12-15 17:55:02'),
(55, '35.92.157.5', NULL, '2025-12-15 17:55:02', '2025-12-15 17:55:02'),
(56, '34.28.17.131', NULL, '2025-12-15 18:02:55', '2025-12-15 18:02:55'),
(57, '34.34.49.206', NULL, '2025-12-15 18:05:51', '2025-12-15 18:05:51'),
(58, '34.221.253.152', NULL, '2025-12-15 18:08:02', '2025-12-15 18:08:02'),
(59, '34.221.253.152', NULL, '2025-12-15 18:08:10', '2025-12-15 18:08:10'),
(60, '205.169.39.50', NULL, '2025-12-15 18:23:46', '2025-12-15 18:23:46'),
(61, '66.132.153.115', NULL, '2025-12-15 18:45:07', '2025-12-15 18:45:07'),
(62, '66.132.153.115', NULL, '2025-12-15 18:45:27', '2025-12-15 18:45:27'),
(63, '91.84.74.250', NULL, '2025-12-15 18:53:40', '2025-12-15 18:53:40'),
(64, '74.7.241.20', NULL, '2025-12-15 18:54:29', '2025-12-15 18:54:29'),
(65, '57.131.35.166', NULL, '2025-12-15 18:59:51', '2025-12-15 18:59:51'),
(66, '34.220.176.138', NULL, '2025-12-15 19:11:52', '2025-12-15 19:11:52'),
(67, '34.220.176.138', NULL, '2025-12-15 19:12:02', '2025-12-15 19:12:02'),
(68, '54.247.57.72', NULL, '2025-12-15 19:58:40', '2025-12-15 19:58:40'),
(69, '54.247.57.72', NULL, '2025-12-15 19:58:42', '2025-12-15 19:58:42'),
(70, '54.247.57.72', NULL, '2025-12-15 19:58:50', '2025-12-15 19:58:50'),
(71, '216.73.216.164', NULL, '2025-12-15 20:19:58', '2025-12-15 20:19:58'),
(72, '193.19.82.13', NULL, '2025-12-15 20:29:42', '2025-12-15 20:29:42'),
(73, '193.19.82.13', NULL, '2025-12-15 20:29:58', '2025-12-15 20:29:58'),
(74, '149.57.180.79', NULL, '2025-12-15 20:54:02', '2025-12-15 20:54:02'),
(75, '149.57.180.141', NULL, '2025-12-15 22:18:51', '2025-12-15 22:18:51'),
(76, '23.27.145.155', NULL, '2025-12-15 22:44:04', '2025-12-15 22:44:04'),
(77, '23.27.145.155', NULL, '2025-12-16 00:46:54', '2025-12-16 00:46:54'),
(78, '91.84.74.250', NULL, '2025-12-16 01:16:11', '2025-12-16 01:16:11'),
(79, '23.159.216.216', NULL, '2025-12-16 03:19:52', '2025-12-16 03:19:52'),
(80, '91.84.74.250', NULL, '2025-12-16 05:51:18', '2025-12-16 05:51:18'),
(81, '34.143.217.236', NULL, '2025-12-16 06:03:35', '2025-12-16 06:03:35'),
(82, '216.73.216.164', NULL, '2025-12-16 06:32:21', '2025-12-16 06:32:21'),
(83, '216.73.216.164', NULL, '2025-12-16 06:32:22', '2025-12-16 06:32:22'),
(84, '216.73.216.164', NULL, '2025-12-16 06:32:39', '2025-12-16 06:32:39'),
(85, '216.73.216.164', NULL, '2025-12-16 06:33:26', '2025-12-16 06:33:26'),
(86, '216.73.216.164', NULL, '2025-12-16 06:34:00', '2025-12-16 06:34:00'),
(87, '216.73.216.164', NULL, '2025-12-16 06:34:19', '2025-12-16 06:34:19'),
(88, '216.73.216.164', NULL, '2025-12-16 06:34:40', '2025-12-16 06:34:40'),
(89, '216.73.216.164', NULL, '2025-12-16 06:34:40', '2025-12-16 06:34:40'),
(90, '216.73.216.164', NULL, '2025-12-16 06:35:31', '2025-12-16 06:35:31'),
(91, '216.73.216.164', NULL, '2025-12-16 06:38:34', '2025-12-16 06:38:34'),
(92, '216.73.216.164', NULL, '2025-12-16 06:39:26', '2025-12-16 06:39:26'),
(93, '216.73.216.164', NULL, '2025-12-16 06:39:27', '2025-12-16 06:39:27'),
(94, '3.88.20.10', NULL, '2025-12-16 08:22:08', '2025-12-16 08:22:08'),
(95, '195.178.110.201', NULL, '2025-12-16 11:29:18', '2025-12-16 11:29:18'),
(96, '216.73.216.164', NULL, '2025-12-16 14:01:29', '2025-12-16 14:01:29'),
(97, '34.168.82.50', NULL, '2025-12-16 15:00:28', '2025-12-16 15:00:28'),
(98, '87.236.176.148', NULL, '2025-12-16 17:47:37', '2025-12-16 17:47:37'),
(99, '91.84.74.250', NULL, '2025-12-16 17:49:26', '2025-12-16 17:49:26'),
(100, '87.236.176.106', NULL, '2025-12-16 17:54:54', '2025-12-16 17:54:54'),
(101, '146.190.26.31', NULL, '2025-12-16 18:32:13', '2025-12-16 18:32:13'),
(102, '34.221.21.250', NULL, '2025-12-16 20:05:52', '2025-12-16 20:05:52'),
(103, '23.27.145.102', NULL, '2025-12-16 20:48:56', '2025-12-16 20:48:56'),
(104, '51.89.23.223', NULL, '2025-12-16 21:38:51', '2025-12-16 21:38:51'),
(105, '23.27.145.173', NULL, '2025-12-16 22:33:25', '2025-12-16 22:33:25'),
(106, '23.27.145.80', NULL, '2025-12-16 23:05:24', '2025-12-16 23:05:24'),
(107, '34.143.244.218', NULL, '2025-12-17 02:55:29', '2025-12-17 02:55:29'),
(108, '151.80.144.77', NULL, '2025-12-17 03:04:23', '2025-12-17 03:04:23'),
(109, '185.177.72.8', NULL, '2025-12-17 03:25:56', '2025-12-17 03:25:56'),
(110, '104.252.191.112', NULL, '2025-12-17 03:46:44', '2025-12-17 03:46:44'),
(111, '154.28.229.115', NULL, '2025-12-17 03:46:45', '2025-12-17 03:46:45'),
(112, '104.252.191.112', NULL, '2025-12-17 03:46:53', '2025-12-17 03:46:53'),
(113, '103.4.251.50', NULL, '2025-12-17 04:42:27', '2025-12-17 04:42:27'),
(114, '104.252.191.215', NULL, '2025-12-17 04:42:27', '2025-12-17 04:42:27'),
(115, '104.252.191.166', NULL, '2025-12-17 04:57:09', '2025-12-17 04:57:09'),
(116, '107.172.195.20', NULL, '2025-12-17 04:57:11', '2025-12-17 04:57:11'),
(117, '107.172.195.20', NULL, '2025-12-17 04:57:18', '2025-12-17 04:57:18'),
(118, '18.132.190.207', NULL, '2025-12-17 08:15:55', '2025-12-17 08:15:55'),
(119, '104.252.191.243', NULL, '2025-12-17 15:34:28', '2025-12-17 15:34:28'),
(120, '107.172.195.124', NULL, '2025-12-17 15:34:28', '2025-12-17 15:34:28'),
(121, '107.172.195.124', NULL, '2025-12-17 15:34:43', '2025-12-17 15:34:43'),
(122, '59.153.103.137', NULL, '2025-12-17 15:35:52', '2025-12-17 15:35:52'),
(123, '127.0.0.1', NULL, '2025-12-17 10:03:33', '2025-12-17 10:03:33'),
(124, '127.0.0.1', NULL, '2025-12-20 00:29:26', '2025-12-20 00:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `help_topics`
--

DROP TABLE IF EXISTS `help_topics`;
CREATE TABLE IF NOT EXISTS `help_topics` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `ranking` int NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `help_topics`
--

INSERT INTO `help_topics` (`id`, `type`, `question`, `answer`, `ranking`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vendor_registration', 'How do I register as a seller?', 'To register, click on the \"Sign Up\" button, fill in your details, and verify your account via email.', 1, 1, NULL, NULL),
(2, 'vendor_registration', 'What are the fees for selling?', 'Our platform charges a small commission on each sale. There are no upfront listing fees.', 2, 1, NULL, NULL),
(3, 'vendor_registration', 'How do I upload products?', 'Log in to your seller account, go to the \"Upload Products\" section, and fill in the product details and images.', 3, 1, NULL, NULL),
(4, 'vendor_registration', 'How do I handle customer inquiries?', 'You can manage customer inquiries directly through our platform\'s messaging system, ensuring quick and efficient communication.', 4, 1, NULL, NULL),
(5, 'vendor_registration', 'How do I register as a seller?', 'To register, click on the \"Sign Up\" button, fill in your details, and verify your account via email.', 1, 1, NULL, NULL),
(6, 'vendor_registration', 'What are the fees for selling?', 'Our platform charges a small commission on each sale. There are no upfront listing fees.', 2, 1, NULL, NULL),
(7, 'vendor_registration', 'How do I upload products?', 'Log in to your seller account, go to the \"Upload Products\" section, and fill in the product details and images.', 3, 1, NULL, NULL),
(8, 'vendor_registration', 'How do I handle customer inquiries?', 'You can manage customer inquiries directly through our platform\'s messaging system, ensuring quick and efficient communication.', 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_setups`
--

DROP TABLE IF EXISTS `login_setups`;
CREATE TABLE IF NOT EXISTS `login_setups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_setups`
--

INSERT INTO `login_setups` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'login_options', '{\"manual_login\":1,\"otp_login\":0,\"social_login\":1}', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(2, 'social_media_for_login', '{\"google\":1,\"facebook\":1,\"apple\":1}', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(3, 'email_verification', '0', '2024-09-24 07:52:17', '2024-09-24 07:52:17'),
(4, 'phone_verification', '0', '2024-09-24 07:52:17', '2024-09-24 07:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_point_transactions`
--

DROP TABLE IF EXISTS `loyalty_point_transactions`;
CREATE TABLE IF NOT EXISTS `loyalty_point_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` decimal(24,3) NOT NULL DEFAULT '0.000',
  `debit` decimal(24,3) NOT NULL DEFAULT '0.000',
  `balance` decimal(24,3) NOT NULL DEFAULT '0.000',
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=580 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_08_105159_create_admins_table', 1),
(5, '2020_09_08_111837_create_admin_roles_table', 1),
(6, '2020_09_16_142451_create_categories_table', 2),
(7, '2020_09_16_181753_create_categories_table', 3),
(8, '2020_09_17_134238_create_brands_table', 4),
(9, '2020_09_17_203054_create_attributes_table', 5),
(10, '2020_09_19_112509_create_coupons_table', 6),
(11, '2020_09_19_161802_create_curriencies_table', 7),
(12, '2020_09_20_114509_create_sellers_table', 8),
(13, '2020_09_23_113454_create_shops_table', 9),
(14, '2020_09_23_115615_create_shops_table', 10),
(15, '2020_09_23_153822_create_shops_table', 11),
(16, '2020_09_21_122817_create_products_table', 12),
(17, '2020_09_22_140800_create_colors_table', 12),
(18, '2020_09_28_175020_create_products_table', 13),
(19, '2020_09_28_180311_create_products_table', 14),
(20, '2020_10_04_105041_create_search_functions_table', 15),
(21, '2020_10_05_150730_create_customers_table', 15),
(22, '2020_10_08_133548_create_wishlists_table', 16),
(23, '2016_06_01_000001_create_oauth_auth_codes_table', 17),
(24, '2016_06_01_000002_create_oauth_access_tokens_table', 17),
(25, '2016_06_01_000003_create_oauth_refresh_tokens_table', 17),
(26, '2016_06_01_000004_create_oauth_clients_table', 17),
(27, '2016_06_01_000005_create_oauth_personal_access_clients_table', 17),
(28, '2020_10_06_133710_create_product_stocks_table', 17),
(29, '2020_10_06_134636_create_flash_deals_table', 17),
(30, '2020_10_06_134719_create_flash_deal_products_table', 17),
(31, '2020_10_08_115439_create_orders_table', 17),
(32, '2020_10_08_115453_create_order_details_table', 17),
(33, '2020_10_08_121135_create_shipping_addresses_table', 17),
(34, '2020_10_10_171722_create_business_settings_table', 17),
(35, '2020_09_19_161802_create_currencies_table', 18),
(36, '2020_10_12_152350_create_reviews_table', 18),
(37, '2020_10_12_161834_create_reviews_table', 19),
(38, '2020_10_12_180510_create_support_tickets_table', 20),
(39, '2020_10_14_140130_create_transactions_table', 21),
(40, '2020_10_14_143553_create_customer_wallets_table', 21),
(41, '2020_10_14_143607_create_customer_wallet_histories_table', 21),
(42, '2020_10_22_142212_create_support_ticket_convs_table', 21),
(43, '2020_10_24_234813_create_banners_table', 22),
(44, '2020_10_27_111557_create_shipping_methods_table', 23),
(45, '2020_10_27_114154_add_url_to_banners_table', 24),
(46, '2020_10_28_170308_add_shipping_id_to_order_details', 25),
(47, '2020_11_02_140528_add_discount_to_order_table', 26),
(48, '2020_11_03_162723_add_column_to_order_details', 27),
(49, '2020_11_08_202351_add_url_to_banners_table', 28),
(50, '2020_11_10_112713_create_help_topic', 29),
(51, '2020_11_10_141513_create_contacts_table', 29),
(52, '2020_11_15_180036_add_address_column_user_table', 30),
(53, '2020_11_18_170209_add_status_column_to_product_table', 31),
(54, '2020_11_19_115453_add_featured_status_product', 32),
(55, '2020_11_21_133302_create_deal_of_the_days_table', 33),
(56, '2020_11_20_172332_add_product_id_to_products', 34),
(57, '2020_11_27_234439_add__state_to_shipping_addresses', 34),
(58, '2020_11_28_091929_create_chattings_table', 35),
(59, '2020_12_02_011815_add_bank_info_to_sellers', 36),
(60, '2020_12_08_193234_create_social_medias_table', 37),
(61, '2020_12_13_122649_shop_id_to_chattings', 37),
(62, '2020_12_14_145116_create_seller_wallet_histories_table', 38),
(63, '2020_12_14_145127_create_seller_wallets_table', 38),
(64, '2020_12_15_174804_create_admin_wallets_table', 39),
(65, '2020_12_15_174821_create_admin_wallet_histories_table', 39),
(66, '2020_12_15_214312_create_feature_deals_table', 40),
(67, '2020_12_17_205712_create_withdraw_requests_table', 41),
(68, '2021_02_22_161510_create_notifications_table', 42),
(69, '2021_02_24_154706_add_deal_type_to_flash_deals', 43),
(70, '2021_03_03_204349_add_cm_firebase_token_to_users', 44),
(71, '2021_04_17_134848_add_column_to_order_details_stock', 45),
(72, '2021_05_12_155401_add_auth_token_seller', 46),
(73, '2021_06_03_104531_ex_rate_update', 47),
(74, '2021_06_03_222413_amount_withdraw_req', 48),
(75, '2021_06_04_154501_seller_wallet_withdraw_bal', 49),
(76, '2021_06_04_195853_product_dis_tax', 50),
(77, '2021_05_27_103505_create_product_translations_table', 51),
(78, '2021_06_17_054551_create_soft_credentials_table', 51),
(79, '2021_06_29_212549_add_active_col_user_table', 52),
(80, '2021_06_30_212619_add_col_to_contact', 53),
(81, '2021_07_01_160828_add_col_daily_needs_products', 54),
(82, '2021_07_04_182331_add_col_seller_sales_commission', 55),
(83, '2021_08_07_190655_add_seo_columns_to_products', 56),
(84, '2021_08_07_205913_add_col_to_category_table', 56),
(85, '2021_08_07_210808_add_col_to_shops_table', 56),
(86, '2021_08_14_205216_change_product_price_col_type', 56),
(87, '2021_08_16_201505_change_order_price_col', 56),
(88, '2021_08_16_201552_change_order_details_price_col', 56),
(89, '2019_09_29_154000_create_payment_cards_table', 57),
(90, '2021_08_17_213934_change_col_type_seller_earning_history', 57),
(91, '2021_08_17_214109_change_col_type_admin_earning_history', 57),
(92, '2021_08_17_214232_change_col_type_admin_wallet', 57),
(93, '2021_08_17_214405_change_col_type_seller_wallet', 57),
(94, '2021_08_22_184834_add_publish_to_products_table', 57),
(95, '2021_09_08_211832_add_social_column_to_users_table', 57),
(96, '2021_09_13_165535_add_col_to_user', 57),
(97, '2021_09_19_061647_add_limit_to_coupons_table', 57),
(98, '2021_09_20_020716_add_coupon_code_to_orders_table', 57),
(99, '2021_09_23_003059_add_gst_to_sellers_table', 57),
(100, '2021_09_28_025411_create_order_transactions_table', 57),
(101, '2021_10_02_185124_create_carts_table', 57),
(102, '2021_10_02_190207_create_cart_shippings_table', 57),
(103, '2021_10_03_194334_add_col_order_table', 57),
(104, '2021_10_03_200536_add_shipping_cost', 57),
(105, '2021_10_04_153201_add_col_to_order_table', 57),
(106, '2021_10_07_172701_add_col_cart_shop_info', 57),
(107, '2021_10_07_184442_create_phone_or_email_verifications_table', 57),
(108, '2021_10_07_185416_add_user_table_email_verified', 57),
(109, '2021_10_11_192739_add_transaction_amount_table', 57),
(110, '2021_10_11_200850_add_order_verification_code', 57),
(111, '2021_10_12_083241_add_col_to_order_transaction', 57),
(112, '2021_10_12_084440_add_seller_id_to_order', 57),
(113, '2021_10_12_102853_change_col_type', 57),
(114, '2021_10_12_110434_add_col_to_admin_wallet', 57),
(115, '2021_10_12_110829_add_col_to_seller_wallet', 57),
(116, '2021_10_13_091801_add_col_to_admin_wallets', 57),
(117, '2021_10_13_092000_add_col_to_seller_wallets_tax', 57),
(118, '2021_10_13_165947_rename_and_remove_col_seller_wallet', 57),
(119, '2021_10_13_170258_rename_and_remove_col_admin_wallet', 57),
(120, '2021_10_14_061603_column_update_order_transaction', 57),
(121, '2021_10_15_103339_remove_col_from_seller_wallet', 57),
(122, '2021_10_15_104419_add_id_col_order_tran', 57),
(123, '2021_10_15_213454_update_string_limit', 57),
(124, '2021_10_16_234037_change_col_type_translation', 57),
(125, '2021_10_16_234329_change_col_type_translation_1', 57),
(126, '2021_10_27_091250_add_shipping_address_in_order', 58),
(127, '2021_01_24_205114_create_paytabs_invoices_table', 59),
(128, '2021_11_20_043814_change_pass_reset_email_col', 59),
(129, '2021_11_25_043109_create_delivery_men_table', 60),
(130, '2021_11_25_062242_add_auth_token_delivery_man', 60),
(131, '2021_11_27_043405_add_deliveryman_in_order_table', 60),
(132, '2021_11_27_051432_create_delivery_histories_table', 60),
(133, '2021_11_27_051512_add_fcm_col_for_delivery_man', 60),
(134, '2021_12_15_123216_add_columns_to_banner', 60),
(135, '2022_01_04_100543_add_order_note_to_orders_table', 60),
(136, '2022_01_10_034952_add_lat_long_to_shipping_addresses_table', 60),
(137, '2022_01_10_045517_create_billing_addresses_table', 60),
(138, '2022_01_11_040755_add_is_billing_to_shipping_addresses_table', 60),
(139, '2022_01_11_053404_add_billing_to_orders_table', 60),
(140, '2022_01_11_234310_add_firebase_toke_to_sellers_table', 60),
(141, '2022_01_16_121801_change_colu_type', 60),
(142, '2022_01_22_101601_change_cart_col_type', 61),
(143, '2022_01_23_031359_add_column_to_orders_table', 61),
(144, '2022_01_28_235054_add_status_to_admins_table', 61),
(145, '2022_02_01_214654_add_pos_status_to_sellers_table', 61),
(146, '2019_12_14_000001_create_personal_access_tokens_table', 62),
(147, '2022_02_11_225355_add_checked_to_orders_table', 62),
(148, '2022_02_14_114359_create_refund_requests_table', 62),
(149, '2022_02_14_115757_add_refund_request_to_order_details_table', 62),
(150, '2022_02_15_092604_add_order_details_id_to_transactions_table', 62),
(151, '2022_02_15_121410_create_refund_transactions_table', 62),
(152, '2022_02_24_091236_add_multiple_column_to_refund_requests_table', 62),
(153, '2022_02_24_103827_create_refund_statuses_table', 62),
(154, '2022_03_01_121420_add_refund_id_to_refund_transactions_table', 62),
(155, '2022_03_10_091943_add_priority_to_categories_table', 63),
(156, '2022_03_13_111914_create_shipping_types_table', 63),
(157, '2022_03_13_121514_create_category_shipping_costs_table', 63),
(158, '2022_03_14_074413_add_four_column_to_products_table', 63),
(159, '2022_03_15_105838_add_shipping_to_carts_table', 63),
(160, '2022_03_16_070327_add_shipping_type_to_orders_table', 63),
(161, '2022_03_17_070200_add_delivery_info_to_orders_table', 63),
(162, '2022_03_18_143339_add_shipping_type_to_carts_table', 63),
(163, '2022_04_06_020313_create_subscriptions_table', 64),
(164, '2022_04_12_233704_change_column_to_products_table', 64),
(165, '2022_04_19_095926_create_jobs_table', 64),
(166, '2022_05_12_104247_create_wallet_transactions_table', 65),
(167, '2022_05_12_104511_add_two_column_to_users_table', 65),
(168, '2022_05_14_063309_create_loyalty_point_transactions_table', 65),
(169, '2022_05_26_044016_add_user_type_to_password_resets_table', 65),
(170, '2022_04_15_235820_add_provider', 66),
(171, '2022_07_21_101659_add_code_to_products_table', 66),
(172, '2022_07_26_103744_add_notification_count_to_notifications_table', 66),
(173, '2022_07_31_031541_add_minimum_order_qty_to_products_table', 66),
(174, '2022_08_11_172839_add_product_type_and_digital_product_type_and_digital_file_ready_to_products', 67),
(175, '2022_08_11_173941_add_product_type_and_digital_product_type_and_digital_file_to_order_details', 67),
(176, '2022_08_20_094225_add_product_type_and_digital_product_type_and_digital_file_ready_to_carts_table', 67),
(177, '2022_10_04_160234_add_banking_columns_to_delivery_men_table', 68),
(178, '2022_10_04_161339_create_deliveryman_wallets_table', 68),
(179, '2022_10_04_184506_add_deliverymanid_column_to_withdraw_requests_table', 68),
(180, '2022_10_11_103011_add_deliverymans_columns_to_chattings_table', 68),
(181, '2022_10_11_144902_add_deliverman_id_cloumn_to_reviews_table', 68),
(182, '2022_10_17_114744_create_order_status_histories_table', 68),
(183, '2022_10_17_120840_create_order_expected_delivery_histories_table', 68),
(184, '2022_10_18_084245_add_deliveryman_charge_and_expected_delivery_date', 68),
(185, '2022_10_18_130938_create_delivery_zip_codes_table', 68),
(186, '2022_10_18_130956_create_delivery_country_codes_table', 68),
(187, '2022_10_20_164712_create_delivery_man_transactions_table', 68),
(188, '2022_10_27_145604_create_emergency_contacts_table', 68),
(189, '2022_10_29_182930_add_is_pause_cause_to_orders_table', 68),
(190, '2022_10_31_150604_add_address_phone_country_code_column_to_delivery_men_table', 68),
(191, '2022_11_05_185726_add_order_id_to_reviews_table', 68),
(192, '2022_11_07_190749_create_deliveryman_notifications_table', 68),
(193, '2022_11_08_132745_change_transaction_note_type_to_withdraw_requests_table', 68),
(194, '2022_11_10_193747_chenge_order_amount_seller_amount_admin_commission_delivery_charge_tax_toorder_transactions_table', 68),
(195, '2022_12_17_035723_few_field_add_to_coupons_table', 69),
(196, '2022_12_26_231606_add_coupon_discount_bearer_and_admin_commission_to_orders', 69),
(197, '2023_01_04_003034_alter_billing_addresses_change_zip', 69),
(198, '2023_01_05_121600_change_id_to_transactions_table', 69),
(199, '2023_02_02_113330_create_product_tag_table', 70),
(200, '2023_02_02_114518_create_tags_table', 70),
(201, '2023_02_02_152248_add_tax_model_to_products_table', 70),
(202, '2023_02_02_152718_add_tax_model_to_order_details_table', 70),
(203, '2023_02_02_171034_add_tax_type_to_carts', 70),
(204, '2023_02_06_124447_add_color_image_column_to_products_table', 70),
(205, '2023_02_07_120136_create_withdrawal_methods_table', 70),
(206, '2023_02_07_175939_add_withdrawal_method_id_and_withdrawal_method_fields_to_withdraw_requests_table', 70),
(207, '2023_02_08_143314_add_vacation_start_and_vacation_end_and_vacation_not_column_to_shops_table', 70),
(208, '2023_02_09_104656_add_payment_by_and_payment_not_to_orders_table', 70),
(209, '2023_03_27_150723_add_expires_at_to_phone_or_email_verifications', 71),
(210, '2023_04_17_095721_create_shop_followers_table', 71),
(211, '2023_04_17_111249_add_bottom_banner_to_shops_table', 71),
(212, '2023_04_20_125423_create_product_compares_table', 71),
(213, '2023_04_30_165642_add_category_sub_category_and_sub_sub_category_add_in_product_table', 71),
(214, '2023_05_16_131006_add_expires_at_to_password_resets', 71),
(215, '2023_05_17_044243_add_visit_count_to_tags_table', 71),
(216, '2023_05_18_000403_add_title_and_subtitle_and_background_color_and_button_text_to_banners_table', 71),
(217, '2023_05_21_111300_add_login_hit_count_and_is_temp_blocked_and_temp_block_time_to_users_table', 71),
(218, '2023_05_21_111600_add_login_hit_count_and_is_temp_blocked_and_temp_block_time_to_phone_or_email_verifications_table', 71),
(219, '2023_05_21_112215_add_login_hit_count_and_is_temp_blocked_and_temp_block_time_to_password_resets_table', 71),
(220, '2023_06_04_210726_attachment_lenght_change_to_reviews_table', 71),
(221, '2023_06_05_115153_add_referral_code_and_referred_by_to_users_table', 72),
(222, '2023_06_21_002658_add_offer_banner_to_shops_table', 72),
(223, '2023_07_08_210747_create_most_demandeds_table', 72),
(224, '2023_07_31_111419_add_minimum_order_amount_to_sellers_table', 72),
(225, '2023_08_03_105256_create_offline_payment_methods_table', 72),
(226, '2023_08_07_131013_add_is_guest_column_to_carts_table', 72),
(227, '2023_08_07_170601_create_offline_payments_table', 72),
(228, '2023_08_12_102355_create_add_fund_bonus_categories_table', 72),
(229, '2023_08_12_215346_create_guest_users_table', 72),
(230, '2023_08_12_215659_add_is_guest_column_to_orders_table', 72),
(231, '2023_08_12_215933_add_is_guest_column_to_shipping_addresses_table', 72),
(232, '2023_08_15_000957_add_email_column_toshipping_address_table', 72),
(233, '2023_08_17_222330_add_identify_related_columns_to_admins_table', 72),
(234, '2023_08_20_230624_add_sent_by_and_send_to_in_notifications_table', 72),
(235, '2023_08_20_230911_create_notification_seens_table', 72),
(236, '2023_08_21_042331_add_theme_to_banners_table', 72),
(237, '2023_08_24_150009_add_free_delivery_over_amount_and_status_to_seller_table', 72),
(238, '2023_08_26_161214_add_is_shipping_free_to_orders_table', 72),
(239, '2023_08_26_173523_add_payment_method_column_to_wallet_transactions_table', 72),
(240, '2023_08_26_204653_add_verification_status_column_to_orders_table', 72),
(241, '2023_08_26_225113_create_order_delivery_verifications_table', 72),
(242, '2023_09_03_212200_add_free_delivery_responsibility_column_to_orders_table', 72),
(243, '2023_09_23_153314_add_shipping_responsibility_column_to_orders_table', 72),
(244, '2023_09_25_152733_create_digital_product_otp_verifications_table', 72),
(245, '2023_09_27_191638_add_attachment_column_to_support_ticket_convs_table', 73),
(246, '2023_10_01_205117_add_attachment_column_to_chattings_table', 73),
(247, '2023_10_07_182714_create_notification_messages_table', 73),
(248, '2023_10_21_113354_add_app_language_column_to_users_table', 73),
(249, '2023_10_21_123433_add_app_language_column_to_sellers_table', 73),
(250, '2023_10_21_124657_add_app_language_column_to_delivery_men_table', 73),
(251, '2023_10_22_130225_add_attachment_to_support_tickets_table', 73),
(252, '2023_10_25_113233_make_message_nullable_in_chattings_table', 73),
(253, '2023_10_30_152005_make_attachment_column_type_change_to_reviews_table', 73),
(254, '2024_01_14_192546_add_slug_to_shops_table', 74),
(255, '2024_01_25_175421_add_country_code_to_emergency_contacts_table', 75),
(256, '2024_02_01_200417_add_denied_count_and_approved_count_to_refund_requests_table', 75),
(257, '2024_03_11_130425_add_seen_notification_and_notification_receiver_to_chattings_table', 76),
(258, '2024_03_12_123322_update_images_column_in_refund_requests_table', 76),
(259, '2024_03_21_134659_change_denied_note_column_type_to_text', 76),
(260, '2024_04_03_093637_create_email_templates_table', 77),
(261, '2024_04_17_102137_add_is_checked_column_to_carts_table', 77),
(262, '2024_04_23_130436_create_vendor_registration_reasons_table', 77),
(263, '2024_04_24_093932_add_type_to_help_topics_table', 77),
(264, '2024_05_20_133216_create_review_replies_table', 78),
(265, '2024_05_20_163043_add_image_alt_text_to_brands_table', 78),
(266, '2024_05_26_152030_create_digital_product_variations_table', 78),
(267, '2024_05_26_152339_create_product_seos_table', 78),
(268, '2024_05_27_184401_add_digital_product_file_types_and_digital_product_extensions_to_products_table', 78),
(269, '2024_05_30_101603_create_storages_table', 78),
(270, '2024_06_10_174952_create_robots_meta_contents_table', 78),
(271, '2024_06_12_105137_create_error_logs_table', 78),
(272, '2024_07_03_130217_add_storage_type_columns_to_product_table', 78),
(273, '2024_07_03_153301_add_icon_storage_type_to_catogory_table', 78),
(274, '2024_07_03_171214_add_image_storage_type_to_brands_table', 78),
(275, '2024_07_03_185048_add_storage_type_columns_to_shop_table', 78),
(276, '2024_07_31_133306_create_login_setups_table', 79),
(277, '2024_08_04_123750_add_preview_file_to_products_table', 79),
(278, '2024_08_04_123805_create_authors_table', 79),
(279, '2024_08_04_123845_create_publishing_houses_table', 79),
(280, '2024_08_04_124023_create_digital_product_authors_table', 79),
(281, '2024_08_04_124046_create_digital_product_publishing_houses_table', 79),
(282, '2024_08_25_130313_modify_email_column_as_nullable_in_users_table', 79),
(283, '2024_08_26_130313_modify_token_column_as_text_in_phone_or_email_verifications_table', 79),
(284, '2024_10_01_130036_add_paid_amount_column_in_orders_table', 80),
(285, '2024_10_01_131352_create_restock_products_table', 80),
(286, '2024_10_01_132315_create_restock_product_customers_table', 80),
(290, '2025_02_18_165709_create_add_fund_bonus_categories_table', 0),
(291, '2025_02_18_165709_create_addon_settings_table', 0),
(292, '2025_02_18_165709_create_admin_roles_table', 0),
(293, '2025_02_18_165709_create_admin_wallet_histories_table', 0),
(294, '2025_02_18_165709_create_admin_wallets_table', 0),
(295, '2025_02_18_165709_create_admins_table', 0),
(296, '2025_02_18_165709_create_analytic_scripts_table', 0),
(297, '2025_02_18_165709_create_attributes_table', 0),
(298, '2025_02_18_165709_create_authors_table', 0),
(299, '2025_02_18_165709_create_banners_table', 0),
(300, '2025_02_18_165709_create_billing_addresses_table', 0),
(301, '2025_02_18_165709_create_brands_table', 0),
(302, '2025_02_18_165709_create_business_settings_table', 0),
(303, '2025_02_18_165709_create_cart_shippings_table', 0),
(304, '2025_02_18_165709_create_carts_table', 0),
(305, '2025_02_18_165709_create_categories_table', 0),
(306, '2025_02_18_165709_create_category_shipping_costs_table', 0),
(307, '2025_02_18_165709_create_chattings_table', 0),
(308, '2025_02_18_165709_create_colors_table', 0),
(309, '2025_02_18_165709_create_contacts_table', 0),
(310, '2025_02_18_165709_create_coupons_table', 0),
(311, '2025_02_18_165709_create_currencies_table', 0),
(312, '2025_02_18_165709_create_customer_wallet_histories_table', 0),
(313, '2025_02_18_165709_create_customer_wallets_table', 0),
(314, '2025_02_18_165709_create_deal_of_the_days_table', 0),
(315, '2025_02_18_165709_create_delivery_country_codes_table', 0),
(316, '2025_02_18_165709_create_delivery_histories_table', 0),
(317, '2025_02_18_165709_create_delivery_man_transactions_table', 0),
(318, '2025_02_18_165709_create_delivery_men_table', 0),
(319, '2025_02_18_165709_create_delivery_zip_codes_table', 0),
(320, '2025_02_18_165709_create_deliveryman_notifications_table', 0),
(321, '2025_02_18_165709_create_deliveryman_wallets_table', 0),
(322, '2025_02_18_165709_create_digital_product_authors_table', 0),
(323, '2025_02_18_165709_create_digital_product_otp_verifications_table', 0),
(324, '2025_02_18_165709_create_digital_product_publishing_houses_table', 0),
(325, '2025_02_18_165709_create_digital_product_variations_table', 0),
(326, '2025_02_18_165709_create_email_templates_table', 0),
(327, '2025_02_18_165709_create_emergency_contacts_table', 0),
(328, '2025_02_18_165709_create_error_logs_table', 0),
(329, '2025_02_18_165709_create_failed_jobs_table', 0),
(330, '2025_02_18_165709_create_feature_deals_table', 0),
(331, '2025_02_18_165709_create_flash_deal_products_table', 0),
(332, '2025_02_18_165709_create_flash_deals_table', 0),
(333, '2025_02_18_165709_create_guest_users_table', 0),
(334, '2025_02_18_165709_create_help_topics_table', 0),
(335, '2025_02_18_165709_create_jobs_table', 0),
(336, '2025_02_18_165709_create_login_setups_table', 0),
(337, '2025_02_18_165709_create_loyalty_point_transactions_table', 0),
(338, '2025_02_18_165709_create_most_demandeds_table', 0),
(339, '2025_02_18_165709_create_notification_messages_table', 0),
(340, '2025_02_18_165709_create_notification_seens_table', 0),
(341, '2025_02_18_165709_create_notifications_table', 0),
(342, '2025_02_18_165709_create_oauth_access_tokens_table', 0),
(343, '2025_02_18_165709_create_oauth_auth_codes_table', 0),
(344, '2025_02_18_165709_create_oauth_clients_table', 0),
(345, '2025_02_18_165709_create_oauth_personal_access_clients_table', 0),
(346, '2025_02_18_165709_create_oauth_refresh_tokens_table', 0),
(347, '2025_02_18_165709_create_offline_payment_methods_table', 0),
(348, '2025_02_18_165709_create_offline_payments_table', 0),
(349, '2025_02_18_165709_create_order_delivery_verifications_table', 0),
(350, '2025_02_18_165709_create_order_details_table', 0),
(351, '2025_02_18_165709_create_order_expected_delivery_histories_table', 0),
(352, '2025_02_18_165709_create_order_status_histories_table', 0),
(353, '2025_02_18_165709_create_order_transactions_table', 0),
(354, '2025_02_18_165709_create_orders_table', 0),
(355, '2025_02_18_165709_create_password_resets_table', 0),
(356, '2025_02_18_165709_create_payment_requests_table', 0),
(357, '2025_02_18_165709_create_paytabs_invoices_table', 0),
(358, '2025_02_18_165709_create_personal_access_tokens_table', 0),
(359, '2025_02_18_165709_create_phone_or_email_verifications_table', 0),
(360, '2025_02_18_165709_create_product_compares_table', 0),
(361, '2025_02_18_165709_create_product_seos_table', 0),
(362, '2025_02_18_165709_create_product_stocks_table', 0),
(363, '2025_02_18_165709_create_product_tag_table', 0),
(364, '2025_02_18_165709_create_products_table', 0),
(365, '2025_02_18_165709_create_publishing_houses_table', 0),
(366, '2025_02_18_165709_create_refund_requests_table', 0),
(367, '2025_02_18_165709_create_refund_statuses_table', 0),
(368, '2025_02_18_165709_create_refund_transactions_table', 0),
(369, '2025_02_18_165709_create_restock_product_customers_table', 0),
(370, '2025_02_18_165709_create_restock_products_table', 0),
(371, '2025_02_18_165709_create_review_replies_table', 0),
(372, '2025_02_18_165709_create_reviews_table', 0),
(373, '2025_02_18_165709_create_robots_meta_contents_table', 0),
(374, '2025_02_18_165709_create_search_functions_table', 0),
(375, '2025_02_18_165709_create_seller_wallet_histories_table', 0),
(376, '2025_02_18_165709_create_seller_wallets_table', 0),
(377, '2025_02_18_165709_create_sellers_table', 0),
(378, '2025_02_18_165709_create_shipping_addresses_table', 0),
(379, '2025_02_18_165709_create_shipping_methods_table', 0),
(380, '2025_02_18_165709_create_shipping_types_table', 0),
(381, '2025_02_18_165709_create_shop_followers_table', 0),
(382, '2025_02_18_165709_create_shops_table', 0),
(383, '2025_02_18_165709_create_social_medias_table', 0),
(384, '2025_02_18_165709_create_soft_credentials_table', 0),
(385, '2025_02_18_165709_create_stock_clearance_products_table', 0),
(386, '2025_02_18_165709_create_stock_clearance_setups_table', 0),
(387, '2025_02_18_165709_create_storages_table', 0),
(388, '2025_02_18_165709_create_subscriptions_table', 0),
(389, '2025_02_18_165709_create_support_ticket_convs_table', 0),
(390, '2025_02_18_165709_create_support_tickets_table', 0),
(391, '2025_02_18_165709_create_tags_table', 0),
(392, '2025_02_18_165709_create_transactions_table', 0),
(393, '2025_02_18_165709_create_translations_table', 0),
(394, '2025_02_18_165709_create_users_table', 0),
(395, '2025_02_18_165709_create_vendor_registration_reasons_table', 0),
(396, '2025_02_18_165709_create_wallet_transactions_table', 0),
(397, '2025_02_18_165709_create_wishlists_table', 0),
(398, '2025_02_18_165709_create_withdraw_requests_table', 0),
(399, '2025_02_18_165709_create_withdrawal_methods_table', 0),
(403, '2024_11_02_075917_create_stock_clearance_setups_table', 81),
(404, '2024_11_02_075931_create_stock_clearance_products_table', 81),
(405, '2024_11_04_162929_create_analytic_scripts_table', 81),
(406, '2025_11_24_162527_create_purchase_requisitions_table', 81),
(407, '2025_11_24_162537_create_purchase_requisition_items_table', 81),
(408, '2025_11_24_162546_create_purchase_orders_table', 81),
(409, '2025_11_24_162550_create_purchase_order_items_table', 81),
(410, '2025_11_24_162555_create_purchase_order_approvals_table', 81),
(411, '2025_11_24_162600_create_purchase_documents_table', 81),
(412, '2025_11_24_162606_create_purchase_grns_table', 81),
(413, '2025_11_24_162613_create_purchase_grn_items_table', 81),
(414, '2025_11_24_163002_create_purchase_invoices_table', 81),
(415, '2025_11_24_163009_create_purchase_invoice_items_table', 81),
(416, '2025_11_24_163014_create_purchase_events_table', 81),
(417, '2025_11_25_035443_create_purchase_vendors_table', 81),
(418, '2025_11_25_035447_create_purchase_vendor_contacts_table', 81),
(419, '2025_11_25_035450_create_purchase_vendor_metrics_table', 81),
(420, '2025_11_25_041347_create_purchase_approval_routes_table', 81),
(421, '2025_11_25_041351_create_purchase_approval_steps_table', 81),
(422, '2025_11_25_120000_create_purchase_order_communications_table', 81),
(423, '2025_11_25_131500_update_purchase_grn_schema', 81),
(424, '2025_11_25_140000_create_finance_accounts_table', 81),
(425, '2025_11_25_140100_create_finance_fiscal_periods_table', 81),
(426, '2025_11_25_140200_create_finance_journals_table', 81),
(427, '2025_11_25_140300_create_finance_journal_rows_table', 81),
(428, '2025_11_25_140400_create_finance_reconciliations_table', 81),
(429, '2025_11_25_140500_create_finance_reconciliation_rows_table', 81),
(430, '2025_11_25_140600_create_finance_expenses_table', 81),
(431, '2025_11_25_140700_create_finance_transfers_table', 81),
(432, '2025_11_25_140800_create_finance_attachments_table', 81),
(433, '2025_11_27_120000_add_finance_journal_id_columns', 82),
(434, '2025_11_27_130500_add_finance_journal_refs_to_purchase_tables', 82),
(435, '2025_11_27_140100_add_finance_journal_to_withdraw_requests', 82),
(436, '2025_11_27_150200_add_finance_journal_to_wallet_transactions', 82),
(437, '2025_11_27_160300_add_finance_journal_to_delivery_man_transactions', 82),
(438, '2025_11_28_120000_create_order_partial_payments_table', 83),
(439, '2025_11_28_130500_add_payment_account_code_to_order_partial_payments_table', 83),
(440, '2025_12_20_170153_create_add_fund_bonus_categories_table', 0),
(441, '2025_12_20_170153_create_addon_settings_table', 0),
(442, '2025_12_20_170153_create_admin_roles_table', 0),
(443, '2025_12_20_170153_create_admin_wallet_histories_table', 0),
(444, '2025_12_20_170153_create_admin_wallets_table', 0),
(445, '2025_12_20_170153_create_admins_table', 0),
(446, '2025_12_20_170153_create_analytic_scripts_table', 0),
(447, '2025_12_20_170153_create_attributes_table', 0),
(448, '2025_12_20_170153_create_authors_table', 0),
(449, '2025_12_20_170153_create_banners_table', 0),
(450, '2025_12_20_170153_create_billing_addresses_table', 0),
(451, '2025_12_20_170153_create_brands_table', 0),
(452, '2025_12_20_170153_create_business_settings_table', 0),
(453, '2025_12_20_170153_create_cart_shippings_table', 0),
(454, '2025_12_20_170153_create_carts_table', 0),
(455, '2025_12_20_170153_create_categories_table', 0),
(456, '2025_12_20_170153_create_category_shipping_costs_table', 0),
(457, '2025_12_20_170153_create_chattings_table', 0),
(458, '2025_12_20_170153_create_colors_table', 0),
(459, '2025_12_20_170153_create_contacts_table', 0),
(460, '2025_12_20_170153_create_coupons_table', 0),
(461, '2025_12_20_170153_create_currencies_table', 0),
(462, '2025_12_20_170153_create_customer_wallet_histories_table', 0),
(463, '2025_12_20_170153_create_customer_wallets_table', 0),
(464, '2025_12_20_170153_create_deal_of_the_days_table', 0),
(465, '2025_12_20_170153_create_delivery_country_codes_table', 0),
(466, '2025_12_20_170153_create_delivery_histories_table', 0),
(467, '2025_12_20_170153_create_delivery_man_transactions_table', 0),
(468, '2025_12_20_170153_create_delivery_men_table', 0),
(469, '2025_12_20_170153_create_delivery_zip_codes_table', 0),
(470, '2025_12_20_170153_create_deliveryman_notifications_table', 0),
(471, '2025_12_20_170153_create_deliveryman_wallets_table', 0),
(472, '2025_12_20_170153_create_digital_product_authors_table', 0),
(473, '2025_12_20_170153_create_digital_product_otp_verifications_table', 0),
(474, '2025_12_20_170153_create_digital_product_publishing_houses_table', 0),
(475, '2025_12_20_170153_create_digital_product_variations_table', 0),
(476, '2025_12_20_170153_create_email_templates_table', 0),
(477, '2025_12_20_170153_create_emergency_contacts_table', 0),
(478, '2025_12_20_170153_create_error_logs_table', 0),
(479, '2025_12_20_170153_create_failed_jobs_table', 0),
(480, '2025_12_20_170153_create_feature_deals_table', 0),
(481, '2025_12_20_170153_create_finance_accounts_table', 0),
(482, '2025_12_20_170153_create_finance_attachments_table', 0),
(483, '2025_12_20_170153_create_finance_expenses_table', 0),
(484, '2025_12_20_170153_create_finance_fiscal_periods_table', 0),
(485, '2025_12_20_170153_create_finance_journal_rows_table', 0),
(486, '2025_12_20_170153_create_finance_journals_table', 0),
(487, '2025_12_20_170153_create_finance_reconciliation_rows_table', 0),
(488, '2025_12_20_170153_create_finance_reconciliations_table', 0),
(489, '2025_12_20_170153_create_finance_transfers_table', 0),
(490, '2025_12_20_170153_create_flash_deal_products_table', 0),
(491, '2025_12_20_170153_create_flash_deals_table', 0),
(492, '2025_12_20_170153_create_guest_users_table', 0),
(493, '2025_12_20_170153_create_help_topics_table', 0),
(494, '2025_12_20_170153_create_jobs_table', 0),
(495, '2025_12_20_170153_create_login_setups_table', 0),
(496, '2025_12_20_170153_create_loyalty_point_transactions_table', 0),
(497, '2025_12_20_170153_create_most_demandeds_table', 0),
(498, '2025_12_20_170153_create_notification_messages_table', 0),
(499, '2025_12_20_170153_create_notification_seens_table', 0),
(500, '2025_12_20_170153_create_notifications_table', 0),
(501, '2025_12_20_170153_create_oauth_access_tokens_table', 0),
(502, '2025_12_20_170153_create_oauth_auth_codes_table', 0),
(503, '2025_12_20_170153_create_oauth_clients_table', 0),
(504, '2025_12_20_170153_create_oauth_personal_access_clients_table', 0),
(505, '2025_12_20_170153_create_oauth_refresh_tokens_table', 0),
(506, '2025_12_20_170153_create_offline_payment_methods_table', 0),
(507, '2025_12_20_170153_create_offline_payments_table', 0),
(508, '2025_12_20_170153_create_order_delivery_verifications_table', 0),
(509, '2025_12_20_170153_create_order_details_table', 0),
(510, '2025_12_20_170153_create_order_expected_delivery_histories_table', 0),
(511, '2025_12_20_170153_create_order_partial_payments_table', 0),
(512, '2025_12_20_170153_create_order_status_histories_table', 0),
(513, '2025_12_20_170153_create_order_transactions_table', 0),
(514, '2025_12_20_170153_create_orders_table', 0),
(515, '2025_12_20_170153_create_password_resets_table', 0),
(516, '2025_12_20_170153_create_payment_requests_table', 0),
(517, '2025_12_20_170153_create_paytabs_invoices_table', 0),
(518, '2025_12_20_170153_create_personal_access_tokens_table', 0),
(519, '2025_12_20_170153_create_phone_or_email_verifications_table', 0),
(520, '2025_12_20_170153_create_product_compares_table', 0),
(521, '2025_12_20_170153_create_product_seos_table', 0),
(522, '2025_12_20_170153_create_product_stocks_table', 0),
(523, '2025_12_20_170153_create_product_tag_table', 0),
(524, '2025_12_20_170153_create_products_table', 0),
(525, '2025_12_20_170153_create_publishing_houses_table', 0),
(526, '2025_12_20_170153_create_purchase_approval_routes_table', 0),
(527, '2025_12_20_170153_create_purchase_approval_steps_table', 0),
(528, '2025_12_20_170153_create_purchase_documents_table', 0),
(529, '2025_12_20_170153_create_purchase_events_table', 0),
(530, '2025_12_20_170153_create_purchase_grn_events_table', 0),
(531, '2025_12_20_170153_create_purchase_grn_items_table', 0),
(532, '2025_12_20_170153_create_purchase_grn_return_items_table', 0),
(533, '2025_12_20_170153_create_purchase_grn_returns_table', 0),
(534, '2025_12_20_170153_create_purchase_grns_table', 0),
(535, '2025_12_20_170153_create_purchase_invoice_items_table', 0),
(536, '2025_12_20_170153_create_purchase_invoices_table', 0),
(537, '2025_12_20_170153_create_purchase_order_approvals_table', 0),
(538, '2025_12_20_170153_create_purchase_order_communications_table', 0),
(539, '2025_12_20_170153_create_purchase_order_items_table', 0),
(540, '2025_12_20_170153_create_purchase_orders_table', 0),
(541, '2025_12_20_170153_create_purchase_requisition_items_table', 0),
(542, '2025_12_20_170153_create_purchase_requisitions_table', 0),
(543, '2025_12_20_170153_create_purchase_vendor_contacts_table', 0),
(544, '2025_12_20_170153_create_purchase_vendor_metrics_table', 0),
(545, '2025_12_20_170153_create_purchase_vendors_table', 0),
(546, '2025_12_20_170153_create_refund_requests_table', 0),
(547, '2025_12_20_170153_create_refund_statuses_table', 0),
(548, '2025_12_20_170153_create_refund_transactions_table', 0),
(549, '2025_12_20_170153_create_restock_product_customers_table', 0),
(550, '2025_12_20_170153_create_restock_products_table', 0),
(551, '2025_12_20_170153_create_review_replies_table', 0),
(552, '2025_12_20_170153_create_reviews_table', 0),
(553, '2025_12_20_170153_create_robots_meta_contents_table', 0),
(554, '2025_12_20_170153_create_search_functions_table', 0),
(555, '2025_12_20_170153_create_seller_wallet_histories_table', 0),
(556, '2025_12_20_170153_create_seller_wallets_table', 0),
(557, '2025_12_20_170153_create_sellers_table', 0),
(558, '2025_12_20_170153_create_shipping_addresses_table', 0),
(559, '2025_12_20_170153_create_shipping_methods_table', 0),
(560, '2025_12_20_170153_create_shipping_types_table', 0),
(561, '2025_12_20_170153_create_shop_followers_table', 0),
(562, '2025_12_20_170153_create_shops_table', 0),
(563, '2025_12_20_170153_create_social_medias_table', 0),
(564, '2025_12_20_170153_create_soft_credentials_table', 0),
(565, '2025_12_20_170153_create_stock_clearance_products_table', 0),
(566, '2025_12_20_170153_create_stock_clearance_setups_table', 0),
(567, '2025_12_20_170153_create_storages_table', 0),
(568, '2025_12_20_170153_create_subscriptions_table', 0),
(569, '2025_12_20_170153_create_support_ticket_convs_table', 0),
(570, '2025_12_20_170153_create_support_tickets_table', 0),
(571, '2025_12_20_170153_create_tags_table', 0),
(572, '2025_12_20_170153_create_transactions_table', 0),
(573, '2025_12_20_170153_create_translations_table', 0),
(574, '2025_12_20_170153_create_users_table', 0),
(575, '2025_12_20_170153_create_vendor_registration_reasons_table', 0),
(576, '2025_12_20_170153_create_wallet_transactions_table', 0),
(577, '2025_12_20_170153_create_wishlists_table', 0),
(578, '2025_12_20_170153_create_withdraw_requests_table', 0),
(579, '2025_12_20_170153_create_withdrawal_methods_table', 0);

-- --------------------------------------------------------

--
-- Table structure for table `most_demandeds`
--

DROP TABLE IF EXISTS `most_demandeds`;
CREATE TABLE IF NOT EXISTS `most_demandeds` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sent_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'system',
  `sent_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_count` int NOT NULL DEFAULT '0',
  `image` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_messages`
--

DROP TABLE IF EXISTS `notification_messages`;
CREATE TABLE IF NOT EXISTS `notification_messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_messages`
--

INSERT INTO `notification_messages` (`id`, `user_type`, `key`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'customer', 'order_pending_message', 'order pen message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(2, 'customer', 'order_confirmation_message', 'Order con Message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(3, 'customer', 'order_processing_message', 'Order pro Message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(4, 'customer', 'out_for_delivery_message', 'Order ouut Message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(5, 'customer', 'order_delivered_message', 'Order del Message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(6, 'customer', 'order_returned_message', 'Order hh Message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(7, 'customer', 'order_failed_message', 'Order fa Message', 0, '2023-10-30 11:02:55', '2024-10-27 08:14:24'),
(8, 'customer', 'order_canceled', '', 0, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(9, 'customer', 'order_refunded_message', 'customize your order refunded message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(10, 'customer', 'refund_request_canceled_message', 'customize your refund request canceled message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(11, 'customer', 'message_from_delivery_man', 'customize your message from delivery man message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(12, 'customer', 'message_from_seller', 'customize your message from seller message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(13, 'customer', 'fund_added_by_admin_message', 'customize your fund added by admin message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(14, 'seller', 'new_order_message', 'customize your new order message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(15, 'seller', 'refund_request_message', 'customize your refund request message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(16, 'seller', 'order_edit_message', 'customize your order edit message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(17, 'seller', 'withdraw_request_status_message', 'customize your withdraw request status message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(18, 'seller', 'message_from_customer', 'customize your message from customer message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(19, 'seller', 'delivery_man_assign_by_admin_message', 'customize your delivery man assign by admin message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(20, 'seller', 'order_delivered_message', 'customize your order delivered message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(21, 'seller', 'order_canceled', 'customize your order canceled message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(22, 'seller', 'order_refunded_message', 'customize your order refunded message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(23, 'seller', 'refund_request_canceled_message', 'customize your refund request canceled message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(24, 'seller', 'refund_request_status_changed_by_admin', 'customize your refund request status changed by admin message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(25, 'delivery_man', 'new_order_assigned_message', '', 0, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(26, 'delivery_man', 'expected_delivery_date', '', 0, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(27, 'delivery_man', 'delivery_man_charge', 'customize your delivery man charge message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(28, 'delivery_man', 'order_canceled', 'customize your order canceled message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(29, 'delivery_man', 'order_rescheduled_message', 'customize your order rescheduled message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(30, 'delivery_man', 'order_edit_message', 'customize your order edit message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(31, 'delivery_man', 'message_from_seller', 'customize your message from seller message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(32, 'delivery_man', 'message_from_admin', 'customize your message from admin message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(33, 'delivery_man', 'message_from_customer', 'customize your message from customer message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(34, 'delivery_man', 'cash_collect_by_admin_message', 'customize your cash collect by admin message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(35, 'delivery_man', 'cash_collect_by_seller_message', 'customize your cash collect by seller message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(36, 'delivery_man', 'withdraw_request_status_message', 'customize your withdraw request status message message', 1, '2023-10-30 11:02:55', '2023-10-30 11:02:55'),
(37, 'seller', 'product_request_approved_message', 'customize your product request approved message message', 1, '2024-02-19 08:35:38', '2024-02-19 08:35:38'),
(38, 'seller', 'product_request_rejected_message', 'customize your product request rejected message message', 1, '2024-02-19 08:35:38', '2024-02-19 08:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `notification_seens`
--

DROP TABLE IF EXISTS `notification_seens`;
CREATE TABLE IF NOT EXISTS `notification_seens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `notification_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('6840b7d4ed685bf2e0dc593affa0bd3b968065f47cc226d39ab09f1422b5a1d9666601f3f60a79c1', 98, 1, 'LaravelAuthApp', '[]', 1, '2021-07-05 09:25:41', '2021-07-05 09:25:41', '2022-07-05 15:25:41'),
('c42cdd5ae652b8b2cbac4f2f4b496e889e1a803b08672954c8bbe06722b54160e71dce3e02331544', 98, 1, 'LaravelAuthApp', '[]', 1, '2021-07-05 09:24:36', '2021-07-05 09:24:36', '2022-07-05 15:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `client_id` int UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`, `provider`) VALUES
(1, NULL, '6amtech', 'GEUx5tqkviM6AAQcz4oi1dcm1KtRdJPgw41lj0eI', 'http://localhost', 1, 0, 0, '2020-10-21 18:27:22', '2020-10-21 18:27:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-10-21 18:27:23', '2020-10-21 18:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offline_payments`
--

DROP TABLE IF EXISTS `offline_payments`;
CREATE TABLE IF NOT EXISTS `offline_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `payment_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `offline_payment_methods`
--

DROP TABLE IF EXISTS `offline_payment_methods`;
CREATE TABLE IF NOT EXISTS `offline_payment_methods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_informations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint NOT NULL DEFAULT '0',
  `customer_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `order_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_ref` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci,
  `order_amount` double NOT NULL DEFAULT '0',
  `paid_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `admin_commission` decimal(8,2) NOT NULL DEFAULT '0.00',
  `is_pause` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `cause` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_amount` double NOT NULL DEFAULT '0',
  `discount_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_discount_bearer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inhouse',
  `shipping_responsibility` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method_id` bigint NOT NULL DEFAULT '0',
  `shipping_cost` double(8,2) NOT NULL DEFAULT '0.00',
  `is_shipping_free` tinyint(1) NOT NULL DEFAULT '0',
  `order_group_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'def-order-group',
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `verification_status` tinyint NOT NULL DEFAULT '0',
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `seller_id` bigint DEFAULT NULL,
  `seller_is` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address_data` text COLLATE utf8mb4_unicode_ci,
  `delivery_man_id` bigint DEFAULT NULL,
  `deliveryman_charge` double NOT NULL DEFAULT '0',
  `expected_delivery_date` date DEFAULT NULL,
  `order_note` text COLLATE utf8mb4_unicode_ci,
  `billing_address` bigint UNSIGNED DEFAULT NULL,
  `billing_address_data` text COLLATE utf8mb4_unicode_ci,
  `order_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_type',
  `extra_discount` double(8,2) NOT NULL DEFAULT '0.00',
  `extra_discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_delivery_bearer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_service_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_party_delivery_tracking_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_delivery_verifications`
--

DROP TABLE IF EXISTS `order_delivery_verifications`;
CREATE TABLE IF NOT EXISTS `order_delivery_verifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `seller_id` bigint DEFAULT NULL,
  `digital_file_after_sell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_details` text COLLATE utf8mb4_unicode_ci,
  `qty` int NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `tax` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `tax_model` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclude',
  `delivery_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_method_id` bigint DEFAULT NULL,
  `variant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_stock_decreased` tinyint(1) NOT NULL DEFAULT '1',
  `refund_request` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_expected_delivery_histories`
--

DROP TABLE IF EXISTS `order_expected_delivery_histories`;
CREATE TABLE IF NOT EXISTS `order_expected_delivery_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expected_delivery_date` date NOT NULL,
  `cause` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_partial_payments`
--

DROP TABLE IF EXISTS `order_partial_payments`;
CREATE TABLE IF NOT EXISTS `order_partial_payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(24,2) NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_account_code` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_partial_payments_order_id_foreign` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status_histories`
--

DROP TABLE IF EXISTS `order_status_histories`;
CREATE TABLE IF NOT EXISTS `order_status_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cause` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_transactions`
--

DROP TABLE IF EXISTS `order_transactions`;
CREATE TABLE IF NOT EXISTS `order_transactions` (
  `seller_id` bigint NOT NULL,
  `order_id` bigint NOT NULL,
  `order_amount` decimal(50,2) NOT NULL DEFAULT '0.00',
  `seller_amount` decimal(50,2) NOT NULL DEFAULT '0.00',
  `admin_commission` decimal(50,2) NOT NULL DEFAULT '0.00',
  `received_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge` decimal(50,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(50,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` bigint DEFAULT NULL,
  `seller_is` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `identity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_hit_count` tinyint NOT NULL DEFAULT '0',
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`identity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

DROP TABLE IF EXISTS `payment_requests`;
CREATE TABLE IF NOT EXISTS `payment_requests` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_amount` decimal(24,2) NOT NULL DEFAULT '0.00',
  `gateway_callback_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_hook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failure_hook` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payer_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `external_redirect_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `attribute_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paytabs_invoices`
--

DROP TABLE IF EXISTS `paytabs_invoices`;
CREATE TABLE IF NOT EXISTS `paytabs_invoices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_code` int UNSIGNED NOT NULL,
  `pt_invoice_id` int UNSIGNED DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` int UNSIGNED DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_first_six_digits` int UNSIGNED DEFAULT NULL,
  `card_last_four_digits` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_or_email_verifications`
--

DROP TABLE IF EXISTS `phone_or_email_verifications`;
CREATE TABLE IF NOT EXISTS `phone_or_email_verifications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone_or_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `otp_hit_count` tinyint NOT NULL DEFAULT '0',
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint DEFAULT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'physical',
  `category_ids` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_sub_category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` bigint DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_qty` int NOT NULL DEFAULT '1',
  `refundable` tinyint(1) NOT NULL DEFAULT '1',
  `digital_product_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `digital_file_ready` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `digital_file_ready_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `color_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `preview_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_file_storage_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `featured` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flash_deal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_provider` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colors` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variant_product` tinyint(1) NOT NULL DEFAULT '0',
  `attributes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choice_options` text COLLATE utf8mb4_unicode_ci,
  `variation` text COLLATE utf8mb4_unicode_ci,
  `digital_product_file_types` longtext COLLATE utf8mb4_unicode_ci,
  `digital_product_extensions` longtext COLLATE utf8mb4_unicode_ci,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `unit_price` double NOT NULL DEFAULT '0',
  `purchase_price` double NOT NULL DEFAULT '0',
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `tax_type` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_model` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'exclude',
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `discount_type` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_stock` int DEFAULT NULL,
  `minimum_order_qty` int NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `free_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `featured_status` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_status` tinyint(1) NOT NULL DEFAULT '0',
  `denied_note` text COLLATE utf8mb4_unicode_ci,
  `shipping_cost` double(8,2) DEFAULT NULL,
  `multiply_qty` tinyint(1) DEFAULT NULL,
  `temp_shipping_cost` double(8,2) DEFAULT NULL,
  `is_shipping_cost_updated` tinyint(1) DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `added_by`, `user_id`, `name`, `slug`, `product_type`, `category_ids`, `category_id`, `sub_category_id`, `sub_sub_category_id`, `brand_id`, `unit`, `min_qty`, `refundable`, `digital_product_type`, `digital_file_ready`, `digital_file_ready_storage_type`, `images`, `color_image`, `thumbnail`, `thumbnail_storage_type`, `preview_file`, `preview_file_storage_type`, `featured`, `flash_deal`, `video_provider`, `video_url`, `colors`, `variant_product`, `attributes`, `choice_options`, `variation`, `digital_product_file_types`, `digital_product_extensions`, `published`, `unit_price`, `purchase_price`, `tax`, `tax_type`, `tax_model`, `discount`, `discount_type`, `current_stock`, `minimum_order_qty`, `details`, `free_shipping`, `attachment`, `created_at`, `updated_at`, `status`, `featured_status`, `meta_title`, `meta_description`, `meta_image`, `request_status`, `denied_note`, `shipping_cost`, `multiply_qty`, `temp_shipping_cost`, `is_shipping_cost_updated`, `code`) VALUES
(1, 'admin', 1, 'Batik Bloom Saree', 'batik-bloom-saree-i4e3TK', 'physical', '[{\"id\":\"5\",\"position\":1}]', '5', NULL, NULL, NULL, 'pc', 1, 0, NULL, NULL, 'public', '[{\"image_name\":\"2025-12-17-6942d024eea40.webp\",\"storage\":\"public\"}]', '[]', '2025-12-17-6942d0250cbd7.webp', 'public', NULL, 'public', '1', NULL, 'youtube', NULL, '[]', 0, 'null', '[]', '[]', '[]', '[]', 0, 1500, 0, '0', 'percent', 'exclude', '0', 'percent', 10, 1, 'hhhhh', 0, NULL, '2025-12-17 15:35:37', '2025-12-17 15:45:49', 1, 0, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, '3N0YFA'),
(2, 'admin', 1, 'Glimmer Party Saree', 'glimmer-party-saree-CSkeAG', 'physical', '[{\"id\":\"4\",\"position\":1}]', '4', NULL, NULL, NULL, 'pc', 1, 0, NULL, NULL, 'public', '[{\"image_name\":\"2025-12-17-6942cfdb755bb.webp\",\"storage\":\"public\"}]', '[]', '2025-12-17-6942cfdb7e82f.webp', 'public', NULL, 'public', '1', NULL, 'youtube', NULL, '[]', 0, 'null', '[]', '[]', '[]', '[]', 0, 1200, 0, '0', 'percent', 'exclude', '0', 'percent', 10, 1, 'hhhhh', 0, NULL, '2025-12-17 15:35:37', '2025-12-17 15:44:36', 1, 0, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, 'X2VDDI'),
(3, 'admin', 1, 'Cotton Serenity Saree', 'cotton-serenity-saree-XLE3tH', 'physical', '[{\"id\":\"3\",\"position\":1}]', '3', NULL, NULL, NULL, 'pc', 1, 0, NULL, NULL, 'public', '[{\"image_name\":\"2025-12-17-6942cf4163afc.webp\",\"storage\":\"public\"}]', '[]', '2025-12-17-6942cf4166a25.webp', 'public', NULL, 'public', '1', NULL, 'youtube', NULL, '[]', 0, 'null', '[]', '[]', '[]', '[]', 0, 1350, 0, '0', 'percent', 'exclude', '0', 'percent', 10, 1, 'hhhhh', 0, NULL, '2025-12-17 15:35:37', '2025-12-17 15:42:48', 1, 0, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, 'YFI9VD'),
(4, 'admin', 1, 'Banarasi Bliss Saree', 'banarasi-bliss-saree-sr4b7q', 'physical', '[{\"id\":\"2\",\"position\":1}]', '2', NULL, NULL, NULL, 'pc', 1, 0, NULL, NULL, 'public', '[{\"image_name\":\"2025-12-17-6942cf011f3cb.webp\",\"storage\":\"public\"}]', '[]', '2025-12-17-6942cf01db7e6.webp', 'public', NULL, 'public', '1', NULL, 'youtube', NULL, '[]', 0, 'null', '[]', '[]', '[]', '[]', 0, 1450, 0, '0', 'percent', 'exclude', '0', 'percent', 10, 1, 'hhhhh', 0, NULL, '2025-12-17 15:35:37', '2025-12-17 15:40:57', 1, 0, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, '5X3CY6'),
(5, 'admin', 1, 'Jamdani Lace Dream Saree', 'jamdani-lace-dream-saree-bJScPT', 'physical', '[{\"id\":\"1\",\"position\":1}]', '1', NULL, NULL, NULL, 'pc', 1, 0, NULL, NULL, 'public', '[{\"image_name\":\"2025-12-17-6942ce86249ad.webp\",\"storage\":\"public\"}]', '[]', '2025-12-17-6942ce8628736.webp', 'public', NULL, 'public', '1', NULL, 'youtube', NULL, '[]', 0, 'null', '[]', '[]', '[]', '[]', 0, 1000, 0, '0', 'percent', 'exclude', '0', 'percent', 10, 1, 'hhhhh', 0, NULL, '2025-12-17 15:35:37', '2025-12-17 15:39:20', 1, 0, NULL, NULL, NULL, 1, NULL, 0.00, 0, NULL, NULL, 'LQGG4I');

-- --------------------------------------------------------

--
-- Table structure for table `product_compares`
--

DROP TABLE IF EXISTS `product_compares`;
CREATE TABLE IF NOT EXISTS `product_compares` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL COMMENT 'customer_id',
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_seos`
--

DROP TABLE IF EXISTS `product_seos`;
CREATE TABLE IF NOT EXISTS `product_seos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_follow` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_image_index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_archive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_snippet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_snippet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_snippet_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_video_preview` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_video_preview_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_image_preview` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_image_preview_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_seos`
--

INSERT INTO `product_seos` (`id`, `product_id`, `title`, `description`, `index`, `no_follow`, `no_image_index`, `no_archive`, `no_snippet`, `max_snippet`, `max_snippet_value`, `max_video_preview`, `max_video_preview_value`, `max_image_preview`, `max_image_preview_value`, `image`, `created_at`, `updated_at`) VALUES
(1, 5, NULL, NULL, '', '', '', '', '0', '0', '-1', '0', '-1', '0', 'large', NULL, '2025-12-17 15:38:46', '2025-12-17 15:38:46'),
(2, 4, NULL, NULL, '', '', '', '', '0', '0', '-1', '0', '-1', '0', 'large', NULL, '2025-12-17 15:40:49', '2025-12-17 15:40:49'),
(3, 3, NULL, NULL, '', '', '', '', '0', '0', '-1', '0', '-1', '0', 'large', NULL, '2025-12-17 15:41:53', '2025-12-17 15:41:53'),
(4, 2, NULL, NULL, '', '', '', '', '0', '0', '-1', '0', '-1', '0', 'large', NULL, '2025-12-17 15:44:27', '2025-12-17 15:44:27'),
(5, 1, NULL, NULL, '', '', '', '', '0', '0', '-1', '0', '-1', '0', 'large', NULL, '2025-12-17 15:45:41', '2025-12-17 15:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

DROP TABLE IF EXISTS `product_stocks`;
CREATE TABLE IF NOT EXISTS `product_stocks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint DEFAULT NULL,
  `variant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE IF NOT EXISTS `product_tag` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishing_houses`
--

DROP TABLE IF EXISTS `publishing_houses`;
CREATE TABLE IF NOT EXISTS `publishing_houses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_approval_routes`
--

DROP TABLE IF EXISTS `purchase_approval_routes`;
CREATE TABLE IF NOT EXISTS `purchase_approval_routes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conditions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `priority` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_approval_routes_created_by_foreign` (`created_by`),
  KEY `purchase_approval_routes_updated_by_foreign` (`updated_by`),
  KEY `purchase_approval_routes_is_active_priority_index` (`is_active`,`priority`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_approval_steps`
--

DROP TABLE IF EXISTS `purchase_approval_steps`;
CREATE TABLE IF NOT EXISTS `purchase_approval_steps` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `route_id` bigint UNSIGNED NOT NULL,
  `step_order` tinyint UNSIGNED NOT NULL,
  `approver_id` bigint UNSIGNED DEFAULT NULL,
  `fallback_role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `threshold_amount` decimal(18,4) DEFAULT NULL,
  `auto_approve` tinyint(1) NOT NULL DEFAULT '0',
  `escalate_after_hours` int UNSIGNED DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_approval_steps_route_id_step_order_unique` (`route_id`,`step_order`),
  KEY `purchase_approval_steps_approver_id_foreign` (`approver_id`),
  KEY `purchase_approval_steps_created_by_foreign` (`created_by`),
  KEY `purchase_approval_steps_updated_by_foreign` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_documents`
--

DROP TABLE IF EXISTS `purchase_documents`;
CREATE TABLE IF NOT EXISTS `purchase_documents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `documentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` bigint UNSIGNED NOT NULL,
  `uploaded_by` bigint UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_documents_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`),
  KEY `purchase_documents_uploaded_by_foreign` (`uploaded_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_events`
--

DROP TABLE IF EXISTS `purchase_events`;
CREATE TABLE IF NOT EXISTS `purchase_events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `dispatched_at` timestamp NULL DEFAULT NULL,
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_events_event_type_status_index` (`event_type`,`status`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_grns`
--

DROP TABLE IF EXISTS `purchase_grns`;
CREATE TABLE IF NOT EXISTS `purchase_grns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `warehouse_id` bigint UNSIGNED DEFAULT NULL,
  `received_by` bigint UNSIGNED NOT NULL,
  `checked_by` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `inspection_score` decimal(5,2) DEFAULT NULL,
  `carrier` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reference` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments_count` int UNSIGNED NOT NULL DEFAULT '0',
  `inventory_sync_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `inventory_sync_payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `inventory_synced_at` timestamp NULL DEFAULT NULL,
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `received_at` timestamp NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_grns_code_unique` (`code`),
  KEY `purchase_grns_order_id_foreign` (`order_id`),
  KEY `purchase_grns_received_by_foreign` (`received_by`),
  KEY `purchase_grns_checked_by_foreign` (`checked_by`),
  KEY `purchase_grns_created_by_foreign` (`created_by`),
  KEY `purchase_grns_updated_by_foreign` (`updated_by`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_grn_events`
--

DROP TABLE IF EXISTS `purchase_grn_events`;
CREATE TABLE IF NOT EXISTS `purchase_grn_events` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `grn_id` bigint UNSIGNED NOT NULL,
  `event_type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_grn_events_created_by_foreign` (`created_by`),
  KEY `purchase_grn_events_grn_id_event_type_index` (`grn_id`,`event_type`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_grn_items`
--

DROP TABLE IF EXISTS `purchase_grn_items`;
CREATE TABLE IF NOT EXISTS `purchase_grn_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `grn_id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED NOT NULL,
  `uom` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `batch_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lot_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `received_qty` decimal(18,4) NOT NULL,
  `accepted_qty` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `rejected_qty` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `storage_location` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_numbers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `inspection_notes` text COLLATE utf8mb4_unicode_ci,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_grn_items_grn_id_foreign` (`grn_id`),
  KEY `purchase_grn_items_order_item_id_foreign` (`order_item_id`),
  KEY `purchase_grn_items_product_id_foreign` (`product_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_grn_returns`
--

DROP TABLE IF EXISTS `purchase_grn_returns`;
CREATE TABLE IF NOT EXISTS `purchase_grn_returns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `grn_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `initiated_by` bigint UNSIGNED NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `carrier` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_reason` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_grn_returns_grn_id_foreign` (`grn_id`),
  KEY `purchase_grn_returns_order_id_foreign` (`order_id`),
  KEY `purchase_grn_returns_vendor_id_foreign` (`vendor_id`),
  KEY `purchase_grn_returns_initiated_by_foreign` (`initiated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_grn_return_items`
--

DROP TABLE IF EXISTS `purchase_grn_return_items`;
CREATE TABLE IF NOT EXISTS `purchase_grn_return_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_id` bigint UNSIGNED NOT NULL,
  `grn_item_id` bigint UNSIGNED NOT NULL,
  `return_qty` decimal(18,4) NOT NULL,
  `disposition` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vendor',
  `restock_decision` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_grn_return_items_return_id_foreign` (`return_id`),
  KEY `purchase_grn_return_items_grn_item_id_foreign` (`grn_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoices`
--

DROP TABLE IF EXISTS `purchase_invoices`;
CREATE TABLE IF NOT EXISTS `purchase_invoices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `grn_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(18,6) NOT NULL DEFAULT '1.000000',
  `subtotal` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `tax_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `discount_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `freight_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `grand_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `match_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `match_variance` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `approved_by` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_invoices_code_unique` (`code`),
  KEY `purchase_invoices_order_id_foreign` (`order_id`),
  KEY `purchase_invoices_grn_id_foreign` (`grn_id`),
  KEY `purchase_invoices_approved_by_foreign` (`approved_by`),
  KEY `purchase_invoices_created_by_foreign` (`created_by`),
  KEY `purchase_invoices_updated_by_foreign` (`updated_by`),
  KEY `purchase_invoices_vendor_id_status_index` (`vendor_id`,`status`),
  KEY `purchase_invoices_match_status_index` (`match_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_items`
--

DROP TABLE IF EXISTS `purchase_invoice_items`;
CREATE TABLE IF NOT EXISTS `purchase_invoice_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint UNSIGNED NOT NULL,
  `order_item_id` bigint UNSIGNED DEFAULT NULL,
  `grn_item_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(18,4) NOT NULL,
  `unit_price` decimal(18,4) NOT NULL,
  `tax_amount` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `discount_amount` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `line_total` decimal(18,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_invoice_items_invoice_id_foreign` (`invoice_id`),
  KEY `purchase_invoice_items_order_item_id_foreign` (`order_item_id`),
  KEY `purchase_invoice_items_grn_item_id_foreign` (`grn_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisition_id` bigint UNSIGNED DEFAULT NULL,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `buyer_id` bigint UNSIGNED NOT NULL,
  `approval_route_id` bigint UNSIGNED DEFAULT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(18,6) NOT NULL DEFAULT '1.000000',
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `receiving_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_received',
  `received_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `payment_terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freight_cost` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `tax_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `subtotal` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `discount_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `grand_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `expected_delivery` date DEFAULT NULL,
  `notes_internal` text COLLATE utf8mb4_unicode_ci,
  `notes_vendor` text COLLATE utf8mb4_unicode_ci,
  `sent_at` timestamp NULL DEFAULT NULL,
  `last_receipt_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_orders_code_unique` (`code`),
  KEY `purchase_orders_buyer_id_foreign` (`buyer_id`),
  KEY `purchase_orders_approval_route_id_foreign` (`approval_route_id`),
  KEY `purchase_orders_created_by_foreign` (`created_by`),
  KEY `purchase_orders_updated_by_foreign` (`updated_by`),
  KEY `purchase_orders_vendor_id_status_index` (`vendor_id`,`status`),
  KEY `purchase_orders_status_index` (`status`),
  KEY `purchase_orders_requisition_id_index` (`requisition_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_approvals`
--

DROP TABLE IF EXISTS `purchase_order_approvals`;
CREATE TABLE IF NOT EXISTS `purchase_order_approvals` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `approvable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approvable_id` bigint UNSIGNED NOT NULL,
  `step` tinyint UNSIGNED NOT NULL,
  `approver_id` bigint UNSIGNED NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `acted_at` timestamp NULL DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `delegated_to` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_approvals_approvable_type_approvable_id_index` (`approvable_type`,`approvable_id`),
  KEY `purchase_order_approvals_delegated_to_foreign` (`delegated_to`),
  KEY `purchase_order_approvals_approver_id_status_index` (`approver_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_communications`
--

DROP TABLE IF EXISTS `purchase_order_communications`;
CREATE TABLE IF NOT EXISTS `purchase_order_communications` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `channel` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'queued',
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_communications_order_id_channel_index` (`order_id`,`channel`),
  KEY `purchase_order_communications_status_channel_index` (`status`,`channel`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
CREATE TABLE IF NOT EXISTS `purchase_order_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED NOT NULL,
  `requisition_item_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uom` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(18,4) NOT NULL,
  `received_qty` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `outstanding_qty` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `unit_price` decimal(18,4) NOT NULL,
  `tax_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `line_total` decimal(18,4) NOT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_items_order_id_foreign` (`order_id`),
  KEY `purchase_order_items_requisition_item_id_foreign` (`requisition_item_id`),
  KEY `purchase_order_items_product_id_index` (`product_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisitions`
--

DROP TABLE IF EXISTS `purchase_requisitions`;
CREATE TABLE IF NOT EXISTS `purchase_requisitions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requester_id` bigint UNSIGNED NOT NULL,
  `cost_center_id` bigint UNSIGNED DEFAULT NULL,
  `priority` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `needed_by` date DEFAULT NULL,
  `justification` text COLLATE utf8mb4_unicode_ci,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `tax_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `grand_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `approval_route_id` bigint UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_reason` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_requisitions_code_unique` (`code`),
  KEY `purchase_requisitions_created_by_foreign` (`created_by`),
  KEY `purchase_requisitions_updated_by_foreign` (`updated_by`),
  KEY `purchase_requisitions_requester_id_status_index` (`requester_id`,`status`),
  KEY `purchase_requisitions_status_needed_by_index` (`status`,`needed_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisition_items`
--

DROP TABLE IF EXISTS `purchase_requisition_items`;
CREATE TABLE IF NOT EXISTS `purchase_requisition_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `requisition_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uom` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` decimal(18,4) NOT NULL,
  `unit_price` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `line_total` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `delivery_date` date DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_requisition_items_requisition_id_foreign` (`requisition_id`),
  KEY `purchase_requisition_items_product_id_index` (`product_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_vendors`
--

DROP TABLE IF EXISTS `purchase_vendors`;
CREATE TABLE IF NOT EXISTS `purchase_vendors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `legal_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_terms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incoterm` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` char(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `lead_time_days` smallint UNSIGNED NOT NULL DEFAULT '0',
  `min_order_value` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` decimal(5,2) NOT NULL DEFAULT '0.00',
  `status` enum('draft','active','inactive','blacklisted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `contract_expires_at` date DEFAULT NULL,
  `compliance_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_vendors_code_unique` (`code`),
  KEY `purchase_vendors_status_category_index` (`status`,`category`),
  KEY `purchase_vendors_created_by_index` (`created_by`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_vendor_contacts`
--

DROP TABLE IF EXISTS `purchase_vendor_contacts`;
CREATE TABLE IF NOT EXISTS `purchase_vendor_contacts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `preferred_channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_vendor_contacts_vendor_id_is_primary_index` (`vendor_id`,`is_primary`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_vendor_metrics`
--

DROP TABLE IF EXISTS `purchase_vendor_metrics`;
CREATE TABLE IF NOT EXISTS `purchase_vendor_metrics` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED NOT NULL,
  `total_po_count` int UNSIGNED NOT NULL DEFAULT '0',
  `total_spend` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `on_time_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `quality_score` decimal(5,2) NOT NULL DEFAULT '0.00',
  `rejection_rate` decimal(5,2) NOT NULL DEFAULT '0.00',
  `last_po_date` timestamp NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_vendor_metrics_vendor_id_unique` (`vendor_id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

DROP TABLE IF EXISTS `refund_requests`;
CREATE TABLE IF NOT EXISTS `refund_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_details_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved_count` tinyint NOT NULL DEFAULT '0',
  `denied_count` tinyint NOT NULL DEFAULT '0',
  `amount` double(8,2) NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `refund_reason` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_note` longtext COLLATE utf8mb4_unicode_ci,
  `rejected_note` longtext COLLATE utf8mb4_unicode_ci,
  `payment_info` longtext COLLATE utf8mb4_unicode_ci,
  `change_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_statuses`
--

DROP TABLE IF EXISTS `refund_statuses`;
CREATE TABLE IF NOT EXISTS `refund_statuses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `refund_request_id` bigint UNSIGNED DEFAULT NULL,
  `change_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_by_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_transactions`
--

DROP TABLE IF EXISTS `refund_transactions`;
CREATE TABLE IF NOT EXISTS `refund_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `payment_for` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_id` bigint UNSIGNED DEFAULT NULL,
  `payment_receiver_id` bigint UNSIGNED DEFAULT NULL,
  `paid_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_details_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `refund_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restock_products`
--

DROP TABLE IF EXISTS `restock_products`;
CREATE TABLE IF NOT EXISTS `restock_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `variant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restock_product_customers`
--

DROP TABLE IF EXISTS `restock_product_customers`;
CREATE TABLE IF NOT EXISTS `restock_product_customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `restock_product_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `variant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `customer_id` bigint NOT NULL,
  `delivery_man_id` bigint DEFAULT NULL,
  `order_id` bigint DEFAULT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci,
  `attachment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `rating` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `is_saved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `review_replies`
--

DROP TABLE IF EXISTS `review_replies`;
CREATE TABLE IF NOT EXISTS `review_replies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `review_id` int NOT NULL,
  `added_by_id` int DEFAULT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'customer, seller, admin, deliveryman',
  `reply_text` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `robots_meta_contents`
--

DROP TABLE IF EXISTS `robots_meta_contents`;
CREATE TABLE IF NOT EXISTS `robots_meta_contents` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canonicals_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_follow` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_image_index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_archive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_snippet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_snippet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_snippet_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_video_preview` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_video_preview_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_image_preview` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_image_preview_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `search_functions`
--

DROP TABLE IF EXISTS `search_functions`;
CREATE TABLE IF NOT EXISTS `search_functions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visible_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_functions`
--

INSERT INTO `search_functions` (`id`, `key`, `url`, `visible_for`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'admin/dashboard', 'admin', NULL, NULL),
(2, 'Order All', 'admin/orders/list/all', 'admin', NULL, NULL),
(3, 'Order Pending', 'admin/orders/list/pending', 'admin', NULL, NULL),
(4, 'Order Processed', 'admin/orders/list/processed', 'admin', NULL, NULL),
(5, 'Order Delivered', 'admin/orders/list/delivered', 'admin', NULL, NULL),
(6, 'Order Returned', 'admin/orders/list/returned', 'admin', NULL, NULL),
(7, 'Order Failed', 'admin/orders/list/failed', 'admin', NULL, NULL),
(8, 'Brand Add', 'admin/brand/add-new', 'admin', NULL, NULL),
(9, 'Brand List', 'admin/brand/list', 'admin', NULL, NULL),
(10, 'Banner', 'admin/banner/list', 'admin', NULL, NULL),
(11, 'Category', 'admin/category/view', 'admin', NULL, NULL),
(12, 'Sub Category', 'admin/category/sub-category/view', 'admin', NULL, NULL),
(13, 'Sub sub category', 'admin/category/sub-sub-category/view', 'admin', NULL, NULL),
(14, 'Attribute', 'admin/attribute/view', 'admin', NULL, NULL),
(15, 'Product', 'admin/product/list', 'admin', NULL, NULL),
(16, 'Promotion', 'admin/coupon/add-new', 'admin', NULL, NULL),
(17, 'Custom Role', 'admin/custom-role/create', 'admin', NULL, NULL),
(18, 'Employee', 'admin/employee/add-new', 'admin', NULL, NULL),
(19, 'Seller', 'admin/sellers/seller-list', 'admin', NULL, NULL),
(20, 'Contacts', 'admin/contact/list', 'admin', NULL, NULL),
(21, 'Flash Deal', 'admin/deal/flash', 'admin', NULL, NULL),
(22, 'Deal of the day', 'admin/deal/day', 'admin', NULL, NULL),
(23, 'Language', 'admin/business-settings/language', 'admin', NULL, NULL),
(24, 'Mail', 'admin/business-settings/mail', 'admin', NULL, NULL),
(25, 'Shipping method', 'admin/business-settings/shipping-method/add', 'admin', NULL, NULL),
(26, 'Currency', 'admin/currency/view', 'admin', NULL, NULL),
(27, 'Payment method', 'admin/business-settings/payment-method', 'admin', NULL, NULL),
(28, 'SMS Gateway', 'admin/business-settings/sms-gateway', 'admin', NULL, NULL),
(29, 'Support Ticket', 'admin/support-ticket/view', 'admin', NULL, NULL),
(30, 'FAQ', 'admin/helpTopic/list', 'admin', NULL, NULL),
(31, 'About Us', 'admin/business-settings/about-us', 'admin', NULL, NULL),
(32, 'Terms and Conditions', 'admin/business-settings/terms-condition', 'admin', NULL, NULL),
(33, 'Web Config', 'admin/business-settings/web-config', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `f_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'def.png',
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` text COLLATE utf8mb4_unicode_ci,
  `sales_commission_percentage` double(8,2) DEFAULT NULL,
  `gst` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cm_firebase_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos_status` tinyint(1) NOT NULL DEFAULT '0',
  `minimum_order_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `free_delivery_status` int NOT NULL DEFAULT '0',
  `free_delivery_over_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `app_language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sellers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `f_name`, `l_name`, `phone`, `image`, `email`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `bank_name`, `branch`, `account_no`, `holder_name`, `auth_token`, `sales_commission_percentage`, `gst`, `cm_firebase_token`, `pos_status`, `minimum_order_amount`, `free_delivery_status`, `free_delivery_over_amount`, `app_language`) VALUES
(1, 'al imrun', 'khandakar', '01759412381', 'def.png', 'seller@seller.com', '$2y$10$uBvv.3oIwfeZut8/2RCQ9.yVpDWbvDZBwGPUAySB3qB/Ztfr2K67a', 'pending', 'HLxkkXTnCZ', '2025-11-27 23:46:11', '2025-11-27 23:46:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0.00, 0, 0.00, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `seller_wallets`
--

DROP TABLE IF EXISTS `seller_wallets`;
CREATE TABLE IF NOT EXISTS `seller_wallets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint DEFAULT NULL,
  `total_earning` double NOT NULL DEFAULT '0',
  `withdrawn` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission_given` double(8,2) NOT NULL DEFAULT '0.00',
  `pending_withdraw` double(8,2) NOT NULL DEFAULT '0.00',
  `delivery_charge_earned` double(8,2) NOT NULL DEFAULT '0.00',
  `collected_cash` double(8,2) NOT NULL DEFAULT '0.00',
  `total_tax_collected` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_wallet_histories`
--

DROP TABLE IF EXISTS `seller_wallet_histories`;
CREATE TABLE IF NOT EXISTS `seller_wallet_histories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `order_id` bigint DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_addresses`
--

DROP TABLE IF EXISTS `shipping_addresses`;
CREATE TABLE IF NOT EXISTS `shipping_addresses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guest` tinyint NOT NULL DEFAULT '0',
  `contact_person_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'home',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_billing` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

DROP TABLE IF EXISTS `shipping_methods`;
CREATE TABLE IF NOT EXISTS `shipping_methods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator_id` bigint DEFAULT NULL,
  `creator_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(8,2) NOT NULL DEFAULT '0.00',
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `creator_id`, `creator_type`, `title`, `cost`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'admin', 'Company Vehicle', 5.00, '2 Week', 0, '2021-05-25 20:57:04', '2025-11-28 01:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_types`
--

DROP TABLE IF EXISTS `shipping_types`;
CREATE TABLE IF NOT EXISTS `shipping_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint UNSIGNED DEFAULT NULL,
  `shipping_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_types`
--

INSERT INTO `shipping_types` (`id`, `seller_id`, `shipping_type`, `created_at`, `updated_at`) VALUES
(1, 0, 'order_wise', '2025-02-17 17:23:11', '2025-02-19 11:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

DROP TABLE IF EXISTS `shops`;
CREATE TABLE IF NOT EXISTS `shops` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'def.png',
  `image_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `bottom_banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottom_banner_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `offer_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_banner_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `vacation_start_date` date DEFAULT NULL,
  `vacation_end_date` date DEFAULT NULL,
  `vacation_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacation_status` tinyint NOT NULL DEFAULT '0',
  `temporary_close` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_storage_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_followers`
--

DROP TABLE IF EXISTS `shop_followers`;
CREATE TABLE IF NOT EXISTS `shop_followers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shop_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Customer ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_medias`
--

DROP TABLE IF EXISTS `social_medias`;
CREATE TABLE IF NOT EXISTS `social_medias` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_medias`
--

INSERT INTO `social_medias` (`id`, `name`, `link`, `icon`, `active_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'twitter', 'https://www.w3schools.com/howto/howto_css_table_responsive.asp', 'fa fa-twitter', 1, 1, '2020-12-31 21:18:03', '2020-12-31 21:18:25'),
(2, 'linkedin', 'https://linkedin.com/', 'fa fa-linkedin', 1, 1, '2021-02-27 16:23:01', '2021-02-27 16:23:05'),
(3, 'google-plus', 'https://google-plus.com/', 'fa fa-google-plus-square', 1, 1, '2021-02-27 16:23:30', '2021-02-27 16:23:33'),
(4, 'pinterest', 'https://pinterest.com/', 'fa fa-pinterest', 1, 1, '2021-02-27 16:24:14', '2021-02-27 16:24:26'),
(5, 'instagram', 'https://instagram.com/', 'fa fa-instagram', 1, 1, '2021-02-27 16:24:36', '2021-02-27 16:24:41'),
(6, 'facebook', 'https://facebook.com', 'fa fa-facebook', 1, 1, '2021-02-27 19:19:42', '2021-06-11 17:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `soft_credentials`
--

DROP TABLE IF EXISTS `soft_credentials`;
CREATE TABLE IF NOT EXISTS `soft_credentials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_clearance_products`
--

DROP TABLE IF EXISTS `stock_clearance_products`;
CREATE TABLE IF NOT EXISTS `stock_clearance_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int DEFAULT NULL,
  `setup_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `shop_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'percentage',
  `discount_amount` decimal(18,12) NOT NULL DEFAULT '0.000000000000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_clearance_setups`
--

DROP TABLE IF EXISTS `stock_clearance_setups`;
CREATE TABLE IF NOT EXISTS `stock_clearance_setups` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `setup_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `shop_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'percentage',
  `discount_amount` decimal(18,12) NOT NULL DEFAULT '0.000000000000',
  `offer_active_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_active_range_start` time DEFAULT NULL,
  `offer_active_range_end` time DEFAULT NULL,
  `show_in_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `show_in_homepage_once` tinyint(1) NOT NULL DEFAULT '0',
  `show_in_shop` tinyint(1) NOT NULL DEFAULT '1',
  `duration_start_date` timestamp NULL DEFAULT NULL,
  `duration_end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

DROP TABLE IF EXISTS `storages`;
CREATE TABLE IF NOT EXISTS `storages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `storages_data_id_index` (`data_id`),
  KEY `storages_value_index` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `data_type`, `data_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\DeliveryMan', '1', 'image', 'public', '2025-09-17 10:21:33', '2025-09-17 10:21:33'),
(2, 'App\\Models\\Banner', '1', 'photo', 'public', '2025-11-28 01:20:45', '2025-11-28 01:20:45'),
(3, 'App\\Models\\ProductSeo', '1', 'image', 'public', '2025-12-17 15:38:46', '2025-12-17 15:38:46'),
(4, 'App\\Models\\ProductSeo', '2', 'image', 'public', '2025-12-17 15:40:49', '2025-12-17 15:40:49'),
(5, 'App\\Models\\ProductSeo', '3', 'image', 'public', '2025-12-17 15:41:53', '2025-12-17 15:41:53'),
(6, 'App\\Models\\ProductSeo', '4', 'image', 'public', '2025-12-17 15:44:27', '2025-12-17 15:44:27'),
(7, 'App\\Models\\ProductSeo', '5', 'image', 'public', '2025-12-17 15:45:41', '2025-12-17 15:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint DEFAULT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `reply` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_convs`
--

DROP TABLE IF EXISTS `support_ticket_convs`;
CREATE TABLE IF NOT EXISTS `support_ticket_convs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `support_ticket_id` bigint DEFAULT NULL,
  `admin_id` bigint DEFAULT NULL,
  `customer_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `admin_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit_count` bigint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint DEFAULT NULL,
  `payment_for` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_id` bigint DEFAULT NULL,
  `payment_receiver_id` bigint DEFAULT NULL,
  `paid_by` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_to` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_details_id` bigint UNSIGNED DEFAULT NULL,
  UNIQUE KEY `transactions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `translationable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `translationable_id` bigint UNSIGNED NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `translations_translationable_id_index` (`translationable_id`),
  KEY `translations_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'def.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `street_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apartment_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cm_firebase_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `payment_card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_card_fawry_token` text COLLATE utf8mb4_unicode_ci,
  `login_medium` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT '0',
  `temporary_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `wallet_balance` double(8,2) DEFAULT NULL,
  `loyalty_point` double(8,2) DEFAULT NULL,
  `login_hit_count` tinyint NOT NULL DEFAULT '0',
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by` int DEFAULT NULL,
  `app_language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `f_name`, `l_name`, `phone`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `street_address`, `country`, `city`, `zip`, `house_no`, `apartment_no`, `cm_firebase_token`, `is_active`, `payment_card_last_four`, `payment_card_brand`, `payment_card_fawry_token`, `login_medium`, `social_id`, `is_phone_verified`, `temporary_token`, `is_email_verified`, `wallet_balance`, `loyalty_point`, `login_hit_count`, `is_temp_blocked`, `temp_block_time`, `referral_code`, `referred_by`, `app_language`) VALUES
(0, 'walking customer', 'walking', 'customer', '00000000000', 'def.png', 'walking@customer.com', NULL, ' ', NULL, NULL, '2022-02-03 03:46:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 'en');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_registration_reasons`
--

DROP TABLE IF EXISTS `vendor_registration_reasons`;
CREATE TABLE IF NOT EXISTS `vendor_registration_reasons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priority` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_registration_reasons`
--

INSERT INTO `vendor_registration_reasons` (`id`, `title`, `description`, `priority`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Millions of Users', 'Access a vast audience with millions of active users ready to buy your products.', 1, 1, NULL, NULL),
(2, 'Free Marketing', 'Benefit from our extensive, no-cost marketing efforts to boost your visibility and sales.', 2, 1, NULL, NULL),
(3, 'SEO Friendly', 'Enjoy enhanced search visibility with our SEO-friendly platform, driving more traffic to your listings.', 3, 1, NULL, NULL),
(4, '24/7 Support', 'Get round-the-clock support from our dedicated team to resolve any issues and assist you anytime.', 4, 1, NULL, NULL),
(5, 'Easy Onboarding', 'Start selling quickly with our user-friendly onboarding process designed to get you up and running fast.', 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
CREATE TABLE IF NOT EXISTS `wallet_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `transaction_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit` decimal(24,3) NOT NULL DEFAULT '0.000',
  `debit` decimal(24,3) NOT NULL DEFAULT '0.000',
  `admin_bonus` decimal(24,3) NOT NULL DEFAULT '0.000',
  `balance` decimal(24,3) NOT NULL DEFAULT '0.000',
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_methods`
--

DROP TABLE IF EXISTS `withdrawal_methods`;
CREATE TABLE IF NOT EXISTS `withdrawal_methods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `method_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint NOT NULL DEFAULT '0',
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

DROP TABLE IF EXISTS `withdraw_requests`;
CREATE TABLE IF NOT EXISTS `withdraw_requests` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint DEFAULT NULL,
  `delivery_man_id` bigint DEFAULT NULL,
  `admin_id` bigint DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.00',
  `withdrawal_method_id` bigint UNSIGNED DEFAULT NULL,
  `withdrawal_method_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `transaction_note` text COLLATE utf8mb4_unicode_ci,
  `finance_journal_id` bigint UNSIGNED DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
