-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2019 pada 05.39
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `entry_queue`
--

CREATE TABLE `entry_queue` (
  `id` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `mover_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `entry_queue`
--

INSERT INTO `entry_queue` (`id`, `queue_id`, `document_no`, `mover_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, '123xyz', 1, 8, 1, '2019-01-04 23:41:31', '2019-01-04 18:11:31'),
(1, 1, 'd13456', 2, 10, 1, '2018-12-22 11:18:16', '2018-12-22 05:48:16'),
(4, 2, 'a1wer', 1, 10, 1, '2018-12-22 17:22:16', '2018-12-22 11:52:16'),
(5, 3, 'b1', 2, 5, 1, '2018-12-22 17:23:19', '2018-12-22 11:53:19'),
(7, 1, 'asw2345', 2, 3, 1, '2018-12-27 22:02:52', '2018-12-27 16:32:52'),
(8, 2, 'fghryt4657', 2, 3, 1, '2018-12-27 22:13:46', '2018-12-27 16:43:46'),
(9, 1, 'sdert5', 2, 3, 1, '2019-01-30 21:49:45', '2019-01-30 16:19:45'),
(11, 1, 'ghtyu789', 1, 5, 1, '2019-01-05 18:09:23', '2019-01-05 12:39:23'),
(12, 1, 'asdert567', 1, 5, 1, '2019-01-30 22:46:40', '2019-01-30 17:16:40'),
(13, 1, 'ghty', 1, 8, 1, '2019-01-30 16:34:18', '2019-01-30 11:04:18'),
(14, 2, 'adwety6', 2, 8, 1, '2019-01-25 10:58:43', '2019-01-25 05:28:43'),
(15, 1, 'asdwe234', 2, 3, 1, '2019-02-06 16:42:12', '2019-02-06 11:12:12'),
(16, 1, 'zxc23', 1, 5, 1, '2019-02-16 12:48:15', '2019-02-16 07:18:15'),
(17, 1, 'Testing Rejected', 1, 9, 1, '2019-02-21 02:45:56', '2019-02-20 19:45:56'),
(18, 2, 'Document Test', 1, 2, 1, '2019-02-21 04:34:57', '2019-02-20 21:34:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `entry_queue_detail`
--

CREATE TABLE `entry_queue_detail` (
  `id` int(11) NOT NULL,
  `entry_queue_id` int(11) NOT NULL,
  `mfr` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty_po` int(11) NOT NULL,
  `qty_sent` int(11) NOT NULL,
  `qty_receive` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `um` varchar(255) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `location_rack` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `entry_queue_detail`
--

INSERT INTO `entry_queue_detail` (`id`, `entry_queue_id`, `mfr`, `part_name`, `description`, `qty_po`, `qty_sent`, `qty_receive`, `balance`, `um`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(1, 1, 'ju1', 'egr', 'dtryhdhgfhdtr ertet', 25, 25, 25, 3666, 'each', '4', '1', '2019-01-04 23:46:26', '2019-01-04 18:16:26'),
(2, 1, 'de2', 'eeee', 'xdfg dfgdf', 20, 10, 10, 700, 'each', '4', '1', '2018-12-22 11:03:55', '2018-12-22 05:33:04'),
(3, 3, 's1', 'ghtyu', 'dfgd trghj', 15, 7, 7, 500, 'each', '4', '1', '2018-12-22 05:37:21', '2018-12-22 05:37:21'),
(4, 3, 's1', 'ghtyu', 'dfgd trghj', 15, 7, 7, 500, 'each', '4', '1', '2019-01-04 23:41:31', '2019-01-04 18:11:31'),
(5, 4, 'd1', 'dde', 'awe warewq', 5, 5, 5, 100, 'each', '4', '1', '2018-12-22 11:50:18', '2018-12-22 11:50:18'),
(6, 5, 'b1', 'bbb', 'erer werwer wer', 10, 10, 10, 300, 'each', '4', '1', '2018-12-22 11:51:09', '2018-12-22 11:51:09'),
(7, 7, 'gq1', 'wesrt ftgh', 'drgfyhe', 30, 20, 20, 6000, 'each', '4', '1', '2018-12-27 16:31:34', '2018-12-27 16:31:34'),
(8, 8, 'fq1', 'fdghfgh', 'drtdrd', 5, 5, 5, 2000, 'each', '4', '1', '2018-12-27 16:40:05', '2018-12-27 16:40:05'),
(9, 8, 'fq2', 'jhhg', 'dxfgd grtg', 10, 5, 5, 1000, 'each', '4', '1', '2019-01-05 10:37:43', '2019-01-05 05:07:43'),
(10, 9, 'ju1', 'egr', 'dtryhdhgfhdtr', 25, 25, 25, 3666, 'each', '4', '1', '2018-12-28 04:52:10', '2018-12-28 04:52:10'),
(11, 11, 'ju1', 'ee', 'tytvbg', 10, 10, 10, 3000, 'each', '4', '1', '2019-01-05 12:38:14', '2019-01-05 12:38:14'),
(12, 11, 'ju2', 'rtr', 'yui', 10, 10, 10, 4000, 'each', '4', '1', '2019-01-05 12:38:14', '2019-01-05 12:38:14'),
(13, 12, 'gr1', 'grr', 'wr qrwr q4rqw3', 5, 5, 5, 2500, 'each', '4', '1', '2019-01-08 05:32:11', '2019-01-08 05:32:11'),
(14, 12, 'gr2', 'grt', 'qweqwrwe q43rw3', 5, 5, 5, 2000, 'each', '4', '1', '2019-01-08 05:32:11', '2019-01-08 05:32:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `warehouse_id`, `location_id`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 9, 3, 0, 1, '2019-02-16 20:04:16', '2019-02-16 14:34:16'),
(2, 1, 4, 1, 2, 0, '2019-02-16 21:40:25', '2019-02-16 16:10:25'),
(3, 1, 9, 3, 3, 0, '2019-02-16 21:40:25', '2019-02-16 16:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `receive_report_id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `source_reference` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`id`, `document_no`, `receive_report_id`, `reference_type`, `reference`, `source`, `source_type`, `source_name`, `source_reference`, `user_id`, `receiver_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'd13456', 3, 'external', 'internal', 'external', 'supplier', 'aswer', 'external', 1, 5, 3, '2018-12-27 23:05:54', '2018-12-27 17:35:54'),
(2, 'fghryt4657', 4, 'external', 'internal', 'external', 'supplier', 'weryui dryt', 'external', 1, 3, 0, '2019-01-05 18:34:36', '2019-01-05 13:04:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_parts_detail`
--

CREATE TABLE `item_parts_detail` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `mfr` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty_po` int(11) NOT NULL,
  `um` varchar(255) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `location_rack` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_parts_detail`
--

INSERT INTO `item_parts_detail` (`id`, `item_id`, `mfr`, `part_name`, `description`, `qty_po`, `um`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(1, 1, 'de1', 'dddd', 'sdfd fght', 10, 'each', 4, 1, '2018-12-23 13:07:04', '2018-12-23 13:07:04'),
(2, 1, 'de2', 'eeee', 'xdfg dfgdf', 20, 'each', 4, 1, '2018-12-23 13:07:04', '2018-12-23 13:07:04'),
(3, 2, 'fq1', 'fdghfgh', 'drtdrd dftgh', 3, 'each', 4, 1, '2019-01-05 18:34:36', '2019-01-05 13:04:36'),
(4, 2, 'fq2', 'dfyrt', 'ghhgf rty', 3, 'each', 4, 1, '2019-01-05 18:34:36', '2019-01-05 13:04:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `material_request`
--

CREATE TABLE `material_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_approve` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `material_request`
--

INSERT INTO `material_request` (`id`, `user_id`, `requester_id`, `reference_type`, `reference`, `source`, `source_type`, `source_id`, `status`, `is_approve`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'internal_department', 'internal', 'external', 'supplier', 2, 3, 1, '2019-02-07 11:54:16', '2019-02-07 06:24:16'),
(2, 1, 5, 'dispatch_order', 'internal', 'external', 'supplier', 2, 1, 1, '2019-02-07 11:33:15', '2018-12-21 16:24:53'),
(3, 1, 3, 'dispatch_order', 'internal', 'external', 'supplier', 1, 2, 1, '2019-02-07 17:09:12', '2019-02-07 11:39:12'),
(7, 1, 3, 'internal_department', 'internal', 'external', 'supplier', 2, 2, 1, '2019-02-07 11:33:15', '2018-12-28 06:19:20'),
(6, 1, 5, 'dispatch_order', 'internal', 'external', 'supplier', 1, 3, 1, '2019-02-07 11:33:15', '2018-12-21 16:44:53'),
(9, 1, 5, 'internal_department', 'internal', 'external', 'supplier', 1, 0, 0, '2019-02-07 06:16:18', '2019-02-07 06:16:18'),
(10, 1, 10, 'internal_department', 'internal', 'external', 'supplier', 2, 1, 1, '2019-02-16 13:37:18', '2019-02-16 08:07:18'),
(11, 1, 9, 'internal_department', 'internal', 'external', 'supplier', 2, 0, 1, '2019-02-16 19:38:34', '2019-02-16 14:08:11'),
(12, 1, 9, 'internal_department', 'internal', 'external', 'supplier', 1, 0, 1, '2019-02-16 19:46:58', '2019-02-16 14:16:58'),
(13, 1, 9, 'internal_department', 'internal', 'external', 'supplier', 1, 1, 1, '2019-02-16 20:04:16', '2019-02-16 14:34:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `material_request_item`
--

CREATE TABLE `material_request_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_request` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `material_request_id` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `location_rack` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `material_request_item`
--

INSERT INTO `material_request_item` (`id`, `product_id`, `mfr`, `part_name`, `description`, `qty_request`, `um`, `material_request_id`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(1, 1, 't1', 'tier', 'sdfre', 5, 'each', 1, 4, 1, '2019-02-07 11:55:01', '2019-02-07 06:25:01'),
(2, 1, 't1', 'tier', 'rtyu', 5, 'each', 2, 4, 1, '2018-12-04 10:51:47', '2018-11-30 17:13:16'),
(11, 3, 'e2', 'hyutg', 'kjhkj kjhkjl kulhk', 5, 'each', 6, 4, 1, '2018-12-21 16:41:17', '2018-12-21 16:41:17'),
(15, 3, NULL, NULL, NULL, 5, NULL, 10, 4, 1, '2019-02-16 13:36:42', '2019-02-16 08:06:42'),
(10, 3, 'e1', 'swer', 'wer w45 w345', 10, 'each', 6, 4, 1, '2018-12-21 16:41:17', '2018-12-21 16:41:17'),
(8, 3, '1b', 'bbbb', 'dsf dre sdr', 10, 'each', 2, 4, 1, '2018-12-14 05:46:23', '2018-12-14 05:46:23'),
(9, 4, '1c', 'ccccc', 'fdgh ty io eyu6', 5, 'each', 3, 4, 1, '2018-12-14 05:52:00', '2018-12-14 05:52:00'),
(12, 1, 'de1', 'dddd', 'sdfd fght', 6, 'each', 7, 4, 1, '2018-12-26 17:46:23', '2018-12-26 17:46:23'),
(14, 1, NULL, NULL, NULL, 2, NULL, 9, 4, 1, '2019-02-07 06:16:18', '2019-02-07 06:16:18'),
(16, 2, NULL, NULL, NULL, 5, NULL, 11, 4, 1, '2019-02-16 13:24:27', '2019-02-16 13:24:27'),
(17, 1, NULL, NULL, NULL, 5, NULL, 12, 4, 1, '2019-02-16 14:16:16', '2019-02-16 14:16:16'),
(18, 3, NULL, NULL, NULL, 15, NULL, 13, 4, 1, '2019-02-16 14:32:04', '2019-02-16 14:32:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_12_05_105205_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mover`
--

CREATE TABLE `mover` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mover`
--

INSERT INTO `mover` (`id`, `name`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'desi', 'first mover', '2018-11-20 19:39:35', '2018-11-20 13:07:36', 1),
(2, 'jesh', 'second mover', '2018-11-26 16:16:33', '2018-11-26 10:46:33', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `packing_items`
--

CREATE TABLE `packing_items` (
  `id` int(11) NOT NULL,
  `send_items_from_wh_id` int(11) NOT NULL,
  `pack_by_id` int(11) NOT NULL,
  `do_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_packed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `packing_items`
--

INSERT INTO `packing_items` (`id`, `send_items_from_wh_id`, `pack_by_id`, `do_id`, `status`, `is_packed`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 8, 1, 1, '2019-02-07 22:33:32', '2019-02-07 17:03:32'),
(2, 5, 5, 5, 1, 1, '2018-12-27 23:16:38', '2018-12-27 17:46:38'),
(3, 8, 2, 3, 1, 1, '2019-02-07 22:42:15', '2019-02-07 17:12:15'),
(4, 8, 5, 5, 0, 0, '2019-02-07 16:45:20', '2019-02-07 16:45:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packing_item_detail`
--

CREATE TABLE `packing_item_detail` (
  `id` int(11) NOT NULL,
  `packing_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_pack` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `location_rack` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `packing_item_detail`
--

INSERT INTO `packing_item_detail` (`id`, `packing_id`, `product_id`, `qty_pack`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 1, 4, 1, '2019-02-07 16:45:20', '2019-02-07 16:45:20'),
(2, 3, 2, 1, 4, 1, '2019-02-07 22:36:05', '0000-00-00 00:00:00'),
(3, 4, 3, 2, 4, 1, '2019-02-07 22:36:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pick_item`
--

CREATE TABLE `pick_item` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pick_by_id` int(11) NOT NULL,
  `material_request_id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pick_item`
--

INSERT INTO `pick_item` (`id`, `user_id`, `pick_by_id`, `material_request_id`, `reference_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 1, 'internal_department', 2, '2018-12-21 22:00:45', '2018-12-21 16:30:45'),
(2, 1, 10, 2, 'dispatch_order', 0, '2018-12-21 16:24:53', '2018-12-21 16:24:53'),
(3, 1, 3, 6, 'dispatch_order', 2, '2018-12-21 22:14:53', '2018-12-21 16:44:53'),
(4, 1, 5, 7, 'internal_department', 1, '2018-12-28 11:49:20', '2018-12-28 06:19:20'),
(5, 1, 8, 8, 'dispatch_order', 2, '2018-12-27 23:14:11', '2018-12-27 17:44:11'),
(12, 1, 3, 10, 'internal_department', 0, '2019-02-16 08:07:18', '2019-02-16 08:07:18'),
(16, 1, 5, 13, 'internal_department', 0, '2019-02-16 14:34:16', '2019-02-16 14:34:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pick_item_detail`
--

CREATE TABLE `pick_item_detail` (
  `id` int(11) NOT NULL,
  `pick_item_id` int(11) NOT NULL,
  `mr_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `um` varchar(255) DEFAULT NULL,
  `qty_picked` int(11) NOT NULL,
  `location_rack` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pick_item_detail`
--

INSERT INTO `pick_item_detail` (`id`, `pick_item_id`, `mr_item_id`, `product_id`, `mfr`, `part_name`, `description`, `um`, `qty_picked`, `location_rack`, `warehouse`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 't1', 'tier', 'sdfre', 'each', 1, 1, 4, 'sdf df sdfs', '2019-02-07 16:16:50', '2018-12-21 16:23:53'),
(2, 1, 6, 1, 't1', 'tier', 'sdfre', 'each', 2, 1, 4, 'sdfdsfgdgd', '2019-02-07 16:16:50', '2018-12-21 16:23:53'),
(3, 2, 2, 2, 't1', 'tier', 'rtyu', 'each', 3, 1, 4, 'xfgdf sdfgs', '2019-02-07 16:16:50', '2018-12-21 16:24:53'),
(4, 2, 8, 2, '1b', 'bbbb', 'dsf dre sdr', 'each', 5, 1, 4, 'sfdgd dfgd', '2019-02-07 16:16:50', '2018-12-21 16:24:53'),
(5, 3, 11, 3, 'e2', 'hyutg', 'kjhkj kjhkjl kulhk', 'each', 2, 1, 4, 'sdfg dfg', '2019-02-07 16:16:50', '2018-12-21 16:42:41'),
(6, 3, 10, 3, 'e1', 'swer', 'wer w45 w345', 'each', 5, 1, 4, 'Asf adf', '2019-02-07 16:16:50', '2018-12-21 16:42:41'),
(7, 4, 12, 4, 'de1', 'dddd', 'sdfd fght', 'each', 5, 1, 4, 'qweqwe', '2019-02-07 16:16:50', '2018-12-26 17:50:15'),
(8, 5, 13, 4, 'de1', 'dddd', 'sdfd fght', 'each', 2, 1, 4, NULL, '2019-02-07 16:16:50', '2018-12-27 17:42:49'),
(9, 5, 9, 5, '1c', 'ccccc', 'fdgh ty io eyu6', 'each', 5, 1, 4, 'zsdfzsg', '2019-02-07 16:16:50', '2018-12-28 06:10:02'),
(11, 12, 15, 3, NULL, NULL, NULL, NULL, 5, 1, 9, 'dfgfh', '2019-02-16 08:07:18', '2019-02-16 08:07:18'),
(14, 16, 18, 3, NULL, NULL, NULL, NULL, 10, 3, 9, NULL, '2019-02-16 14:34:16', '2019-02-16 14:34:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `mfr` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `um` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `mfr`, `product_number`, `part_name`, `description`, `qty`, `um`, `created_at`, `updated_at`) VALUES
(1, 'aaa1', '123a', 'aaa1', 'aaa aaaa', 5, 'each', '2019-02-01 10:48:18', '0000-00-00 00:00:00'),
(2, 'bbb1', '1234b', 'bbb1', 'bbb bbbb bbbb', 10, 'each', '2019-02-01 10:48:18', '0000-00-00 00:00:00'),
(3, 'ccc1', '123c', 'ccc1', 'ccc ccc ccc', 15, 'each', '2019-02-01 10:48:18', '0000-00-00 00:00:00'),
(4, 'ddd1', '123d', 'ddd1', 'fgrtfg fyhyu', 10, 'each', '2019-02-01 10:48:18', '0000-00-00 00:00:00'),
(5, 'ae1', '123e', 'eee1', 'eeee1', 5, 'each', '2019-02-01 10:48:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_request`
--

CREATE TABLE `qc_request` (
  `id` int(11) NOT NULL,
  `entry_queue_id` int(11) NOT NULL,
  `receive_document_id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `qc_by` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_request`
--

INSERT INTO `qc_request` (`id`, `entry_queue_id`, `receive_document_id`, `document_no`, `user_id`, `remark`, `qc_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'd13456', 1, 'wrw4tr etry r', '5', 4, '2019-02-20 09:12:55', '2019-02-20 02:12:55'),
(4, 14, 8, 'adwety6', 1, 'fsre tgyry rty .', '8', 1, '2019-02-21 04:16:44', '2019-02-20 21:16:44'),
(3, 8, 6, 'fghryt4657', 1, 'asdeaw bwerw w46tr5', '5', 1, '2018-12-27 22:39:52', '2018-12-27 17:09:52'),
(5, 7, 5, 'asw2345', 1, 'huki', '5', 2, '2019-02-16 12:53:25', '2019-02-16 07:23:25'),
(6, 13, 9, 'ghty', 1, 'wrwetwerte', '5', 2, '2019-02-06 17:21:54', '2019-01-30 11:16:30'),
(13, 16, 13, 'zxc23', 1, 'fhggfhgj ht', '8', 3, '2019-02-20 09:47:46', '2019-02-20 02:47:46'),
(9, 12, 11, 'asdert567', 1, 'sdfdf', '8', 0, '2019-02-21 04:17:37', '2019-02-20 21:17:37'),
(14, 17, 14, 'Testing Rejected', 1, 'Testing', '3', 3, '2019-02-21 03:33:23', '2019-02-20 20:33:23'),
(15, 18, 15, 'Document Test', 1, 'wow', '2', 3, '2019-02-21 04:36:04', '2019-02-20 21:36:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_request_item_parts`
--

CREATE TABLE `qc_request_item_parts` (
  `id` int(11) NOT NULL,
  `qc_request_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_qc` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_request_item_parts`
--

INSERT INTO `qc_request_item_parts` (`id`, `qc_request_id`, `product_id`, `mfr`, `part_name`, `description`, `qty_qc`, `um`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'de1', 'dddd', 'sdfd fght', 10, 'each', '2019-02-08 22:21:58', '2018-12-22 06:38:02'),
(2, 1, 2, 'de2', 'eeee', 'xdfg dfgdf', 20, 'each', '2019-02-08 22:21:58', '2018-12-22 06:38:02'),
(6, 4, 3, 'fr4', 'sdweertr', 'dtyrrtyry', 5, 'each', '2019-02-08 22:21:58', '2019-01-25 05:30:58'),
(4, 3, 4, 'fq1', 'fdghfgh', 'drtdrd', 3, 'each', '2019-02-08 22:21:58', '2018-12-27 16:49:41'),
(5, 6, 5, 'fq2', 'dfyrt', 'ghhgf', 3, 'each', '2019-02-15 10:00:47', '2018-12-27 16:49:41'),
(7, 5, 1, '567s', 'rdgfgh', 'tyht6uy', 6, 'each', '2019-02-08 22:21:58', '2019-01-29 10:42:12'),
(8, 9, 1, NULL, NULL, NULL, 6, NULL, '2019-01-30 23:15:43', '2019-01-30 17:45:43'),
(10, 13, 3, NULL, NULL, NULL, 10, NULL, '2019-02-16 07:22:19', '2019-02-16 07:22:19'),
(11, 14, 1, NULL, NULL, NULL, 10, NULL, '2019-02-20 19:46:55', '2019-02-20 19:46:55'),
(12, 15, 2, NULL, NULL, NULL, 1, NULL, '2019-02-20 21:35:50', '2019-02-20 21:35:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_request_serial_no`
--

CREATE TABLE `qc_request_serial_no` (
  `id` int(11) NOT NULL,
  `qc_request_item_parts_id` int(11) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `qc_request_id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_request_serial_no`
--

INSERT INTO `qc_request_serial_no` (`id`, `qc_request_item_parts_id`, `serial_no`, `product_number`, `qc_request_id`, `document_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'as345678', 'aaaa', 1, '', '2019-01-05 11:21:15', '2019-01-05 05:51:15'),
(2, 2, '13sdg', 'bbbb', 1, '', '2018-11-27 12:49:32', '2018-11-27 12:49:32'),
(9, 8, '4567u', '123a', 9, '', '2019-02-01 16:55:46', '2019-02-01 16:55:46'),
(8, 1, '12345asd', 'aaaa', 1, '', '2018-12-13 12:22:57', '2018-12-13 12:22:57'),
(11, 8, 'ghjg789', '123a', 9, 'asdert567', '2019-02-06 12:00:54', '2019-02-06 12:00:54'),
(12, 10, '45657989', '123c', 13, 'zxc23', '2019-02-16 12:54:10', '2019-02-16 07:24:10'),
(13, 12, '12345678', '1234b', 15, 'Document Test', '2019-02-20 21:54:16', '2019-02-20 21:54:16'),
(14, 7, '212121', '123a', 5, 'asw2345', '2019-02-20 21:55:17', '2019-02-20 21:55:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_return`
--

CREATE TABLE `qc_return` (
  `id` int(11) NOT NULL,
  `qc_request_id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_contact` varchar(255) NOT NULL,
  `mover_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_return`
--

INSERT INTO `qc_return` (`id`, `qc_request_id`, `document_no`, `supplier_id`, `supplier_contact`, `mover_id`, `remark`, `status`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 2, 'eret45', 2, '4455667799', 1, 'w4 wa4q 45 w4 trtyu', 1, 1, '2019-01-22 16:43:37', '2019-01-22 11:13:37'),
(2, 2, 'e5ytr766', 2, '4455667788', 1, 'we3r 45t y65u w56 45', 1, 1, '2019-01-22 11:47:13', '2019-01-22 06:17:13'),
(3, 9, 'asdert567', 5, '8768698', 2, 'hjfhg', 1, 0, '2019-02-06 22:54:42', '2019-02-06 17:24:42'),
(5, 1, 'd13456', 1, '68679870', 1, 'yguiuhkio', 0, 0, '2019-02-16 07:25:23', '2019-02-16 07:25:23'),
(6, 4, 'adwety6', 2, 'UIUIUIUI', 1, 'JBHB', 0, 0, '2019-02-20 20:43:11', '2019-02-20 20:43:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_return_items`
--

CREATE TABLE `qc_return_items` (
  `id` int(11) NOT NULL,
  `qc_return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_return` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_return_items`
--

INSERT INTO `qc_return_items` (`id`, `qc_return_id`, `product_id`, `mfr`, `part_name`, `description`, `qty_return`, `um`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'p1', 'dddd', 'jhgf hr hg jh drtr', 3, 'each', '2019-02-06 22:40:15', '2019-01-05 06:37:03'),
(2, 1, 2, 'p2', 'eeee', 'sdbf jhe whge hj dtr', 4, 'each', '2019-02-06 22:40:15', '2019-01-05 06:37:03'),
(3, 2, 1, 'p1', 'dddd', 'jhgf hr hg jh', 3, 'each', '2019-02-06 22:40:15', '2018-12-11 05:17:51'),
(4, 3, 1, NULL, NULL, NULL, 5, NULL, '2019-02-01 23:55:57', '2019-02-01 18:25:57'),
(6, 5, 1, NULL, NULL, NULL, 10, NULL, '2019-02-16 07:25:23', '2019-02-16 07:25:23'),
(7, 5, 2, NULL, NULL, NULL, 20, NULL, '2019-02-16 07:25:23', '2019-02-16 07:25:23'),
(8, 6, 3, NULL, NULL, NULL, 5, NULL, '2019-02-20 20:43:11', '2019-02-20 20:43:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qc_return_serial_no`
--

CREATE TABLE `qc_return_serial_no` (
  `id` int(11) NOT NULL,
  `qc_return_items_id` int(11) NOT NULL,
  `qc_return_id` int(11) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `qc_return_serial_no`
--

INSERT INTO `qc_return_serial_no` (`id`, `qc_return_items_id`, `qc_return_id`, `serial_no`, `product_number`, `document_no`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 'sdfert578', 'dddd', '', '2019-01-22 16:45:19', '2019-01-22 11:15:19'),
(2, 4, 3, 'sdfdfb46', '123a', 'asdert567', '2019-02-06 17:24:42', '2019-02-06 17:24:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_document`
--

CREATE TABLE `receive_document` (
  `id` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_phone` varchar(255) NOT NULL,
  `document_via` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `attach_pic` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mover_id` int(11) NOT NULL,
  `item_linked` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_document`
--

INSERT INTO `receive_document` (`id`, `queue_id`, `document_no`, `reference_type`, `reference`, `sender_name`, `sender_phone`, `document_via`, `source`, `source_type`, `source_id`, `remark`, `attach_pic`, `created_at`, `updated_at`, `mover_id`, `item_linked`, `user_id`, `status`, `is_verified`) VALUES
(1, 3, '123xyz', 'external', 'internal', 'dfggjh', '4567889900', 'direct_from_source', 'external', 'supplier', 2, 'yuiyu 6yui6tj', 'Media/images/48DJMS1WYsn8bfsoRSNmPr9xdUHbyCwq.jpg', '2019-02-06 18:50:12', '2019-01-29 10:48:24', 1, 0, 1, 2, 1),
(2, 1, 'd13456', 'external', 'internal', 'qwert', '2345678956', 'direct_from_source', 'external', 'supplier', 2, 'rdyt 45y645 45y6', 'Media/images/osUTgJJb16xlVg23aadY7Q9dwK3pEm8a.jpg', '2019-02-06 18:50:12', '2018-12-22 05:50:24', 1, 0, 1, 1, 2),
(3, 4, 'a1wer', 'external', 'internal', 'fffff', '123456567', 'direct_from_source', 'external', 'supplier', 2, 'tre st ret f', 'Media/images/DTNSray6eJBmXdQjeR8HIBIB24Kei0hB.jpg', '2019-02-06 18:50:12', '2018-12-22 12:57:13', 1, 0, 1, 2, 1),
(4, 5, 'b1', 'external', 'internal', 'ggggg', '12345678', 'direct_from_source', 'external', 'supplier', 2, 'esr rwew trs', 'Media/images/dkuS6Tn60dnBLD9wbMUwiU1SAdGN8sCC.jpg', '2019-02-06 18:50:12', '2018-12-22 12:01:13', 1, 0, 1, 1, 2),
(5, 7, 'asw2345', 'external', 'internal', 'dfg', '3467', 'direct_from_source', 'external', 'supplier', 2, 'fuj dt dsfg', 'Media/images/fD3V7dbQ5617ohSxAGl98MH4qWDCqysf.jpg', '2019-02-06 18:50:12', '2019-01-29 10:42:12', 1, 0, 1, 1, 1),
(6, 8, 'fghryt4657', 'external', 'internal', 'xdfgdr', '43556769', 'direct_from_source', 'external', 'supplier', 2, 'werr', NULL, '2019-02-06 18:50:12', '2018-12-27 16:49:41', 1, 0, 1, 1, 2),
(7, 11, 'ghtyu789', 'external', 'internal', 'rytruyt', '4655876', 'direct_from_source', 'external', 'supplier', 1, 'dtrty ftyutr', 'Media/images/bbp8OpYUOyclNV8Q7dxoUFu0VZfrJMMW.jpg', '2019-02-06 18:50:12', '2019-01-05 12:40:28', 1, 0, 1, 2, 1),
(8, 14, 'adwety6', 'external', 'internal', 'ghj', '567687980', 'direct_from_source', 'external', 'supplier', 1, 'dfgh ftyht', 'Media/images/ukRqYxcETRFMAY3bwIOw6ACCOjIaoxB5.jpg', '2019-02-06 18:50:12', '2019-01-25 05:30:58', 1, 0, 1, 1, 2),
(9, 13, 'ghty', 'external', 'internal', 'gdgfdf', '4546465', 'direct_from_source', 'external', 'supplier', 1, 'rtgfhgfjhg', 'Media/images/x9IWDW41ThRIjyZjWtTP9xoPSsP8B2KD.jpg', '2019-02-06 18:50:12', '2019-01-30 11:16:30', 1, 0, 1, 1, 0),
(10, 9, 'sdert5', 'external', 'internal', 'dfghf', '123456', 'direct_from_source', 'external', 'supplier', 1, 'ADASFSDGSF', 'Media/images/7xlz7zFFJvnCVck9tq380wakOCGbbsbc.jpg', '2019-02-06 18:50:12', '2019-01-30 17:06:26', 1, 0, 1, 1, 0),
(11, 12, 'asdert567', 'external', 'internal', 'afrsg', '2344', 'direct_from_source', 'external', 'supplier', 1, 'sdfgd', 'Media/images/F1hfSOeijiBMpMTFrtqznFzpBLQDbDRS.jpg', '2019-02-06 18:50:12', '2019-02-02 06:53:28', 1, 0, 1, 1, 0),
(12, 15, 'asdwe234', 'external', 'internal', 'e6y5y5', '567658', 'direct_from_source', 'external', 'supplier', 2, 'huiyi tyu', NULL, '2019-02-06 11:12:12', '2019-02-06 11:12:12', 1, 0, 1, 0, 0),
(13, 16, 'zxc23', 'external', 'internal', 'dgffh', '45676786', 'direct_from_source', 'external', 'supplier', 1, 'wtetry', 'Media/images/3JvZguFkLm2lPDnahAa7LqBCPHzCPKTz.jpg', '2019-02-16 12:52:19', '2019-02-16 07:22:19', 1, 0, 1, 1, 0),
(14, 17, 'Testing Rejected', 'external', 'internal', 'Angga', '123456676', 'via_mover', 'external', 'supplier', 1, 'Testing', NULL, '2019-02-21 02:46:55', '2019-02-20 19:46:55', 1, 0, 1, 1, 0),
(15, 18, 'Document Test', 'external', 'internal', 'Angga2', 'qwqw', 'direct_from_source', 'external', 'supplier', 1, 'testing', NULL, '2019-02-21 04:35:50', '2019-02-20 21:35:50', 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_items`
--

CREATE TABLE `receive_items` (
  `id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `received_by_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_items`
--

INSERT INTO `receive_items` (`id`, `reference_type`, `reference_id`, `sender_id`, `received_by_id`, `status`, `created_at`, `updated_at`) VALUES
(6, 'dispatch_order', 5, 1, 8, 1, '2019-02-08 11:14:54', '2018-12-27 17:35:54'),
(3, 'dispatch_order', 4, 2, 3, 1, '2019-02-08 16:57:26', '2019-02-08 11:27:26'),
(5, 'internal_department', 3, 1, 3, 1, '2019-02-08 11:14:54', '2018-12-21 17:13:00'),
(7, 'dispatch_order', 3, 2, 5, 1, '2019-02-16 13:32:29', '2019-02-16 08:02:29'),
(8, 'dispatch_order', 7, 5, 10, 1, '2019-02-16 13:17:15', '2019-02-16 07:47:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_items_detail`
--

CREATE TABLE `receive_items_detail` (
  `id` int(11) NOT NULL,
  `receive_items_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `um` varchar(255) DEFAULT NULL,
  `qty_receive` int(11) NOT NULL,
  `warehouse` varchar(255) DEFAULT NULL,
  `location_rack` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_items_detail`
--

INSERT INTO `receive_items_detail` (`id`, `receive_items_id`, `product_id`, `mfr`, `part_name`, `description`, `um`, `qty_receive`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'e1', 'swer', 'wer w45 w345', 'each', 20, '4', '1', '2019-02-08 16:54:15', '2018-12-21 17:08:03'),
(2, 3, 2, 'e2', 'hyutg', 'kjhkj kjhkjl kulhk', 'each', 10, '4', '1', '2019-02-08 16:54:15', '2018-12-21 17:08:03'),
(3, 5, 3, 't1', 'tier', 'sdfre', 'each', 1, '4', '1', '2019-02-08 16:54:15', '2018-12-21 17:11:18'),
(4, 5, 3, 't1', 'tier', 'sdfre', 'each', 2, '4', '1', '2019-02-08 16:54:15', '2018-12-21 17:11:18'),
(5, 6, 4, 'de1', 'dddd', 'sdfd fght', 'each', 10, '4', '1', '2019-02-08 16:54:15', '2018-12-27 17:33:55'),
(6, 6, 5, 'de2', 'eeee', 'xdfg dfgdf', 'each', 20, '4', '1', '2019-02-08 16:54:15', '2018-12-27 17:33:55'),
(7, 7, 1, NULL, NULL, NULL, NULL, 5, '4', '1', '2019-02-08 06:03:29', '2019-02-08 06:03:29'),
(8, 8, 3, NULL, NULL, NULL, NULL, 10, '4', '1', '2019-02-16 07:38:24', '2019-02-16 07:38:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_item_from_wh`
--

CREATE TABLE `receive_item_from_wh` (
  `id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `send_item_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `received_by_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_item_from_wh`
--

INSERT INTO `receive_item_from_wh` (`id`, `reference_type`, `send_item_id`, `sender_id`, `received_by_id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'dispatch_order', 6, 1, 5, 1, '2019-02-08 22:52:47', '2018-12-27 17:44:53'),
(3, 'internal_department', 4, 2, 5, 1, '2019-02-08 22:52:47', '2018-12-21 17:01:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_item_from_wh_detail`
--

CREATE TABLE `receive_item_from_wh_detail` (
  `id` int(11) NOT NULL,
  `receive_item_from_wh_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `um` varchar(255) DEFAULT NULL,
  `qty_receive` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `location_rack` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_item_from_wh_detail`
--

INSERT INTO `receive_item_from_wh_detail` (`id`, `receive_item_from_wh_id`, `product_id`, `mfr`, `part_name`, `description`, `um`, `qty_receive`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(9, 5, 1, 'de1', 'dddd', 'sdfd fght', 'each', 2, 4, 1, '2019-02-07 17:19:26', '2018-12-27 17:44:11'),
(5, 3, 2, 't1', 'tier', 'sdfre', 'each', 1, 4, 1, '2019-02-07 17:19:26', '2018-12-21 16:30:45'),
(6, 3, 2, 't1', 'tier', 'sdfre', 'each', 2, 4, 1, '2019-02-07 17:19:26', '2018-12-21 16:30:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_report`
--

CREATE TABLE `receive_report` (
  `id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `sender_phone` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `mover_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_report`
--

INSERT INTO `receive_report` (`id`, `document_no`, `reference_type`, `reference_id`, `sender`, `sender_phone`, `source`, `source_type`, `source_id`, `mover_id`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(3, 'd13456', 'qc_pass', 1, 'aswer dort', '234667788', 'external', 'supplier', 1, 1, 'sfserte rtyte', 3, '2019-02-08 16:57:26', '2019-02-08 11:27:26'),
(2, 'a1wer', 'verified_doc', 3, 'ghty', '56789000', 'external', 'supplier', 1, 2, 'fyj yru r6u7', 3, '2019-02-16 13:32:29', '2019-02-16 08:02:29'),
(4, 'fghryt4657', 'qc_pass', 3, 'xdfxh', '456547', 'external', 'supplier', 2, 2, 'cfhgfcjg', 1, '2019-02-06 22:01:05', '2018-12-28 05:51:22'),
(6, 'ghtyu789', 'verified_doc', 7, 'ryttu', '567589', 'external', 'supplier', 2, 2, 'fghfgj dfyhg', 0, '2019-02-06 22:01:05', '2019-01-05 12:40:28'),
(7, 'adwety6', 'external', 4, 'k,ml', '8987900', 'external', 'supplier', 2, 2, 'fyhyfgh', 0, '2019-02-06 22:02:40', '2019-01-29 10:41:28'),
(9, 'zxc23', 'internal', 13, 'hgjuhkj', '6787898', 'external', 'supplier', 1, 1, 'hjku', 3, '2019-02-16 13:17:15', '2019-02-16 07:47:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_report_detail`
--

CREATE TABLE `receive_report_detail` (
  `id` int(11) NOT NULL,
  `receive_report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_receive` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_report_detail`
--

INSERT INTO `receive_report_detail` (`id`, `receive_report_id`, `product_id`, `mfr`, `part_name`, `description`, `qty_receive`, `um`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'd1', 'dde', 'awe warewq', 5, 'each', '2019-02-08 16:25:53', '2018-12-22 12:57:13'),
(2, 3, 2, 'de1', 'dddd', 'sdfd fght hghh', 10, 'each', '2019-02-08 16:25:53', '2019-01-05 11:31:46'),
(3, 3, 3, 'de2', 'eeee', 'xdfg dfgdf gygh', 20, 'each', '2019-02-08 16:25:53', '2019-01-05 11:31:46'),
(4, 4, 4, 'fq1', 'fdghfgh', 'drtdrd', 3, 'each', '2019-02-08 16:25:53', '2018-12-27 17:09:52'),
(5, 4, 5, 'fq2', 'dfyrt', 'ghhgf', 3, 'each', '2019-02-08 16:25:53', '2018-12-27 17:09:52'),
(9, 6, 4, 'ju2', 'rtr', 'yui', 10, 'each', '2019-02-06 22:04:06', '2019-01-05 12:40:28'),
(8, 6, 3, 'ju1', 'ee', 'tytvbg', 10, 'each', '2019-02-08 16:25:53', '2019-01-05 12:40:28'),
(10, 7, 2, 'fr4', 'sdweertr', 'dtyrrtyry', 5, 'each', '2019-02-08 16:25:53', '2019-01-29 10:41:28'),
(11, 9, 3, NULL, NULL, NULL, 10, NULL, '2019-02-16 07:31:56', '2019-02-16 07:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_report_detail_no`
--

CREATE TABLE `receive_report_detail_no` (
  `id` int(11) NOT NULL,
  `receive_report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_receive` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_report_detail_no`
--

INSERT INTO `receive_report_detail_no` (`id`, `receive_report_id`, `product_id`, `mfr`, `part_name`, `description`, `qty_receive`, `um`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'd1', 'dde', 'awe warewq', 5, 'each', '2019-02-08 09:25:53', '2018-12-22 05:57:13'),
(2, 3, 2, 'de1', 'dddd', 'sdfd fght hghh', 10, 'each', '2019-02-08 09:25:53', '2019-01-05 04:31:46'),
(3, 3, 3, 'de2', 'eeee', 'xdfg dfgdf gygh', 20, 'each', '2019-02-08 09:25:53', '2019-01-05 04:31:46'),
(4, 4, 4, 'fq1', 'fdghfgh', 'drtdrd', 3, 'each', '2019-02-08 09:25:53', '2018-12-27 10:09:52'),
(5, 4, 5, 'fq2', 'dfyrt', 'ghhgf', 3, 'each', '2019-02-08 09:25:53', '2018-12-27 10:09:52'),
(9, 6, 4, 'ju2', 'rtr', 'yui', 10, 'each', '2019-02-06 15:04:06', '2019-01-05 05:40:28'),
(8, 6, 3, 'ju1', 'ee', 'tytvbg', 10, 'each', '2019-02-08 09:25:53', '2019-01-05 05:40:28'),
(10, 7, 2, 'fr4', 'sdweertr', 'dtyrrtyry', 5, 'each', '2019-02-08 09:25:53', '2019-01-29 03:41:28'),
(11, 9, 3, NULL, NULL, NULL, 10, NULL, '2019-02-16 00:31:56', '2019-02-16 00:31:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_report_serial_no`
--

CREATE TABLE `receive_report_serial_no` (
  `id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `sender_phone` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `mover_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `receive_report_serial_no`
--

INSERT INTO `receive_report_serial_no` (`id`, `document_no`, `reference_type`, `reference_id`, `sender`, `sender_phone`, `source`, `source_type`, `source_id`, `mover_id`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(3, 'd13456', 'qc_pass', 1, 'aswer dort', '234667788', 'external', 'supplier', 1, 1, 'sfserte rtyte', 3, '2019-02-08 09:57:26', '2019-02-08 04:27:26'),
(2, 'a1wer', 'verified_doc', 3, 'ghty', '56789000', 'external', 'supplier', 1, 2, 'fyj yru r6u7', 3, '2019-02-16 06:32:29', '2019-02-16 01:02:29'),
(4, 'fghryt4657', 'qc_pass', 3, 'xdfxh', '456547', 'external', 'supplier', 2, 2, 'cfhgfcjg', 1, '2019-02-06 15:01:05', '2018-12-27 22:51:22'),
(6, 'ghtyu789', 'verified_doc', 7, 'ryttu', '567589', 'external', 'supplier', 2, 2, 'fghfgj dfyhg', 0, '2019-02-06 15:01:05', '2019-01-05 05:40:28'),
(7, 'adwety6', 'external', 4, 'k,ml', '8987900', 'external', 'supplier', 2, 2, 'fyhyfgh', 0, '2019-02-06 15:02:40', '2019-01-29 03:41:28'),
(9, 'zxc23', 'internal', 13, 'hgjuhkj', '6787898', 'external', 'supplier', 1, 1, 'hjku', 3, '2019-02-16 06:17:15', '2019-02-16 00:47:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_serial_no`
--

CREATE TABLE `report_serial_no` (
  `id` int(11) NOT NULL,
  `qc_request_item_parts_id` int(11) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `qc_request_id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `report_serial_no`
--

INSERT INTO `report_serial_no` (`id`, `qc_request_item_parts_id`, `serial_no`, `product_number`, `qc_request_id`, `document_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'as345678', 'aaaa', 1, '', '2019-01-05 04:21:15', '2019-01-04 22:51:15'),
(2, 2, '13sdg', 'bbbb', 1, '', '2018-11-27 05:49:32', '2018-11-27 05:49:32'),
(9, 8, '4567u', '123a', 9, '', '2019-02-01 09:55:46', '2019-02-01 09:55:46'),
(8, 1, '12345asd', 'aaaa', 1, '', '2018-12-13 05:22:57', '2018-12-13 05:22:57'),
(11, 8, 'ghjg789', '123a', 9, 'asdert567', '2019-02-06 05:00:54', '2019-02-06 05:00:54'),
(12, 10, '45657989', '123c', 13, 'zxc23', '2019-02-16 05:54:10', '2019-02-16 00:24:10'),
(13, 11, '121212', '123a', 14, 'Testing Rejected', '2019-03-04 19:55:59', '2019-03-04 19:55:59'),
(14, 11, '121211212', '123a', 14, 'Testing Rejected', '2019-03-04 19:55:59', '2019-03-04 19:55:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_report`
--

CREATE TABLE `return_report` (
  `id` int(11) NOT NULL,
  `document_no` varchar(255) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `sender_phone` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `mover_id` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return_report`
--

INSERT INTO `return_report` (`id`, `document_no`, `reference_id`, `sender`, `sender_phone`, `source`, `source_type`, `source_id`, `mover_id`, `remark`, `status`, `created_at`, `updated_at`) VALUES
(1, 'e5ytr766', 2, 'fghyfty ghjhguiu sdf', '4765869678', 'external', 'supplier', 0, 2, 'ghjgkjh jhkljldgf rew', 0, '2019-01-22 11:51:07', '2019-01-22 06:21:07'),
(3, 'eret45', 1, 'hjghk', '67868679', 'external', 'supplier', 0, 1, 'ygujyu yuiyui', 1, '2019-01-22 16:44:39', '2019-01-22 11:14:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_report_detail`
--

CREATE TABLE `return_report_detail` (
  `id` int(11) NOT NULL,
  `return_report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_return` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return_report_detail`
--

INSERT INTO `return_report_detail` (`id`, `return_report_id`, `product_id`, `mfr`, `part_name`, `description`, `qty_return`, `um`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'p1', 'dddd', 'jhgf hr hg jh fgrtyu', 3, 'each', '2019-01-22 11:51:07', '2019-01-22 06:21:07'),
(2, 3, 0, 'p1', 'dddd', 'jhgf hr hg jh drtr', 3, 'each', '2019-01-22 11:13:37', '2019-01-22 11:13:37'),
(3, 3, 0, 'p2', 'eeee', 'sdbf jhe whge hj dtr', 4, 'each', '2019-01-22 11:13:37', '2019-01-22 11:13:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', '2018-12-15 11:02:32', '2018-12-15 11:02:32'),
(2, 'internal_department', 'internal_department', 'internal_department', '2018-12-15 11:02:32', '2018-12-15 11:02:32'),
(3, 'warehouse', 'warehouse', 'warehouse', '2018-12-15 11:03:25', '2018-12-15 11:03:25'),
(4, 'loading_department', 'loading_department', 'loading_department', '2018-12-15 11:03:25', '2018-12-15 11:03:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 4),
(3, 3),
(4, 2),
(5, 4),
(6, 4),
(7, 3),
(8, 2),
(9, 2),
(10, 3),
(11, 2),
(12, 4),
(15, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `send_do_items`
--

CREATE TABLE `send_do_items` (
  `id` int(11) NOT NULL,
  `packing_items_id` int(11) NOT NULL,
  `send_via` varchar(255) NOT NULL,
  `do_id` int(11) NOT NULL,
  `handover_by_id` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `pickup_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `send_do_items`
--

INSERT INTO `send_do_items` (`id`, `packing_items_id`, `send_via`, `do_id`, `handover_by_id`, `contact`, `sender_id`, `pickup_date`, `status`, `is_delivered`, `created_at`, `updated_at`) VALUES
(1, 1, 'crc', 5, 3, '678896545', 2, '2018-12-22 10:35:00', 0, 1, '2019-02-15 12:07:46', '2018-12-21 16:52:16'),
(2, 2, 'installer', 3, 5, '566687', 1, '2018-12-06 10:15:00', 0, 1, '2019-02-15 12:07:46', '2018-12-27 17:46:54'),
(3, 3, 'installer', 5, 3, '34645', 1, '2019-02-04 09:45:00', 0, 0, '2019-02-15 12:07:46', '2019-02-07 17:12:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `send_items_from_wh`
--

CREATE TABLE `send_items_from_wh` (
  `id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `pick_item_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `handover_by_id` int(11) NOT NULL,
  `warehouse` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `send_items_from_wh`
--

INSERT INTO `send_items_from_wh` (`id`, `reference_type`, `pick_item_id`, `sender_id`, `handover_by_id`, `warehouse`, `location`, `status`, `created_at`, `updated_at`) VALUES
(5, 'dispatch_order', 3, 3, 5, '4', '1', 1, '2018-12-21 22:14:53', '2018-12-21 16:44:53'),
(4, 'internal_department', 1, 3, 5, '4', '1', 1, '2018-12-21 22:00:45', '2018-12-21 16:30:45'),
(6, 'dispatch_order', 5, 5, 5, '4', '1', 1, '2018-12-27 23:14:11', '2018-12-27 17:44:11'),
(7, 'internal_department', 4, 8, 5, '4', '1', 0, '2018-12-28 06:19:20', '2018-12-28 06:19:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `send_items_to_warehouse`
--

CREATE TABLE `send_items_to_warehouse` (
  `id` int(11) NOT NULL,
  `receive_report_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `handover_by_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `send_items_to_warehouse`
--

INSERT INTO `send_items_to_warehouse` (`id`, `receive_report_id`, `sender_id`, `handover_by_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 10, 2, '2019-02-08 22:17:22', '2018-12-21 12:12:56'),
(3, 2, 2, 10, 2, '2019-02-16 13:32:29', '2019-02-16 08:02:29'),
(7, 9, 5, 9, 2, '2019-02-16 13:17:15', '2019-02-16 07:47:15'),
(5, 7, 2, 3, 2, '2019-02-08 22:17:22', '2018-12-27 17:35:54'),
(6, 2, 1, 3, 0, '2019-02-08 21:44:18', '2019-02-06 17:39:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `send_store_items`
--

CREATE TABLE `send_store_items` (
  `id` int(11) NOT NULL,
  `store_item_request_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `handover_by_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `send_store_items`
--

INSERT INTO `send_store_items` (`id`, `store_item_request_id`, `sender_id`, `handover_by_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 2, 8, 2, '2019-02-08 11:03:03', '2018-12-21 17:14:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `storer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `store_items`
--

INSERT INTO `store_items` (`id`, `reference_type`, `reference_id`, `storer_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'internal_department', 5, 3, 0, '2018-12-21 17:14:04', '2018-12-21 17:14:04'),
(2, 'dispatch_order', 6, 8, 0, '2018-12-27 17:35:54', '2018-12-27 17:35:54'),
(8, 'dispatch_order', 7, 10, 0, '2019-02-16 08:02:29', '2019-02-16 08:02:29'),
(7, 'dispatch_order', 8, 3, 0, '2019-02-16 07:58:53', '2019-02-16 07:58:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_items_detail`
--

CREATE TABLE `store_items_detail` (
  `id` int(11) NOT NULL,
  `store_items_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_store` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `warehouse` int(11) NOT NULL,
  `location_rack` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `store_items_detail`
--

INSERT INTO `store_items_detail` (`id`, `store_items_id`, `product_id`, `mfr`, `part_name`, `description`, `qty_store`, `um`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 't1', 'tier', 'sdfre', 1, 'each', 4, 1, '2019-02-08 16:18:12', '2018-12-21 17:14:04'),
(2, 1, 2, 't1', 'tier', 'sdfre', 2, 'each', 4, 1, '2019-02-08 16:18:12', '2018-12-21 17:14:04'),
(3, 2, 3, 'de1', 'dddd', 'sdfd fght', 10, 'each', 4, 1, '2019-02-08 16:18:12', '2018-12-27 17:35:54'),
(4, 2, 4, 'de2', 'eeee', 'xdfg dfgdf', 20, 'each', 4, 1, '2019-02-08 16:18:12', '2018-12-27 17:35:54'),
(11, 8, 1, NULL, NULL, NULL, 5, NULL, 9, 1, '2019-02-16 08:02:29', '2019-02-16 08:02:29'),
(10, 7, 3, NULL, NULL, NULL, 10, NULL, 9, 3, '2019-02-16 07:58:53', '2019-02-16 07:58:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_item_request`
--

CREATE TABLE `store_item_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_type` varchar(255) NOT NULL,
  `source_id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `store_item_request`
--

INSERT INTO `store_item_request` (`id`, `user_id`, `reference_type`, `reference`, `source`, `source_type`, `source_id`, `requester_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'external', 'internal', 'external', 'supplier', 2, 3, 0, '2019-02-07 23:43:04', '2019-02-07 18:13:04'),
(3, 1, 'external', 'internal', 'external', 'supplier', 1, 5, 1, '2019-02-07 23:47:49', '2019-02-07 18:17:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `store_item_request_detail`
--

CREATE TABLE `store_item_request_detail` (
  `id` int(11) NOT NULL,
  `mfr` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `qty_request` int(11) NOT NULL,
  `um` varchar(255) DEFAULT NULL,
  `store_item_request_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse` varchar(255) NOT NULL,
  `location_rack` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `store_item_request_detail`
--

INSERT INTO `store_item_request_detail` (`id`, `mfr`, `part_name`, `description`, `qty_request`, `um`, `store_item_request_id`, `product_id`, `warehouse`, `location_rack`, `created_at`, `updated_at`) VALUES
(3, 't1', 'tier', 'sdfre', 2, 'each', 2, 1, '4', '1', '2019-02-07 23:42:28', '2019-02-07 18:12:28'),
(4, 't1', 'tier', 'sdfre', 2, 'each', 2, 2, '4', '1', '2019-02-07 23:17:06', '2018-12-21 17:01:01'),
(5, NULL, NULL, NULL, 4, NULL, 3, 2, '4', '1', '2019-02-07 23:49:06', '2019-02-07 18:19:06'),
(6, NULL, NULL, NULL, 5, NULL, 3, 1, '4', '1', '2019-02-07 18:17:28', '2019-02-07 18:17:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'jepal', '2019-02-06 16:23:03', '0000-00-00 00:00:00'),
(2, 'hetvi', '2019-02-06 16:23:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_inventory`
--

CREATE TABLE `transaction_inventory` (
  `id` int(11) NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `txn_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `qty_in` int(11) DEFAULT NULL,
  `qty_out` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction_inventory`
--

INSERT INTO `transaction_inventory` (`id`, `txn_type`, `txn_id`, `inventory_id`, `qty_in`, `qty_out`, `created_at`, `updated_at`) VALUES
(1, 'store', 7, 1, 10, NULL, '2019-02-16 07:58:53', '2019-02-16 07:58:53'),
(2, 'store', 8, 2, 5, NULL, '2019-02-16 08:02:29', '2019-02-16 08:02:29'),
(3, 'pick', 16, 1, NULL, 10, '2019-02-16 14:34:16', '2019-02-16 14:34:16'),
(4, 'transfer', 5, 2, NULL, 2, '2019-02-16 15:58:59', '2019-02-16 15:58:59'),
(5, 'transfer', 5, 3, 2, NULL, '2019-02-16 15:58:59', '2019-02-16 15:58:59'),
(6, 'transfer', 8, 2, NULL, 1, '2019-02-16 16:10:25', '2019-02-16 16:10:25'),
(7, 'transfer', 8, 3, 1, NULL, '2019-02-16 16:10:25', '2019-02-16 16:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer_items`
--

CREATE TABLE `transfer_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `get_from_id` int(11) NOT NULL,
  `sent_by_id` int(11) NOT NULL,
  `from_warehouse` int(11) NOT NULL,
  `to_warehouse` int(11) NOT NULL,
  `from_location_rack` int(11) NOT NULL,
  `to_location_rack` int(11) NOT NULL,
  `document_no` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transfer_items`
--

INSERT INTO `transfer_items` (`id`, `user_id`, `get_from_id`, `sent_by_id`, `from_warehouse`, `to_warehouse`, `from_location_rack`, `to_location_rack`, `document_no`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 3, 4, 4, 1, 1, '123xyz', 0, '2018-12-03 17:34:43', '2018-11-30 11:56:29'),
(5, 1, 9, 10, 4, 9, 1, 3, NULL, 0, '2019-02-16 15:58:59', '2019-02-16 15:58:59'),
(8, 1, 2, 9, 4, 9, 1, 3, NULL, 0, '2019-02-16 16:10:25', '2019-02-16 16:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer_items_detail`
--

CREATE TABLE `transfer_items_detail` (
  `id` int(11) NOT NULL,
  `transfer_items_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transfer_items_detail`
--

INSERT INTO `transfer_items_detail` (`id`, `transfer_items_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 5, '2018-11-30 11:56:29', '2018-11-30 11:56:29'),
(3, 5, 1, 2, '2019-02-16 15:58:59', '2019-02-16 15:58:59'),
(4, 8, 1, 1, '2019-02-16 16:10:25', '2019-02-16 16:10:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `department`, `status`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$/kphnIfHSVjCaDsqg86EMeDvgGfdSvprTcKkkF3YMlkDBpZ1JUUW2', 'admin', 0, '2019-11-06 02:53:56', '2018-12-20 11:13:10', 'HKByk2BZmAOjmihlLNgd8Tx4tn5bMXAOxU47iwebIZdsS2Lx0VTSjt3e4ve0'),
(2, 'joli', 'joli@gmail.com', '$2y$10$7VZAD1J87h/2yAuPvwi9HuaCyVQoQsRhAxFM7iL60jgSojBK.ekMi', 'loading_department', 1, '2018-12-28 16:31:24', '2018-12-14 17:05:19', 'ta5LtG1J4z0VCurLe9wniyLJwZ9A8VPOb8yPvSrIt3YBEPP0ZXdz0I6gZ9DW'),
(3, 'pol', 'pol@gmail.com', '$2y$10$7VZAD1J87h/2yAuPvwi9HuaCyVQoQsRhAxFM7iL60jgSojBK.ekMi', 'warehouse', 1, '2018-12-28 16:32:36', '2018-12-14 17:05:23', 'PpxuYOarVHY9yuZucdv5cfo8Rdev13Zgw90n5Sx9CFd8yVVuwO41aBtHYbcO'),
(4, 'shesa', 'shesa@gmail.com', '$2y$10$7VZAD1J87h/2yAuPvwi9HuaCyVQoQsRhAxFM7iL60jgSojBK.ekMi', 'internal_department', 0, '2018-12-18 15:57:05', '0000-00-00 00:00:00', 'dz5rRUvogvVNTE9u9JL2g54xtaSKYh1SpQgC2AhLwpfkhvLP1AQht5OPXJn1'),
(5, 'bela', 'belaghose@gmail.com', '$2y$10$7VZAD1J87h/2yAuPvwi9HuaCyVQoQsRhAxFM7iL60jgSojBK.ekMi', 'loading_department', 1, '2019-01-04 18:17:37', '2019-01-04 12:47:37', 'aCglVJihAAcja2CYrOJcSfv5uv5ny7kMRVwPnWM04F6O0fNFkdS26lK3YOj2'),
(6, 'leo blaster', 'leo@gmail.com', '$2y$10$7VZAD1J87h/2yAuPvwi9HuaCyVQoQsRhAxFM7iL60jgSojBK.ekMi', 'loading_department', 0, '2018-12-15 11:00:47', '2018-12-11 17:44:53', NULL),
(8, 'jelir pol', 'jelir@gmail.com', '$2y$10$eUvF41MvsV.mzoKYIA4jYORWenaeCN5Ryt0WQNOzH5JzIthyEv8K.', 'internal_department', 1, '2018-12-15 11:00:10', '2018-12-14 17:05:42', NULL),
(9, 'medi larceda', 'medi@gmail.com', '$2y$10$8WCBphzDVu6aNu7NVxKLn.rl86c3ZAG/XVxqgCb01n2uG9fSwPNnO', 'internal_department', 1, '2018-12-28 16:33:41', '2018-12-15 05:51:04', NULL),
(10, 'heli por', 'heli@gmail.com', '$2y$10$psqVr9tDM8oFVtv6lin0neqfTMHelMsCCEO2xGBWFsnub0x76gi0G', 'warehouse', 1, '2018-12-18 22:06:49', '2018-12-18 16:36:49', NULL),
(11, 'fizi mola', 'fizi@gmail.com', '$2y$10$RvdSrd82GeXgyNUkHQdJpON1/7b6n9/VUyxJywLr8wLInp2O1zVAS', 'internal_department', 0, '2018-12-15 05:54:51', '2018-12-15 05:54:51', NULL),
(12, 'kilo oza', 'kilo@gmail.com', '$2y$10$gAH5RpVnSHJkzRJhT.AyVOoDBxD7GE9Mb2pTtV0DlalKfE8zH9DxK', 'loading_department', 0, '2018-12-15 06:04:11', '2018-12-15 06:04:11', NULL),
(15, 'leni faruk', 'leni@gmail.com', '$2y$10$ht.o8R2RphaQ2zCycrc/T.pPtJ1bgD078cxKsAASHo9J4QvEE..BK', 'warehouse', 0, '2018-12-15 06:16:28', '2018-12-15 06:16:28', NULL),
(16, 'angga', 'angga@gmail.com', '12345', 'admin', 1, '2019-11-06 02:58:14', '2019-11-05 19:58:14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `description`, `created_at`, `updated_at`, `user_id`) VALUES
(3, 'kanpur', 'central', '2018-11-24 16:21:11', '2018-11-24 10:51:11', 1),
(4, 'nagpur', 'near abc village', '2018-11-20 19:40:00', '2018-11-20 06:29:16', 1),
(9, 'surat', 'dgfdg tyry', '2019-02-16 07:45:50', '2019-02-16 07:45:50', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouse_location`
--

CREATE TABLE `warehouse_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `warehouse_location`
--

INSERT INTO `warehouse_location` (`id`, `location`, `description`, `warehouse_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'rampur', 'main one 1', 4, '2018-11-26 17:00:15', '2018-11-26 11:30:15', 1),
(3, 'varacha', 'trgyry', 9, '2019-02-16 07:46:31', '2019-02-16 07:46:31', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `entry_queue`
--
ALTER TABLE `entry_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `entry_queue_detail`
--
ALTER TABLE `entry_queue_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_parts_detail`
--
ALTER TABLE `item_parts_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_request`
--
ALTER TABLE `material_request`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_request_item`
--
ALTER TABLE `material_request_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mover`
--
ALTER TABLE `mover`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packing_items`
--
ALTER TABLE `packing_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packing_item_detail`
--
ALTER TABLE `packing_item_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indeks untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `pick_item`
--
ALTER TABLE `pick_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pick_item_detail`
--
ALTER TABLE `pick_item_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qc_request`
--
ALTER TABLE `qc_request`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qc_request_item_parts`
--
ALTER TABLE `qc_request_item_parts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qc_request_serial_no`
--
ALTER TABLE `qc_request_serial_no`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qc_return`
--
ALTER TABLE `qc_return`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qc_return_items`
--
ALTER TABLE `qc_return_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qc_return_serial_no`
--
ALTER TABLE `qc_return_serial_no`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_document`
--
ALTER TABLE `receive_document`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_items`
--
ALTER TABLE `receive_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_items_detail`
--
ALTER TABLE `receive_items_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_item_from_wh`
--
ALTER TABLE `receive_item_from_wh`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_item_from_wh_detail`
--
ALTER TABLE `receive_item_from_wh_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_report`
--
ALTER TABLE `receive_report`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_report_detail`
--
ALTER TABLE `receive_report_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `report_serial_no`
--
ALTER TABLE `report_serial_no`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `return_report`
--
ALTER TABLE `return_report`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `return_report_detail`
--
ALTER TABLE `return_report_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `send_do_items`
--
ALTER TABLE `send_do_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `send_items_from_wh`
--
ALTER TABLE `send_items_from_wh`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `send_items_to_warehouse`
--
ALTER TABLE `send_items_to_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `send_store_items`
--
ALTER TABLE `send_store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `store_items_detail`
--
ALTER TABLE `store_items_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `store_item_request`
--
ALTER TABLE `store_item_request`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `store_item_request_detail`
--
ALTER TABLE `store_item_request_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_inventory`
--
ALTER TABLE `transaction_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transfer_items`
--
ALTER TABLE `transfer_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transfer_items_detail`
--
ALTER TABLE `transfer_items_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `warehouse_location`
--
ALTER TABLE `warehouse_location`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `entry_queue`
--
ALTER TABLE `entry_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `entry_queue_detail`
--
ALTER TABLE `entry_queue_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `item_parts_detail`
--
ALTER TABLE `item_parts_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `material_request`
--
ALTER TABLE `material_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `material_request_item`
--
ALTER TABLE `material_request_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `mover`
--
ALTER TABLE `mover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `packing_items`
--
ALTER TABLE `packing_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `packing_item_detail`
--
ALTER TABLE `packing_item_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pick_item`
--
ALTER TABLE `pick_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pick_item_detail`
--
ALTER TABLE `pick_item_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `qc_request`
--
ALTER TABLE `qc_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `qc_request_item_parts`
--
ALTER TABLE `qc_request_item_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `qc_request_serial_no`
--
ALTER TABLE `qc_request_serial_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `qc_return`
--
ALTER TABLE `qc_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `qc_return_items`
--
ALTER TABLE `qc_return_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `qc_return_serial_no`
--
ALTER TABLE `qc_return_serial_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `receive_document`
--
ALTER TABLE `receive_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `receive_items`
--
ALTER TABLE `receive_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `receive_items_detail`
--
ALTER TABLE `receive_items_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `receive_item_from_wh`
--
ALTER TABLE `receive_item_from_wh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `receive_item_from_wh_detail`
--
ALTER TABLE `receive_item_from_wh_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `receive_report`
--
ALTER TABLE `receive_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `receive_report_detail`
--
ALTER TABLE `receive_report_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `report_serial_no`
--
ALTER TABLE `report_serial_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `return_report`
--
ALTER TABLE `return_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `return_report_detail`
--
ALTER TABLE `return_report_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `send_do_items`
--
ALTER TABLE `send_do_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `send_items_from_wh`
--
ALTER TABLE `send_items_from_wh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `send_items_to_warehouse`
--
ALTER TABLE `send_items_to_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `send_store_items`
--
ALTER TABLE `send_store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `store_items_detail`
--
ALTER TABLE `store_items_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `store_item_request`
--
ALTER TABLE `store_item_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `store_item_request_detail`
--
ALTER TABLE `store_item_request_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaction_inventory`
--
ALTER TABLE `transaction_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transfer_items`
--
ALTER TABLE `transfer_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transfer_items_detail`
--
ALTER TABLE `transfer_items_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `warehouse_location`
--
ALTER TABLE `warehouse_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
