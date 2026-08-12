-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2026 at 10:03 AM
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

--
-- Dumping data for table `barang_tersedias`
--

INSERT INTO `barang_tersedias` (`id`, `pengajuan_item_id`, `nama_barang`, `jumlah`, `tahun_perolehan`, `kondisi`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 6, 'sdfdsfds', 5, '2019', 'Rusak Berat', NULL, '2026-08-06 05:30:02', '2026-08-06 05:30:02');

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
(1, 'Alat Kesehatan', '2026-08-06 01:02:22', '2026-08-06 01:02:22'),
(2, 'Komputer', '2026-08-06 01:02:30', '2026-08-06 01:02:30'),
(3, 'ATK', '2026-08-06 01:02:36', '2026-08-06 01:02:36');

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
(1, NULL, '000', 'Asministrator', 'null', 'admin', NULL, '2026-08-06 01:01:02', '2026-08-06 01:01:02'),
(2, 2, '001', 'Riza Rahardina', 'Kepala Ruangan', 'SIMRS', '1785978252_anis sulala.png', '2026-08-06 01:04:13', '2026-08-06 01:07:48'),
(3, NULL, '002', 'dinda', 'Kepala Ruangan', 'RUANG BOUGENVILE', '1785978310_holisotul hoiria.png', '2026-08-06 01:05:10', '2026-08-06 01:05:10'),
(4, 2, '003', 'Dita Auni', 'Kepala Bidang', 'MANAJEMEN', '1785978350_siti julaeha.png', '2026-08-06 01:05:50', '2026-08-06 01:07:10'),
(5, 2, '006', 'dr aini manarul', 'Kepala Bidang', 'MANAJEMEN', '1786324572_putri alvianita.png', '2026-08-10 01:16:12', '2026-08-10 01:16:37'),
(6, NULL, '007', 'dina mrshella', 'Kepala Bidang', 'KEUANGAN', '1786413286_murniawati.png', '2026-08-11 01:54:46', '2026-08-11 01:54:46');

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
(10, '2026_08_03_132656_create_barang_tersedias_table', 1),
(11, '2026_08_06_083304_update_pengajuans_file_columns_nullable', 2),
(12, '2026_08_06_093951_add_log_status_columns_to_pengajuans', 3),
(13, '2026_08_11_081650_add_keuangan_to_status_enum_on_pengajuan_table', 4);

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
  `foto_barang` varchar(255) DEFAULT NULL,
  `data_kerusakan` varchar(255) DEFAULT NULL,
  `penawaran_harga` varchar(255) DEFAULT NULL,
  `penerima_id` bigint(20) UNSIGNED DEFAULT NULL,
  `atasan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `direktur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_pengajuan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_disetujui` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('draft','diajukan','disetujui_koordinator','disetujui_kabid','menunggu_direktur','disetujui','ditolak','revisi') NOT NULL DEFAULT 'draft',
  `id_keuangan` bigint(20) UNSIGNED DEFAULT NULL,
  `disetujui_keuangan_at` timestamp NULL DEFAULT NULL,
  `diterima_at` timestamp NULL DEFAULT NULL,
  `disetujui_kabid_at` timestamp NULL DEFAULT NULL,
  `disetujui_direktur_at` timestamp NULL DEFAULT NULL,
  `catatan_unit` text DEFAULT NULL,
  `log_status_penerima` varchar(255) DEFAULT NULL,
  `log_status_atasan` varchar(255) DEFAULT NULL,
  `log_status_direktur` varchar(255) DEFAULT NULL,
  `catatan_bidang` text DEFAULT NULL,
  `catatan_perencanaan` text DEFAULT NULL,
  `catatan_ipsrs` text DEFAULT NULL,
  `catatan_farmasi` text DEFAULT NULL,
  `catatan_keuangan` text DEFAULT NULL,
  `status_keuangan` int(11) DEFAULT NULL,
  `log_status_keuangan` varchar(255) DEFAULT NULL,
  `catatan_direktur` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuans`
--

INSERT INTO `pengajuans` (`id`, `karyawan_id`, `bidang_id`, `no_pengajuan`, `tanggal_pengajuan`, `tahun_anggaran`, `instalasi`, `dasar_usulan`, `alasan_justifikasi`, `manfaat`, `dampak`, `kondisi_barang_lama`, `ket_barang_lama`, `foto_barang`, `data_kerusakan`, `penawaran_harga`, `penerima_id`, `atasan_id`, `direktur_id`, `total_pengajuan`, `total_disetujui`, `status`, `id_keuangan`, `disetujui_keuangan_at`, `diterima_at`, `disetujui_kabid_at`, `disetujui_direktur_at`, `catatan_unit`, `log_status_penerima`, `log_status_atasan`, `log_status_direktur`, `catatan_bidang`, `catatan_perencanaan`, `catatan_ipsrs`, `catatan_farmasi`, `catatan_keuangan`, `status_keuangan`, `log_status_keuangan`, `catatan_direktur`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'PGD-20260806-6194', '2026-08-06', '2026', 'RUANG BOUGENVILE', 'Kebutuhan Operasional', 'dsfsdfsdfds', 'sdfsdfsfsdf', 'fdsfsdfdsf', 'Rusak Ringan', 'sdsdsds', NULL, 'pengajuan/data_kerusakan/1785980117_data_kerusakan.pdf', NULL, 4, 5, NULL, 307032.00, 0.00, 'disetujui_kabid', NULL, NULL, '2026-08-11 01:48:41', '2026-08-12 02:28:36', NULL, 'jggjyfdydryhdryhd', 'disetujui_koordinator', 'disetujui_kabid', NULL, 'asdafsdfsffsdfsfsdfsd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06 01:35:17', '2026-08-12 02:28:36'),
(2, 3, 2, 'PGD-20260806-8737', '2026-08-06', '2026', 'RUANG BOUGENVILE', 'Penggantian Barang Rusak', 'dasdasdas', 'dasdadasdas', 'dadadas', NULL, 'asdasdas', NULL, 'pengajuan/data_kerusakan/1785985267_data_kerusakan.pdf', NULL, 4, 5, NULL, 181780.00, 0.00, 'disetujui_kabid', NULL, NULL, '2026-08-07 01:47:24', '2026-08-12 02:26:21', NULL, 'adadadasdasdasdadadqwdqwakb\r\nfjlljlhjkls\r\nk\'klfkl\'fkl;dfsjl;fdsjl;\r\nfjdfl;sj;dfsjk;dfsj;kefs', NULL, NULL, NULL, 'aDQDASDASDASDSADSA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06 03:01:08', '2026-08-12 02:26:21');

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
  `harga_disetujui` bigint(20) UNSIGNED DEFAULT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_items`
--

INSERT INTO `pengajuan_items` (`id`, `pengajuan_id`, `nama_barang`, `spesifikasi`, `satuan`, `jumlah`, `harga`, `jumlah_disetujui`, `harga_disetujui`, `harga_satuan`, `created_at`, `updated_at`) VALUES
(3, 2, 'adasdasdas', 'dsadasdasdas', 'Pcs', 4, 181780, 4, NULL, 45445.00, '2026-08-06 03:01:08', '2026-08-06 03:01:08'),
(6, 1, 'sdfdsfds', 'sdfsdfsd', 'Unit', 4, 280032, 4, NULL, 70008.00, '2026-08-06 05:30:02', '2026-08-06 05:30:02'),
(7, 1, 'asdasdasdsa', 'dadasd', 'Pcs', 3, 27000, 3, NULL, 9000.00, '2026-08-06 05:30:02', '2026-08-06 05:30:02');

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
('5B1QvJqT1MURbnThzdMxFgKysucwZyMIQRdZn4SZ', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia3Q1b29rZGtrVEZBUXlzM1p6RWFUc0M2N2FKSkZPdGZlNFNQWW5NTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZXVhbmdhbi9wZW5nYWRhYW4vMi9kZXRhaWwiO3M6NToicm91dGUiO3M6MjU6ImtldWFuZ2FuLnBlbmdhZGFhbi5kZXRhaWwiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1786504438),
('eX0J7P3BNQfoDcqi7q0hRPGleQC5I9xReGZg64NB', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.132.1 Chrome/148.0.7778.280 Electron/42.7.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVFtbUF1UGo3dlpmTmlVZjB3dWFuZ2dYVVA3NE5NTG1PaGFFbWVsQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZXVhbmdhbi9wZXJtaW50YWFubiI7czo1OiJyb3V0ZSI7czoxODoia2V1YW5nYW4ucGVuZ2FkYWFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1786500600);

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
(1, 'Admin RSMZ', 1, 'admin@rsmz.com', '2026-08-06 01:01:03', '$2y$12$a2MJNRMSw2TvbJCD88K/IeSDyMJHwb1agBrKv9HEG5IRUoDcsrk8K', 'admin', NULL, 1, NULL, '2026-08-06 01:01:03', '2026-08-06 01:01:03'),
(2, 'dinda', 3, 'dinda@rsmz.com', NULL, '$2y$12$ARwFfDuva1Al8umlgz6Qw.pq.vdQZAZolozx7MugsnpbdXKrc928C', 'pemohon', NULL, 1, NULL, '2026-08-06 01:06:35', '2026-08-06 01:06:35'),
(3, 'Dita Auni', 4, 'dita@rsmz.com', NULL, '$2y$12$Xh1a6UZKAlhPnXt.6QtEH.0eTcoPx7b3RcMP2MvFcFQ90uUg1gYNW', 'atasan', NULL, 1, NULL, '2026-08-06 01:07:11', '2026-08-06 01:07:11'),
(4, 'Riza Rahardina', 2, 'riza@rsmz.com', NULL, '$2y$12$Pwr9Sv8EFF4pRB2dAAWqWuBk20j5LsI5cRmeKVYK1EzlwdBIdEkum', 'penerima', NULL, 1, NULL, '2026-08-06 01:07:48', '2026-08-06 01:07:48'),
(5, 'dr aini manarul', 5, 'drmanarul@rsmz.com', NULL, '$2y$12$g.s0eg35pqNt9bKn/4BaFu9JlPXa7unze3G8Ml1DyyAudleqNtgU.', 'atasan', NULL, 1, NULL, '2026-08-10 01:16:38', '2026-08-10 01:16:38'),
(6, 'dina mrshella', 6, 'dina@rsmz.com', NULL, '$2y$12$taJjnUVXHf9lCAbzZeVR3.Gf39ciO02.2NfQlkeyFsj75lNYEeFK.', 'keuangan', NULL, 1, NULL, '2026-08-11 01:58:45', '2026-08-11 01:58:45');

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
  ADD KEY `pengajuans_direktur_id_foreign` (`direktur_id`),
  ADD KEY `pengajuans_id_keuangan_foreign` (`id_keuangan`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengadaan_barangs`
--
ALTER TABLE `pengadaan_barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuans`
--
ALTER TABLE `pengajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengajuan_items`
--
ALTER TABLE `pengajuan_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `pengajuans_id_keuangan_foreign` FOREIGN KEY (`id_keuangan`) REFERENCES `karyawans` (`id`) ON DELETE SET NULL,
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
