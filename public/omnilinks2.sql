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
-- Database: `omnilinks2`
--

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
  `jmlpoin` int(11) NOT NULL DEFAULT '0',
  `total` double NOT NULL DEFAULT '0',
  `discount` double DEFAULT '0',
  `grand_total` double NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `buktibayar` text COLLATE utf8mb4_unicode_ci,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `no_order`, `user_id`, `coupon_id`, `package`, `jmlpoin`, `total`, `discount`, `grand_total`, `status`, `buktibayar`, `keterangan`, `created_at`, `updated_at`) VALUES
(14, 'OML1905021346001', 18, 4, 'Basic Monthly', 0, 197000, 100000, 97000, 0, '', '', '2019-05-02 06:46:23', '2019-05-02 06:46:23'),
(15, 'OML1905021347001', 18, 4, 'Basic Monthly', 0, 197000, 100000, 97000, 0, '', '', '2019-05-02 06:47:09', '2019-05-02 06:47:09'),
(16, 'OML1905021350001', 18, NULL, 'Basic Monthly', 0, 197000, 0, 197000, 0, '', '', '2019-05-02 06:50:34', '2019-05-02 06:50:34'),
(17, 'OML1905021358001', 19, 5, 'Basic Yearly', 0, 660000, 660000, 0, 2, '', '', '2019-05-02 06:58:20', '2019-05-02 06:58:20'),
(18, 'OML1905021404001', 20, 5, 'Basic Yearly', 0, 660000, 660000, 0, 2, '', '', '2019-05-02 07:04:39', '2019-05-02 07:04:39'),
(19, 'OML1905021406001', 20, NULL, 'Basic Monthly', 0, 197000, 0, 197000, 2, '', '', '2019-05-02 07:06:25', '2019-05-02 09:28:57'),
(20, 'OML1905021410001', 20, 6, 'Elite Monthly', 0, 297000, 100000, 197000, 0, '', '', '2019-05-02 07:10:32', '2019-05-02 07:10:32'),
(21, 'OML1905021412001', 21, NULL, 'Elite Monthly', 0, 297000, 0, 297000, 0, '', '', '2019-05-02 07:12:30', '2019-05-02 07:12:30'),
(22, 'OML1905021430001', 21, 7, 'Basic Monthly', 0, 197000, 197000, 0, 2, '', '', '2019-05-02 07:30:37', '2019-05-02 07:30:37'),
(23, 'OML1905021433001', 22, NULL, 'Basic Monthly', 0, 197000, 0, 197000, 0, '', '', '2019-05-02 07:33:19', '2019-05-02 07:33:19'),
(24, 'OML1905021438001', 22, 8, 'Basic Yearly', 0, 660000, 100000, 560000, 0, '', '', '2019-05-02 07:38:26', '2019-05-02 07:38:26'),
(25, 'OML1905021439001', 22, NULL, 'Elite Monthly', 0, 297000, 0, 297000, 2, '', '', '2019-05-02 07:39:39', '2019-05-02 09:25:05'),
(26, 'OML1905021440001', 23, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 07:40:52', '2019-05-02 07:40:52'),
(27, 'OML1905021446001', 24, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 07:46:10', '2019-05-02 07:46:10'),
(28, 'OML1905021503001', 25, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:03:31', '2019-05-02 08:03:31'),
(29, 'OML1905021507001', 26, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:07:49', '2019-05-02 08:07:49'),
(30, 'OML1905021509001', 27, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:09:44', '2019-05-02 08:09:44'),
(31, 'OML1905021516001', 28, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:16:34', '2019-05-02 08:16:34'),
(32, 'OML1905021517001', 29, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:17:53', '2019-05-02 08:17:53'),
(33, 'OML1905021536001', 30, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:36:26', '2019-05-02 08:36:26'),
(34, 'OML1905021547001', 31, 9, 'Elite Monthly', 0, 297000, 297000, 0, 2, '', '', '2019-05-02 08:47:12', '2019-05-02 08:47:12'),
(35, 'OML1905021659001', 31, 4, 'Basic Monthly', 0, 197000, 100000, 97000, 0, '', '', '2019-05-02 09:59:50', '2019-05-02 09:59:50'),
(36, 'OML1905141015001', 5, NULL, 'Basic Yearly', 0, 660000, 0, 660000, 0, '', '', '2019-05-14 03:15:05', '2019-05-14 03:15:05'),
(37, 'OML1905141015002', 5, NULL, 'Elite Yearly', 0, 900000, 0, 900000, 0, '', '', '2019-05-14 03:15:54', '2019-05-14 03:15:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
