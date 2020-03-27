-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2020 at 12:32 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_sarpras`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `nama_barang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_rusak` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `id_barang`, `kategori_id`, `nama_barang`, `satuan`, `jumlah`, `jumlah_rusak`) VALUES
(15, '10101010', '5', 'bangku', 'unit', '91', '4'),
(16, '10101011', '4', 'Meja', 'Unit', '70', '0');

-- --------------------------------------------------------

--
-- Table structure for table `input_ruangan`
--

CREATE TABLE `input_ruangan` (
  `id_input_ruangan` int(11) NOT NULL,
  `id_ruangan_barang` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah_masuk` varchar(200) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_rusak_ruangan` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `input_ruangan`
--

INSERT INTO `input_ruangan` (`id_input_ruangan`, `id_ruangan_barang`, `id_barang`, `jumlah_masuk`, `tanggal_masuk`, `jumlah_rusak_ruangan`) VALUES
(27, 11, '10101010', '19', '2020-01-01', '0'),
(28, 10, '10101011', '25', '2020-01-27', '5'),
(29, 11, '10101011', '25', '2020-01-01', '0');

--
-- Triggers `input_ruangan`
--
DELIMITER $$
CREATE TRIGGER `tg_barang_masuk` AFTER INSERT ON `input_ruangan` FOR EACH ROW BEGIN
UPDATE barangs
SET jumlah = jumlah - NEW.jumlah_masuk
WHERE
id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(200) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(4, 'Mebel'),
(5, 'Elektronik'),
(6, 'Perkakas');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah_keluar` varchar(150) NOT NULL,
  `untuk` text NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`id_keluar`, `id_barang`, `jumlah_keluar`, `untuk`, `tanggal_keluar`) VALUES
(21, '10101010', '30', 'Guru', '2020-01-01'),
(22, '10101010', '24', 'Pa Ferry', '2020-01-27');

--
-- Triggers `keluar`
--
DELIMITER $$
CREATE TRIGGER `tg_barang_keluar` AFTER INSERT ON `keluar` FOR EACH ROW BEGIN
UPDATE barangs
SET jumlah = jumlah - NEW.jumlah_keluar
WHERE
id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_keluar`
--

CREATE TABLE `keranjang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah_keluar` varchar(150) NOT NULL,
  `untuk` text NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_masuk`
--

CREATE TABLE `keranjang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah_asup` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_satuan` varchar(200) NOT NULL DEFAULT '0',
  `harga_total` varchar(200) NOT NULL DEFAULT '0',
  `nama_toko` varchar(200) NOT NULL DEFAULT '0',
  `merek` varchar(200) NOT NULL DEFAULT '0',
  `sumber_dana` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_peminjaman`
--

CREATE TABLE `keranjang_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_peminjam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pinjam` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_ruangan`
--

CREATE TABLE `keranjang_ruangan` (
  `id_input_ruangan` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah_masuk` varchar(200) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_rusak_luar`
--

CREATE TABLE `keranjang_rusak_luar` (
  `id_rusak_luar` int(11) NOT NULL,
  `id_barang_rusak_luar` varchar(200) NOT NULL,
  `jumlah_rusak_luar` varchar(200) NOT NULL,
  `tanggal_rusak_luar` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `user_id_luar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang_rusak_ruangan`
--

CREATE TABLE `keranjang_rusak_ruangan` (
  `id_rusak_ruangan` int(11) NOT NULL,
  `id_barang_rusak` varchar(200) NOT NULL,
  `jumlah_rusak_ruangan` varchar(200) NOT NULL,
  `id_ruangan_rusak` varchar(200) DEFAULT NULL,
  `tanggal_rusak` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `user_id_ruangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` varchar(200) NOT NULL,
  `jumlah_asup` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga_satuan` varchar(200) NOT NULL DEFAULT '0',
  `harga_total` varchar(200) NOT NULL DEFAULT '0',
  `nama_toko` varchar(200) NOT NULL DEFAULT '0',
  `merek` varchar(200) NOT NULL DEFAULT '0',
  `sumber_dana` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`id_masuk`, `id_barang`, `jumlah_asup`, `tanggal_masuk`, `harga_satuan`, `harga_total`, `nama_toko`, `merek`, `sumber_dana`) VALUES
(15, '10101010', '9', '2020-01-30', '50000', '200000', 'toko1', 'futura', 'BOS'),
(16, '10101010', '6', '2020-01-27', '30000', '180000', 'Bangku Shop', 'Futura', 'BOS');

--
-- Triggers `masuk`
--
DELIMITER $$
CREATE TRIGGER `tg_masuk_barang` AFTER INSERT ON `masuk` FOR EACH ROW BEGIN
UPDATE barangs
SET jumlah = jumlah + NEW.jumlah_asup
WHERE
id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2019_09_30_134041_create_barangs_table', 1),
(25, '2019_10_10_031322_create_jenis_table', 1),
(26, '2019_10_10_062257_create_ruangan_table', 1),
(27, '2019_10_11_025053_create_peminjaman_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_peminjam` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_barang` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_pinjam` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `nama_peminjam`, `id_barang`, `jumlah_pinjam`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Ramdani', '10101010', '4', '2020-01-02', '2020-01-31', 'Sudah Dikembalikan', NULL, NULL),
(14, 'Donto', '10101011', '5', '2020-01-27', '2020-01-30', 'Sudah Dikembalikan', NULL, NULL),
(15, 'Donto', '10101010', '20', '2020-01-27', '2020-01-30', 'Sudah Dikembalikan', NULL, NULL),
(16, 'Ramdani', '10101010', '15', '2020-01-01', '2020-01-31', 'Belum Dikembalikan', NULL, NULL);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `tg_pinjam` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
UPDATE barangs
SET jumlah = jumlah - NEW.jumlah_pinjam
WHERE
id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` bigint(20) UNSIGNED NOT NULL,
  `ruangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pembimbing` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `id_pj` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `ruangan`, `id_pembimbing`, `id_pj`) VALUES
(10, '219', '16', '17'),
(11, '220', '16', '17'),
(12, '221', '19', '22'),
(13, '222', '21', '17'),
(14, '223', '16', '22'),
(15, '224', '16', '17');

-- --------------------------------------------------------

--
-- Table structure for table `rusak_luar`
--

CREATE TABLE `rusak_luar` (
  `id_rusak_luar` int(11) NOT NULL,
  `id_barang_rusak_luar` varchar(200) NOT NULL,
  `jumlah_rusak_luar` varchar(200) NOT NULL,
  `tanggal_rusak_luar` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `user_id_luar` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rusak_luar`
--

INSERT INTO `rusak_luar` (`id_rusak_luar`, `id_barang_rusak_luar`, `jumlah_rusak_luar`, `tanggal_rusak_luar`, `status`, `user_id_luar`) VALUES
(12, '10101010', '11', '2020-01-09', 'sudah_diperbaiki', '6'),
(13, '10101010', '4', '2020-01-27', 'rusak', '16');

--
-- Triggers `rusak_luar`
--
DELIMITER $$
CREATE TRIGGER `tg_rusak_luar` AFTER INSERT ON `rusak_luar` FOR EACH ROW BEGIN
UPDATE barangs
SET jumlah = jumlah - NEW.jumlah_rusak_luar
WHERE
id_barang = NEW.id_barang_rusak_luar;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rusak_ruangan`
--

CREATE TABLE `rusak_ruangan` (
  `id_rusak_ruangan` int(11) NOT NULL,
  `id_barang_rusak` varchar(200) NOT NULL,
  `jumlah_rusak_ruangan` varchar(200) NOT NULL,
  `id_ruangan_rusak` varchar(200) DEFAULT '0',
  `tanggal_rusak` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `user_id_ruangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rusak_ruangan`
--

INSERT INTO `rusak_ruangan` (`id_rusak_ruangan`, `id_barang_rusak`, `jumlah_rusak_ruangan`, `id_ruangan_rusak`, `tanggal_rusak`, `status`, `user_id_ruangan`) VALUES
(42, '10101010', '2', '11', '2020-01-01', 'sudah_diperbaiki', '6'),
(43, '10101010', '1', '11', '2020-01-02', 'sudah_diperbaiki', '6'),
(44, '10101011', '5', '10', '2020-01-27', 'rusak', '6'),
(45, '10101010', '1', '11', '2020-01-27', 'sudah_diperbaiki', '16');

--
-- Triggers `rusak_ruangan`
--
DELIMITER $$
CREATE TRIGGER `tg_rusak_ruangan` AFTER INSERT ON `rusak_ruangan` FOR EACH ROW BEGIN
UPDATE input_ruangan
SET jumlah_masuk = jumlah_masuk - NEW.jumlah_rusak_ruangan
WHERE
id_barang = NEW.id_barang_rusak
AND
id_ruangan_barang=NEW.id_ruangan_rusak;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('rayon','pj','admin','bukan_pj') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `username`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'admin1', 'rmdn.syaputra@gmail.com', NULL, 'admin', '$2y$10$U3vSPRlePBNyqEf2HFnIKuGcAdb9az6SplqJWaSfqjqqvYITN6.3a', 'admin', NULL, '2019-11-26 17:49:45', '2020-01-04 19:56:19'),
(16, 'pembimbing1', 'pembimbing@smkwikrama.sch.id', NULL, 'pembimbing', '$2y$10$ikpJZeh/8y9jD.Gp1uPYnurKVTdguNs4O9ll8dViQZI7zlVto8QPG', 'rayon', NULL, '2020-01-26 20:57:34', '2020-01-26 20:57:34'),
(17, 'pj', 'pj@gmail.com', NULL, 'pj', '$2y$10$G6g/UUdyoCqDa.VgJCXUZ.jFG4WQ/bQrcU3ZWbI23YXxm1r76afX2', 'pj', NULL, '2020-01-26 20:59:15', '2020-01-26 20:59:15'),
(18, 'bukanpj1', 'bukanpj@gmail.com', NULL, 'bukanpj', '$2y$10$vFb0TH/dmuuU1Ff2/HUGQ.H7Z1BVSg.eqm.9e7cW8tneeNjd/ABlO', 'bukan_pj', NULL, '2020-01-26 21:00:20', '2020-01-26 21:00:20'),
(19, 'pemb2', 'pemb2@gmail.com', NULL, 'pemb2', '$2y$10$1qDmx/7U03HRXIpQ7.Ar3OIWUOZhIlROvUwgtRdQFYKBze7mn1ULO', 'rayon', NULL, '2020-01-27 00:50:22', '2020-01-27 00:50:22'),
(20, 'admin2', 'admin2@gmail.com', NULL, 'admin2', '$2y$10$.XapfceL50Tb8EbgJLh04ezrzKePx0ae7kYCbHosyW9SZ3.koUCPu', 'admin', NULL, '2020-01-27 00:51:09', '2020-01-27 00:51:09'),
(21, 'pem3', 'pem@gmail.com', NULL, 'pem2', '$2y$10$cywcSe5sTrcRzLmjk8CJ0eGrZwJDDM.cWMv8.JkebmvAyagdCjnkG', 'rayon', NULL, '2020-01-27 20:21:14', '2020-01-27 20:21:14'),
(22, 'pj2', 'pj2@gmail.com', NULL, 'pj3', '$2y$10$lvse5fonN6dyo7WDctGwlesBXfL/9Dzc784XZ6cLPcIfXDB4A2dN6', 'pj', NULL, '2020-01-27 20:23:45', '2020-01-27 20:23:45'),
(23, 'notpj', 'notpj@gmail.com', NULL, 'notpj2', '$2y$10$WgBH6V7vuCNPctYEctAYheGy.uAlMid4BsZR.odIOqUxt7oTv.cGG', 'bukan_pj', NULL, '2020-01-27 20:24:18', '2020-01-27 20:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indexes for table `input_ruangan`
--
ALTER TABLE `input_ruangan`
  ADD PRIMARY KEY (`id_input_ruangan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `keranjang_keluar`
--
ALTER TABLE `keranjang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `keranjang_masuk`
--
ALTER TABLE `keranjang_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `keranjang_peminjaman`
--
ALTER TABLE `keranjang_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `keranjang_ruangan`
--
ALTER TABLE `keranjang_ruangan`
  ADD PRIMARY KEY (`id_input_ruangan`);

--
-- Indexes for table `keranjang_rusak_luar`
--
ALTER TABLE `keranjang_rusak_luar`
  ADD PRIMARY KEY (`id_rusak_luar`);

--
-- Indexes for table `keranjang_rusak_ruangan`
--
ALTER TABLE `keranjang_rusak_ruangan`
  ADD PRIMARY KEY (`id_rusak_ruangan`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `rusak_luar`
--
ALTER TABLE `rusak_luar`
  ADD PRIMARY KEY (`id_rusak_luar`);

--
-- Indexes for table `rusak_ruangan`
--
ALTER TABLE `rusak_ruangan`
  ADD PRIMARY KEY (`id_rusak_ruangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `input_ruangan`
--
ALTER TABLE `input_ruangan`
  MODIFY `id_input_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `keranjang_keluar`
--
ALTER TABLE `keranjang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_masuk`
--
ALTER TABLE `keranjang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_peminjaman`
--
ALTER TABLE `keranjang_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_ruangan`
--
ALTER TABLE `keranjang_ruangan`
  MODIFY `id_input_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_rusak_luar`
--
ALTER TABLE `keranjang_rusak_luar`
  MODIFY `id_rusak_luar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang_rusak_ruangan`
--
ALTER TABLE `keranjang_rusak_ruangan`
  MODIFY `id_rusak_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rusak_luar`
--
ALTER TABLE `rusak_luar`
  MODIFY `id_rusak_luar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rusak_ruangan`
--
ALTER TABLE `rusak_ruangan`
  MODIFY `id_rusak_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
