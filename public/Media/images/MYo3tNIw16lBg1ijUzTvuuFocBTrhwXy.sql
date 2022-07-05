-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2020 pada 01.50
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
-- Database: `procurement_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `mfr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_part_num` smallint(6) NOT NULL,
  `part_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_um` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_curr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sell_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `break_down_price` tinyint(1) NOT NULL,
  `item_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_valid_until` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_need_qc` tinyint(1) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `mfr`, `category_part_num`, `part_num`, `part_name`, `part_desc`, `default_um`, `default_curr`, `unit_cost`, `sell_price`, `break_down_price`, `item_price`, `price_date`, `lead_time`, `price_valid_until`, `item_need_qc`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'samsung', 1, 'galaxy', 'Samsung', 'FASDF', 'Pcs', 'Rupiah', '2000', '2200', 0, '2200', '15-18-2018', 'ASDF', '2018-11-29 17:43:34', 0, 'ASDFA', 'Firdauz Fanani', 'Firdauz Fanani', '2018-12-11 10:45:41', '2019-03-11 19:12:59'),
(2, 'apple', 1, 'samsung', 'Apple', 'asdf', 'Pcs', 'Rupiah', '1000', '1200', 1, '1200', '15-18-2018', 'asdfa', '2018-11-29 17:43:34', 0, 'Good', 'Firdauz Fanani', 'Firdauz Fanani', '2018-12-11 10:46:10', '2019-03-11 19:13:44'),
(4, 'Isk', 1, '125123', 'Isk', 'tes', 'Pcs', 'Rupiah', '500', '700', 1, '700', '15-18-2018', 'tes', '2018-11-29', 0, 'tes', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-18 19:20:32', '2019-03-11 19:12:15'),
(5, 'Logitech', 1, 'Xiomi1', 'Logitech', 'xiaomi', 'Pcs', 'Rupiah', '3800', '4000', 0, '4000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 18:43:23', '2019-03-11 19:12:44'),
(6, 'Asus', 1, '61236', 'Asus', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(7, 'ROG', 1, '61236', 'ROG', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(8, 'LG', 1, '61236', 'LG', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(9, 'HP', 1, '61236', 'HP', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(10, 'Razer', 1, '61236', 'Razer', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(11, 'Watch', 1, '61236', 'Watch', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(12, 'Steel', 1, '61236', 'Steel', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(13, 'sans', 1, '61236', 'Sans', 'tes', 'Pcs', 'Rupiah', '5000', '5000', 0, '5000', '15-18-2018', 'tes', '2018-11-29', 0, 'On Progress', 'Firdauz Fanani', 'Firdauz Fanani', '2019-02-27 19:16:07', '2019-02-27 19:16:07'),
(14, 'Sony', 3, '123', 'abc', 'abc', 'abc', 'abc', '123', '123', 0, '0', '123', '123', '123', 0, '123', 'admin', 'admin', '2019-05-05 20:02:24', '2019-05-05 20:02:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
