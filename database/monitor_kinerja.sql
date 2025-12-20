-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2025 at 04:52 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitor_kinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'Asus FXhc506', 'Asus TUF Gaming', 'Rusak MB nya', '2025-11-24 07:52:49', '2025-11-24 07:52:49'),
(3, 'PC-4353245', 'PC Gaming Series', 'sdasdasdasd', '2025-11-24 08:16:25', '2025-11-24 08:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telpon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint UNSIGNED DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama_customer`, `alamat`, `no_telpon`, `nama_pic`, `barang_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(4, 'Andre', 'akada;ls', '9109131029301290', 'asdlkasdkj', 3, 'Rusak Hardware RAM', '2025-12-20 16:00:25', '2025-12-20 16:00:25'),
(5, 'Asep', 'jjasijdsia', '32428347892374', 'ashdauhdahdsa', 2, 'hfjshdfjshd', '2025-12-20 16:27:07', '2025-12-20 16:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_assignments`
--

CREATE TABLE `enrollment_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `barang_id` bigint UNSIGNED DEFAULT NULL,
  `kepala_gudang_id` bigint UNSIGNED NOT NULL,
  `teknisi_id` bigint UNSIGNED NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  `timeline` datetime DEFAULT NULL,
  `tingkat_kesulitan` enum('mudah','menengah','sulit') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin` smallint UNSIGNED NOT NULL DEFAULT '0',
  `status` enum('dikerjakan_teknisi','selesai','proses_packing') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dikerjakan_teknisi',
  `deskripsi_hasil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `solusi` text COLLATE utf8mb4_unicode_ci,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollment_assignments`
--

INSERT INTO `enrollment_assignments` (`id`, `customer_id`, `barang_id`, `kepala_gudang_id`, `teknisi_id`, `qty`, `timeline`, `tingkat_kesulitan`, `poin`, `status`, `deskripsi_hasil`, `solusi`, `completed_at`, `created_at`, `updated_at`) VALUES
(17, 4, 3, 2, 3, 15, '2025-12-21 23:19:00', 'mudah', 5, 'selesai', 'Ram Rusak', 'Beli Baru Ram 3GB', '2025-12-20 16:37:29', '2025-12-20 16:19:45', '2025-12-20 16:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_08_112509_create_sessions_table', 2),
(5, '2025_11_08_174412_create_enrollment_assignments_table', 3),
(6, '2025_11_08_174533_add_score_to_users_table', 3),
(7, '2025_11_08_174707_create_shipment_assignments_table', 3),
(8, '2025_11_08_183732_remove_unused_columns_from_shipment_assignments_table', 4),
(9, '2025_11_09_094712_add_timeline_to_enrollment_assignments_table', 5),
(10, '2025_11_09_155641_add_nama_customer_to_enrollment_assignments_table', 6),
(11, '2025_12_01_000001_create_customers_table', 7),
(12, '2025_12_01_000002_create_barangs_table', 7),
(13, '2025_11_24_151119_update_enrollment_assignments_add_fk_and_remove_old_columns', 8),
(14, '2025_12_20_225359_add_barang_id_to_customers_table', 9),
(15, '2025_12_20_233328_add_solusi_to_enrollment_assignments_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2Ys5lPtSgHiBU1mq84OD7wtUeucuS6T21Ky2BVe9', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmNNMG5EQTZXWkFhZVFOaVd0MFVjQzE2bVpvekFmZHhyNjdYcXpmbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW51Z2FzYW4tZW5yb2xsbWVudCI7czo1OiJyb3V0ZSI7czoyNjoicGVudWdhc2FuLWVucm9sbG1lbnQuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1766249502),
('LaIu4yfpGJKsG4nn1LJFldI8C4SxjtNOiQUcjr5t', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRjdZdnlsZndVQ2dweVd5MFZKakpqYmI3VUp0WXZsT1hHeHBaN0tPSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oYXNpbC1lbnJvbGxtZW50IjtzOjU6InJvdXRlIjtzOjIyOiJoYXNpbC1lbnJvbGxtZW50LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1766248650),
('ZNwTzpG3OHax9DUa8s7gP1bQ7cu9ooUCe5Z26Ih9', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRW9ja0dIUHhUUFQ1M05XWDhMT2hSU1BPUTBDUE5ZRmtSU1FJckh0NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW51Z2FzYW4tZW5yb2xsbWVudCI7czo1OiJyb3V0ZSI7czoyNjoicGVudWdhc2FuLWVucm9sbG1lbnQuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1766248878);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_assignments`
--

CREATE TABLE `shipment_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `enrollment_assignment_id` bigint UNSIGNED NOT NULL,
  `no_resi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jasa_kirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_assignments`
--

INSERT INTO `shipment_assignments` (`id`, `enrollment_assignment_id`, `no_resi`, `jasa_kirim`, `created_at`, `updated_at`) VALUES
(8, 17, '3424234', 'JNT', '2025-12-20 16:41:35', '2025-12-20 16:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kepala_gudang','teknisi','helper') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'helper',
  `score` int DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `score`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '$2y$12$7zX0WwZ6.hCEiCBtAfWOM.OkFl5u6XIMnGzjSL3uuXAFXmWnjJ.q.', 'admin', NULL, NULL, '2025-11-09 18:59:48', '2025-11-09 18:59:48'),
(2, 'Kepala Gudang', 'kepala@gmail.com', '$2y$12$DLXIwQliTW80X2BQ9xOI1erZ3i1892jf79EKLNw..h2XxIkJ0FgTa', 'kepala_gudang', NULL, NULL, '2025-11-09 18:59:48', '2025-11-09 18:59:48'),
(3, 'Teknisi 1', 'teknisi@gmail.com', '$2y$12$c5C.vXsqRfuTLn3nRs5zY.5YycfAupiNoOKae5Roy73G3c9Ee.Rv6', 'teknisi', NULL, NULL, '2025-11-09 18:59:48', '2025-11-09 18:59:48'),
(4, 'Teknisi 2', 'teknisi2@gmail.com', '$2y$12$9dP9qt1m9QZNnSO41YFDzuyZ4srgkQZZZMT.CbeCF62qRjzmbOO1G', 'teknisi', NULL, NULL, '2025-11-09 18:59:48', '2025-11-09 18:59:48'),
(6, 'Helper', 'helper@gmail.com', '$2y$12$P744JmqO.XLUfQpUkrc8i.B4R34qnYKM3eEw43cNnqO2KJe8L2ilC', 'helper', NULL, NULL, '2025-11-10 02:52:22', '2025-11-10 02:52:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `enrollment_assignments`
--
ALTER TABLE `enrollment_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollment_assignments_kepala_gudang_id_foreign` (`kepala_gudang_id`),
  ADD KEY `enrollment_assignments_teknisi_id_foreign` (`teknisi_id`),
  ADD KEY `enrollment_assignments_customer_id_foreign` (`customer_id`),
  ADD KEY `enrollment_assignments_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipment_assignments`
--
ALTER TABLE `shipment_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_assignments_enrollment_assignment_id_foreign` (`enrollment_assignment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollment_assignments`
--
ALTER TABLE `enrollment_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `shipment_assignments`
--
ALTER TABLE `shipment_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `enrollment_assignments`
--
ALTER TABLE `enrollment_assignments`
  ADD CONSTRAINT `enrollment_assignments_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `enrollment_assignments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `enrollment_assignments_kepala_gudang_id_foreign` FOREIGN KEY (`kepala_gudang_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollment_assignments_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_assignments`
--
ALTER TABLE `shipment_assignments`
  ADD CONSTRAINT `shipment_assignments_enrollment_assignment_id_foreign` FOREIGN KEY (`enrollment_assignment_id`) REFERENCES `enrollment_assignments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
