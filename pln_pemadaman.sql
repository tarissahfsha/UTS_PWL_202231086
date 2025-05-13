-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 05:59 PM
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
-- Database: `pln_pemadaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_13_014450_create_pln_tables', 1);

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
-- Table structure for table `pemadamans`
--

CREATE TABLE `pemadamans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wilayah_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `jenis_pemadaman` enum('terencana','mendadak') NOT NULL,
  `alasan` text NOT NULL,
  `status` enum('scheduled','ongoing','completed','cancelled') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemadamans`
--

INSERT INTO `pemadamans` (`id`, `wilayah_id`, `tanggal`, `jam_mulai`, `jam_selesai`, `jenis_pemadaman`, `alasan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-13', '22:30:00', '23:59:00', 'mendadak', 'Karena Hujan Deras', 'ongoing', '2025-05-13 08:27:05', '2025-05-13 08:27:05'),
(2, 17, '2025-05-20', '15:00:00', '17:00:00', 'terencana', 'Perbaikan Trafo', 'scheduled', '2025-05-13 08:27:45', '2025-05-13 08:27:45'),
(3, 30, '2025-05-30', '12:00:00', '20:00:00', 'terencana', 'Karena adanya gangguan konsleting', 'scheduled', '2025-05-13 08:29:05', '2025-05-13 08:29:05'),
(4, 11, '2025-05-13', '12:00:00', '13:00:00', 'mendadak', 'Karena Hujan Angin Dan Petir', 'completed', '2025-05-13 08:36:31', '2025-05-13 08:36:31'),
(5, 44, '2025-05-13', '11:00:00', '15:30:00', 'terencana', 'Perbaikan Trafo', 'cancelled', '2025-05-13 08:37:16', '2025-05-13 08:37:16');

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
('2dyBtiQx4SmfZzJ1twejUjo9l088rSoXIhiu6RVX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiN3RKVnNTVURWNFU1bkNVSVFUQVZSRkh1Ukg4c2pmNWFtdlpvbVVhdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZW1hZGFtYW4iO31zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDcxNTE5NDM7fX0=', 1747151949);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@pln.com', NULL, '$2y$12$9UEm/gCRBg6X7e0qFdC1..oEUAs2fipwE8wdEaOkhcysy9cfFOyPu', NULL, '2025-05-13 08:24:06', '2025-05-13 08:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `wilayahs`
--

CREATE TABLE `wilayahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_wilayah` varchar(255) NOT NULL,
  `kode_wilayah` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wilayahs`
--

INSERT INTO `wilayahs` (`id`, `nama_wilayah`, `kode_wilayah`, `kecamatan`, `kelurahan`, `created_at`, `updated_at`) VALUES
(1, 'Jakarta Pusat', 'JP001', 'Menteng', 'Cikini', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(2, 'Jakarta Pusat', 'JP002', 'Tanah Abang', 'Kebon Melati', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(3, 'Jakarta Pusat', 'JP003', 'Gambir', 'Cideng', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(4, 'Jakarta Barat', 'JB001', 'Tambora', 'Jembatan Lima', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(5, 'Jakarta Barat', 'JB002', 'Grogol Petamburan', 'Jelambar', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(6, 'Jakarta Barat', 'JB003', 'Kebon Jeruk', 'Kedoya Utara', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(7, 'Jakarta Selatan', 'JS001', 'Kebayoran Baru', 'Senayan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(8, 'Jakarta Selatan', 'JS002', 'Pancoran', 'Pengadegan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(9, 'Jakarta Selatan', 'JS003', 'Tebet', 'Tebet Timur', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(10, 'Jakarta Timur', 'JT001', 'Matraman', 'Pisangan Baru', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(11, 'Jakarta Timur', 'JT002', 'Pulo Gadung', 'Rawamangun', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(12, 'Jakarta Timur', 'JT003', 'Duren Sawit', 'Pondok Bambu', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(13, 'Jakarta Utara', 'JU001', 'Tanjung Priok', 'Sunter Jaya', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(14, 'Jakarta Utara', 'JU002', 'Koja', 'Rawa Badak', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(15, 'Jakarta Utara', 'JU003', 'Kelapa Gading', 'Kelapa Gading Barat', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(16, 'Bandung', 'BDG001', 'Andir', 'Cigondewah', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(17, 'Bandung', 'BDG002', 'Cicendo', 'Pasirkaliki', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(18, 'Bogor', 'BGR001', 'Bogor Tengah', 'Babakan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(19, 'Bogor', 'BGR002', 'Bogor Utara', 'Ciparigi', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(20, 'Depok', 'DPK001', 'Cimanggis', 'Mekarsari', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(21, 'Depok', 'DPK002', 'Beji', 'Kemiri Muka', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(22, 'Semarang', 'SMG001', 'Semarang Tengah', 'Tugurejo', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(23, 'Semarang', 'SMG002', 'Semarang Barat', 'Kembangarum', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(24, 'Solo', 'SOL001', 'Jebres', 'Mojosongo', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(25, 'Solo', 'SOL002', 'Banjarsari', 'Mangkubumen', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(26, 'Yogyakarta', 'YK001', 'Gondokusuman', 'Jogoyudan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(27, 'Yogyakarta', 'YK002', 'Umbulharjo', 'Pandeyan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(28, 'Surabaya', 'SBY001', 'Gubeng', 'Bubutan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(29, 'Surabaya', 'SBY002', 'Tegalsari', 'Keputran', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(30, 'Surabaya', 'SBY003', 'Wonokromo', 'Darmo', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(31, 'Malang', 'MLG001', 'Klojen', 'Kauman', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(32, 'Malang', 'MLG002', 'Lowokwaru', 'Dinoyo', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(33, 'Tangerang', 'TNG001', 'Ciledug', 'Sudimara Barat', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(34, 'Tangerang', 'TNG002', 'Karawaci', 'Cimone', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(35, 'Medan', 'MDN001', 'Medan Kota', 'Teladan Barat', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(36, 'Medan', 'MDN002', 'Medan Petisah', 'Petisah Tengah', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(37, 'Palembang', 'PLB001', 'Ilir Barat I', 'Bukit Lama', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(38, 'Palembang', 'PLB002', 'Ilir Timur II', '3 Ilir', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(39, 'Pontianak', 'PTK001', 'Pontianak Selatan', 'Benua Melayu Darat', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(40, 'Banjarmasin', 'BJM001', 'Banjarmasin Tengah', 'Teluk Dalam', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(41, 'Makassar', 'MKS001', 'Rappocini', 'Buakana', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(42, 'Manado', 'MND001', 'Wenang', 'Wenang Selatan', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(43, 'Denpasar', 'DPS001', 'Denpasar Barat', 'Dauh Puri', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(44, 'Denpasar', 'DPS002', 'Denpasar Timur', 'Kesiman', '2025-05-13 08:15:06', '2025-05-13 08:15:06'),
(45, 'Jayapura', 'JPR001', 'Abepura', 'Wahno', '2025-05-13 08:15:06', '2025-05-13 08:15:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemadamans`
--
ALTER TABLE `pemadamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemadamans_tanggal_status_index` (`tanggal`,`status`),
  ADD KEY `pemadamans_wilayah_id_tanggal_index` (`wilayah_id`,`tanggal`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wilayahs`
--
ALTER TABLE `wilayahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wilayahs_kode_wilayah_unique` (`kode_wilayah`),
  ADD KEY `wilayahs_kecamatan_kelurahan_index` (`kecamatan`,`kelurahan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemadamans`
--
ALTER TABLE `pemadamans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wilayahs`
--
ALTER TABLE `wilayahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemadamans`
--
ALTER TABLE `pemadamans`
  ADD CONSTRAINT `pemadamans_wilayah_id_foreign` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayahs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
