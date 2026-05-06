-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2026 at 12:27 PM
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
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_booking` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`judul`, `penulis`, `penerbit`, `tahun`, `isbn`, `kategori`, `stok`, `deskripsi`, `created_at`, `updated_at`, `cover`) VALUES
('Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, '9780132350884', 'Informatika', 2, 'Buku tentang praktik menulis kode program yang bersih dan mudah dipelihara.', '2026-03-11 03:15:14', '2026-05-03 22:41:31', 'covers/g1GpQuYZ0ll2QypDYrZJsQtq0VUIHpwRYmORXBXj.jpg'),
('Akuntansi Manajemen', 'Charles T. Horngren', 'Pearson', 2019, '9780133424300', 'Akuntansi', 3, 'Buku yang menjelaskan akuntansi untuk pengambilan keputusan manajemen.', '2026-03-11 03:38:07', '2026-05-06 09:51:31', 'covers/CeediFVkGwzGgu4KvFnkZHOJTwoPG0W2oRICYs2h.jpg'),
('Principles of Management', 'Stephen P. Robbins, Mary Coulter', 'Pearson', 2018, '9780134527604', 'Manajemen', 3, 'Buku yang membahas prinsip dasar manajemen organisasi modern.', '2026-03-11 03:52:07', '2026-05-06 09:02:54', 'covers/Avs7FoefDNwzNPEVgiOevXf7OZ4UUKe79nEqClL8.webp'),
('Introduction to Algorithms', 'Thomas H. Cormen, Charles E. Leiserson, Ronald L. Rivest, Clifford Stein', 'MIT Press', 2009, '9780262033848', 'Informatika', 2, 'Buku referensi algoritma yang banyak digunakan di universitas seluruh dunia.', '2026-03-11 03:13:10', '2026-05-06 16:52:55', 'covers/8CogrAz4h2taCTlo8XJB37jtZXmHOYfFRmNjYMrV.jpg'),
('Akuntansi Keuangan Menengah', 'Donald E. Kieso, Jerry J. Weygandt', 'Wiley', 2020, '9781119503668', 'Akuntansi', 4, 'Buku yang membahas konsep akuntansi keuangan secara mendalam.', '2026-03-11 03:35:38', '2026-05-06 16:11:42', 'covers/mwKAccqX6rn3TURzfPChlfCUew3oCkZvXzpeGvSM.jpg'),
('Principles of Economics', 'N. Gregory Mankiw', 'Cengage Learning', 2018, '9781305585122', 'Ekonomi', 6, 'Buku ekonomi populer yang menjelaskan prinsip dasar ekonomi modern.', '2026-03-11 03:17:59', '2026-04-26 18:41:58', 'covers/nxOeSCp3O9wOlj2wC98Ipe04t5mOzomJxbLzEaJm.jpg'),
('Algoritma dan Pemrograman', 'Rinaldi Munir', 'Informatika', 2020, '9786021514524', 'Informatika', 9, 'Buku pengantar algoritma dan dasar pemrograman untuk mahasiswa informatika.', '2026-03-11 03:12:02', '2026-04-24 11:30:50', 'covers/KnLMuakWbgA3389lTeVTZrN8VqZFC89eyDDLXfsD.jpg'),
('Pengantar Sejarah Agama Buddha Mahayana', 'Bhikkhu Bodhi', 'Karaniya', 2019, '9786028194508', 'Agama', 5, 'Buku pengantar untuk memahami ajaran dasar agama Buddha.', '2026-03-11 03:48:01', '2026-04-24 10:54:50', 'covers/3vDzW0GpkOmn5vUKMyewYtKzWwIEwtmtBOKUzLay.jpg'),
('Pengantar Akuntansi', 'Carl S. Warren, James M. Reeve, Jonathan Duchac', 'Salemba Empat', 2021, '9789790618493', 'Akuntansi', 10, 'Buku dasar akuntansi untuk mahasiswa ekonomi dan bisnis.', '2026-03-11 03:32:14', '2026-03-11 03:32:14', 'covers/X5q9X8oZNK6bXuUfiALdlXm6UfQ927LPP8lY6qmh.jpg'),
('Pengantar Ilmu Hukum', 'Satjipto Rahardjo', 'Citra Aditya Bakti', 2014, '9789794148491', 'Hukum', 5, 'Buku pengantar untuk memahami konsep dasar ilmu hukum.', '2026-03-11 03:21:35', '2026-04-24 13:14:33', 'covers/LHxHSlUhs9efdMblWGqbZ0LaMoGMEAy46RODnvAH.avif'),
('Sejarah Kristianitas', 'Justo L. Gonzalez', 'BPK Gunung Mulia', 2019, '9789794155673', 'Agama', 3, 'Buku yang membahas perkembangan gereja dari masa awal hingga modern.', '2026-03-11 03:54:55', '2026-04-26 18:46:48', 'covers/nFbJtk3jI6TAcEKUO9gWMftBQPWDNuDnd7TIRGll.jpg'),
('Pengantar Studi Islam', 'Harun Nasution', 'UI Press', 2019, '9789794565670', 'Agama', 2, 'Buku yang membahas dasar-dasar pemahaman ajaran Islam dan sejarahnya.', '2026-03-11 03:45:41', '2026-04-24 13:14:34', 'covers/JM9zdNjIMDe8fhsBPA5JzCxJYhUDDLDyk9GRA43F.jpg'),
('Teologi Sistematika', 'Wayne Grudem', 'Gandum Mas', 2020, '9789796876342', 'Agama', 3, 'Buku yang menjelaskan doktrin dasar iman Kristen secara sistematis.', '2026-03-11 03:40:55', '2026-05-03 22:41:06', 'covers/ti1y893MPzaxjQCtQb3AfTDa6vUqtNtzZyVEkKA0.jpg'),
('Pengantar Ilmu Ekonomi', 'Sadono Sukirno', 'Rajawali Pers', 2016, '9789797694667', 'Ekonomi', 8, 'Buku dasar ekonomi yang membahas konsep ekonomi mikro dan makro.', '2026-03-11 03:07:56', '2026-05-06 17:00:40', 'covers/jsvtTrYQp7cMsg0S9PzHe5dFRNehSAuLG7D0ymXZ.jpg'),
('Hukum Perdata Indonesia', 'Subekti', 'Intermasa', 2010, '9789798761122', 'Hukum', 3, 'Buku yang membahas hukum perdata yang berlaku di Indonesia.', '2026-03-11 03:29:51', '2026-05-06 09:08:21', 'covers/509STmUymwwcwYhovLahXIYVKC0BLRnvLHqkwKrZ.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dendas`
--

CREATE TABLE `dendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `peminjaman_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_hari_terlambat` int(11) NOT NULL,
  `total_denda` int(11) NOT NULL,
  `status` enum('belum_bayar','lunas') NOT NULL DEFAULT 'belum_bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dendas`
--

INSERT INTO `dendas` (`id`, `user_id`, `peminjaman_id`, `jumlah_hari_terlambat`, `total_denda`, `status`, `created_at`, `updated_at`) VALUES
(7, 5, 29, 35, 35000, 'lunas', '2026-04-26 11:23:17', '2026-04-26 11:30:30'),
(8, 5, 34, 13, 13000, 'lunas', '2026-04-26 11:41:58', '2026-05-06 02:28:31'),
(9, 4, 10, 10, 10000, 'lunas', '2026-05-03 15:41:06', '2026-05-05 08:27:39'),
(10, 4, 11, 2, 2000, 'belum_bayar', '2026-05-03 15:41:31', '2026-05-03 15:41:31'),
(11, 4, 12, 4, 4000, 'belum_bayar', '2026-05-05 09:06:56', '2026-05-05 09:06:56'),
(12, 4, 13, 5, 5000, 'belum_bayar', '2026-05-06 02:02:54', '2026-05-06 02:02:54'),
(13, 4, 14, 5, 5000, 'belum_bayar', '2026-05-06 02:08:21', '2026-05-06 02:08:21'),
(14, 5, 25, 5, 5000, 'belum_bayar', '2026-05-06 09:11:42', '2026-05-06 09:11:42'),
(15, 5, 26, 5, 5151, 'lunas', '2026-05-06 09:52:55', '2026-05-06 10:02:06'),
(16, 4, 15, 5, 5000, 'belum_bayar', '2026-05-06 10:00:40', '2026-05-06 10:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` int(11) NOT NULL,
  `reserved_at` int(11) DEFAULT NULL,
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `failed_job_ids` text NOT NULL,
  `options` text DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_13_074709_create_bukus_table', 1),
(6, '2026_03_06_013953_create_books_table', 1),
(7, '2026_03_11_021745_add_cover_to_bukus_table', 2),
(8, '2026_03_30_131127_create_peminjaman_table', 3),
(11, '2026_04_04_091917_add_tanggal_kembali_to_peminjaman_table', 5),
(12, '2026_03_02_044630_create_peminjamen_table', 6),
(13, '2026_04_15_072939_create_peminjaman_table', 7),
(14, '2026_04_15_073401_add_status_to_peminjaman_table', 8),
(15, '2026_04_15_073701_create_dendas_table', 9),
(16, '2026_04_15_081553_add_user_id_to_peminjaman_table', 10),
(17, '2026_04_15_082439_add_buku_id_to_peminjaman_table', 11),
(18, '2026_04_15_082714_add_tanggal_to_peminjaman_table', 12),
(19, '2026_04_16_192407_add_tanggal_kembali_to_peminjaman_table', 13),
(20, '2026_05_03_220943_add_diambil_at_to_peminjaman_table', 14),
(21, '2026_05_03_233856_add_tanggal_booking_to_peminjaman_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'dipinjam',
  `tanggal_pinjam` datetime DEFAULT NULL,
  `tanggal_jatuh_tempo` datetime DEFAULT NULL,
  `tanggal_kembali` timestamp NULL DEFAULT NULL,
  `diambil_at` timestamp NULL DEFAULT NULL,
  `tanggal_booking` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user_id`, `buku_id`, `created_at`, `updated_at`, `status`, `tanggal_pinjam`, `tanggal_jatuh_tempo`, `tanggal_kembali`, `diambil_at`, `tanggal_booking`) VALUES
(1, 5, '9780132350884', '2026-04-15 01:28:57', '2026-04-16 12:25:26', 'dikembalikan', '2026-04-15 08:28:57', '2026-04-22 08:28:57', '2026-04-16 12:25:26', NULL, NULL),
(2, 5, '9780132350884', '2026-04-16 11:44:38', '2026-04-23 12:17:51', 'dikembalikan', '2026-04-16 18:44:38', '2026-04-23 18:44:38', '2026-04-23 12:17:51', NULL, NULL),
(3, 5, '9780133424300', '2026-04-16 11:44:45', '2026-04-24 03:55:34', 'dikembalikan', '2026-04-16 18:44:45', '2026-04-23 18:44:45', '2026-04-24 03:55:34', NULL, NULL),
(4, 5, '9780134527604', '2026-04-16 11:44:51', '2026-04-24 04:21:20', 'dikembalikan', '2026-04-16 18:44:51', '2026-04-23 18:44:51', '2026-04-24 04:21:20', NULL, NULL),
(5, 5, '9786021514524', '2026-04-16 11:44:58', '2026-04-24 04:30:50', 'dikembalikan', '2026-04-16 18:44:58', '2026-04-23 18:44:58', '2026-04-24 04:30:50', NULL, NULL),
(6, 5, '9789798761122', '2026-04-16 11:45:04', '2026-04-24 05:57:00', 'dikembalikan', '2026-04-16 18:45:04', '2026-04-23 18:45:04', '2026-04-24 05:57:00', NULL, NULL),
(7, 4, '9780133424300', '2026-04-16 12:43:22', '2026-04-16 12:43:56', 'dikembalikan', '2026-04-16 19:43:22', '2026-04-23 19:43:22', '2026-04-16 12:43:56', NULL, NULL),
(8, 4, '9780132350884', '2026-04-16 12:43:26', '2026-04-24 03:31:45', 'dikembalikan', '2026-04-16 19:43:26', '2026-04-23 19:43:26', '2026-04-24 03:31:45', NULL, NULL),
(9, 4, '9786028194508', '2026-04-16 12:43:33', '2026-04-24 03:54:50', 'dikembalikan', '2026-04-16 19:43:33', '2026-04-23 19:43:33', '2026-04-24 03:54:49', NULL, NULL),
(10, 4, '9789796876342', '2026-04-16 12:43:48', '2026-05-03 15:41:06', 'dikembalikan', '2026-04-16 19:43:48', '2026-04-23 19:43:48', '2026-05-02 17:00:00', NULL, NULL),
(11, 4, '9780132350884', '2026-04-24 06:14:19', '2026-05-03 15:41:31', 'dikembalikan', '2026-04-24 13:14:19', '2026-05-01 13:14:19', '2026-05-02 17:00:00', NULL, NULL),
(12, 4, '9780133424300', '2026-04-24 06:14:23', '2026-05-05 09:06:56', 'dikembalikan', '2026-04-24 13:14:23', '2026-05-01 13:14:23', '2026-05-04 17:00:00', NULL, NULL),
(13, 4, '9780134527604', '2026-04-24 06:14:23', '2026-05-06 02:02:54', 'dikembalikan', '2026-04-24 13:14:23', '2026-05-01 13:14:23', '2026-05-06 02:02:54', NULL, NULL),
(14, 4, '9789798761122', '2026-04-24 06:14:30', '2026-05-06 02:08:21', 'dikembalikan', '2026-04-24 13:14:30', '2026-05-01 13:14:30', '2026-05-06 02:08:21', NULL, NULL),
(15, 4, '9789797694667', '2026-04-24 06:14:32', '2026-05-06 10:00:40', 'dikembalikan', '2026-04-24 13:14:32', '2026-05-01 13:14:32', '2026-05-06 10:00:40', NULL, NULL),
(16, 4, '9789796876342', '2026-04-24 06:14:32', '2026-04-24 06:14:32', 'dipinjam', '2026-04-24 13:14:32', '2026-05-01 13:14:32', NULL, NULL, NULL),
(17, 4, '9789794148491', '2026-04-24 06:14:33', '2026-04-24 06:14:33', 'dipinjam', '2026-04-24 13:14:33', '2026-05-01 13:14:33', NULL, NULL, NULL),
(18, 4, '9789794155673', '2026-04-24 06:14:33', '2026-04-24 06:14:33', 'dipinjam', '2026-04-24 13:14:33', '2026-05-01 13:14:33', NULL, NULL, NULL),
(19, 4, '9789794565670', '2026-04-24 06:14:34', '2026-04-24 06:14:34', 'dipinjam', '2026-04-24 13:14:34', '2026-05-01 13:14:34', NULL, NULL, NULL),
(20, 4, '9781119503668', '2026-04-24 06:14:41', '2026-04-24 06:14:41', 'dipinjam', '2026-04-24 13:14:41', '2026-05-01 13:14:41', NULL, NULL, NULL),
(21, 4, '9780262033848', '2026-04-24 06:14:42', '2026-04-24 06:14:42', 'dipinjam', '2026-04-24 13:14:42', '2026-05-01 13:14:42', NULL, NULL, NULL),
(22, 4, '9781305585122', '2026-04-24 06:14:43', '2026-04-24 06:14:43', 'dipinjam', '2026-04-24 13:14:43', '2026-05-01 13:14:43', NULL, NULL, NULL),
(23, 5, '9780132350884', '2026-04-24 06:15:37', '2026-04-24 07:32:54', 'dikembalikan', '2026-04-24 13:15:37', '2026-05-01 13:15:37', '2026-04-24 07:32:54', NULL, NULL),
(24, 5, '9780133424300', '2026-04-24 06:15:38', '2026-04-26 11:08:10', 'dikembalikan', '2026-04-24 13:15:38', '2026-05-01 13:15:38', '2026-04-26 11:08:10', NULL, NULL),
(25, 5, '9781119503668', '2026-04-24 06:15:47', '2026-05-06 09:11:42', 'dikembalikan', '2026-04-24 13:15:47', '2026-05-01 13:15:47', '2026-05-06 09:11:42', NULL, NULL),
(26, 5, '9780262033848', '2026-04-24 06:15:48', '2026-05-06 09:52:55', 'dikembalikan', '2026-04-24 13:15:48', '2026-05-01 13:15:48', '2026-05-06 09:52:55', NULL, NULL),
(27, 5, '9789798761122', '2026-04-24 06:15:56', '2026-04-24 06:15:56', 'dipinjam', '2026-04-24 13:15:56', '2026-05-01 13:15:56', NULL, NULL, NULL),
(28, 5, '9780132350884', '2026-04-26 10:46:13', '2026-04-26 10:48:08', 'dikembalikan', '2026-04-26 17:46:13', '2026-04-26 17:47:13', '2026-04-26 10:48:08', NULL, NULL),
(29, 5, '9780133424300', '2026-04-26 10:47:39', '2026-04-26 11:23:17', 'dikembalikan', '2026-04-26 17:47:39', '2026-04-26 18:24:17', '2026-05-06 08:55:12', NULL, NULL),
(30, 5, '9780133424300', '2026-04-26 10:57:17', '2026-04-26 10:57:17', 'dipinjam', '2026-04-26 17:57:17', '2026-04-26 17:58:17', NULL, NULL, NULL),
(31, 5, '9780134527604', '2026-04-26 11:08:00', '2026-04-26 11:08:00', 'dipinjam', '2026-04-26 18:08:00', '2026-04-26 18:09:00', NULL, NULL, NULL),
(32, 5, '9780134527604', '2026-04-26 11:12:45', '2026-04-26 11:12:45', 'dipinjam', '2026-04-26 18:12:45', '2026-04-26 18:13:45', NULL, NULL, NULL),
(33, 5, '9780134527604', '2026-04-26 11:15:16', '2026-04-26 11:15:16', 'dipinjam', '2026-04-26 18:15:16', '2026-04-26 18:16:16', NULL, NULL, NULL),
(34, 5, '9781305585122', '2026-04-26 11:28:03', '2026-04-26 11:41:58', 'dikembalikan', '2026-04-26 18:28:03', '2026-04-26 18:42:58', '2026-05-06 08:55:12', NULL, NULL),
(35, 5, '9780132350884', '2026-04-26 11:42:09', '2026-04-26 11:42:09', 'dipinjam', '2026-04-26 18:42:09', '2026-04-26 18:43:09', NULL, NULL, NULL),
(36, 5, '9789794155673', '2026-04-26 11:46:48', '2026-04-26 11:46:48', 'dipinjam', '2026-04-26 18:46:48', '2026-04-26 18:47:48', NULL, NULL, NULL),
(37, 5, '9789798761122', '2026-04-26 11:52:23', '2026-04-26 11:52:23', 'dipinjam', '2026-04-26 18:52:23', '2026-04-26 18:53:23', NULL, NULL, NULL),
(38, 5, '9780132350884', '2026-04-26 11:56:30', '2026-04-26 11:56:30', 'dipinjam', '2026-04-26 18:56:30', '2026-04-26 18:57:30', NULL, NULL, NULL),
(39, 5, '9780262033848', '2026-04-26 12:28:31', '2026-04-26 12:28:31', 'dipinjam', '2026-04-26 19:28:31', '2026-04-26 19:29:31', NULL, NULL, NULL),
(40, 5, '9780132350884', '2026-04-30 05:47:13', '2026-04-30 05:47:13', 'dipinjam', '2026-05-01 00:00:00', '2026-05-08 00:00:00', NULL, NULL, NULL),
(41, 5, '9780133424300', '2026-04-30 05:49:19', '2026-04-30 05:49:19', 'dipinjam', '2026-05-04 00:00:00', '2026-05-11 00:00:00', NULL, NULL, NULL),
(42, 5, '9780134527604', '2026-04-30 05:52:24', '2026-04-30 05:52:24', 'dipinjam', '2026-05-09 00:00:00', '2026-05-16 00:00:00', NULL, NULL, NULL),
(43, 5, '9780262033848', '2026-04-30 05:55:46', '2026-04-30 05:55:46', 'dipinjam', '2026-05-06 00:00:00', '2026-05-13 00:00:00', NULL, NULL, NULL),
(44, 5, '9780132350884', '2026-04-30 06:23:34', '2026-04-30 06:23:34', 'dipinjam', '2026-05-04 00:00:00', '2026-05-11 00:00:00', NULL, NULL, NULL),
(45, 4, '9780132350884', '2026-04-30 14:52:34', '2026-04-30 14:52:34', 'dipinjam', '2026-04-30 21:52:34', '2026-05-07 21:52:34', NULL, NULL, NULL),
(46, 4, '9780132350884', '2026-04-30 14:53:12', '2026-04-30 14:53:12', 'dipinjam', '2026-04-30 21:53:12', '2026-05-07 21:53:12', NULL, NULL, NULL),
(47, 4, '9789794565670', '2026-04-30 15:09:54', '2026-04-30 15:09:54', 'dipinjam', '2026-04-30 22:09:54', '2026-05-07 22:09:54', NULL, NULL, NULL),
(48, 4, '9780132350884', '2026-04-30 15:21:17', '2026-04-30 15:21:17', 'dipinjam', '2026-04-30 22:21:17', '2026-05-07 22:21:17', NULL, NULL, NULL),
(49, 5, '9780133424300', '2026-04-30 15:22:15', '2026-05-06 02:51:31', 'dikembalikan', '2026-04-30 22:23:20', '2026-05-07 22:23:20', '2026-05-06 02:51:31', NULL, NULL),
(50, 5, '9780134527604', '2026-04-30 15:33:02', '2026-04-30 15:38:30', 'dipinjam', '2026-04-30 22:38:30', '2026-05-07 22:38:30', NULL, NULL, NULL),
(51, 5, '9780262033848', '2026-04-30 15:33:12', '2026-05-03 13:43:52', 'dipinjam', '2026-05-03 20:43:52', '2026-05-10 20:43:52', NULL, NULL, NULL),
(52, 5, '9789798761122', '2026-05-02 14:04:54', '2026-05-03 14:05:51', 'dipinjam', '2026-05-03 21:05:51', '2026-05-10 21:05:51', NULL, NULL, NULL),
(53, 5, '9780132350884', '2026-05-02 14:58:14', '2026-05-03 15:38:27', 'dipinjam', '2026-05-03 22:38:27', '2026-05-10 22:38:27', NULL, NULL, NULL),
(54, 5, '9780132350884', '2026-05-02 15:05:56', '2026-05-03 15:38:49', 'dipinjam', '2026-05-03 22:38:49', '2026-05-10 22:38:49', NULL, NULL, NULL),
(55, 5, '9780133424300', '2026-05-02 15:07:15', '2026-05-03 15:39:13', 'dipinjam', '2026-05-03 22:39:13', '2026-05-10 22:39:13', NULL, NULL, NULL),
(56, 5, '9789798761122', '2026-05-03 15:58:44', '2026-05-03 16:04:14', 'dipinjam', '2026-05-03 23:04:14', '2026-05-10 23:04:14', NULL, NULL, NULL),
(57, 5, '9780132350884', '2026-05-03 16:09:18', '2026-05-05 04:38:15', 'dipinjam', '2026-05-05 11:38:15', '2026-05-12 11:38:15', NULL, NULL, NULL),
(58, 5, '9780133424300', '2026-05-03 16:13:22', '2026-05-05 04:38:34', 'dipinjam', '2026-05-05 11:38:34', '2026-05-12 11:38:34', NULL, NULL, NULL),
(59, 5, '9780262033848', '2026-05-03 16:39:59', '2026-05-06 01:09:40', 'dipinjam', '2026-05-06 08:09:40', '2026-05-13 08:09:40', NULL, NULL, '2026-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ML51LSDxX0oXrfbkzo7jRLO70K5ouvuJziP7pDMo', 5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidlBmZTI0WVNNYXplVkp2SXFTdWN0MzA4dGx4NjFKdDFhcUNWanJzQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3QvcGVycHVzL3B1YmxpYy9tYWhhc2lzd2EiO3M6NToicm91dGUiO3M6MTk6Im1haGFzaXN3YS5kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1778063183);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-03-10 03:10:11', '$2y$12$5h5BxFBg3ZqoA62gYqnKrOR2VS7hywP1Xvmkm4altccgcMZhnE64K', 'S9mODFrrf2', '2026-03-10 03:10:11', '2026-03-10 03:10:11'),
(2, 'Admin Staff', '01admin@staff.edu', NULL, '$2y$12$cKP6fNaPx/ImDiDlMug0PudMlV6j.Lke7P6G33VcWspL.ndVfeAS6', NULL, '2026-03-10 03:11:19', '2026-03-10 03:11:19'),
(3, 'Operator Sistem', '02operator@operator.edu', NULL, '$2y$12$iN3p23V7Zm2rGHvx4ECzuewgdVpkGdJDy7/y3qkx0DyX.7Q2b9q2G', NULL, '2026-03-10 03:11:19', '2026-03-10 03:11:19'),
(4, 'Dosen Pengajar', '03dosen@lecture.edu', NULL, '$2y$12$1x7n7cTH2DcGs802Mm2Acuy3qraRn9EaX2HAvazzUtYsOA74J3MBC', NULL, '2026-03-10 03:11:19', '2026-03-10 03:11:19'),
(5, 'Mahasiswa', '04mahasiswa@student.edu', NULL, '$2y$12$8z1Fezv.BrZYPaJWZlhoVuCTEEvlTSkKYqd6bw9ZXFwOn2MePX3c.', NULL, '2026-03-10 03:11:19', '2026-03-10 03:11:19'),
(6, 'janice nicole', '04mahasiswa1@student.edu', NULL, '$2y$12$Nxf9bkziAQR3K25vLIHw/uTz/yhCEkblW9KzcD51eMBgyMbN9VdNG', NULL, '2026-03-10 03:23:48', '2026-03-13 01:46:11'),
(7, 'aa', '03012345@lecture.edu', NULL, '$2y$12$Gm/P/z1/679/uKmntww4POhhHHCDj7N2CZ0nZ6gOiy/YGkIkwVYK.', NULL, '2026-03-13 01:33:17', '2026-03-13 01:42:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`isbn`);

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
-- Indexes for table `dendas`
--
ALTER TABLE `dendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dendas_user_id_foreign` (`user_id`),
  ADD KEY `dendas_peminjaman_id_foreign` (`peminjaman_id`);

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
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`),
  ADD KEY `sessions_user_id_index` (`user_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dendas`
--
ALTER TABLE `dendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dendas`
--
ALTER TABLE `dendas`
  ADD CONSTRAINT `dendas_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dendas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;