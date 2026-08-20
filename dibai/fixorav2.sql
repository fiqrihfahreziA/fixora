-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2026 at 09:20 AM
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
(3, NULL, '002', 'dinda aulina putri', 'Kepala Ruangan', 'RUANG BOUGENVILE', '1785978310_holisotul hoiria.png', '2026-08-06 01:05:10', '2026-08-06 01:05:10'),
(4, 2, '003', 'Dita Auni', 'Kepala Bidang', 'MANAJEMEN', '1785978350_siti julaeha.png', '2026-08-06 01:05:50', '2026-08-06 01:07:10'),
(5, 2, '006', 'dr aini manarul', 'Kepala Bidang', 'MANAJEMEN', '1786324572_putri alvianita.png', '2026-08-10 01:16:12', '2026-08-10 01:16:37'),
(6, NULL, '007', 'dina mrshella', 'Kepala Bidang', 'KEUANGAN', '1786413286_murniawati.png', '2026-08-11 01:54:46', '2026-08-11 01:54:46'),
(7, NULL, '0010', 'hasan habibi', 'Direktur', 'MANAJEMEN', '1787014491_Diyah Kesling.png', '2026-08-18 00:54:52', '2026-08-18 00:54:52');

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
(13, '2026_08_11_081650_add_keuangan_to_status_enum_on_pengajuan_table', 4),
(14, '2026_08_18_084336_add_direktur_fields_to_pengajuans_table', 5);

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
  `total_disetujui_direktur` decimal(15,2) DEFAULT NULL,
  `status` enum('draft','diajukan','disetujui_koordinator','disetujui_kabid','menunggu_direktur','disetujui','ditolak','revisi','disetujui sebagian','ditunda') NOT NULL DEFAULT 'draft',
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
  `alasan_direktur` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuans`
--

INSERT INTO `pengajuans` (`id`, `karyawan_id`, `bidang_id`, `no_pengajuan`, `tanggal_pengajuan`, `tahun_anggaran`, `instalasi`, `dasar_usulan`, `alasan_justifikasi`, `manfaat`, `dampak`, `kondisi_barang_lama`, `ket_barang_lama`, `foto_barang`, `data_kerusakan`, `penawaran_harga`, `penerima_id`, `atasan_id`, `direktur_id`, `total_pengajuan`, `total_disetujui`, `total_disetujui_direktur`, `status`, `id_keuangan`, `disetujui_keuangan_at`, `diterima_at`, `disetujui_kabid_at`, `disetujui_direktur_at`, `catatan_unit`, `log_status_penerima`, `log_status_atasan`, `log_status_direktur`, `catatan_bidang`, `catatan_perencanaan`, `catatan_ipsrs`, `catatan_farmasi`, `catatan_keuangan`, `status_keuangan`, `log_status_keuangan`, `catatan_direktur`, `alasan_direktur`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'PGD-20260806-6194', '2026-08-06', '2026', 'RUANG BOUGENVILE', 'Kebutuhan Operasional', 'dsfsdfsdfds', 'sdfsdfsfsdf', 'fdsfsdfdsf', 'Rusak Ringan', 'sdsdsds', NULL, 'pengajuan/data_kerusakan/1785980117_data_kerusakan.pdf', NULL, 2, 5, 7, 307032.00, 100000.00, 100000.00, 'disetujui', 6, '2026-08-19 03:48:50', '2026-08-13 01:34:44', '2026-08-13 01:37:34', '2026-08-20 02:00:38', 'asdadasdas', 'disetujui_koordinator', 'disetujui_kabid', 'disetujui', 'asdadsasdasdasdadasdasdasdasdada  das das', NULL, NULL, NULL, 'asdadadasda', NULL, 'disetujui_keuangan', 'wqewqeqwedq', NULL, '2026-08-06 01:35:17', '2026-08-20 02:00:38'),
(2, 3, 2, 'PGD-20260806-8737', '2026-08-06', '2026', 'RUANG BOUGENVILE', 'Penggantian Barang Rusak', 'dasdasdas', 'dasdadasdas', 'dadadas', NULL, 'asdasdas', NULL, 'pengajuan/data_kerusakan/1785985267_data_kerusakan.pdf', NULL, 2, 5, 7, 181780.00, 100000.00, 100000.00, 'disetujui', 6, '2026-08-19 01:44:30', '2026-08-13 01:33:43', '2026-08-13 01:37:20', '2026-08-20 02:50:57', 'fsdfsdsdfsdfdsfdsf', 'disetujui_koordinator', 'disetujui_kabid', 'disetujui', 'ddgfggd', NULL, NULL, NULL, 'huhuiguiyioh uoe huiphoahudao hudoap husaop hsiadop iaop idhoap hioap ioap huoa hiopsh oipa doipahopduah iopah iohadiohaoipdh auophd ouap hduopa huopa huaop hduoap hduap', 0, 'disetujui_keuangan', 'asdasdasdasdsadsadasdsadsadasdsadsadsa', NULL, '2026-08-06 03:01:08', '2026-08-20 02:50:57');

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
  `disetujui_direktur` tinyint(1) NOT NULL DEFAULT 0,
  `jumlah_disetujui` int(10) UNSIGNED DEFAULT NULL,
  `harga_disetujui` bigint(20) UNSIGNED DEFAULT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_items`
--

INSERT INTO `pengajuan_items` (`id`, `pengajuan_id`, `nama_barang`, `spesifikasi`, `satuan`, `jumlah`, `harga`, `disetujui_direktur`, `jumlah_disetujui`, `harga_disetujui`, `harga_satuan`, `created_at`, `updated_at`) VALUES
(3, 2, 'adasdasdas', 'dsadasdasdas', 'Pcs', 4, 181780, 0, 4, NULL, 45445.00, '2026-08-06 03:01:08', '2026-08-06 03:01:08'),
(6, 1, 'sdfdsfds', 'sdfsdfsd', 'Unit', 4, 280032, 0, 4, NULL, 70008.00, '2026-08-06 05:30:02', '2026-08-06 05:30:02'),
(7, 1, 'asdasdasdsa', 'dadasd', 'Pcs', 3, 27000, 0, 3, NULL, 9000.00, '2026-08-06 05:30:02', '2026-08-06 05:30:02');

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
('1j1mnq1f5sQo6XryzkduaeJiGZfYugJk05YQj3ed', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNU1ES3NPUHdDSXZCUG5hUkdBNGtUMVNlejd6dm9sZXZRdXI5RFJIUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2RpcmVrdHVyL3BlbmdhZGFhbi8yL2NldGFrIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1787210361),
('2WhFoqEVC4PBFMS5NeACWMgPzqZ6y7IbUxR5sc9o', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGNvQ3pwMjFuVlVtcjh0aUZiRWtMNWJzeUtDOFd0ejFtWGhnUHdlUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1vaG9uL3BlbmdhZGFhbi8yL2NldGFrIjtzOjU6InJvdXRlIjtzOjIzOiJwZW1vaG9uLnBlbmdhZGFhbi5jZXRhayI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1787193629),
('cDCFetzUJPVzQNNz1aWsI23rSf636JTw0tixvrVu', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY3A1N3c2c1FxeUwyYkJqRHBiWng2bnh1YXNsT2xQUjYzVlNPQzNTOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kaXJla3R1ci9wZXJtaW50YWFubiI7czo1OiJyb3V0ZSI7czoxODoiZGlyZWt0dXIucGVuZ2FkYWFuIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1787192517),
('ngr9wD3GNzSxfA9HVdG1sgSkvvKpFD3v36jOrvWF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:154.0) Gecko/20100101 Firefox/154.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid29VSnNjSFY5ajNadkNqTVdNTDU0Rk45OWFYVDhQcWltN2YyMXI5MSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3BlbW9ob24vcGVuZ2FkYWFuLzIvY2V0YWsiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787202546),
('nSYPKc1PJ4mJL9wFxUn46nP6iuXPoLp2rVrWR1I7', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.133.0 Chrome/148.0.7778.280 Electron/42.8.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN0hWaUFscEo4cktjRmxlTGxjUzZIR29uOU52aWZTT3pMaGtZMmV4dSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kaXJla3R1ci9wZXJtaW50YWFubiI7czo1OiJyb3V0ZSI7czoxODoiZGlyZWt0dXIucGVuZ2FkYWFuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1787194294),
('WhRlh3WpPOAsq7uaqoZsJJmwVoXCV5QBbnEhOjcD', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.133.0 Chrome/148.0.7778.280 Electron/42.8.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTExJbzN4TFZ5RkQzR0FuQnJjdHFGR012V2pGNmUzNjVvcEFlQ3VlMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2RpcmVrdHVyL3BlbmdhZGFhbi8yL2NldGFrIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1787206501);

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
(6, 'dina mrshella', 6, 'dina@rsmz.com', NULL, '$2y$12$taJjnUVXHf9lCAbzZeVR3.Gf39ciO02.2NfQlkeyFsj75lNYEeFK.', 'keuangan', NULL, 1, NULL, '2026-08-11 01:58:45', '2026-08-11 01:58:45'),
(7, 'hasan habibi', 7, 'hasan@rsmz.com', NULL, '$2y$12$PqXW0fBGNtcrNgpRrTFjYu883cn/qTF.RczUFm48so3L9sZXmrhwe', 'direktur', NULL, 1, NULL, '2026-08-18 00:55:04', '2026-08-18 00:55:27');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
