-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 juin 2024 à 14:20
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `delivery_app_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `add_ons`
--

CREATE TABLE `add_ons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `add_ons`
--

INSERT INTO `add_ons` (`id`, `name`, `price`, `created_at`, `updated_at`, `description`, `image`, `quantity`) VALUES
(22, 'frites', 2.5, '2024-05-11 20:03:31', '2024-05-11 20:03:31', NULL, '2024-05-11-663f88c2dd9c4.png', NULL),
(23, 'Mayonnaise', 1, '2024-06-09 03:07:56', '2024-06-09 03:14:09', NULL, '2024-06-09-6664d7b111700.png', NULL),
(24, 'Ketchup', 1, '2024-06-09 03:09:23', '2024-06-09 03:10:08', NULL, '2024-06-09-6664d693ca5cd.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `f_name`, `l_name`, `phone`, `email`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'marwen', NULL, '24191285', 'marwen20@gmail.com', 'Capture-3-400x289.png', '$2y$10$WJ6M.T7MoPibi8CKEFxCn.5l6f6wzq8l3rV3J.u8s2.oWzMbMy9HK', '1LCB6oi7MSCa7C9SOaNMBB7b3uPHmzh3gEODUNgcs5RWaORRbfjSEqcrpGbM', '2024-03-03 16:17:15', '2024-03-03 21:23:44');

-- --------------------------------------------------------

--
-- Structure de la table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'size', '2024-03-24 00:45:23', '2024-06-09 00:05:09');

-- --------------------------------------------------------

--
-- Structure de la table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `email_verification` varchar(255) DEFAULT NULL,
  `blocked_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `branches`
--

INSERT INTO `branches` (`id`, `restaurant_id`, `name`, `email`, `password`, `address`, `status`, `created_at`, `updated_at`, `remember_token`, `l_name`, `phone`, `image`, `auth_token`, `email_verification`, `blocked_until`) VALUES
(53, NULL, 'shamsi', 'shamsi@hotmail.com', '$2y$10$3NgyTaLAw4HTgXVCzud2gOf6KFYyB6EX4AL6THPJRIcKluLE9NLqa', 'houmet souk', 1, '2024-05-08 20:54:13', '2024-05-08 20:54:13', NULL, 'borgi', '55888444', '2024-05-08-663ba0254afd9.png', NULL, NULL, NULL),
(54, NULL, 'yassine', 'yassine17@gmail.com', '$2y$10$FP61hceyUJzENrR3vFUOLO.AzKO/nvalQ4KRoKJBORhDagLFkq/zO', 'houmet souk', 1, '2024-05-08 20:55:23', '2024-05-12 18:35:16', NULL, 'faghim', '22555666', '2024-05-08-663ba06ba9ef6.png', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `business_settings`
--

INSERT INTO `business_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'restaurant_open_time', '08:00', '2021-01-06 05:55:51', '2021-01-06 05:55:51'),
(2, 'restaurant_close_time', '00:00', NULL, NULL),
(3, 'restaurant_name', 'tacostorens', NULL, NULL),
(4, 'currency', 'TND', NULL, NULL),
(5, 'logo', '2024-05-08-663badeca21fc.png', NULL, NULL),
(6, 'mail_config', '{\"name\":\"Delivery APP\",\"host\":\"mail.demo.com\",\"driver\":\"smtp\",\"port\":\"587\",\"username\":\"info@demo.com\",\"email_id\":\"info@demo.com\",\"encryption\":\"tls\",\"password\":\"demo\"}', NULL, '2021-07-25 14:38:13'),
(7, 'delivery_charge', '0', NULL, NULL),
(8, 'ssl_commerz_payment', '{\"status\":\"0\",\"store_id\":null,\"store_password\":null}', NULL, '2021-07-25 14:38:25'),
(9, 'paypal', '{\"status\":\"0\",\"paypal_client_id\":null,\"paypal_secret\":null}', NULL, '2021-07-25 14:38:48'),
(10, 'stripe', '{\"status\":\"0\",\"api_key\":null,\"published_key\":null}', NULL, '2021-07-25 14:38:57'),
(11, 'phone', '55889980', NULL, NULL),
(13, 'footer_text', 'Copyright', NULL, NULL),
(14, 'address', 'Houmet el Souk', NULL, NULL),
(15, 'email_address', 'marwen20@gmail.com', NULL, NULL),
(16, 'cash_on_delivery', '{\"status\":\"1\"}', NULL, '2021-02-11 18:39:36'),
(17, 'email_verification', NULL, NULL, NULL),
(18, 'digital_payment', '{\"status\":\"1\"}', '2021-01-30 19:38:54', '2021-01-30 19:38:58'),
(19, 'terms_and_conditions', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\"><h1>Terms and Condition</h1><p><br></p><ol><li>Hello, terms and conditions.......</li><li>Hello</li></ol></div><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', NULL, '2021-02-11 18:31:50'),
(20, 'fcm_topic', '', NULL, NULL),
(21, 'fcm_project_id', '3f34f34', NULL, NULL),
(22, 'push_notification_key', 'demo', NULL, NULL),
(24, 'order_pending_message', '{\"status\":1,\"message\":\"Your order has been placed successfully.\"}', NULL, NULL),
(25, 'order_processing_message', '{\"status\":1,\"message\":\"Your order is going to the cook\"}', NULL, NULL),
(26, 'out_for_delivery_message', '{\"status\":0,\"message\":\"Order out for delivery.\"}', NULL, NULL),
(27, 'order_delivered_message', '{\"status\":1,\"message\":\"delivered\"}', NULL, NULL),
(28, 'delivery_boy_assign_message', '{\"status\":1,\"message\":\"boy assigned\"}', NULL, NULL),
(29, 'delivery_boy_start_message', '{\"status\":1,\"message\":\"start delivery\"}', NULL, NULL),
(30, 'delivery_boy_delivered_message', '{\"status\":1,\"message\":\"boy delivered\"}', NULL, NULL),
(32, 'order_confirmation_msg', '{\"status\":1,\"message\":\"Your order has been confirmed.\"}', NULL, NULL),
(33, 'razor_pay', '{\"status\":\"0\",\"razor_key\":null,\"razor_secret\":null}', '2021-02-14 10:15:12', '2021-07-25 14:38:34'),
(34, 'location_coverage', '{\"status\":1,\"longitude\":\"91.410747\",\"latitude\":\"22.986282\",\"coverage\":\"20\"}', NULL, NULL),
(35, 'minimum_order_value', NULL, NULL, NULL),
(36, 'point_per_currency', NULL, NULL, NULL),
(37, 'internal_point', '{\"status\":null}', '2021-04-24 01:50:19', '2021-04-24 01:50:19'),
(38, 'senang_pay', '{\"status\":\"0\",\"secret_key\":null,\"merchant_id\":null}', '2021-04-24 01:58:21', '2021-07-25 14:39:23'),
(39, 'privacy_policy', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\" spellcheck=\"false\"><p>privacy policy</p></div><grammarly-extension data-grammarly-shadow-root=\"true\" style=\"position: absolute; top: 0px; left: -1px; pointer-events: none; z-index: auto;\" class=\"cGcvT\"></grammarly-extension><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', NULL, '2021-04-28 03:36:02'),
(40, 'about_us', '<div class=\"ql-editor\" data-gramm=\"false\" contenteditable=\"true\" spellcheck=\"false\"><p><strong><em>hello world </em></strong></p><p><strong><em>nice </em></strong></p></div><grammarly-extension data-grammarly-shadow-root=\"true\" style=\"position: absolute; top: 0px; left: -1px; pointer-events: none; z-index: auto;\" class=\"cGcvT\"></grammarly-extension><grammarly-extension data-grammarly-shadow-root=\"true\" style=\"mix-blend-mode: darken; position: absolute; top: 0px; left: -1px; pointer-events: none; z-index: auto;\" class=\"cGcvT\"></grammarly-extension><div class=\"ql-clipboard\" contenteditable=\"true\" tabindex=\"-1\"></div><div class=\"ql-tooltip ql-hidden\"><a class=\"ql-preview\" target=\"_blank\" href=\"about:blank\"></a><input type=\"text\" data-formula=\"e=mc^2\" data-link=\"https://quilljs.com\" data-video=\"Embed URL\"><a class=\"ql-action\"></a><a class=\"ql-remove\"></a></div>', NULL, '2021-05-23 18:29:52'),
(42, 'paystack', '{\"status\":\"0\",\"publicKey\":null,\"secretKey\":null,\"paymentUrl\":\"https:\\/\\/api.paystack.co\",\"merchantEmail\":null}', '2021-05-04 14:38:35', '2021-07-25 14:39:12'),
(43, 'time_zone', 'Africa/Tunisia', NULL, NULL),
(44, 'maintenance_mode', '0', NULL, NULL),
(45, 'currency_symbol_position', 'right', NULL, NULL),
(46, 'language', 'null', NULL, NULL),
(47, 'self_pickup', NULL, NULL, NULL),
(48, 'delivery', '1', NULL, NULL),
(49, 'phone_verification', NULL, NULL, NULL),
(50, 'msg91_sms', '{\"status\":0,\"template_id\":null,\"authkey\":null}', NULL, NULL),
(51, '2factor_sms', '{\"status\":\"0\",\"api_key\":null}', NULL, NULL),
(52, 'nexmo_sms', '{\"status\":0,\"api_key\":null,\"api_secret\":null,\"signature_secret\":\"\",\"private_key\":\"\",\"application_id\":\"\",\"from\":null,\"otp_template\":null}', NULL, NULL),
(53, 'twilio_sms', '{\"status\":0,\"sid\":null,\"token\":null,\"from\":null,\"otp_template\":null}', NULL, NULL),
(54, 'pagination_limit', '10', NULL, NULL),
(55, 'map_api_key', '', NULL, NULL),
(56, 'delivery_management', '{\"status\":null,\"min_shipping_charge\":0,\"shipping_per_km\":0}', NULL, NULL),
(57, 'bkash', '{\"status\":\"1\",\"api_key\":\"\",\"api_secret\":\"\",\"username\":\"\",\"password\":\"\"}', NULL, NULL),
(58, 'paymob', '{\"status\":\"1\",\"api_key\":\"\",\"iframe_id\":\"\",\"integration_id\":\"\",\"hmac\":\"\"}', NULL, NULL),
(59, 'flutterwave', '{\"status\":\"1\",\"public_key\":\"\",\"secret_key\":\"\",\"hash\":\"\"}', NULL, NULL),
(60, 'mercadopago', '{\"status\":\"1\",\"public_key\":\"\",\"access_token\":\"\"}', NULL, NULL),
(61, 'returned_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(62, 'failed_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(63, 'canceled_message', '{\"status\":0,\"message\":\"\"}', NULL, NULL),
(64, 'country', 'TN', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` bigint(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'def.png',
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `position`, `status`, `created_at`, `updated_at`, `image`, `description`) VALUES
(38, 'Boisson', 0, 0, 1, '2024-05-08 23:12:47', '2024-05-08 23:12:47', '2024-05-09-663bc09f9123f.png', NULL),
(39, 'Tacos', 0, 0, 1, '2024-05-11 19:58:20', '2024-05-12 18:23:14', '2024-05-12-6640c2c285134.png', NULL),
(40, 'Salade', 0, 0, 1, '2024-06-06 22:32:07', '2024-06-06 22:32:07', '2024-06-06-6661f296f41c9.png', NULL),
(41, 'Frites', 0, 0, 1, '2024-06-09 02:27:38', '2024-06-09 02:27:38', '2024-06-09-6664ccca9875a.png', NULL),
(42, 'Burger', 0, 0, 1, '2024-06-09 02:42:09', '2024-06-09 02:42:09', '2024-06-09-6664d0316704b.png', NULL),
(43, 'Dessert', 0, 0, 1, '2024-06-09 02:46:49', '2024-06-09 02:47:11', '2024-06-09-6664d149a5664.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `min_purchase` decimal(8,2) NOT NULL DEFAULT 0.00,
  `max_discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_type` varchar(15) NOT NULL DEFAULT 'percentage',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_type` varchar(255) NOT NULL DEFAULT 'default',
  `limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `exchange_rate` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency_code`, `currency_symbol`, `exchange_rate`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'USD', '$', '1.00', NULL, NULL),
(2, 'Canadian Dollar', 'CAD', 'CA$', '1.00', NULL, NULL),
(3, 'Euro', 'EUR', '€', '1.00', NULL, NULL),
(4, 'United Arab Emirates Dirham', 'AED', 'د.إ.‏', '1.00', NULL, NULL),
(5, 'Afghan Afghani', 'AFN', '؋', '1.00', NULL, NULL),
(6, 'Albanian Lek', 'ALL', 'L', '1.00', NULL, NULL),
(7, 'Armenian Dram', 'AMD', '֏', '1.00', NULL, NULL),
(8, 'Argentine Peso', 'ARS', '$', '1.00', NULL, NULL),
(9, 'Australian Dollar', 'AUD', '$', '1.00', NULL, NULL),
(10, 'Azerbaijani Manat', 'AZN', '₼', '1.00', NULL, NULL),
(11, 'Bosnia-Herzegovina Convertible Mark', 'BAM', 'KM', '1.00', NULL, NULL),
(12, 'Bangladeshi Taka', 'BDT', '৳', '1.00', NULL, NULL),
(13, 'Bulgarian Lev', 'BGN', 'лв.', '1.00', NULL, NULL),
(14, 'Bahraini Dinar', 'BHD', 'د.ب.‏', '1.00', NULL, NULL),
(15, 'Burundian Franc', 'BIF', 'FBu', '1.00', NULL, NULL),
(16, 'Brunei Dollar', 'BND', 'B$', '1.00', NULL, NULL),
(17, 'Bolivian Boliviano', 'BOB', 'Bs', '1.00', NULL, NULL),
(18, 'Brazilian Real', 'BRL', 'R$', '1.00', NULL, NULL),
(19, 'Botswanan Pula', 'BWP', 'P', '1.00', NULL, NULL),
(20, 'Belarusian Ruble', 'BYN', 'Br', '1.00', NULL, NULL),
(21, 'Belize Dollar', 'BZD', '$', '1.00', NULL, NULL),
(22, 'Congolese Franc', 'CDF', 'FC', '1.00', NULL, NULL),
(23, 'Swiss Franc', 'CHF', 'CHf', '1.00', NULL, NULL),
(24, 'Chilean Peso', 'CLP', '$', '1.00', NULL, NULL),
(25, 'Chinese Yuan', 'CNY', '¥', '1.00', NULL, NULL),
(26, 'Colombian Peso', 'COP', '$', '1.00', NULL, NULL),
(27, 'Costa Rican Colón', 'CRC', '₡', '1.00', NULL, NULL),
(28, 'Cape Verdean Escudo', 'CVE', '$', '1.00', NULL, NULL),
(29, 'Czech Republic Koruna', 'CZK', 'Kč', '1.00', NULL, NULL),
(30, 'Djiboutian Franc', 'DJF', 'Fdj', '1.00', NULL, NULL),
(31, 'Danish Krone', 'DKK', 'Kr.', '1.00', NULL, NULL),
(32, 'Dominican Peso', 'DOP', 'RD$', '1.00', NULL, NULL),
(33, 'Algerian Dinar', 'DZD', 'د.ج.‏', '1.00', NULL, NULL),
(34, 'Estonian Kroon', 'EEK', 'kr', '1.00', NULL, NULL),
(35, 'Egyptian Pound', 'EGP', 'E£‏', '1.00', NULL, NULL),
(36, 'Eritrean Nakfa', 'ERN', 'Nfk', '1.00', NULL, NULL),
(37, 'Ethiopian Birr', 'ETB', 'Br', '1.00', NULL, NULL),
(38, 'British Pound Sterling', 'GBP', '£', '1.00', NULL, NULL),
(39, 'Georgian Lari', 'GEL', 'GEL', '1.00', NULL, NULL),
(40, 'Ghanaian Cedi', 'GHS', 'GH¢', '1.00', NULL, NULL),
(41, 'Guinean Franc', 'GNF', 'FG', '1.00', NULL, NULL),
(42, 'Guatemalan Quetzal', 'GTQ', 'Q', '1.00', NULL, NULL),
(43, 'Hong Kong Dollar', 'HKD', 'HK$', '1.00', NULL, NULL),
(44, 'Honduran Lempira', 'HNL', 'L', '1.00', NULL, NULL),
(45, 'Croatian Kuna', 'HRK', 'kn', '1.00', NULL, NULL),
(46, 'Hungarian Forint', 'HUF', 'Ft', '1.00', NULL, NULL),
(47, 'Indonesian Rupiah', 'IDR', 'Rp', '1.00', NULL, NULL),
(48, 'Israeli New Sheqel', 'ILS', '₪', '1.00', NULL, NULL),
(49, 'Indian Rupee', 'INR', '₹', '1.00', NULL, NULL),
(50, 'Iraqi Dinar', 'IQD', 'ع.د', '1.00', NULL, NULL),
(51, 'Iranian Rial', 'IRR', '﷼', '1.00', NULL, NULL),
(52, 'Icelandic Króna', 'ISK', 'kr', '1.00', NULL, NULL),
(53, 'Jamaican Dollar', 'JMD', '$', '1.00', NULL, NULL),
(54, 'Jordanian Dinar', 'JOD', 'د.ا‏', '1.00', NULL, NULL),
(55, 'Japanese Yen', 'JPY', '¥', '1.00', NULL, NULL),
(56, 'Kenyan Shilling', 'KES', 'Ksh', '1.00', NULL, NULL),
(57, 'Cambodian Riel', 'KHR', '៛', '1.00', NULL, NULL),
(58, 'Comorian Franc', 'KMF', 'FC', '1.00', NULL, NULL),
(59, 'South Korean Won', 'KRW', 'CF', '1.00', NULL, NULL),
(60, 'Kuwaiti Dinar', 'KWD', 'د.ك.‏', '1.00', NULL, NULL),
(61, 'Kazakhstani Tenge', 'KZT', '₸.', '1.00', NULL, NULL),
(62, 'Lebanese Pound', 'LBP', 'ل.ل.‏', '1.00', NULL, NULL),
(63, 'Sri Lankan Rupee', 'LKR', 'Rs', '1.00', NULL, NULL),
(64, 'Lithuanian Litas', 'LTL', 'Lt', '1.00', NULL, NULL),
(65, 'Latvian Lats', 'LVL', 'Ls', '1.00', NULL, NULL),
(66, 'Libyan Dinar', 'LYD', 'د.ل.‏', '1.00', NULL, NULL),
(67, 'Moroccan Dirham', 'MAD', 'د.م.‏', '1.00', NULL, NULL),
(68, 'Moldovan Leu', 'MDL', 'L', '1.00', NULL, NULL),
(69, 'Malagasy Ariary', 'MGA', 'Ar', '1.00', NULL, NULL),
(70, 'Macedonian Denar', 'MKD', 'Ден', '1.00', NULL, NULL),
(71, 'Myanma Kyat', 'MMK', 'K', '1.00', NULL, NULL),
(72, 'Macanese Pataca', 'MOP', 'MOP$', '1.00', NULL, NULL),
(73, 'Mauritian Rupee', 'MUR', 'Rs', '1.00', NULL, NULL),
(74, 'Mexican Peso', 'MXN', '$', '1.00', NULL, NULL),
(75, 'Malaysian Ringgit', 'MYR', 'RM', '1.00', NULL, NULL),
(76, 'Mozambican Metical', 'MZN', 'MT', '1.00', NULL, NULL),
(77, 'Namibian Dollar', 'NAD', 'N$', '1.00', NULL, NULL),
(78, 'Nigerian Naira', 'NGN', '₦', '1.00', NULL, NULL),
(79, 'Nicaraguan Córdoba', 'NIO', 'C$', '1.00', NULL, NULL),
(80, 'Norwegian Krone', 'NOK', 'kr', '1.00', NULL, NULL),
(81, 'Nepalese Rupee', 'NPR', 'Re.', '1.00', NULL, NULL),
(82, 'New Zealand Dollar', 'NZD', '$', '1.00', NULL, NULL),
(83, 'Omani Rial', 'OMR', 'ر.ع.‏', '1.00', NULL, NULL),
(84, 'Panamanian Balboa', 'PAB', 'B/.', '1.00', NULL, NULL),
(85, 'Peruvian Nuevo Sol', 'PEN', 'S/', '1.00', NULL, NULL),
(86, 'Philippine Peso', 'PHP', '₱', '1.00', NULL, NULL),
(87, 'Pakistani Rupee', 'PKR', 'Rs', '1.00', NULL, NULL),
(88, 'Polish Zloty', 'PLN', 'zł', '1.00', NULL, NULL),
(89, 'Paraguayan Guarani', 'PYG', '₲', '1.00', NULL, NULL),
(90, 'Qatari Rial', 'QAR', 'ر.ق.‏', '1.00', NULL, NULL),
(91, 'Romanian Leu', 'RON', 'lei', '1.00', NULL, NULL),
(92, 'Serbian Dinar', 'RSD', 'din.', '1.00', NULL, NULL),
(93, 'Russian Ruble', 'RUB', '₽.', '1.00', NULL, NULL),
(94, 'Rwandan Franc', 'RWF', 'FRw', '1.00', NULL, NULL),
(95, 'Saudi Riyal', 'SAR', 'ر.س.‏', '1.00', NULL, NULL),
(96, 'Sudanese Pound', 'SDG', 'ج.س.', '1.00', NULL, NULL),
(97, 'Swedish Krona', 'SEK', 'kr', '1.00', NULL, NULL),
(98, 'Singapore Dollar', 'SGD', '$', '1.00', NULL, NULL),
(99, 'Somali Shilling', 'SOS', 'Sh.so.', '1.00', NULL, NULL),
(100, 'Syrian Pound', 'SYP', 'LS‏', '1.00', NULL, NULL),
(101, 'Thai Baht', 'THB', '฿', '1.00', NULL, NULL),
(102, 'Tunisian Dinar', 'TND', 'TND', '1.00', NULL, NULL),
(103, 'Tongan Paʻanga', 'TOP', 'T$', '1.00', NULL, NULL),
(104, 'Turkish Lira', 'TRY', '₺', '1.00', NULL, NULL),
(105, 'Trinidad and Tobago Dollar', 'TTD', '$', '1.00', NULL, NULL),
(106, 'New Taiwan Dollar', 'TWD', 'NT$', '1.00', NULL, NULL),
(107, 'Tanzanian Shilling', 'TZS', 'TSh', '1.00', NULL, NULL),
(108, 'Ukrainian Hryvnia', 'UAH', '₴', '1.00', NULL, NULL),
(109, 'Ugandan Shilling', 'UGX', 'USh', '1.00', NULL, NULL),
(110, 'Uruguayan Peso', 'UYU', '$', '1.00', NULL, NULL),
(111, 'Uzbekistan Som', 'UZS', 'so\'m', '1.00', NULL, NULL),
(112, 'Venezuelan Bolívar', 'VEF', 'Bs.F.', '1.00', NULL, NULL),
(113, 'Vietnamese Dong', 'VND', '₫', '1.00', NULL, NULL),
(114, 'CFA Franc BEAC', 'XAF', 'FCFA', '1.00', NULL, NULL),
(115, 'CFA Franc BCEAO', 'XOF', 'CFA', '1.00', NULL, NULL),
(116, 'Yemeni Rial', 'YER', '﷼‏', '1.00', NULL, NULL),
(117, 'South African Rand', 'ZAR', 'R', '1.00', NULL, NULL),
(118, 'Zambian Kwacha', 'ZMK', 'ZK', '1.00', NULL, NULL),
(119, 'Zimbabwean Dollar', 'ZWL', 'Z$', '1.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `priceSupp` decimal(8,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_ids` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `image`, `quantity`, `description`, `priceSupp`, `created_at`, `updated_at`, `category_ids`) VALUES
(32, 'Tomate', '2024-06-07-6661fac3647f4.png', NULL, NULL, NULL, '2024-05-11 20:07:21', '2024-06-06 23:06:59', '[{\"id\":\"10\"}]'),
(33, 'Steak hachée', '2024-05-11-663f89bb00c10.png', NULL, NULL, NULL, '2024-05-11 20:07:39', '2024-05-11 20:07:39', '[{\"id\":\"11\"}]'),
(34, 'Salade', '2024-06-07-6661fa2a10077.png', NULL, NULL, NULL, '2024-06-06 23:04:26', '2024-06-06 23:04:26', '[{\"id\":\"10\"}]'),
(35, 'Onion frites', '2024-06-09-6664d2092e550.png', NULL, NULL, NULL, '2024-06-06 23:09:34', '2024-06-09 02:50:01', '[{\"id\":\"10\"}]'),
(36, 'Poulet pané', '2024-06-07-6661fbad5ad27.png', NULL, NULL, NULL, '2024-06-06 23:10:53', '2024-06-06 23:10:53', '[{\"id\":\"11\"}]'),
(37, 'Cornichon', '2024-06-07-6661fc5e66707.png', NULL, NULL, NULL, '2024-06-06 23:13:28', '2024-06-06 23:13:50', '[{\"id\":\"10\"}]'),
(38, 'Mais', '2024-06-07-6661fcfe21dd1.png', NULL, NULL, NULL, '2024-06-06 23:16:30', '2024-06-06 23:16:30', '[{\"id\":\"10\"}]'),
(39, 'Légume confit', '2024-06-09-6664d4b1b049e.png', NULL, NULL, NULL, '2024-06-06 23:25:01', '2024-06-09 03:01:21', '[{\"id\":\"10\"}]'),
(40, 'Fromage américain', '2024-06-09-6664ceac34f65.png', NULL, NULL, NULL, '2024-06-09 02:35:40', '2024-06-09 02:35:40', '[{\"id\":\"12\"}]'),
(41, 'Concombre', '2024-06-09-6664ceff200f3.png', NULL, NULL, NULL, '2024-06-09 02:37:03', '2024-06-09 02:37:03', '[{\"id\":\"10\"}]'),
(42, 'Onion', '2024-06-09-6664d2aec29f5.png', NULL, NULL, NULL, '2024-06-09 02:52:46', '2024-06-09 02:52:46', '[{\"id\":\"10\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `ing_categories`
--

CREATE TABLE `ing_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ing_categories`
--

INSERT INTO `ing_categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`, `parent_id`) VALUES
(10, 'Légume', '2024-06-08-66649a275526b.png', 1, '2024-05-11 20:01:26', '2024-06-08 22:51:35', 0),
(11, 'Viande', '2024-05-11-663f885751d13.png', 1, '2024-05-11 20:01:43', '2024-05-11 20:01:43', 0),
(12, 'Fromage', '2024-06-09-6664ce93d9e4f.png', 1, '2024-06-09 02:35:15', '2024-06-09 02:35:15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_28_082729_create_admins_table', 1),
(5, '2020_12_28_083059_create_delivery_men_table', 1),
(6, '2020_12_28_085055_create_attributes_table', 1),
(7, '2020_12_28_085146_create_add_ons_table', 1),
(8, '2020_12_28_085255_create_categories_table', 1),
(9, '2020_12_28_085511_create_business_settings_table', 1),
(10, '2020_12_28_085733_create_customer_addresses_table', 1),
(11, '2020_12_28_090037_create_orders_table', 1),
(12, '2020_12_28_090551_create_order_details_table', 1),
(13, '2020_12_28_091214_create_order_delivery_histories_table', 1),
(14, '2020_12_28_092607_create_banners_table', 1),
(15, '2020_12_28_092747_create_notifications_table', 1),
(16, '2020_12_28_092933_create_coupons_table', 1),
(17, '2020_12_28_093409_create_track_deliverymen_table', 1),
(18, '2020_12_28_093637_create_conversations_table', 1),
(19, '2020_12_28_093812_create_reviews_table', 1),
(20, '2020_12_28_093937_create_products_table', 1),
(21, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(22, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(23, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(24, '2016_06_01_000004_create_oauth_clients_table', 2),
(25, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(26, '2021_01_02_053131_add_products_column_attributes', 2),
(27, '2021_01_02_062050_add_products_table_column_discount_tax', 2),
(28, '2021_01_03_083314_add_column_to_order_details', 3),
(29, '2021_01_03_084318_add_another_column_to_order_details', 3),
(30, '2021_01_05_133023_add_columns_to_customer_addressess', 4),
(31, '2021_01_07_142644_add_column_to_conversation', 5),
(32, '2021_01_09_145939_add_column_to_order_table', 6),
(33, '2021_01_09_180439_add_column_to_product_table', 7),
(34, '2021_01_09_182458_add_image_column_to_category', 7),
(35, '2021_01_10_144352_create_wishlists_table', 8),
(36, '2021_01_16_182939_add_column_to_order_table1', 9),
(37, '2021_01_18_124153_add_column_to_cono_table', 10),
(38, '2021_01_18_132026_add_column_to_deliveryman_table', 11),
(39, '2021_01_18_135107_create_delivery_histories_table', 11),
(40, '2021_01_23_102525_add_col_to_banner_category_id', 12),
(41, '2021_01_26_133423_add_delivery_charge_order_table', 13),
(42, '2021_01_27_111644_add_email_token_to_user_table', 13),
(43, '2021_01_27_112309_create_email_verifications_table', 13),
(44, '2021_01_27_120054_remove_column_from_users', 13),
(45, '2021_01_27_120306_add_column_tousers', 13),
(46, '2021_01_28_152556_create_currencies_table', 14),
(47, '2021_02_07_140951_add_firebase_token_to_users_table', 15),
(48, '2021_02_07_141134_add_order_note_to_orders_table', 15),
(49, '2021_02_11_125439_add_fcm_to_delivery_man', 16),
(50, '2021_02_15_094227_add_orderid_to_reviews_table', 17),
(51, '2021_02_18_085112_add_coupon_type_column_in_coupons', 18),
(52, '2021_02_18_095103_add_coupon_code_to_order_table', 18),
(53, '2021_02_20_051812_create_d_m_reviews_table', 19),
(54, '2021_02_20_070636_add_addon_qtys_order_table', 19),
(55, '2021_02_22_084240_add_order_type', 20),
(56, '2021_02_23_053203_create_branches_table', 21),
(57, '2021_02_23_093537_add_branch_in_order', 21),
(58, '2021_02_24_055406_add_coverage_in_branch', 21),
(59, '2021_02_25_063013_add_branch_to_delivery_man', 22),
(60, '2021_02_28_080406_add_remember_token_to_branch', 23),
(61, '2021_03_01_112807_change_poduct_table_column_change', 24),
(62, '2021_03_22_055801_add_branch_id_to_product', 25),
(63, '2021_03_24_055957_add_image_table_in_branch', 26),
(64, '2021_04_05_144520_update_product_image_column', 27),
(65, '2021_04_06_040409_create_colors_table', 28),
(66, '2021_04_10_141505_add_colors_column_products', 28),
(67, '2021_04_17_054600_add_point_to_users', 29),
(68, '2021_04_17_084426_create_point_transitions', 29),
(69, '2021_04_11_140138_create_phone_verifications_table', 30),
(70, '2021_04_12_144205_add_column_password_resets', 30),
(71, '2021_05_03_160034_add_callback_to_order', 31),
(72, '2021_05_04_203143_add_delivery_date_to_order', 32),
(73, '2021_05_06_144650_change_business_value_col_type', 33),
(74, '2021_06_17_054551_create_soft_credentials_table', 34),
(75, '2021_09_01_133521_create_phone_verifications_table', 35),
(76, '2021_09_03_194551_create_translations_table', 35),
(77, '2021_09_04_082220_rename_email_col', 35),
(78, '2021_10_12_164428_add_temporary_token_to_users_table', 36),
(79, '2021_11_07_165323_add_extra_discount_to_order_table', 37),
(80, '2022_03_09_164443_add_satuts_to_users_table', 38),
(81, '2022_03_09_191158_add_info_to_add_ons_table', 39),
(82, '2022_03_09_193753_add_description_to_categories_table', 40),
(83, '2022_03_10_152628_add_colmuns_to_branches_table', 41),
(84, '2022_03_10_184354_add_image_to_branches_table', 42),
(85, '2022_03_10_202916_add_image_to_branches_table', 43),
(86, '2022_03_10_211015_add_image_to_branches_table', 44),
(87, '2022_03_11_164139_add_quantity_to_products_table', 45),
(88, '2022_03_15_092833_create_ingredient_table', 46),
(89, '2022_03_16_103911_add_token_to_branches_table', 47),
(90, '2022_03_24_230337_add_ingredient_to_products_table', 48),
(91, '2022_03_25_014018_create_abonnements_table', 49),
(92, '2022_03_29_032600_create_tables_table', 50),
(93, '2022_04_03_202604_add_status_to_tables_table', 51),
(94, '2022_04_06_214149_add_price_disc_to_products_table', 52),
(95, '2022_04_13_214331_add_foreign_key_to_products_table', 53),
(96, '2022_04_19_212202_add_email_verif_to_branches_table', 53),
(97, '2022_05_03_214836_create_ing_categories_table', 54),
(98, '2022_05_04_031726_add_parentid_to_ing_categories_table', 55),
(99, '2022_05_04_031916_addcategoryid_to_ingredients_table', 56),
(100, '2022_05_09_211632_create_produit_compose_table', 57),
(101, '2022_05_17_212507_add_formule_to_products_table', 58),
(102, '2022_05_17_220650_create_fomrules_table', 59),
(103, '2022_05_27_213813_add_blocked_until_to_branches_table', 60),
(104, '2024_05_20_215343_add_ingredient_to_order_details_table', 61);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'notif', 'hello', '2022-03-15-62305ad81a4e9.png', 1, '2022-03-15 08:22:32', '2022-03-15 08:22:32');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `order_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `coupon_discount_amount` decimal(8,2) DEFAULT 0.00,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `order_status` varchar(255) NOT NULL DEFAULT 'confirmed',
  `total_tax_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(30) DEFAULT NULL,
  `transaction_reference` varchar(30) DEFAULT NULL,
  `delivery_address_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `checked` tinyint(1) DEFAULT 0,
  `delivery_man_id` bigint(20) DEFAULT NULL,
  `delivery_charge` decimal(8,2) DEFAULT 0.00,
  `order_note` text DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) DEFAULT 'Sur_place',
  `branch_id` bigint(20) DEFAULT 1,
  `callback` varchar(255) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_time` varchar(255) DEFAULT NULL,
  `extra_discount` decimal(8,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_amount`, `coupon_discount_amount`, `payment_status`, `order_status`, `total_tax_amount`, `payment_method`, `transaction_reference`, `delivery_address_id`, `created_at`, `updated_at`, `checked`, `delivery_man_id`, `delivery_charge`, `order_note`, `coupon_code`, `order_type`, `branch_id`, `callback`, `delivery_date`, `delivery_time`, `extra_discount`) VALUES
(100001, NULL, 16.50, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-06 19:35:39', '2024-06-06 19:35:39', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-06', '20:35:39', '0.00'),
(100002, NULL, 34.50, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-07 04:16:27', '2024-06-07 04:16:27', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-07', '05:16:27', '0.00'),
(100003, NULL, 10.00, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-07 04:16:41', '2024-06-07 04:16:41', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-07', '05:16:41', '0.00'),
(100004, NULL, 18.00, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-07 04:16:48', '2024-06-07 04:16:48', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-07', '05:16:48', '0.00'),
(100005, NULL, 18.00, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-09 00:05:56', '2024-06-09 00:05:56', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-09', '01:05:56', '0.00'),
(100006, NULL, 6.00, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-09 00:06:32', '2024-06-09 00:06:32', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-09', '01:06:32', '0.00'),
(100007, NULL, 8.50, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-09 02:04:06', '2024-06-09 02:04:06', 1, NULL, '0.00', NULL, NULL, 'pos', 54, NULL, '2024-06-09', '03:04:06', '0.00'),
(100008, NULL, 16.50, '0.00', 'paid', 'confirmed', 0.00, 'cash', NULL, NULL, '2024-06-09 15:55:58', '2024-06-09 15:55:58', 1, NULL, '0.00', NULL, NULL, 'pos', 53, NULL, '2024-06-09', '16:55:58', '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `product_details` text DEFAULT NULL,
  `variation` varchar(255) DEFAULT NULL,
  `discount_on_product` decimal(8,2) DEFAULT NULL,
  `discount_type` varchar(20) NOT NULL DEFAULT 'amount',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `tax_amount` decimal(8,2) NOT NULL DEFAULT 1.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `add_on_ids` varchar(255) DEFAULT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `add_on_qtys` varchar(255) DEFAULT NULL,
  `ingredients` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_details`
--

INSERT INTO `order_details` (`id`, `product_id`, `order_id`, `price`, `product_details`, `variation`, `discount_on_product`, `discount_type`, `quantity`, `tax_amount`, `created_at`, `updated_at`, `add_on_ids`, `variant`, `add_on_qtys`, `ingredients`) VALUES
(181, 106, 100001, '6.00', '{\"id\":106,\"name\":\"Tacos\",\"description\":null,\"image\":\"2024-05-11-663f89f57b5e7.png\",\"price\":6,\"variations\":[{\"type\":\"S\",\"price\":6},{\"type\":\"M\",\"price\":8},{\"type\":\"L\",\"price\":10},{\"type\":\"XL\",\"price\":12}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-11T15:08:37.000000Z\",\"updated_at\":\"2024-05-11T15:08:37.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"39\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"S\",\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[{\"id\":22,\"name\":\"frites\",\"price\":2.5,\"created_at\":\"2024-05-11T15:03:31.000000Z\",\"updated_at\":\"2024-05-11T15:03:31.000000Z\",\"description\":null,\"image\":\"2024-05-11-663f88c2dd9c4.png\",\"quantity\":null}],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-05-11-663f89a9536e9.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-05-11T15:07:21.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":33,\"name\":\"Steak hach\\u00e9e\",\"image\":\"2024-05-11-663f89bb00c10.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:39.000000Z\",\"updated_at\":\"2024-05-11T15:07:39.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"11\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"S\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-06 19:35:39', '2024-06-06 19:35:39', '[22]', '\"S\"', '[\"1\"]', '[32,33]'),
(182, 105, 100001, '8.00', '{\"id\":105,\"name\":\"caf\\u00e9\",\"description\":null,\"image\":\"2024-05-09-663bc0cf09eaf.png\",\"price\":4,\"variations\":[{\"type\":\"M\",\"price\":4},{\"type\":\"L\",\"price\":6},{\"type\":\"XL\",\"price\":8}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-08T18:13:35.000000Z\",\"updated_at\":\"2024-05-08T18:13:35.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"38\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"XL\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-06 19:35:39', '2024-06-06 19:35:39', '[]', '\"XL\"', '[]', '[]'),
(183, 106, 100002, '6.00', '{\"id\":106,\"name\":\"Tacos\",\"description\":null,\"image\":\"2024-05-11-663f89f57b5e7.png\",\"price\":6,\"variations\":[{\"type\":\"S\",\"price\":6},{\"type\":\"M\",\"price\":8},{\"type\":\"L\",\"price\":10},{\"type\":\"XL\",\"price\":12}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-11T15:08:37.000000Z\",\"updated_at\":\"2024-05-11T15:08:37.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"39\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"S\",\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[{\"id\":22,\"name\":\"frites\",\"price\":2.5,\"created_at\":\"2024-05-11T15:03:31.000000Z\",\"updated_at\":\"2024-05-11T15:03:31.000000Z\",\"description\":null,\"image\":\"2024-05-11-663f88c2dd9c4.png\",\"quantity\":null}],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":33,\"name\":\"Steak hach\\u00e9e\",\"image\":\"2024-05-11-663f89bb00c10.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:39.000000Z\",\"updated_at\":\"2024-05-11T15:07:39.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"11\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"S\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-07 04:16:27', '2024-06-07 04:16:27', '[22]', '\"S\"', '[\"1\"]', '[]'),
(184, 105, 100002, '8.00', '{\"id\":105,\"name\":\"caf\\u00e9\",\"description\":null,\"image\":\"2024-05-09-663bc0cf09eaf.png\",\"price\":4,\"variations\":[{\"type\":\"M\",\"price\":4},{\"type\":\"L\",\"price\":6},{\"type\":\"XL\",\"price\":8}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-08T18:13:35.000000Z\",\"updated_at\":\"2024-05-08T18:13:35.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"38\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"XL\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-07 04:16:27', '2024-06-07 04:16:27', '[]', '\"XL\"', '[]', '[]'),
(185, 107, 100002, '18.00', '{\"id\":107,\"name\":\"Salade C\\u00e9sar\",\"description\":null,\"image\":\"2024-06-07-6661fdc020a0b.png\",\"price\":18,\"variations\":[],\"tax\":0,\"status\":1,\"created_at\":\"2024-06-06T18:19:44.000000Z\",\"updated_at\":\"2024-06-06T23:07:32.000000Z\",\"attributes\":[],\"category_ids\":[{\"id\":\"40\"}],\"choice_options\":[],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":34,\"name\":\"Salade\",\"image\":\"2024-06-07-6661fa2a10077.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:04:26.000000Z\",\"updated_at\":\"2024-06-06T18:04:26.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":37,\"name\":\"Cornichon\",\"image\":\"2024-06-07-6661fc5e66707.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:13:28.000000Z\",\"updated_at\":\"2024-06-06T18:13:50.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":38,\"name\":\"Mais\",\"image\":\"2024-06-07-6661fcfe21dd1.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:16:30.000000Z\",\"updated_at\":\"2024-06-06T18:16:30.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[[]]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-07 04:16:27', '2024-06-07 04:16:27', '[]', '\"\"', '[]', '[32,34,35,36,37,38]'),
(186, 106, 100003, '6.00', '{\"id\":106,\"name\":\"Tacos\",\"description\":null,\"image\":\"2024-05-11-663f89f57b5e7.png\",\"price\":6,\"variations\":[{\"type\":\"S\",\"price\":6},{\"type\":\"M\",\"price\":8},{\"type\":\"L\",\"price\":10},{\"type\":\"XL\",\"price\":12}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-11T15:08:37.000000Z\",\"updated_at\":\"2024-05-11T15:08:37.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"39\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"S\",\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[{\"id\":22,\"name\":\"frites\",\"price\":2.5,\"created_at\":\"2024-05-11T15:03:31.000000Z\",\"updated_at\":\"2024-05-11T15:03:31.000000Z\",\"description\":null,\"image\":\"2024-05-11-663f88c2dd9c4.png\",\"quantity\":null}],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":33,\"name\":\"Steak hach\\u00e9e\",\"image\":\"2024-05-11-663f89bb00c10.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:39.000000Z\",\"updated_at\":\"2024-05-11T15:07:39.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"11\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"S\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-07 04:16:41', '2024-06-07 04:16:41', '[]', '\"S\"', '[]', '[]'),
(187, 105, 100003, '4.00', '{\"id\":105,\"name\":\"caf\\u00e9\",\"description\":null,\"image\":\"2024-05-09-663bc0cf09eaf.png\",\"price\":4,\"variations\":[{\"type\":\"M\",\"price\":4},{\"type\":\"L\",\"price\":6},{\"type\":\"XL\",\"price\":8}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-08T18:13:35.000000Z\",\"updated_at\":\"2024-05-08T18:13:35.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"38\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"M\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-07 04:16:41', '2024-06-07 04:16:41', '[]', '\"M\"', '[]', '[]'),
(188, 108, 100004, '18.00', '{\"id\":108,\"name\":\"Salade Estivale\",\"description\":null,\"image\":\"2024-06-07-6661ff5677f19.png\",\"price\":18,\"variations\":[],\"tax\":0,\"status\":1,\"created_at\":\"2024-06-06T18:26:30.000000Z\",\"updated_at\":\"2024-06-06T18:26:30.000000Z\",\"attributes\":[],\"category_ids\":[{\"id\":\"40\"}],\"choice_options\":[],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":34,\"name\":\"Salade\",\"image\":\"2024-06-07-6661fa2a10077.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:04:26.000000Z\",\"updated_at\":\"2024-06-06T18:04:26.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":35,\"name\":\"Onion frites\",\"image\":\"2024-06-07-6661fb5ee6de2.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:09:34.000000Z\",\"updated_at\":\"2024-06-06T18:09:34.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":37,\"name\":\"Cornichon\",\"image\":\"2024-06-07-6661fc5e66707.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:13:28.000000Z\",\"updated_at\":\"2024-06-06T18:13:50.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":38,\"name\":\"Mais\",\"image\":\"2024-06-07-6661fcfe21dd1.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:16:30.000000Z\",\"updated_at\":\"2024-06-06T18:16:30.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":39,\"name\":\"L\\u00e9gume confit\",\"image\":\"2024-06-07-6661fefdb6407.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:25:01.000000Z\",\"updated_at\":\"2024-06-06T18:25:01.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[[]]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-07 04:16:48', '2024-06-07 04:16:48', '[]', '\"\"', '[]', '[]'),
(189, 107, 100005, '18.00', '{\"id\":107,\"name\":\"Salade C\\u00e9sar\",\"description\":null,\"image\":\"2024-06-07-6661fdc020a0b.png\",\"price\":18,\"variations\":[],\"tax\":0,\"status\":1,\"created_at\":\"2024-06-06T18:19:44.000000Z\",\"updated_at\":\"2024-06-06T23:07:32.000000Z\",\"attributes\":[],\"category_ids\":[{\"id\":\"40\"}],\"choice_options\":[],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":34,\"name\":\"Salade\",\"image\":\"2024-06-07-6661fa2a10077.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:04:26.000000Z\",\"updated_at\":\"2024-06-06T18:04:26.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":37,\"name\":\"Cornichon\",\"image\":\"2024-06-07-6661fc5e66707.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:13:28.000000Z\",\"updated_at\":\"2024-06-06T18:13:50.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":38,\"name\":\"Mais\",\"image\":\"2024-06-07-6661fcfe21dd1.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:16:30.000000Z\",\"updated_at\":\"2024-06-06T18:16:30.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[[]]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-09 00:05:56', '2024-06-09 00:05:56', '[]', '\"\"', '[]', '[]'),
(190, 105, 100006, '6.00', '{\"id\":105,\"name\":\"caf\\u00e9\",\"description\":null,\"image\":\"2024-05-09-663bc0cf09eaf.png\",\"price\":4,\"variations\":[{\"type\":\"M\",\"price\":4},{\"type\":\"L\",\"price\":6},{\"type\":\"XL\",\"price\":8}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-08T18:13:35.000000Z\",\"updated_at\":\"2024-05-08T18:13:35.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"38\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"L\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-09 00:06:32', '2024-06-09 00:06:32', '[]', '\"L\"', '[]', '[]'),
(191, 106, 100007, '6.00', '{\"id\":106,\"name\":\"Tacos\",\"description\":null,\"image\":\"2024-05-11-663f89f57b5e7.png\",\"price\":6,\"variations\":[{\"type\":\"S\",\"price\":6},{\"type\":\"M\",\"price\":8},{\"type\":\"L\",\"price\":10},{\"type\":\"XL\",\"price\":12}],\"tax\":0,\"status\":1,\"created_at\":\"2024-05-11T15:08:37.000000Z\",\"updated_at\":\"2024-05-11T15:08:37.000000Z\",\"attributes\":[\"1\"],\"category_ids\":[{\"id\":\"39\"}],\"choice_options\":[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"S\",\"M\",\"L\",\"XL\"]}],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[{\"id\":22,\"name\":\"frites\",\"price\":2.5,\"created_at\":\"2024-05-11T15:03:31.000000Z\",\"updated_at\":\"2024-05-11T15:03:31.000000Z\",\"description\":null,\"image\":\"2024-05-11-663f88c2dd9c4.png\",\"quantity\":null}],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":33,\"name\":\"Steak hach\\u00e9e\",\"image\":\"2024-05-11-663f89bb00c10.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:39.000000Z\",\"updated_at\":\"2024-05-11T15:07:39.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"11\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[{\"size\":\"S\"}]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-09 02:04:06', '2024-06-09 02:04:06', '[22]', '\"S\"', '[\"1\"]', '[32,33]'),
(192, 112, 100008, '6.50', '{\"id\":112,\"name\":\"Tarte daim\",\"description\":null,\"image\":\"2024-06-09-6664d5915526c.png\",\"price\":6.5,\"variations\":[],\"tax\":0,\"status\":1,\"created_at\":\"2024-06-08T22:05:05.000000Z\",\"updated_at\":\"2024-06-08T22:05:05.000000Z\",\"attributes\":[],\"category_ids\":[{\"id\":\"43\"}],\"choice_options\":[],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[[]]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-09 15:55:58', '2024-06-09 15:55:58', '[]', '\"\"', '[]', '[]'),
(193, 110, 100008, '10.00', '{\"id\":110,\"name\":\"Chicken burger\",\"description\":null,\"image\":\"2024-06-09-6664d0770d23d.png\",\"price\":10,\"variations\":[],\"tax\":0,\"status\":1,\"created_at\":\"2024-06-08T21:43:19.000000Z\",\"updated_at\":\"2024-06-08T21:53:41.000000Z\",\"attributes\":[],\"category_ids\":[{\"id\":\"42\"}],\"choice_options\":[],\"discount\":0,\"discount_type\":\"percent\",\"tax_type\":\"percent\",\"branch_id\":1,\"add_ons\":[],\"ingredients\":[{\"id\":32,\"name\":\"Tomate\",\"image\":\"2024-06-07-6661fac3647f4.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-05-11T15:07:21.000000Z\",\"updated_at\":\"2024-06-06T18:06:59.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":34,\"name\":\"Salade\",\"image\":\"2024-06-07-6661fa2a10077.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:04:26.000000Z\",\"updated_at\":\"2024-06-06T18:04:26.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":36,\"name\":\"Poulet pan\\u00e9\",\"image\":\"2024-06-07-6661fbad5ad27.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-06T18:10:53.000000Z\",\"updated_at\":\"2024-06-06T18:10:53.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"11\\\"}]\"},{\"id\":40,\"name\":\"Fromage am\\u00e9ricain\",\"image\":\"2024-06-09-6664ceac34f65.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-08T21:35:40.000000Z\",\"updated_at\":\"2024-06-08T21:35:40.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"12\\\"}]\"},{\"id\":41,\"name\":\"Concombre\",\"image\":\"2024-06-09-6664ceff200f3.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-08T21:37:03.000000Z\",\"updated_at\":\"2024-06-08T21:37:03.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"},{\"id\":42,\"name\":\"Onion\",\"image\":\"2024-06-09-6664d2aec29f5.png\",\"quantity\":null,\"description\":null,\"priceSupp\":null,\"created_at\":\"2024-06-08T21:52:46.000000Z\",\"updated_at\":\"2024-06-08T21:52:46.000000Z\",\"category_ids\":\"[{\\\"id\\\":\\\"10\\\"}]\"}],\"pricedisc\":null,\"products\":null,\"translations\":[]}', '[[]]', '0.00', 'discount_on_product', 1, '0.00', '2024-06-09 15:55:58', '2024-06-09 15:55:58', '[]', '\"\"', '[]', '[36]');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `variations` text DEFAULT NULL,
  `tax` double NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attributes` varchar(255) DEFAULT NULL,
  `category_ids` varchar(255) DEFAULT NULL,
  `choice_options` text DEFAULT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `discount_type` varchar(20) NOT NULL DEFAULT 'percent',
  `tax_type` varchar(20) NOT NULL DEFAULT 'percent',
  `branch_id` bigint(20) NOT NULL DEFAULT 1,
  `add_ons` varchar(100) DEFAULT NULL,
  `ingredients` varchar(255) DEFAULT NULL,
  `pricedisc` double DEFAULT NULL,
  `products` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`, `variations`, `tax`, `status`, `created_at`, `updated_at`, `attributes`, `category_ids`, `choice_options`, `discount`, `discount_type`, `tax_type`, `branch_id`, `add_ons`, `ingredients`, `pricedisc`, `products`) VALUES
(105, 'café', NULL, '2024-05-09-663bc0cf09eaf.png', 4, '[{\"type\":\"M\",\"price\":4},{\"type\":\"L\",\"price\":6},{\"type\":\"XL\",\"price\":8}]', 0, 1, '2024-05-08 23:13:35', '2024-06-09 03:16:32', '[\"1\"]', '[{\"id\":\"38\"}]', '[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"M\",\"L\",\"XL\"]}]', 0, 'percent', 'percent', 1, '[]', '[]', NULL, NULL),
(106, 'Tacos', NULL, '2024-05-11-663f89f57b5e7.png', 6, '[{\"type\":\"S\",\"price\":6},{\"type\":\"M\",\"price\":8},{\"type\":\"L\",\"price\":10},{\"type\":\"XL\",\"price\":12}]', 0, 1, '2024-05-11 20:08:37', '2024-05-11 20:08:37', '[\"1\"]', '[{\"id\":\"39\"}]', '[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"S\",\"M\",\"L\",\"XL\"]}]', 0, 'percent', 'percent', 1, '[\"22\"]', '[\"32\",\"33\"]', NULL, NULL),
(107, 'Salade César', NULL, '2024-06-07-6661fdc020a0b.png', 18, '[]', 0, 1, '2024-06-06 23:19:44', '2024-06-07 04:07:32', '[]', '[{\"id\":\"40\"}]', '[]', 0, 'percent', 'percent', 1, '[]', '[\"37\",\"38\",\"34\",\"32\"]', NULL, NULL),
(108, 'Salade Estivale', NULL, '2024-06-07-6661ff5677f19.png', 18, '[]', 0, 1, '2024-06-06 23:26:30', '2024-06-09 03:17:41', '[]', '[{\"id\":\"40\"}]', '[]', 0, 'percent', 'percent', 1, '[]', '[\"32\",\"34\",\"35\",\"37\",\"38\",\"39\"]', NULL, NULL),
(109, 'Frites', NULL, '2024-06-09-6664cd5b3f43d.png', 1.5, '[{\"type\":\"M\",\"price\":1.5},{\"type\":\"L\",\"price\":2.5},{\"type\":\"XL\",\"price\":3.5}]', 0, 1, '2024-06-09 02:30:03', '2024-06-09 03:09:42', '[\"1\"]', '[{\"id\":\"41\"}]', '[{\"name\":\"choice_1\",\"title\":\"size\",\"options\":[\"M\",\" L\",\" XL\"]}]', 0, 'percent', 'percent', 1, '[\"24\",\"23\"]', '[]', NULL, NULL),
(110, 'Chicken burger', NULL, '2024-06-09-6664d0770d23d.png', 10, '[]', 0, 1, '2024-06-09 02:43:19', '2024-06-09 02:53:41', '[]', '[{\"id\":\"42\"}]', '[]', 0, 'percent', 'percent', 1, '[]', '[\"41\",\"40\",\"42\",\"36\",\"34\",\"32\"]', NULL, NULL),
(111, 'Tiramisu', NULL, '2024-06-09-6664d544b4062.png', 8, '[]', 0, 1, '2024-06-09 03:03:48', '2024-06-09 03:03:48', '[]', '[{\"id\":\"43\"}]', '[]', 0, 'percent', 'percent', 1, '[]', '[]', NULL, NULL),
(112, 'Tarte daim', NULL, '2024-06-09-6664d5915526c.png', 6.5, '[]', 0, 1, '2024-06-09 03:05:05', '2024-06-09 03:05:05', '[]', '[{\"id\":\"43\"}]', '[]', 0, 'percent', 'percent', 1, '[]', '[]', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `translations`
--

CREATE TABLE `translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `translationable_type` varchar(255) NOT NULL,
  `translationable_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `translations`
--

INSERT INTO `translations` (`id`, `translationable_type`, `translationable_id`, `locale`, `key`, `value`) VALUES
(1, 'App\\Model\\Product', 2, 'sq', 'name', 'burger'),
(2, 'App\\Model\\Product', 2, 'sq', 'description', 'DdDdd'),
(3, 'App\\Model\\AddOn', 2, 'en', 'name', 'coca cola'),
(4, 'App\\Model\\AddOn', 3, 'en', 'name', 'fanta'),
(5, 'App\\Model\\AddOn', 4, 'en', 'name', 'Frites'),
(6, 'App\\Model\\Product', 2, 'fr', 'name', 'burger'),
(7, 'App\\Model\\Product', 2, 'fr', 'description', 'aaaaaa'),
(8, 'App\\Model\\Product', 4, 'fr', 'name', 'Libanais'),
(9, 'App\\Model\\Product', 4, 'fr', 'description', 'escalope'),
(10, 'App\\Model\\Product', 5, 'fr', 'name', 'makloub'),
(11, 'App\\Model\\Product', 5, 'fr', 'description', 'chawarma'),
(12, 'App\\Model\\Product', 11, 'fr', 'name', 'Grillade'),
(13, 'App\\Model\\Product', 10, 'fr', 'name', 'ravioli'),
(14, 'App\\Model\\Product', 9, 'fr', 'name', 'spaghetti'),
(15, 'App\\Model\\Product', 8, 'fr', 'name', 'lasagne'),
(16, 'App\\Model\\Product', 7, 'fr', 'name', 'pizza'),
(17, 'App\\Model\\Product', 6, 'fr', 'name', 'Plat'),
(18, 'App\\Model\\Product', 6, 'fr', 'description', 'escalope'),
(19, 'App\\Model\\Product', 17, 'fr', 'name', 'burger'),
(20, 'App\\Model\\Product', 18, 'fr', 'name', 'pizza'),
(21, 'App\\Model\\Product', 19, 'fr', 'name', 'lasagne'),
(22, 'App\\Model\\Product', 80, 'fr-FR', 'name', 'Coca cola'),
(23, 'App\\Model\\Product', 80, 'fr-FR', 'description', 'boisson');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `is_phone_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `add_ons`
--
ALTER TABLE `add_ons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Index pour la table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ing_categories`
--
ALTER TABLE `ing_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translations_translationable_id_index` (`translationable_id`),
  ADD KEY `translations_locale_index` (`locale`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `add_ons`
--
ALTER TABLE `add_ons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT pour la table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `ing_categories`
--
ALTER TABLE `ing_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100185;

--
-- AUTO_INCREMENT pour la table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT pour la table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
