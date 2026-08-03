-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2026 at 09:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixorav2`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_tersedias`
--

CREATE TABLE `barang_tersedias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_item_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tahun_perolehan` year(4) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidangs`
--

CREATE TABLE `bidangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidangs`
--

INSERT INTO `bidangs` (`id`, `nama_bidang`, `created_at`, `updated_at`) VALUES
(1, 'Alat kesehatan', '2026-08-03 02:24:04', '2026-08-03 02:24:04'),
(2, 'Komputer', '2026-08-03 02:24:12', '2026-08-03 02:24:12'),
(3, 'ATK', '2026-08-03 02:24:25', '2026-08-03 02:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_barangs`
--

CREATE TABLE `detail_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kode_aset` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `spesifikasi` text DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `no_surat` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_acc` date DEFAULT NULL,
  `tanggal_kerusakan` date DEFAULT NULL,
  `tanggal_verif` timestamp NULL DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `ttd` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `bidang_id`, `nip`, `nama`, `jabatan`, `ruangan`, `ttd`, `created_at`, `updated_at`) VALUES
(1, NULL, '-', 'Administrator', 'admin', 'admin', NULL, NULL, NULL),
(2, 2, '001', 'Riza Rahardina', 'Kepala Ruangan', 'SIMRS', '1785723948_ach wahyudi.png', '2026-08-03 02:25:48', '2026-08-03 02:28:45'),
(3, NULL, '002', 'Dinda Steffany', 'Kepala Ruangan', 'RUANG TERATAI', '1785724054_ani ratmono.png', '2026-08-03 02:27:34', '2026-08-03 02:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_06_29_034538_create_bidangs_table', 1),
(2, '0000_07_29_034320_create_karyawans_table', 1),
(3, '0001_01_01_000000_create_users_table', 1),
(4, '2026_07_29_034500_create_requests_table', 1),
(5, '2026_07_29_034524_create_detail_barangs_table', 1),
(6, '2026_07_30_090410_create_cache_table', 1),
(7, '2026_07_31_083548_create_pengadaan_barangs_table', 1),
(8, '2026_07_31_085008_create_pengajuans_table', 1),
(9, '2026_07_31_085839_create_pengajuan_items_table', 1),
(10, '2026_08_03_132656_create_barang_tersedias_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_barangs`
--

CREATE TABLE `pengadaan_barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dasar_usulan` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `spesifikasi_teknis` varchar(255) DEFAULT NULL,
  `satuan` text DEFAULT NULL,
  `perkiraanharga` varchar(255) DEFAULT NULL,
  `total_harga` varchar(255) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_acc` date DEFAULT NULL,
  `tanggal_kerusakan` date DEFAULT NULL,
  `tanggal_verif` timestamp NULL DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuans`
--

CREATE TABLE `pengajuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `bidang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_pengajuan` varchar(255) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `tahun_anggaran` year(4) DEFAULT NULL,
  `instalasi` varchar(255) NOT NULL,
  `dasar_usulan` varchar(255) DEFAULT NULL,
  `alasan_justifikasi` text DEFAULT NULL,
  `manfaat` text DEFAULT NULL,
  `dampak` text DEFAULT NULL,
  `kondisi_barang_lama` text DEFAULT NULL,
  `ket_barang_lama` text DEFAULT NULL,
  `foto_barang` tinyint(1) DEFAULT 0,
  `data_kerusakan` tinyint(1) DEFAULT 0,
  `penawaran_harga` tinyint(1) DEFAULT 0,
  `penerima_id` bigint(20) UNSIGNED DEFAULT NULL,
  `atasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direktur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_pengajuan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('draft','diajukan','disetujui_koordinator','disetujui_kabid','menunggu_direktur','disetujui','ditolak') NOT NULL DEFAULT 'draft',
  `diterima_at` timestamp NULL DEFAULT NULL,
  `disetujui_kabid_at` timestamp NULL DEFAULT NULL,
  `disetujui_direktur_at` timestamp NULL DEFAULT NULL,
  `catatan_unit` text DEFAULT NULL,
  `catatan_bidang` text DEFAULT NULL,
  `catatan_perencanaan` text DEFAULT NULL,
  `catatan_ipsrs` text DEFAULT NULL,
  `catatan_farmasi` text DEFAULT NULL,
  `catatan_keuangan` text DEFAULT NULL,
  `catatan_direktur` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_items`
--

CREATE TABLE `pengajuan_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `spesifikasi` text DEFAULT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` bigint(20) UNSIGNED DEFAULT NULL,
  `jumlah_disetujui` int(10) UNSIGNED DEFAULT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `penerima_id` bigint(20) UNSIGNED DEFAULT NULL,
  `atasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `request_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `ruangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1Xv1ND9IztHaMVVWlSLTI471cAkE5z4STA6oJUof', NULL, '10.10.9.241', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5.2 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3lGWHhNOTJwN0JNam95TGlDUHI3V1J0VVpzZlJSN3BHSWdYRVJOViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly8xMC4xMC45LjI0MToyMjIyIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785724252),
('5XEJhEScMx8nyVrPKRY4mMa7CJEjLpUalXRuj5Zh', 2, '10.10.10.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVlAxbzlXSFJQd1VtRndVM1VuVjVRWXE1aTFhMGozamhzaUN1UzdOWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMC4xMC45LjI0MToyMjIyL3BlbW9ob24vcGVuZ2FkYWFuL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoyNDoicGVtb2hvbi5wZW5nYWRhYW4uY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1785731956),
('eW68XV3oYocqnODM27AU5YUrv0g0x1wrUrI50eDT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.131.0 Chrome/148.0.7778.280 Electron/42.7.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidWNSWVdFb0dtYWt0bnhjQlpuQmdUS0lCTXFVUFdsSWxjcFVMREx4cyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785739219),
('KvZ42Zl8JHjzFTlx1Eb0yrS7XBiRw3pYZ8ZrpBqL', NULL, '10.10.11.168', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlVQd2IyU0RsSFV4UUlMTDRrcGdqOXJucExXQ3owWlp4V3haNGZHaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly8xMC4xMC45LjI0MToyMjIyIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785727704),
('lklBJX5Tfyl6PY8pWIgmh1dMHihlNzNAIWDUaDwv', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMWdEeTFNWFNZVWIzSXJuclNBTm5FZUN4cjMzdVRTVU9Rc3AwTUZOYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1vaG9uL3BlbmdhZGFhbi9jcmVhdGUiO3M6NToicm91dGUiO3M6MjQ6InBlbW9ob24ucGVuZ2FkYWFuLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1785731892),
('zLwQtD8FMzDsJNxnIUYRegJ4sRcy3EtRps89rVtt', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.131.0 Chrome/148.0.7778.280 Electron/42.7.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoienc1QVFLcDVZdG5NS3Y4VE9SZm1Ndm1lUkFPbDFrUllTMHpibW1JeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1785724908);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `role2` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `karyawan_id`, `email`, `email_verified_at`, `password`, `role`, `role2`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin RSMZ', 1, 'admin@rsmz.com', '2026-08-03 02:22:12', '$2y$12$BPMhE2Hw.p7d6ET3ZAYQde.H8MTZUmko.q/TRRci087ZjEoypngY6', 'admin', NULL, 1, NULL, '2026-08-03 02:22:12', '2026-08-03 02:22:12'),
(2, 'Dinda Steffany', 3, 'dinda@rsmz.com', NULL, '$2y$12$TTIwMYaX7g1PhgU1K9.uFei/1o2pZeuYUOGosjqVEnEo1FqJEMwxO', 'pemohon', NULL, 1, NULL, '2026-08-03 02:28:27', '2026-08-03 02:28:27'),
(3, 'Riza Rahardina', 2, 'riza@rsmz.com', NULL, '$2y$12$asGtLecEs1Y3aB9FkFcfieVjYerOGqudPT0nNLhrStTZJfaneVpIa', 'penerima', NULL, 1, NULL, '2026-08-03 02:28:46', '2026-08-03 02:28:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_tersedias`
--
ALTER TABLE `barang_tersedias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_tersedias_pengajuan_item_id_foreign` (`pengajuan_item_id`);

--
-- Indexes for table `bidangs`
--
ALTER TABLE `bidangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_barangs`
--
ALTER TABLE `detail_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_barangs_request_id_foreign` (`request_id`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawans_nip_unique` (`nip`),
  ADD KEY `karyawans_bidang_id_foreign` (`bidang_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengajuans_no_pengajuan_unique` (`no_pengajuan`),
  ADD KEY `pengajuans_karyawan_id_foreign` (`karyawan_id`),
  ADD KEY `pengajuans_bidang_id_foreign` (`bidang_id`),
  ADD KEY `pengajuans_penerima_id_foreign` (`penerima_id`),
  ADD KEY `pengajuans_atasan_id_foreign` (`atasan_id`),
  ADD KEY `pengajuans_direktur_id_foreign` (`direktur_id`);

--
-- Indexes for table `pengajuan_items`
--
ALTER TABLE `pengajuan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_items_pengajuan_id_foreign` (`pengajuan_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_bidang_id_foreign` (`bidang_id`),
  ADD KEY `requests_penerima_id_foreign` (`penerima_id`),
  ADD KEY `requests_atasan_id_foreign` (`atasan_id`),
  ADD KEY `requests_karyawan_id_foreign` (`karyawan_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_karyawan_id_foreign` (`karyawan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_tersedias`
--
ALTER TABLE `barang_tersedias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bidangs`
--
ALTER TABLE `bidangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_barangs`
--
ALTER TABLE `detail_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuans`
--
ALTER TABLE `pengajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_items`
--
ALTER TABLE `pengajuan_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_tersedias`
--
ALTER TABLE `barang_tersedias`
  ADD CONSTRAINT `barang_tersedias_pengajuan_item_id_foreign` FOREIGN KEY (`pengajuan_item_id`) REFERENCES `pengajuan_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_barangs`
--
ALTER TABLE `detail_barangs`
  ADD CONSTRAINT `detail_barangs_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `karyawans_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD CONSTRAINT `pengajuans_atasan_id_foreign` FOREIGN KEY (`atasan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuans_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuans_direktur_id_foreign` FOREIGN KEY (`direktur_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengajuans_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`),
  ADD CONSTRAINT `pengajuans_penerima_id_foreign` FOREIGN KEY (`penerima_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pengajuan_items`
--
ALTER TABLE `pengajuan_items`
  ADD CONSTRAINT `pengajuan_items_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_atasan_id_foreign` FOREIGN KEY (`atasan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `requests_bidang_id_foreign` FOREIGN KEY (`bidang_id`) REFERENCES `bidangs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `requests_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `requests_penerima_id_foreign` FOREIGN KEY (`penerima_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
