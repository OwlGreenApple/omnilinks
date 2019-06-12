-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 10:58 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omnilinks`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) DEFAULT '0',
  `pages_id` int(11) DEFAULT '0',
  `pixel_id` int(11) DEFAULT '0',
  `counter` int(11) DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images_banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `users_id`, `pages_id`, `pixel_id`, `counter`, `title`, `images_banner`, `link`, `created_at`, `updated_at`) VALUES
(23, 5, 1, 0, 0, 'banner1', 'banner/puspita.celebgramme@gmail.com/banner1/banner1.jpg', 'https://omnifluencer.com/', '2019-04-23 07:41:29', '2019-05-16 08:17:07'),
(24, 5, 1, 0, 0, 'banner2', 'banner/puspita.celebgramme@gmail.com/banner2/banner2.jpg', 'https://omnifluencer.com/', '2019-04-23 07:42:19', '2019-05-16 08:17:07'),
(30, 5, 9, NULL, 0, 'banner1', 'banner/Puspitasari-5/1906111558-30.jpg', 'https://stackoverflow.com', '2019-06-11 08:58:30', '2019-06-11 08:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `kodekupon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon_value` int(11) NOT NULL,
  `diskon_percent` int(11) NOT NULL,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valid_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `package_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `kodekupon`, `diskon_value`, `diskon_percent`, `valid_until`, `valid_to`, `keterangan`, `package_id`, `created_at`, `updated_at`) VALUES
(4, 'OMNL1', 100000, 0, '2019-05-03 17:00:00', 'all', NULL, 0, '2019-05-02 02:22:39', '2019-05-02 02:22:39'),
(5, 'OMNL2', 0, 100, '2019-05-03 17:00:00', 'new', NULL, 0, '2019-05-02 02:23:16', '2019-05-02 02:23:16'),
(6, 'OMNL3', 100000, 0, '2019-05-03 17:00:00', 'extend', NULL, 0, '2019-05-02 02:23:55', '2019-05-02 02:23:55'),
(7, 'OMNL4', 0, 100, '2019-05-04 07:07:42', 'extend', NULL, 1, '2019-05-02 02:24:16', '2019-05-02 02:24:16'),
(8, 'OMNL5', 100000, 0, '2019-05-03 17:00:00', 'all', NULL, 2, '2019-05-02 02:24:35', '2019-05-02 02:24:35'),
(9, 'OMNL6', 0, 100, '2019-05-03 17:00:00', 'new', NULL, 3, '2019-05-02 02:40:16', '2019-05-02 02:40:16'),
(10, 'OMNL7', 100000, 0, '2019-05-03 17:00:00', 'extend', NULL, 4, '2019-05-02 02:40:34', '2019-05-02 02:40:34'),
(11, 'OMNL8', 100000, 0, '2019-04-30 17:00:00', 'extend', NULL, 4, '2019-05-02 02:40:34', '2019-05-02 02:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(10) UNSIGNED NOT NULL,
  `pages_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `type` smallint(6) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `names` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pixel_id` int(11) NOT NULL DEFAULT '0',
  `counter` int(11) NOT NULL DEFAULT '0',
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id`, `pages_id`, `users_id`, `type`, `title`, `link`, `names`, `pixel_id`, `counter`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, 'link1', 'https://omnifluencer.com/', NULL, 1, 39, NULL, '2019-04-18 02:47:33', '2019-06-10 06:45:08'),
(2, 0, 5, NULL, 'testing', 'https://www.google.com/?gws_rd=ssl', 'KACsSGT', 2, 0, NULL, '2019-05-06 01:43:53', '2019-05-06 01:43:53'),
(6, 3, 5, NULL, 'tes', 'https://mail.google.com', NULL, 0, 2, NULL, '2019-05-07 03:04:56', '2019-05-08 07:04:36'),
(7, 0, 5, NULL, 'testing2', 'testestes', 'lR5Mlkk', 2, 0, NULL, '2019-05-15 06:21:54', '2019-05-15 06:21:54'),
(8, 1, 5, NULL, 'link2', 'https://omnifluencer.com/', NULL, 0, 5, NULL, '2019-05-20 04:37:56', '2019-06-12 08:55:13'),
(10, 1, 5, NULL, 'link2', 'https://omnifluencer.com/', NULL, 0, 1, NULL, '2019-05-20 06:56:23', '2019-06-12 08:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_13_154720_create_orders_table', 1),
(4, '2019_02_18_113445_create_table_notification', 1),
(5, '2019_02_22_104534_create_pages_table', 1),
(6, '2019_02_22_112939_create_links_table', 1),
(7, '2019_02_22_113951_create_referral_table', 1),
(8, '2019_02_22_131730_create_pixel_table', 1),
(9, '2019_02_22_132327_create_template_table', 1),
(10, '2019_03_01_111535_add_type_pixel', 1),
(11, '2019_03_01_133948_add_names_pages', 1),
(12, '2019_03_01_153346_create_whatsapplink_table', 1),
(13, '2019_03_04_091043_add_uid_pages', 1),
(14, '2019_03_12_152753_add_names_links', 1),
(15, '2019_03_13_152205_add_sort_pages', 1),
(16, '2019_03_14_095214_add_pagetitle_table', 1),
(17, '2019_03_14_101944_add_full_table', 1),
(18, '2019_03_14_105944_add_totalcounter_table', 1),
(19, '2019_03_14_114449_add_logo_table', 1),
(20, '2019_03_14_155336_add_image_table', 1),
(21, '2019_03_14_161253_add_nomor_table', 1),
(22, '2019_03_18_170046_create_banner_table', 1),
(23, '2019_03_25_152139_add_template_table', 1),
(24, '2019_03_26_133950_add_colorpicker_pages', 1),
(25, '2019_03_27_084321_add_rounded_pages', 1),
(26, '2019_03_27_095743_add_outline_pages', 1),
(27, '2019_03_27_144815_add_powered_pages', 1),
(28, '2019_03_28_114923_add_colom_pages', 1),
(29, '2019_03_28_154202_add_sosmedcolom_pages', 1),
(30, '2019_04_01_111021_create_history_table', 1),
(32, '2019_04_29_145236_change_membership_users_table', 2),
(33, '2019_04_08_095940_create_orders_table_mysql2', 3),
(34, '2019_04_29_153001_create_coupons_table', 4),
(35, '2019_05_02_154202_add_isrounded_isoutlined_pages', 5),
(36, '2019_05_09_154833_add_jenis_pixel_pixels_table', 5),
(38, '2019_06_12_082457_add_line_messenger_table_pages', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` smallint(6) NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `package` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jmlpoin` int(11) NOT NULL,
  `total` double NOT NULL,
  `discount` double DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `buktibayar` text COLLATE utf8mb4_unicode_ci,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `color_picker` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rounded` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `powered` int(11) DEFAULT '0',
  `template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `names` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_pages` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_utama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telpon_utama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` smallint(6) DEFAULT NULL,
  `uid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_pixel_id` int(11) DEFAULT '0',
  `wa_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_pixel_id` int(11) DEFAULT '0',
  `fb_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ig_pixel_id` int(11) DEFAULT '0',
  `ig_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_pixel_id` int(11) DEFAULT '0',
  `twitter_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_pixel_id` int(11) DEFAULT '0',
  `youtube_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram_pixel_id` int(11) DEFAULT '0',
  `telegram_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_pixel_id` int(11) DEFAULT '0',
  `skype_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_link_counter` int(11) DEFAULT '0',
  `fb_link_counter` int(11) DEFAULT '0',
  `ig_link_counter` int(11) DEFAULT '0',
  `twitter_link_counter` int(11) DEFAULT '0',
  `youtube_link_counter` int(11) DEFAULT '0',
  `telegram_link_counter` int(11) DEFAULT '0',
  `skype_link_counter` int(11) DEFAULT '0',
  `total_counter` bigint(20) NOT NULL DEFAULT '0',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `colom_sosmed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_msg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_sosmed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_rounded` smallint(6) DEFAULT '0',
  `is_outlined` smallint(6) DEFAULT '0',
  `line_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_pixel_id` int(11) NOT NULL,
  `line_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messenger_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messenger_link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `messenger_pixel_id` int(11) NOT NULL,
  `messenger_logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_link_counter` int(11) NOT NULL DEFAULT '0',
  `messenger_link_counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `color_picker`, `rounded`, `outline`, `powered`, `template`, `names`, `image_pages`, `page_title`, `link_utama`, `telpon_utama`, `type`, `uid`, `wa_title`, `wa_link`, `wa_pixel_id`, `wa_logo`, `keterangan`, `fb_title`, `fb_link`, `fb_pixel_id`, `fb_logo`, `ig_title`, `ig_link`, `ig_pixel_id`, `ig_logo`, `twitter_title`, `twitter_link`, `twitter_pixel_id`, `twitter_logo`, `youtube_title`, `youtube_link`, `youtube_pixel_id`, `youtube_logo`, `telegram_title`, `telegram_link`, `telegram_pixel_id`, `telegram_logo`, `skype_title`, `skype_link`, `skype_pixel_id`, `skype_logo`, `wa_link_counter`, `fb_link_counter`, `ig_link_counter`, `twitter_link_counter`, `youtube_link_counter`, `telegram_link_counter`, `skype_link_counter`, `total_counter`, `description`, `colom`, `colom_sosmed`, `sort_msg`, `sort_link`, `sort_sosmed`, `created_at`, `updated_at`, `is_rounded`, `is_outlined`, `line_title`, `line_link`, `line_pixel_id`, `line_logo`, `messenger_title`, `messenger_link`, `messenger_pixel_id`, `messenger_logo`, `line_link_counter`, `messenger_link_counter`) VALUES
(1, 5, '#18334e', '#5418b4', '#1f52e0', 1, NULL, 'Pg7rInA', 'photo_page/Puspitasari-5/1906101711-1.jpg', 'Omnifluencer', 'https://omnifluencer.com/', NULL, NULL, 'edd58740-038c-4fb8-8250-ada3ff0484c5', NULL, 'https://api.whatsapp.com/send?phone=087853453863', 0, NULL, NULL, NULL, 'https://www.facebook.com/', 0, NULL, NULL, 'https://www.instagram.com/', 0, NULL, NULL, 'https://www.twitter.com/', 0, NULL, NULL, 'https://www.youtube.com/', 0, NULL, NULL, '087853453863', 0, NULL, NULL, '087853453863', 0, NULL, 15, 7, 9, 6, 5, 14, 9, 0, NULL, 'links-num-3', 'col-md-3 col-3 text-center', 'telegram;line;wa;messenger;skype;', '8;10;1;', 'youtube;fb;twitter;ig;', '2019-04-18 02:33:01', '2019-06-12 08:56:07', 1, 1, '', '930219301', 1, '', '', '3201930193', 1, '', 9, 0),
(3, 5, NULL, NULL, NULL, 0, 'colorgradient1', 'dNaAH5B', NULL, NULL, NULL, NULL, NULL, 'f491a96b-dace-4d62-840a-acf722832a24', NULL, 'https://mail.google.com', 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, 'https://mail.google.com', 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, 3, 1, 1, 1, 3, 0, 0, 0, NULL, 'links-num-1', 'col-md-12 col-12 text-center', '', '6-12', 'youtube-12', '2019-05-07 03:03:26', '2019-05-08 07:04:56', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(5, 5, NULL, NULL, NULL, 0, NULL, 'eV4UjsZ', NULL, NULL, NULL, NULL, NULL, '51b56d67-c58c-4bfd-834d-b400918bd92b', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-08 08:06:58', '2019-05-08 08:06:58', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(7, 15, NULL, NULL, NULL, 0, NULL, 'UjidxYT', NULL, NULL, NULL, NULL, NULL, 'a113fdc8-43ff-4995-9b5a-b8910583914b', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 06:55:55', '2019-05-17 06:55:55', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(8, 5, NULL, NULL, NULL, 0, NULL, 'g0K9qES', NULL, NULL, NULL, NULL, NULL, '90b8eb27-aa59-472d-a8ea-7907bf4aa76f', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-27 06:15:47', '2019-05-27 06:15:47', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(9, 5, NULL, '#123456', '#123456', 1, 'colorgradient1', 'ImvqF7p', 'photo_page/Puspitasari-5/1906111602-9.jpg', 'omnilinkz', 'https://stackoverflow.com', '0920192018', NULL, 'a0928abe-012c-485f-bc4f-8f0930e6d7d1', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-28 01:45:50', '2019-06-11 09:02:43', NULL, NULL, '', '', 0, '', '', '', 0, '', 0, 0),
(12, 38, NULL, NULL, NULL, 0, NULL, '2hK0Gd1', NULL, NULL, NULL, NULL, NULL, 'df47f6b5-26fb-4d29-a609-38256c386cde', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:11:14', '2019-06-11 07:11:14', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(13, 38, NULL, NULL, NULL, 0, NULL, 'SqbmeHv', NULL, NULL, NULL, NULL, NULL, '2e48dda5-8f9a-476b-9ba1-eb5fd0e2aa07', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:11:54', '2019-06-11 07:11:54', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(14, 38, NULL, NULL, NULL, 0, NULL, 'p5wzfSE', NULL, NULL, NULL, NULL, NULL, 'a9e46d33-ad29-4016-8d30-8191eee36d1b', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:12:03', '2019-06-11 07:12:03', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(15, 38, NULL, NULL, NULL, 0, NULL, 'WM6z197', NULL, NULL, NULL, NULL, NULL, '907a1512-3c51-4d9f-9cd1-9d130cbf077f', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:13:01', '2019-06-11 07:13:01', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(16, 38, NULL, NULL, NULL, 0, NULL, 'RVNvbvU', NULL, NULL, NULL, NULL, NULL, '9b4bccd1-8367-4239-b8c8-2341b59d7de6', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:13:14', '2019-06-11 07:13:14', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(17, 38, NULL, NULL, NULL, 0, NULL, 'jHTIB5m', NULL, NULL, NULL, NULL, NULL, '317e81eb-7e8a-4c11-8754-b26a6512c610', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:13:22', '2019-06-11 07:13:22', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(18, 38, NULL, NULL, NULL, 0, NULL, 'bSrQx3R', NULL, NULL, NULL, NULL, NULL, 'c1b0e697-dd31-402a-92a4-274d465fac70', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:13:30', '2019-06-11 07:13:30', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(19, 38, NULL, NULL, NULL, 0, NULL, '9swhz9P', NULL, NULL, NULL, NULL, NULL, '3a9a3737-b7b2-4a92-9285-1036b1e74a54', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:13:46', '2019-06-11 07:13:46', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(20, 38, NULL, NULL, NULL, 0, NULL, 'MyaCPez', NULL, NULL, NULL, NULL, NULL, '9b7fcabf-49aa-40ac-9d53-c7ac59fceb2b', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:13:54', '2019-06-11 07:13:54', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0),
(21, 38, NULL, NULL, NULL, 0, NULL, 'S42NYWd', NULL, NULL, NULL, NULL, NULL, 'c7272997-1b39-44fc-bc60-7e592d4b322f', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-11 07:14:02', '2019-06-11 07:14:02', 0, 0, '', '', 0, '', '', '', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pixels`
--

CREATE TABLE `pixels` (
  `id` int(10) UNSIGNED NOT NULL,
  `pages_id` int(11) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pixel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pixels`
--

INSERT INTO `pixels` (`id`, `pages_id`, `users_id`, `type`, `jenis_pixel`, `title`, `script`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, 'fb', 'pixel1', '<script>\r\n  !function(f,b,e,v,n,t,s)\r\n  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?\r\n  n.callMethod.apply(n,arguments):n.queue.push(arguments)};\r\n  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version=\'2.0\';\r\n  n.queue=[];t=b.createElement(e);t.async=!0;\r\n  t.src=v;s=b.getElementsByTagName(e)[0];\r\n  s.parentNode.insertBefore(t,s)}(window, document,\'script\',\r\n  \'https://connect.facebook.net/en_US/fbevents.js\');\r\n  fbq(\'init\', \'354171388566042\');\r\n  fbq(\'track\', \'PageView\');\r\n</script>\r\n<noscript><img height=\"1\" width=\"1\" style=\"display:none\"\r\n  src=\"https://www.facebook.com/tr?id=354171388566042&ev=PageView&noscript=1\"\r\n/></noscript>\r\n', NULL, '2019-04-18 02:33:53', '2019-04-18 02:33:53'),
(2, 0, 5, NULL, 'google', 'aaa', 'aaa', NULL, '2019-05-06 01:43:47', '2019-05-06 01:43:47'),
(3, 1, 5, NULL, 'twitter', 'apapapa', 'apayaa', NULL, '2019-05-13 07:45:27', '2019-05-13 07:45:27'),
(4, 0, 5, NULL, 'fb', 'testes', 'testes', NULL, '2019-05-14 02:08:11', '2019-05-14 02:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id_taker` int(11) NOT NULL DEFAULT '0',
  `user_id_giver` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `point` int(11) DEFAULT '0',
  `is_admin` tinyint(1) DEFAULT '0',
  `is_confirm` tinyint(1) DEFAULT '0',
  `confirm_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `membership` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prof_pic` text COLLATE utf8mb4_unicode_ci,
  `count_csv` int(11) NOT NULL DEFAULT '0',
  `count_pdf` int(11) NOT NULL DEFAULT '0',
  `count_calc` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valid_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `gender`, `point`, `is_admin`, `is_confirm`, `confirm_code`, `last_login`, `membership`, `referral_link`, `prof_pic`, `count_csv`, `count_pdf`, `count_calc`, `remember_token`, `created_at`, `updated_at`, `valid_until`) VALUES
(5, 'Puspitasari N', 'puspita.celebgramme@gmail.com', 'puspitaa', '$2y$10$dZMICoYMc8j6oTCp7VU0Zu8I46/DfWaDRT7X6efdzSWQVbsA9vjy.', 0, 0, 1, 1, NULL, NULL, 'free', NULL, NULL, 0, 0, 0, 'sfniIsOO2kFB3iXJIgsl8SMyMo54N1BzsTGOT3rcy9HEQLPYUZDbdpfEPlwF', NULL, '2019-06-11 07:51:14', NULL),
(15, 'Puspita', 'puspitanurhidayati@gmail.com', 'puspitanurhidayati@gmail.com', '$2y$10$0L6yWEhMAn0kX8uFNUrN9ulKQtgjDFdEtPH0feZf/xTrWiS.r8msK', 1, 0, 0, 0, '$2y$10$95E5B/IbVRdfQ/9XyD7nYOIs0W4iv.iLSEJEM2F/n3zRlcFOVHaty', NULL, 'free', NULL, NULL, 0, 0, 0, 'gYlnGKSBP7D0W1P0PM1dxmTGhGEoNnio7DbIIXDpvSS2iDbz3kMOhcnZaJLj', '2019-04-30 07:29:06', '2019-06-10 09:38:58', NULL),
(33, 'Wahyu wahyuclbg', 'wahyucelebgramme@gmail.com', 'wahyucelebgramme', '$2y$10$MO1BqKAIQcSYvfMlssTcEu6uCp3hqisQcIoBJ2lC3ZM8EQN0bNViS', 1, 0, 0, 0, '$2y$10$Ap5pHtsVyRI7But/nKwSTebveo8aaTOZXHoeEBAt9X.9Ff8ZCmfs6', NULL, 'free', NULL, NULL, 0, 0, 0, 'C2mIi1qHgscWr6tlBGMNXSdXABXdulHsQhznvcrawupLw4LAH5QELzWep03Q', '2019-05-14 03:30:16', '2019-05-14 03:30:16', '2019-06-30 03:30:16'),
(38, 'free1', 'free1@gmail.com', 'free1', '$2y$10$aHl9aEwOhGOuXZ7SsFQwBepbEA3HwH2TqdFGNqCrwmPB8eZ76OPAu', 0, 0, 0, 0, '$2y$10$NVlwn/Mk0jnB59UGLq8T4eCulo.FzNcoyPBF1V..KeW8TFZqXsVc.', NULL, 'free', NULL, NULL, 0, 0, 0, 'RfVddFwmhk1mxupmsMy7eLFeqyZ7VaCNEi0GIe91Ndha3BCc9ePuLnT6HlLt', '2019-06-11 03:30:28', '2019-06-11 03:30:28', '2019-06-11 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapplinks`
--

CREATE TABLE `whatsapplinks` (
  `id` int(10) UNSIGNED NOT NULL,
  `pages_id` int(11) NOT NULL DEFAULT '0',
  `users_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor` bigint(20) DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci,
  `linkgenerator` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whatsapplinks`
--

INSERT INTO `whatsapplinks` (`id`, `pages_id`, `users_id`, `title`, `nomor`, `pesan`, `linkgenerator`, `created_at`, `updated_at`) VALUES
(1, 1, 5, NULL, 29209029, 'teuyrueyru', 'https://api.whatsapp.com/send?phone=29209029&text=%20teuyrueyru', '2019-05-27 01:40:11', '2019-05-27 01:40:11'),
(2, 1, 5, NULL, 29209029, 'teuyrueyru', 'https://api.whatsapp.com/send?phone=29209029&text=%20teuyrueyru', '2019-05-27 01:40:11', '2019-05-27 01:40:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `links_names_unique` (`names`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_names_unique` (`names`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pixels`
--
ALTER TABLE `pixels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `whatsapplinks`
--
ALTER TABLE `whatsapplinks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pixels`
--
ALTER TABLE `pixels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `whatsapplinks`
--
ALTER TABLE `whatsapplinks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
