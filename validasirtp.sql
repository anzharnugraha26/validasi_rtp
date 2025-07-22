-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jul 2025 pada 06.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `validasirtp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_07_08_102611_create_validasi_data_table', 1),
(7, '2025_07_08_152746_create_validasi_data_details_table', 1),
(8, '2025_07_09_112435_create_validasi_logs_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'anzhar', 1, 'anzharnugraha50@gmail.com', 'anzharnugraha', NULL, '$2y$12$LXixm0qy0oTlviHwo8DioOPZ0Xth.xDxuLRF83GzEaYJEBd5NsINO', '5iGtEXF67wCA1OOSOW1B6eA71WjUG3kf6ffuTyAthYxZmaJiSELDH95h5ZXZ', '2025-07-09 02:43:24', '2025-07-09 02:43:24'),
(2, 'user', 0, 'user123@gmail.com', 'user', NULL, '$2y$12$G2Ck/4g2/Yoh456PBLPb9OpA5XKQTaNmQVwpEXH0YSYKuQXcxHmR6', NULL, '2025-07-09 02:44:42', '2025-07-09 02:44:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `validasi_data`
--

CREATE TABLE `validasi_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `create_by` varchar(255) NOT NULL,
  `nama_file_1` varchar(255) DEFAULT NULL,
  `nama_file_2` varchar(255) DEFAULT NULL,
  `jumlah_data_1` varchar(255) DEFAULT NULL,
  `jumlah_data_2` varchar(255) DEFAULT NULL,
  `total_1` varchar(255) DEFAULT NULL,
  `total_2` varchar(255) DEFAULT NULL,
  `temp_file1` varchar(255) DEFAULT NULL,
  `temp_file2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `validasi_data`
--

INSERT INTO `validasi_data` (`id`, `client`, `title`, `create_by`, `nama_file_1`, `nama_file_2`, `jumlah_data_1`, `jumlah_data_2`, `total_1`, `total_2`, `temp_file1`, `temp_file2`, `created_at`, `updated_at`) VALUES
(1, 'cek 1', 'cek', 'anzhar', 'data 1 (RTP).xlsx', 'data 2 (tarikan gaji).xlsx', '11', '11', '63700316', '63700335', 'validasi_1_file1.xlsx', 'validasi_1_file2.xlsx', '2025-07-14 07:07:20', '2025-07-14 07:08:26'),
(2, 'cek', 'cek new', 'anzhar', 'data 1 (RTP).xlsx', 'data 2 (tarikan gaji).xlsx', '11', '11', '63700316', '63700335', 'validasi_2_file1.xlsx', 'validasi_2_file2.xlsx', '2025-07-14 08:01:24', '2025-07-14 08:01:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `validasi_data_details`
--

CREATE TABLE `validasi_data_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_validasi` int(11) NOT NULL,
  `sim_id` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `file1` varchar(255) DEFAULT NULL,
  `file2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `validasi_data_details`
--

INSERT INTO `validasi_data_details` (`id`, `id_validasi`, `sim_id`, `parameter`, `file1`, `file2`, `created_at`, `updated_at`) VALUES
(1, 1, 'PEG23121696', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(2, 1, 'PEG23121696', 'END_DATE', '45838', '46022', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(3, 1, 'PEG23121696', 'TOTAL', '5006286.0582059', '5006285', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(4, 1, 'PEG24081487', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(5, 1, 'PEG24081487', 'END_DATE', '45838', '46203', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(6, 1, 'PEG24081487', 'PPH 21', '52916.170294188', '52912', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(7, 1, 'PEG24081487', 'TOTAL', '6530410.5460642', '6530414', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(8, 1, 'PEG24081488', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(9, 1, 'PEG24081488', 'END_DATE', '45838', '46203', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(10, 1, 'PEG24081488', 'PPH 21', '85850.848320959', '85845', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(11, 1, 'PEG24081488', 'TOTAL', '8027071.327575', '8027077', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(12, 1, 'PEG24081489', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(13, 1, 'PEG24081489', 'END_DATE', '45838', '46203', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(14, 1, 'PEG24081485', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(15, 1, 'PEG24081485', 'END_DATE', '45838', '46203', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(16, 1, 'PEG24081485', 'PPH 21', '85850.848320959', '85845', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(17, 1, 'PEG24081485', 'TOTAL', '8027071.327575', '8027077', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(18, 1, '01208266', 'TOTAL', '4346879.5594825', '4346879', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(19, 1, '01218809', 'NPWP', '', '0', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(20, 1, '01218809', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(21, 1, '01218809', 'END_DATE', '45838', '46022', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(22, 1, '01232645', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(23, 1, '01232645', 'END_DATE', '45838', '46203', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(24, 1, '01232645', 'PPH 21', '17063.069226194', '17062', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(25, 1, '01232645', 'TOTAL', '6336001.9650513', '6336003', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(26, 1, 'PEG23021530', 'HIRED_DATE', '45474', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(27, 1, 'PEG23021530', 'END_DATE', '45838', '46203', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(28, 1, 'PEG23021530', 'PPH 21', '85315.346130968', '85309', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(29, 1, 'PEG23021530', 'TOTAL', '6267749.6881465', '6267756', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(30, 1, 'PEG23102811', 'HIRED_DATE', '45597', '45839', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(31, 1, 'PEG23102811', 'END_DATE', '45838', '46022', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(32, 1, 'PEG25044063', 'HIRED_DATE', '45768', '45829', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(33, 1, 'PEG25044063', 'END_DATE', '45828', '46193', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(34, 2, 'PEG23121696', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(35, 2, 'PEG23121696', 'END_DATE', '45838', '46022', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(36, 2, 'PEG23121696', 'TOTAL', '5006286.0582059', '5006285', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(37, 2, 'PEG24081487', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(38, 2, 'PEG24081487', 'END_DATE', '45838', '46203', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(39, 2, 'PEG24081487', 'PPH 21', '52916.170294188', '52912', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(40, 2, 'PEG24081487', 'TOTAL', '6530410.5460642', '6530414', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(41, 2, 'PEG24081488', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(42, 2, 'PEG24081488', 'END_DATE', '45838', '46203', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(43, 2, 'PEG24081488', 'PPH 21', '85850.848320959', '85845', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(44, 2, 'PEG24081488', 'TOTAL', '8027071.327575', '8027077', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(45, 2, 'PEG24081489', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(46, 2, 'PEG24081489', 'END_DATE', '45838', '46203', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(47, 2, 'PEG24081485', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(48, 2, 'PEG24081485', 'END_DATE', '45838', '46203', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(49, 2, 'PEG24081485', 'PPH 21', '85850.848320959', '85845', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(50, 2, 'PEG24081485', 'TOTAL', '8027071.327575', '8027077', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(51, 2, '01208266', 'TOTAL', '4346879.5594825', '4346879', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(52, 2, '01218809', 'NPWP', '', '0', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(53, 2, '01218809', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(54, 2, '01218809', 'END_DATE', '45838', '46022', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(55, 2, '01232645', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(56, 2, '01232645', 'END_DATE', '45838', '46203', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(57, 2, '01232645', 'PPH 21', '17063.069226194', '17062', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(58, 2, '01232645', 'TOTAL', '6336001.9650513', '6336003', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(59, 2, 'PEG23021530', 'HIRED_DATE', '45474', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(60, 2, 'PEG23021530', 'END_DATE', '45838', '46203', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(61, 2, 'PEG23021530', 'PPH 21', '85315.346130968', '85309', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(62, 2, 'PEG23021530', 'TOTAL', '6267749.6881465', '6267756', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(63, 2, 'PEG23102811', 'HIRED_DATE', '45597', '45839', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(64, 2, 'PEG23102811', 'END_DATE', '45838', '46022', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(65, 2, 'PEG25044063', 'HIRED_DATE', '45768', '45829', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(66, 2, 'PEG25044063', 'END_DATE', '45828', '46193', '2025-07-14 08:01:46', '2025-07-14 08:01:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `validasi_logs`
--

CREATE TABLE `validasi_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_validasi` int(11) DEFAULT NULL,
  `aksi` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file1` text DEFAULT NULL,
  `file2` text DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `sim_id` varchar(255) DEFAULT NULL,
  `oleh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `validasi_logs`
--

INSERT INTO `validasi_logs` (`id`, `id_validasi`, `aksi`, `deskripsi`, `file1`, `file2`, `parameter`, `sim_id`, `oleh`, `created_at`, `updated_at`) VALUES
(1, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG23121696', '45474', '45839', 'HIRED_DATE', 'PEG23121696', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(2, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG23121696', '45838', '46022', 'END_DATE', 'PEG23121696', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(3, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG23121696', '5006286.0582059', '5006285', 'TOTAL', 'PEG23121696', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(4, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081487', '45474', '45839', 'HIRED_DATE', 'PEG24081487', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(5, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081487', '45838', '46203', 'END_DATE', 'PEG24081487', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(6, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG24081487', '52916.170294188', '52912', 'PPH 21', 'PEG24081487', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(7, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG24081487', '6530410.5460642', '6530414', 'TOTAL', 'PEG24081487', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(8, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081488', '45474', '45839', 'HIRED_DATE', 'PEG24081488', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(9, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081488', '45838', '46203', 'END_DATE', 'PEG24081488', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(10, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG24081488', '85850.848320959', '85845', 'PPH 21', 'PEG24081488', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(11, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG24081488', '8027071.327575', '8027077', 'TOTAL', 'PEG24081488', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(12, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081489', '45474', '45839', 'HIRED_DATE', 'PEG24081489', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(13, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081489', '45838', '46203', 'END_DATE', 'PEG24081489', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(14, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081485', '45474', '45839', 'HIRED_DATE', 'PEG24081485', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(15, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081485', '45838', '46203', 'END_DATE', 'PEG24081485', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(16, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG24081485', '85850.848320959', '85845', 'PPH 21', 'PEG24081485', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(17, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG24081485', '8027071.327575', '8027077', 'TOTAL', 'PEG24081485', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(18, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: 01208266', '4346879.5594825', '4346879', 'TOTAL', '01208266', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(19, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom NPWP, SIMID_BPR: 01218809', '', '0', 'NPWP', '01218809', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(20, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: 01218809', '45474', '45839', 'HIRED_DATE', '01218809', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(21, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: 01218809', '45838', '46022', 'END_DATE', '01218809', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(22, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: 01232645', '45474', '45839', 'HIRED_DATE', '01232645', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(23, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: 01232645', '45838', '46203', 'END_DATE', '01232645', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(24, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: 01232645', '17063.069226194', '17062', 'PPH 21', '01232645', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(25, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: 01232645', '6336001.9650513', '6336003', 'TOTAL', '01232645', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(26, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG23021530', '45474', '45839', 'HIRED_DATE', 'PEG23021530', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(27, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG23021530', '45838', '46203', 'END_DATE', 'PEG23021530', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(28, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG23021530', '85315.346130968', '85309', 'PPH 21', 'PEG23021530', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(29, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG23021530', '6267749.6881465', '6267756', 'TOTAL', 'PEG23021530', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(30, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG23102811', '45597', '45839', 'HIRED_DATE', 'PEG23102811', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(31, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG23102811', '45838', '46022', 'END_DATE', 'PEG23102811', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(32, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG25044063', '45768', '45829', 'HIRED_DATE', 'PEG25044063', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(33, 1, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG25044063', '45828', '46193', 'END_DATE', 'PEG25044063', 'anzhar', '2025-07-14 07:08:30', '2025-07-14 07:08:30'),
(34, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG23121696', '45474', '45839', 'HIRED_DATE', 'PEG23121696', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(35, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG23121696', '45838', '46022', 'END_DATE', 'PEG23121696', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(36, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG23121696', '5006286.0582059', '5006285', 'TOTAL', 'PEG23121696', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(37, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081487', '45474', '45839', 'HIRED_DATE', 'PEG24081487', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(38, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081487', '45838', '46203', 'END_DATE', 'PEG24081487', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(39, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG24081487', '52916.170294188', '52912', 'PPH 21', 'PEG24081487', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(40, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG24081487', '6530410.5460642', '6530414', 'TOTAL', 'PEG24081487', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(41, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081488', '45474', '45839', 'HIRED_DATE', 'PEG24081488', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(42, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081488', '45838', '46203', 'END_DATE', 'PEG24081488', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(43, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG24081488', '85850.848320959', '85845', 'PPH 21', 'PEG24081488', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(44, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG24081488', '8027071.327575', '8027077', 'TOTAL', 'PEG24081488', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(45, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081489', '45474', '45839', 'HIRED_DATE', 'PEG24081489', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(46, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081489', '45838', '46203', 'END_DATE', 'PEG24081489', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(47, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG24081485', '45474', '45839', 'HIRED_DATE', 'PEG24081485', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(48, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG24081485', '45838', '46203', 'END_DATE', 'PEG24081485', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(49, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG24081485', '85850.848320959', '85845', 'PPH 21', 'PEG24081485', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(50, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG24081485', '8027071.327575', '8027077', 'TOTAL', 'PEG24081485', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(51, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: 01208266', '4346879.5594825', '4346879', 'TOTAL', '01208266', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(52, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom NPWP, SIMID_BPR: 01218809', '', '0', 'NPWP', '01218809', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(53, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: 01218809', '45474', '45839', 'HIRED_DATE', '01218809', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(54, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: 01218809', '45838', '46022', 'END_DATE', '01218809', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(55, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: 01232645', '45474', '45839', 'HIRED_DATE', '01232645', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(56, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: 01232645', '45838', '46203', 'END_DATE', '01232645', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(57, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: 01232645', '17063.069226194', '17062', 'PPH 21', '01232645', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(58, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: 01232645', '6336001.9650513', '6336003', 'TOTAL', '01232645', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(59, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG23021530', '45474', '45839', 'HIRED_DATE', 'PEG23021530', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(60, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG23021530', '45838', '46203', 'END_DATE', 'PEG23021530', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(61, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom PPH 21, SIMID_BPR: PEG23021530', '85315.346130968', '85309', 'PPH 21', 'PEG23021530', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(62, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom TOTAL, SIMID_BPR: PEG23021530', '6267749.6881465', '6267756', 'TOTAL', 'PEG23021530', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(63, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG23102811', '45597', '45839', 'HIRED_DATE', 'PEG23102811', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(64, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG23102811', '45838', '46022', 'END_DATE', 'PEG23102811', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(65, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom HIRED_DATE, SIMID_BPR: PEG25044063', '45768', '45829', 'HIRED_DATE', 'PEG25044063', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46'),
(66, 2, 'validasi_dijalankan', 'Perbedaan ditemukan di kolom END_DATE, SIMID_BPR: PEG25044063', '45828', '46193', 'END_DATE', 'PEG25044063', 'anzhar', '2025-07-14 08:01:46', '2025-07-14 08:01:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `validasi_data`
--
ALTER TABLE `validasi_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `validasi_data_details`
--
ALTER TABLE `validasi_data_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `validasi_logs`
--
ALTER TABLE `validasi_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `validasi_data`
--
ALTER TABLE `validasi_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `validasi_data_details`
--
ALTER TABLE `validasi_data_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `validasi_logs`
--
ALTER TABLE `validasi_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
