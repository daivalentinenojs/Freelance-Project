-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2017 at 02:57 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harmonis`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangcatatnotabelis`
--

CREATE TABLE `barangcatatnotabelis` (
  `NotaBeliNo` int(10) UNSIGNED NOT NULL,
  `BarangID` int(10) UNSIGNED NOT NULL,
  `Kuantiti` int(11) NOT NULL,
  `HargaBeli` int(11) NOT NULL,
  `SubTotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangcatatnotabelis`
--

INSERT INTO `barangcatatnotabelis` (`NotaBeliNo`, `BarangID`, `Kuantiti`, `HargaBeli`, `SubTotal`, `created_at`, `updated_at`) VALUES
(1, 1, 35, 120000, 4200000, NULL, NULL),
(2, 2, 50, 90000, 4500000, NULL, NULL),
(32, 1, 1, 70000, 70000, NULL, NULL),
(33, 1, 3, 70000, 210000, NULL, NULL),
(33, 2, 3, 60000, 180000, NULL, NULL),
(34, 1, 1, 70000, 70000, NULL, NULL),
(35, 1, 1, 70000, 70000, NULL, NULL),
(36, 1, 1, 70000, 70000, NULL, NULL),
(36, 2, 1, 60000, 60000, NULL, NULL),
(37, 1, 1, 70000, 70000, NULL, NULL),
(38, 1, 1, 70000, 70000, NULL, NULL),
(39, 1, 1, 70000, 70000, NULL, NULL),
(40, 1, 1, 70000, 70000, NULL, NULL),
(41, 1, 1, 70000, 70000, NULL, NULL),
(42, 1, 1, 70000, 70000, NULL, NULL),
(43, 1, 1, 65000, 65000, NULL, NULL),
(44, 12, 1, 32000, 32000, NULL, NULL),
(45, 12, 1, 32000, 32000, NULL, NULL),
(46, 12, 1, 32000, 32000, NULL, NULL),
(47, 12, 1, 32000, 32000, NULL, NULL),
(48, 12, 1, 32000, 32000, NULL, NULL),
(49, 12, 1, 56000, 56000, NULL, NULL),
(50, 12, 1, 56000, 56000, NULL, NULL),
(51, 12, 1, 56000, 56000, NULL, NULL),
(52, 12, 1, 56000, 56000, NULL, NULL),
(53, 12, 1, 56000, 56000, NULL, NULL),
(54, 1, 1, 12000, 12000, NULL, NULL),
(55, 1, 1, 34000, 34000, NULL, NULL),
(56, 1, 2, 32000, 64000, NULL, NULL),
(57, 1, 2, 32000, 64000, NULL, NULL),
(58, 1, 1, 50000, 50000, NULL, NULL),
(59, 1, 1, 50000, 50000, NULL, NULL),
(60, 1, 1, 50000, 50000, NULL, NULL),
(61, 1, 1, 50000, 50000, NULL, NULL),
(62, 1, 1, 50000, 50000, NULL, NULL),
(63, 12, 1, 50000, 50000, NULL, NULL),
(64, 12, 1, 60000, 60000, NULL, NULL),
(65, 12, 1, 78000, 78000, NULL, NULL),
(66, 1, 1, 40000, 40000, NULL, NULL),
(67, 12, 1, 50000, 50000, NULL, NULL),
(68, 1, 1, 23000, 23000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barangcatatnotajuals`
--

CREATE TABLE `barangcatatnotajuals` (
  `NotaJualNo` int(10) UNSIGNED NOT NULL,
  `BarangID` int(10) UNSIGNED NOT NULL,
  `Kuantiti` int(11) NOT NULL,
  `HargaJual` int(11) NOT NULL,
  `SubTotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangcatatnotajuals`
--

INSERT INTO `barangcatatnotajuals` (`NotaJualNo`, `BarangID`, `Kuantiti`, `HargaJual`, `SubTotal`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 120000, 1200000, NULL, NULL),
(2, 2, 15, 90000, 1350000, NULL, NULL),
(10, 1, 1, 80000, 80000, NULL, NULL),
(10, 2, 1, 70000, 70000, NULL, NULL),
(11, 1, 1, 80000, 80000, NULL, NULL),
(11, 2, 1, 70000, 70000, NULL, NULL),
(12, 1, 1, 80000, 80000, NULL, NULL),
(13, 1, 1, 80000, 80000, NULL, NULL),
(14, 1, 1, 80000, 80000, NULL, NULL),
(15, 1, 1, 80000, 80000, NULL, NULL),
(15, 2, 1, 70000, 70000, NULL, NULL),
(16, 1, 1, 80000, 80000, NULL, NULL),
(17, 1, 1000, 80000, 80000000, NULL, NULL),
(18, 3, 1, 90000, 90000, NULL, NULL),
(19, 1, 1, 80000, 80000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barangcatatreturbelis`
--

CREATE TABLE `barangcatatreturbelis` (
  `ReturBeliID` int(10) UNSIGNED NOT NULL,
  `BarangID` int(10) UNSIGNED NOT NULL,
  `KuantitiBarangAsal` int(11) NOT NULL,
  `KuantitiBarangGanti` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangcatatreturbelis`
--

INSERT INTO `barangcatatreturbelis` (`ReturBeliID`, `BarangID`, `KuantitiBarangAsal`, `KuantitiBarangGanti`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, NULL, NULL),
(2, 2, 1, 1, NULL, NULL),
(6, 1, 1, 1, NULL, NULL),
(7, 1, 1, 1, NULL, NULL),
(8, 1, 1, 1, NULL, NULL),
(10, 1, 1, 1, NULL, NULL),
(10, 2, 1, 1, NULL, NULL),
(11, 2, 2, 2, NULL, NULL),
(13, 1, 1, 1, NULL, NULL),
(14, 2, 1, 1, NULL, NULL),
(15, 1, 1, 1, NULL, NULL),
(16, 1, 1, 1, NULL, NULL),
(17, 1, 1, 1, NULL, NULL),
(18, 12, 1, 1, NULL, NULL),
(19, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barangcatatreturjuals`
--

CREATE TABLE `barangcatatreturjuals` (
  `ReturJualID` int(10) UNSIGNED NOT NULL,
  `BarangID` int(10) UNSIGNED NOT NULL,
  `KuantitiBarangAsal` int(11) NOT NULL,
  `KuantitiBarangGanti` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangcatatreturjuals`
--

INSERT INTO `barangcatatreturjuals` (`ReturJualID`, `BarangID`, `KuantitiBarangAsal`, `KuantitiBarangGanti`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 2, 3, 3, NULL, NULL),
(6, 1, 1, 1, NULL, NULL),
(18, 2, 1, 1, NULL, NULL),
(19, 2, 1, 1, NULL, NULL),
(20, 1, 1, 1, NULL, NULL),
(21, 1, 1, 1, NULL, NULL),
(22, 1, 1, 1, NULL, NULL),
(23, 1, 1, 1, NULL, NULL),
(24, 2, 1, 1, NULL, NULL),
(25, 1, 1, 1, NULL, NULL),
(26, 1, 1, 1, NULL, NULL),
(27, 1, 1, 1, NULL, NULL),
(28, 1, 1, 1, NULL, NULL),
(29, 1, 1, 1, NULL, NULL),
(30, 1, 1, 1, NULL, NULL),
(31, 1, 1, 1, NULL, NULL),
(32, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barangcatatstokopnames`
--

CREATE TABLE `barangcatatstokopnames` (
  `NotaStokOpnameNo` int(10) UNSIGNED NOT NULL,
  `BarangID` int(10) UNSIGNED NOT NULL,
  `JumlahSelisih` int(11) NOT NULL,
  `Alasan` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangcatatstokopnames`
--

INSERT INTO `barangcatatstokopnames` (`NotaStokOpnameNo`, `BarangID`, `JumlahSelisih`, `Alasan`, `created_at`, `updated_at`) VALUES
(1, 1, -3, 'Barang rusak', NULL, NULL),
(2, 2, -2, 'Barang cacat', NULL, NULL),
(51, 1, -1, 'rusak', NULL, NULL),
(51, 2, -1, 'rusak', NULL, NULL),
(52, 1, -2, 'rusak', NULL, NULL),
(53, 1, -2, 'rusak', NULL, NULL),
(54, 1, -2, 'rusak', NULL, NULL),
(55, 1, -1, 'rusak', NULL, NULL),
(56, 1, -1, 'rusak', NULL, NULL),
(57, 1, -2, 'rusak', NULL, NULL),
(58, 1, -2, 'rusak', NULL, NULL),
(59, 1, -1, 'rusak', NULL, NULL),
(60, 1, 1, 'salah hitung', NULL, NULL),
(61, 1, -1, 'rusak', NULL, NULL),
(62, 1, -1, 'rusak', NULL, NULL),
(63, 1, 1, 'salah hitung', NULL, NULL),
(64, 1, -1, 'rusak', NULL, NULL),
(65, 2, 1, 'salah hitung', NULL, NULL),
(66, 1, 1, 'salah hitung', NULL, NULL),
(67, 1, 1, 'salah hitung', NULL, NULL),
(68, 2, -1, 'rusak', NULL, NULL),
(69, 2, 1, 'rusak', NULL, NULL),
(70, 2, 1, 'salah hitung', NULL, NULL),
(71, 2, 2, 'salah hitung', NULL, NULL),
(72, 1, 1, 'salah hitung', NULL, NULL),
(73, 1, 1, 'salah hitung', NULL, NULL),
(74, 1, 1, 'salah hitung', NULL, NULL),
(75, 1, 1, 'salah hitung', NULL, NULL),
(76, 1, -1, 'rusak', NULL, NULL),
(77, 1, -1, 'barang rusak', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `IDBarang` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tahun` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Stok` int(11) NOT NULL,
  `HPP` int(11) NOT NULL,
  `HargaJual` int(11) NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KategoriID` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`IDBarang`, `Nama`, `Tahun`, `Stok`, `HPP`, `HargaJual`, `StatusTerdaftar`, `KategoriID`, `created_at`, `updated_at`) VALUES
(1, 'AAA', '2017', 2002, 2022, 80000, 1, 2, NULL, '2017-08-31 05:39:41'),
(2, 'BBB', '2016', 82, 60000, 70000, 1, 2, NULL, '2017-08-17 22:52:16'),
(3, 'aaa', '2017', 12, 78000, 90000, 1, 1, '2017-07-23 06:15:19', '2017-07-23 06:15:19'),
(4, 'abc', '2017', 5, 80000, 85000, 1, 1, '2017-07-31 10:05:53', '2017-07-31 10:05:53'),
(5, 'bbb', '2017', 5, 30000, 40000, 1, 1, '2017-07-31 10:06:52', '2017-07-31 10:06:52'),
(6, 'ccc', '2017', 2, 23000, 36000, 1, 1, '2017-08-09 03:11:45', '2017-08-09 03:11:45'),
(7, 'DDD', '2016', 2, 25000, 30000, 1, 1, '2017-08-09 08:47:17', '2017-08-09 08:47:17'),
(8, 'eee', '2017', 5, 45000, 50000, 1, 1, '2017-08-17 04:23:21', '2017-08-17 04:23:21'),
(9, 'Coil Spring', '2017', 5, 23000, 35000, 1, 1, '2017-08-17 05:32:55', '2017-08-17 05:32:55'),
(10, 'Busi', '2017', 2, 25000, 45000, 1, 2, '2017-08-22 00:39:43', '2017-08-22 00:39:43'),
(11, 'adfg', '2017', 3, 23000, 30000, 1, 1, '2017-08-23 01:12:02', '2017-08-23 01:12:02'),
(12, 'Busi Tipe II', '2017', 4, 16667, 30000, 1, 2, '2017-08-24 22:06:55', '2017-08-31 05:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `IDKaryawan` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoTelepon` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`IDKaryawan`, `Nama`, `Alamat`, `Email`, `Password`, `NoTelepon`, `StatusTerdaftar`, `created_at`, `updated_at`) VALUES
(1, 'nick', 'Jalan RMS No 90', 'nick@gmail.com', 'nick', '082335625802', 1, NULL, NULL),
(2, 'andi', 'Jalan RMS No 88', 'andi@gmail.com', 'andi', '081334654321', 1, NULL, NULL),
(3, 'tjandra', 'Jalan Tenggilis Mejoyo Utara AN-55', 'tjandrahalim08@gmail.com', 'tjandra', '082335625802', 1, '2017-07-22 22:47:28', '2017-07-22 22:47:28'),
(4, 'felix', 'Jalan Nusantara AS 55', 'felix@gmail.com', 'felix', '082334567342', 1, '2017-07-25 20:51:22', '2017-07-25 20:51:22'),
(5, 'asas', 'asas', 'asas@gmail.com', '145', '2334', 1, '2017-07-27 01:28:37', '2017-07-27 01:28:37'),
(6, 'asd', 'asd', 'asd@gmail.com', '123', '966', 1, '2017-08-26 08:56:04', '2017-08-26 08:56:04'),
(7, 'www', 'www', 'www@gmail.com', '12', '212', 1, '2017-08-26 08:58:08', '2017-08-26 08:58:08'),
(8, 'aa', 'aa', 'aa', '123', '1212', 1, '2017-08-26 09:03:13', '2017-08-26 09:03:13'),
(9, 'b', 'b', 'b', '23', '2121', 1, '2017-08-26 09:05:18', '2017-08-26 09:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `IDKategori` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`IDKategori`, `Nama`, `StatusTerdaftar`, `created_at`, `updated_at`) VALUES
(1, 'Toyota', 1, NULL, NULL),
(2, 'Mitsubishi', 1, NULL, NULL),
(3, 'KYB', 1, NULL, NULL),
(4, 'KW2', 1, NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_22_032848_create_kategoris_table', 1),
(4, '2017_02_24_022556_create_barangs_table', 1),
(5, '2017_02_25_032850_create_karyawans_table', 1),
(6, '2017_02_25_033822_create_pembelis_table', 1),
(7, '2017_02_25_034142_create_pemasoks_table', 1),
(8, '2017_02_25_040547_create_notaJuals_table', 1),
(9, '2017_02_25_041257_create_barangCatatNotaJuals_table', 1),
(10, '2017_02_25_041759_create_notaBelis_table', 1),
(11, '2017_02_25_042024_create_barangCatatNotaBelis_table', 1),
(12, '2017_04_27_133335_create_returJuals_table', 1),
(13, '2017_04_27_133911_create_returBelis_table', 1),
(14, '2017_05_10_114543_create_stokOpnames_table', 1),
(15, '2017_05_10_115237_create_barangCatatStokOpnames_table', 1),
(16, '2017_05_10_115300_create_barangCatatReturJuals_table', 1),
(17, '2017_05_10_115314_create_barangCatatReturBelis_table', 1),
(18, '2017_05_10_115953_create_pengeluarans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notabelis`
--

CREATE TABLE `notabelis` (
  `NoNotaBeli` int(10) UNSIGNED NOT NULL,
  `TanggalBuat` date NOT NULL,
  `JatuhTempo` date NOT NULL,
  `Total` int(11) NOT NULL,
  `StatusBeli` enum('Pesan','Dikirim','Lunas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KaryawanID` int(10) UNSIGNED NOT NULL,
  `PemasokID` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notabelis`
--

INSERT INTO `notabelis` (`NoNotaBeli`, `TanggalBuat`, `JatuhTempo`, `Total`, `StatusBeli`, `StatusTerdaftar`, `KaryawanID`, `PemasokID`, `created_at`, `updated_at`) VALUES
(1, '2017-01-29', '2017-02-28', 4200000, 'Pesan', 1, 1, 1, NULL, NULL),
(2, '2017-01-29', '2017-02-28', 4500000, 'Dikirim', 1, 2, 2, NULL, NULL),
(3, '2017-08-12', '2017-08-12', 140000, 'Pesan', 1, 3, 1, '2017-08-12 06:08:11', '2017-08-12 06:08:11'),
(4, '2017-08-13', '2017-08-13', 140000, 'Pesan', 1, 3, 1, '2017-08-12 06:09:27', '2017-08-12 06:09:27'),
(5, '2017-08-14', '2017-08-14', 70000, 'Pesan', 1, 3, 1, '2017-08-12 06:14:57', '2017-08-12 06:14:57'),
(6, '2017-08-15', '2017-08-15', 70000, 'Dikirim', 1, 3, 1, '2017-08-12 06:16:11', '2017-08-12 06:16:11'),
(7, '2017-08-12', '2017-08-12', 130000, 'Pesan', 1, 3, 1, '2017-08-12 09:29:45', '2017-08-12 09:29:45'),
(8, '2017-08-12', '2017-08-12', 130000, 'Pesan', 1, 3, 1, '2017-08-12 09:30:42', '2017-08-12 09:30:42'),
(9, '2017-08-12', '2017-08-12', 130000, 'Pesan', 1, 3, 1, '2017-08-12 09:46:50', '2017-08-12 09:46:50'),
(10, '2017-08-12', '2017-08-12', 120000, 'Pesan', 1, 3, 1, '2017-08-12 09:47:10', '2017-08-12 09:47:10'),
(11, '2017-08-12', '2017-08-12', 260000, 'Pesan', 1, 3, 1, '2017-08-12 09:47:43', '2017-08-12 09:47:43'),
(12, '2017-08-13', '2017-08-13', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:09:41', '2017-08-12 22:09:41'),
(13, '2017-08-13', '2017-08-13', 130000, 'Pesan', 1, 3, 1, '2017-08-12 22:10:10', '2017-08-12 22:10:10'),
(14, '2017-08-13', '2017-08-16', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:14:18', '2017-08-12 22:14:18'),
(15, '2017-08-13', '2017-08-16', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:14:30', '2017-08-12 22:14:30'),
(16, '2017-08-13', '2017-08-13', 140000, 'Pesan', 1, 3, 1, '2017-08-12 22:20:15', '2017-08-12 22:20:15'),
(17, '2017-08-13', '2017-08-13', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:20:44', '2017-08-12 22:20:44'),
(18, '2017-08-13', '2017-08-13', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:21:28', '2017-08-12 22:21:28'),
(19, '2017-08-13', '2017-08-13', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:36:38', '2017-08-12 22:36:38'),
(20, '2017-08-13', '2017-08-13', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:41:24', '2017-08-12 22:41:24'),
(21, '2017-08-13', '2017-08-15', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:43:09', '2017-08-12 22:43:09'),
(22, '2017-08-13', '2017-08-15', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:44:06', '2017-08-12 22:44:06'),
(23, '2017-08-13', '2017-08-15', 70000, 'Pesan', 1, 3, 1, '2017-08-12 22:45:25', '2017-08-12 22:45:25'),
(24, '2017-08-13', '2017-08-16', 130000, 'Pesan', 1, 3, 1, '2017-08-12 22:46:00', '2017-08-12 22:46:00'),
(25, '2017-08-13', '2017-08-13', 70000, 'Lunas', 1, 3, 1, '2017-08-12 22:47:39', '2017-08-12 22:47:39'),
(26, '2017-08-13', '2017-08-13', 60000, 'Pesan', 1, 3, 1, '2017-08-12 22:54:11', '2017-08-12 22:54:11'),
(27, '2017-08-13', '2017-08-13', 60000, 'Pesan', 1, 3, 1, '2017-08-12 22:54:25', '2017-08-12 22:54:25'),
(28, '2017-08-13', '2017-08-13', 70000, 'Pesan', 1, 3, 1, '2017-08-13 08:29:26', '2017-08-13 08:29:26'),
(29, '2017-08-14', '2017-08-14', 148000, 'Pesan', 1, 3, 1, '2017-08-13 18:36:15', '2017-08-13 18:36:15'),
(30, '2017-08-14', '2017-08-16', 130000, 'Pesan', 1, 3, 1, '2017-08-13 20:16:20', '2017-08-13 20:16:20'),
(31, '2017-08-14', '2017-08-14', 70000, 'Pesan', 1, 3, 2, '2017-08-13 21:50:22', '2017-08-13 21:50:22'),
(32, '2017-08-14', '2017-08-14', 70000, 'Dikirim', 1, 3, 2, '2017-08-13 21:51:04', '2017-08-13 21:51:04'),
(33, '2017-08-14', '2017-08-14', 390000, 'Dikirim', 1, 3, 1, '2017-08-13 21:51:32', '2017-08-13 21:51:32'),
(34, '2017-08-15', '2017-08-17', 70000, 'Dikirim', 1, 3, 1, '2017-08-14 23:07:37', '2017-08-14 23:07:37'),
(35, '2017-08-15', '2017-08-15', 70000, 'Dikirim', 1, 3, 1, '2017-08-14 23:16:36', '2017-08-14 23:16:36'),
(36, '2017-08-15', '2017-08-15', 130000, 'Dikirim', 1, 3, 1, '2017-08-14 23:18:51', '2017-08-14 23:18:51'),
(37, '2017-08-15', '2017-08-15', 70000, 'Dikirim', 1, 3, 1, '2017-08-14 23:24:18', '2017-08-14 23:24:18'),
(38, '2017-08-15', '2017-08-18', 70000, 'Dikirim', 1, 3, 1, '2017-08-14 23:26:11', '2017-08-14 23:26:11'),
(39, '2017-08-15', '2017-08-15', 70000, 'Dikirim', 1, 3, 1, '2017-08-14 23:30:02', '2017-08-14 23:30:02'),
(40, '2017-08-15', '2017-08-15', 70000, 'Dikirim', 1, 3, 1, '2017-08-14 23:32:12', '2017-08-14 23:32:12'),
(41, '2017-08-15', '2017-08-15', 70000, 'Pesan', 1, 3, 1, '2017-08-14 23:39:03', '2017-08-14 23:39:03'),
(42, '2017-08-15', '2017-08-15', 70000, 'Lunas', 1, 3, 1, '2017-08-15 00:13:53', '2017-08-15 00:13:53'),
(43, '2017-08-25', '2017-08-25', 65000, 'Pesan', 1, 3, 1, '2017-08-25 01:14:27', '2017-08-25 01:14:27'),
(44, '2017-08-26', '2017-08-26', 32000, 'Pesan', 1, 3, 1, '2017-08-26 09:29:49', '2017-08-26 09:29:49'),
(45, '2017-08-26', '2017-08-26', 32000, 'Pesan', 1, 3, 1, '2017-08-26 09:31:02', '2017-08-26 09:31:02'),
(46, '2017-08-26', '2017-08-26', 32000, 'Pesan', 1, 3, 1, '2017-08-26 09:31:15', '2017-08-26 09:31:15'),
(47, '2017-08-26', '2017-08-26', 32000, 'Pesan', 1, 3, 1, '2017-08-26 09:32:30', '2017-08-26 09:32:30'),
(48, '2017-08-26', '2017-08-26', 32000, 'Pesan', 1, 3, 1, '2017-08-26 09:32:37', '2017-08-26 09:32:37'),
(49, '2017-08-27', '2017-08-29', 56000, 'Pesan', 1, 3, 1, '2017-08-27 09:18:08', '2017-08-27 09:18:08'),
(50, '2017-08-27', '2017-08-29', 56000, 'Pesan', 1, 3, 1, '2017-08-27 09:22:45', '2017-08-27 09:22:45'),
(51, '2017-08-27', '2017-08-29', 56000, 'Pesan', 1, 3, 1, '2017-08-27 09:23:18', '2017-08-27 09:23:18'),
(52, '2017-08-27', '2017-08-29', 56000, 'Pesan', 1, 3, 1, '2017-08-27 09:24:26', '2017-08-27 09:24:26'),
(53, '2017-08-27', '2017-08-29', 56000, 'Dikirim', 1, 3, 1, '2017-08-27 09:25:20', '2017-08-27 09:25:20'),
(54, '2017-08-29', '2017-08-29', 12000, 'Pesan', 1, 3, 1, '2017-08-28 22:42:27', '2017-08-28 22:42:27'),
(55, '2017-08-31', '2017-08-31', 34000, 'Pesan', 1, 3, 1, '2017-08-30 20:43:54', '2017-08-30 20:43:54'),
(56, '2017-08-31', '2017-08-31', 64000, 'Pesan', 1, 3, 1, '2017-08-30 21:06:28', '2017-08-30 21:06:28'),
(57, '2017-08-31', '2017-08-31', 64000, 'Dikirim', 1, 3, 1, '2017-08-30 21:14:45', '2017-08-30 21:14:45'),
(58, '2017-08-31', '2017-08-31', 50000, 'Pesan', 1, 3, 1, '2017-08-30 22:22:31', '2017-08-30 22:22:31'),
(59, '2017-08-31', '2017-08-31', 50000, 'Pesan', 1, 3, 1, '2017-08-30 22:23:01', '2017-08-30 22:23:01'),
(60, '2017-08-31', '2017-08-31', 50000, 'Pesan', 1, 3, 1, '2017-08-30 22:23:04', '2017-08-30 22:23:04'),
(61, '2017-08-31', '2017-08-31', 50000, 'Pesan', 1, 3, 1, '2017-08-30 22:23:23', '2017-08-30 22:23:23'),
(62, '2017-08-31', '2017-08-31', 50000, 'Pesan', 1, 3, 1, '2017-08-30 22:24:16', '2017-08-30 22:24:16'),
(63, '2017-08-31', '2017-08-31', 50000, 'Pesan', 1, 3, 1, '2017-08-30 22:24:46', '2017-08-30 22:24:46'),
(64, '2017-08-31', '2017-08-31', 60000, 'Dikirim', 1, 3, 1, '2017-08-30 22:25:17', '2017-08-30 22:25:17'),
(65, '2017-08-31', '2017-08-31', 78000, 'Pesan', 1, 3, 1, '2017-08-30 22:29:11', '2017-08-30 22:29:11'),
(66, '2017-08-31', '2017-08-31', 40000, 'Pesan', 1, 3, 1, '2017-08-30 22:29:48', '2017-08-30 22:29:48'),
(67, '2017-08-31', '2017-08-31', 50000, 'Dikirim', 1, 3, 1, '2017-08-30 22:33:45', '2017-08-30 22:33:45'),
(68, '2017-08-31', '2017-08-31', 23000, 'Pesan', 1, 3, 1, '2017-08-31 02:25:11', '2017-08-31 02:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `notajuals`
--

CREATE TABLE `notajuals` (
  `NoNotaJual` int(10) UNSIGNED NOT NULL,
  `TanggalBuat` date NOT NULL,
  `TanggalBayar` date NOT NULL,
  `Total` int(11) NOT NULL,
  `StatusJual` enum('Sudah Lunas','Belum Lunas','Lewat Jatuh Tempo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KaryawanID` int(10) UNSIGNED NOT NULL,
  `PembeliID` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notajuals`
--

INSERT INTO `notajuals` (`NoNotaJual`, `TanggalBuat`, `TanggalBayar`, `Total`, `StatusJual`, `StatusTerdaftar`, `KaryawanID`, `PembeliID`, `created_at`, `updated_at`) VALUES
(1, '2017-01-29', '2017-01-30', 1140000, 'Belum Lunas', 1, 1, 1, NULL, NULL),
(2, '2017-01-29', '2017-01-30', 1282500, 'Sudah Lunas', 1, 2, 2, NULL, NULL),
(3, '2017-08-12', '2017-08-13', 152000, 'Belum Lunas', 1, 3, 1, '2017-08-12 09:08:05', '2017-08-12 09:08:05'),
(4, '2017-08-12', '2017-08-15', 142500, 'Belum Lunas', 1, 3, 1, '2017-08-12 09:18:51', '2017-08-12 09:18:51'),
(5, '2017-08-13', '2017-08-15', 142500, 'Belum Lunas', 1, 3, 1, '2017-08-12 09:19:51', '2017-08-12 09:19:51'),
(6, '2017-08-12', '2017-08-15', 142500, 'Belum Lunas', 1, 3, 1, '2017-08-12 09:20:15', '2017-08-12 09:20:15'),
(7, '2017-08-13', '2017-08-13', 304000, 'Belum Lunas', 1, 3, 1, '2017-08-13 08:32:30', '2017-08-13 08:32:30'),
(8, '2017-08-14', '2017-08-14', 142500, 'Belum Lunas', 1, 3, 1, '2017-08-13 21:52:31', '2017-08-13 21:52:31'),
(9, '2017-08-14', '2017-08-14', 142500, 'Belum Lunas', 1, 3, 1, '2017-08-13 21:53:11', '2017-08-13 21:53:11'),
(10, '2017-08-14', '2017-08-14', 142500, 'Belum Lunas', 1, 3, 1, '2017-08-13 21:53:26', '2017-08-13 21:53:26'),
(11, '2017-08-14', '2017-08-14', 142500, 'Sudah Lunas', 1, 3, 1, '2017-08-13 21:54:13', '2017-08-13 21:54:13'),
(12, '2017-08-14', '2017-08-14', 80000, 'Sudah Lunas', 1, 3, 3, '2017-08-14 08:43:43', '2017-08-14 08:43:43'),
(13, '2017-08-15', '2017-08-15', 76000, 'Sudah Lunas', 1, 3, 1, '2017-08-15 00:22:30', '2017-08-15 00:22:30'),
(14, '2017-08-15', '2017-08-15', 76000, 'Sudah Lunas', 1, 3, 1, '2017-08-15 00:34:24', '2017-08-15 00:34:24'),
(15, '2017-08-17', '2017-08-17', 142500, 'Sudah Lunas', 1, 3, 1, '2017-08-17 09:12:58', '2017-08-17 09:12:58'),
(16, '2017-08-24', '2017-08-24', 76000, 'Belum Lunas', 1, 3, 1, '2017-08-23 20:59:38', '2017-08-23 20:59:38'),
(17, '2017-08-24', '2017-08-24', 76000000, 'Sudah Lunas', 1, 3, 2, '2017-08-23 22:24:22', '2017-08-23 22:24:22'),
(18, '2017-08-26', '2017-08-26', 90000, 'Lewat Jatuh Tempo', 1, 3, 1, '2017-08-26 07:27:43', '2017-08-26 07:27:43'),
(19, '2017-08-31', '2017-08-31', 80000, 'Belum Lunas', 1, 3, 1, '2017-08-31 04:38:08', '2017-08-31 04:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemasoks`
--

CREATE TABLE `pemasoks` (
  `IDPemasok` int(10) UNSIGNED NOT NULL,
  `NoRekening` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaRekening` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bank` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoTelepon` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusBeli` int(11) NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemasoks`
--

INSERT INTO `pemasoks` (`IDPemasok`, `NoRekening`, `NamaRekening`, `Bank`, `Alamat`, `NoTelepon`, `StatusBeli`, `StatusTerdaftar`, `created_at`, `updated_at`) VALUES
(1, '090098390', 'Aldo', 'BCA', 'Jalan Tenggilis 78 B', '082335677809', 0, 1, NULL, NULL),
(2, '090098389', 'Hadi', 'Mandiri', 'Jalan Tenggilis 79 B', '082335677888', 1, 1, NULL, NULL),
(3, '11111111', 'abc', 'BCA', 'Jalan RMU No 88', '081334567890', 0, 1, '2017-07-31 09:54:22', '2017-07-31 09:54:22'),
(4, '23232', '0876', 'BCA', 'Jalan Tenggilis', '098786545234', 1, 1, '2017-08-23 01:12:41', '2017-08-23 01:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `pembelis`
--

CREATE TABLE `pembelis` (
  `IDPembeli` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoTelepon` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Bank` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusLangganan` int(11) NOT NULL,
  `StatusJual` int(11) NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelis`
--

INSERT INTO `pembelis` (`IDPembeli`, `Nama`, `NoTelepon`, `Kota`, `Bank`, `StatusLangganan`, `StatusJual`, `StatusTerdaftar`, `created_at`, `updated_at`) VALUES
(1, 'Calvin', '081990876543', 'Surabaya', 'BCA', 1, 1, 1, NULL, NULL),
(2, 'Aldo', '081990876540', 'Surabaya', 'Mandiri', 1, 1, 1, NULL, NULL),
(3, 'TJ', '0909090', 'Pasuruan', 'BCA', 0, 0, 1, '2017-07-23 06:59:49', '2017-07-23 06:59:49'),
(4, 'asasa', '42323', 'asas', 'asa', 1, 1, 1, '2017-07-26 18:35:21', '2017-07-26 18:35:21'),
(5, 'acc', '1212', 'Pasuruan', 'BCA', 0, 0, 1, '2017-08-23 01:53:46', '2017-08-23 01:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarans`
--

CREATE TABLE `pengeluarans` (
  `IDPengeluaran` int(10) UNSIGNED NOT NULL,
  `Tanggal` date NOT NULL,
  `Nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nominal` int(11) NOT NULL,
  `Keterangan` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KaryawanID` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluarans`
--

INSERT INTO `pengeluarans` (`IDPengeluaran`, `Tanggal`, `Nama`, `Nominal`, `Keterangan`, `StatusTerdaftar`, `KaryawanID`, `created_at`, `updated_at`) VALUES
(1, '2015-06-09', 'Kas', 10000, 'AAA', 1, 1, NULL, NULL),
(2, '2016-10-10', 'Hutang', 9000000, 'ACC', 1, 2, NULL, NULL),
(3, '2017-07-27', 'Piutang', 55000, 'ASB', 1, 1, '2017-07-26 18:55:12', '2017-07-26 18:55:12'),
(4, '2017-07-30', 'as', 30, 'jjh', 1, 1, '2017-07-30 07:48:29', '2017-07-30 07:48:29'),
(5, '2017-07-30', 'Hutang', 45, 'hutang bank', 1, 1, '2017-07-30 07:49:32', '2017-07-30 07:49:32'),
(6, '2017-07-30', 'Piutang', 40, 'piutang bank', 1, 1, '2017-07-30 07:51:41', '2017-07-30 07:51:41'),
(7, '2017-07-30', 'hutang', 56, 'hutang bank', 1, 1, '2017-07-30 07:54:18', '2017-07-30 07:54:18'),
(8, '2017-07-30', 'dsads', 34, 'erw', 1, 1, '2017-07-30 07:58:14', '2017-07-30 07:58:14'),
(9, '2017-07-30', 'Kas', 34, 'sasas', 1, 1, '2017-07-30 08:09:56', '2017-07-30 08:09:56'),
(10, '2017-07-30', 'hhh', 760000, 'jhhj', 1, 1, '2017-07-30 08:10:49', '2017-07-30 08:10:49'),
(11, '2017-07-30', 'asas', 45, 'sdsd', 1, 1, '2017-07-30 08:27:49', '2017-07-30 08:27:49'),
(12, '2017-07-30', 'aasa', 45, 'sas', 1, 1, '2017-07-30 08:35:08', '2017-07-30 08:35:08'),
(13, '2017-07-30', 'asa', 45, 'asas', 1, 1, '2017-07-30 08:39:38', '2017-07-30 08:39:38'),
(14, '2017-07-30', 'dsdsa', 50, 'sasas', 1, 1, '2017-07-30 08:40:17', '2017-07-30 08:40:17'),
(15, '2017-07-30', 'sdsd', 43, 'wdw', 1, 1, '2017-07-30 09:11:34', '2017-07-30 09:11:34'),
(16, '2017-07-30', 'sdsd', 430, 'dad', 1, 1, '2017-07-30 09:13:29', '2017-07-30 09:13:29'),
(17, '2017-07-30', 'asas', 20, 'asas', 1, 1, '2017-07-30 09:17:06', '2017-07-30 09:17:06'),
(18, '2017-07-30', 'asas', 32, 'dsds', 1, 1, '2017-07-30 09:19:37', '2017-07-30 09:19:37'),
(19, '2017-07-30', 'dssd', 56, 'sds', 1, 1, '2017-07-30 09:38:54', '2017-07-30 09:38:54'),
(20, '2017-07-30', 'hutang', 34, 'sasa', 1, 1, '2017-07-30 09:42:15', '2017-07-30 09:42:15'),
(21, '2017-07-30', 'hutang', 56, 'asas', 1, 1, '2017-07-30 09:43:56', '2017-07-30 09:43:56'),
(22, '2017-07-31', 'Hutang', 65, 'hutang bank', 1, 1, '2017-07-30 23:08:05', '2017-07-30 23:08:05'),
(23, '2017-07-31', 'dsd', 45, 'dsds', 1, 1, '2017-07-30 23:08:24', '2017-07-30 23:08:24'),
(24, '2017-08-02', 'Hutang', 23, 'hutang pegawai', 1, 1, '2017-08-02 02:34:19', '2017-08-02 02:34:19'),
(25, '2017-08-02', 'aaaa', 98, 'hutang', 1, 3, '2017-08-02 02:38:09', '2017-08-02 02:38:09'),
(26, '2017-08-02', 'ttt', 56, 'abcd', 1, 3, '2017-08-02 02:58:21', '2017-08-02 02:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `returbelis`
--

CREATE TABLE `returbelis` (
  `IDReturBeli` int(10) UNSIGNED NOT NULL,
  `Tanggal` date NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KaryawanID` int(10) UNSIGNED NOT NULL,
  `NotaBeliNo` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returbelis`
--

INSERT INTO `returbelis` (`IDReturBeli`, `Tanggal`, `StatusTerdaftar`, `KaryawanID`, `NotaBeliNo`, `created_at`, `updated_at`) VALUES
(1, '2017-01-29', 0, 1, 1, NULL, NULL),
(2, '2017-01-29', 1, 2, 2, NULL, NULL),
(3, '2017-08-14', 1, 3, 1, '2017-08-14 00:56:20', '2017-08-14 00:56:20'),
(4, '2017-08-14', 1, 3, 1, '2017-08-14 00:57:38', '2017-08-14 00:57:38'),
(5, '2017-08-14', 1, 3, 1, '2017-08-14 01:00:33', '2017-08-14 01:00:33'),
(6, '2017-08-14', 1, 3, 1, '2017-08-14 01:00:52', '2017-08-14 01:00:52'),
(7, '2017-08-14', 1, 3, 2, '2017-08-14 01:02:15', '2017-08-14 01:02:15'),
(8, '2017-08-14', 1, 3, 2, '2017-08-14 01:02:36', '2017-08-14 01:02:36'),
(9, '2017-08-14', 1, 3, 1, '2017-08-14 01:18:32', '2017-08-14 01:18:32'),
(10, '2017-08-14', 1, 3, 1, '2017-08-14 07:45:24', '2017-08-14 07:45:24'),
(11, '2017-08-14', 1, 3, 1, '2017-08-14 08:26:47', '2017-08-14 08:26:47'),
(12, '2017-08-18', 1, 3, 1, '2017-08-17 22:50:04', '2017-08-17 22:50:04'),
(13, '2017-08-18', 1, 3, 1, '2017-08-17 22:50:18', '2017-08-17 22:50:18'),
(14, '2017-08-18', 1, 3, 1, '2017-08-17 22:52:16', '2017-08-17 22:52:16'),
(15, '2017-08-18', 1, 3, 2, '2017-08-17 23:42:58', '2017-08-17 23:42:58'),
(16, '2017-08-18', 1, 3, 1, '2017-08-17 23:51:22', '2017-08-17 23:51:22'),
(17, '2017-08-31', 1, 3, 41, '2017-08-31 05:00:25', '2017-08-31 05:00:25'),
(18, '2017-08-31', 1, 3, 1, '2017-08-31 05:21:51', '2017-08-31 05:21:51'),
(19, '2017-08-31', 1, 3, 34, '2017-08-31 05:26:01', '2017-08-31 05:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `returjuals`
--

CREATE TABLE `returjuals` (
  `IDReturJual` int(10) UNSIGNED NOT NULL,
  `Tanggal` date NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KaryawanID` int(10) UNSIGNED NOT NULL,
  `NotaJualNo` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returjuals`
--

INSERT INTO `returjuals` (`IDReturJual`, `Tanggal`, `StatusTerdaftar`, `KaryawanID`, `NotaJualNo`, `created_at`, `updated_at`) VALUES
(1, '2017-01-29', 0, 1, 1, NULL, NULL),
(2, '2017-01-29', 1, 2, 2, NULL, NULL),
(3, '2017-08-14', 1, 3, 1, '2017-08-14 08:31:05', '2017-08-14 08:31:05'),
(4, '2017-08-14', 1, 3, 1, '2017-08-14 08:31:40', '2017-08-14 08:31:40'),
(5, '2017-08-14', 1, 3, 1, '2017-08-14 08:31:52', '2017-08-14 08:31:52'),
(6, '2017-08-14', 1, 3, 1, '2017-08-14 08:32:38', '2017-08-14 08:32:38'),
(7, '2017-08-18', 1, 3, 1, '2017-08-17 23:28:48', '2017-08-17 23:28:48'),
(8, '2017-08-18', 1, 3, 1, '2017-08-17 23:28:58', '2017-08-17 23:28:58'),
(9, '2017-08-18', 1, 3, 1, '2017-08-17 23:29:06', '2017-08-17 23:29:06'),
(10, '2017-08-18', 1, 3, 1, '2017-08-17 23:30:23', '2017-08-17 23:30:23'),
(11, '2017-08-18', 1, 3, 1, '2017-08-17 23:33:26', '2017-08-17 23:33:26'),
(12, '2017-08-18', 1, 3, 1, '2017-08-17 23:37:13', '2017-08-17 23:37:13'),
(13, '2017-08-18', 1, 3, 1, '2017-08-17 23:38:00', '2017-08-17 23:38:00'),
(14, '2017-08-18', 1, 3, 1, '2017-08-17 23:38:04', '2017-08-17 23:38:04'),
(15, '2017-08-18', 1, 3, 1, '2017-08-17 23:39:04', '2017-08-17 23:39:04'),
(16, '2017-08-18', 1, 3, 1, '2017-08-17 23:40:03', '2017-08-17 23:40:03'),
(17, '2017-08-18', 1, 3, 1, '2017-08-17 23:40:07', '2017-08-17 23:40:07'),
(18, '2017-08-18', 1, 3, 1, '2017-08-17 23:40:26', '2017-08-17 23:40:26'),
(19, '2017-08-18', 1, 3, 1, '2017-08-17 23:42:19', '2017-08-17 23:42:19'),
(20, '2017-08-18', 1, 3, 1, '2017-08-17 23:43:07', '2017-08-17 23:43:07'),
(21, '2017-08-18', 1, 3, 1, '2017-08-17 23:44:05', '2017-08-17 23:44:05'),
(22, '2017-08-18', 1, 3, 1, '2017-08-17 23:44:53', '2017-08-17 23:44:53'),
(23, '2017-08-18', 1, 3, 1, '2017-08-17 23:46:38', '2017-08-17 23:46:38'),
(24, '2017-08-18', 1, 3, 1, '2017-08-17 23:47:44', '2017-08-17 23:47:44'),
(25, '2017-08-18', 1, 3, 1, '2017-08-17 23:48:22', '2017-08-17 23:48:22'),
(26, '2017-08-18', 1, 3, 1, '2017-08-17 23:51:56', '2017-08-17 23:51:56'),
(27, '2017-08-18', 1, 3, 1, '2017-08-17 23:52:24', '2017-08-17 23:52:24'),
(28, '2017-08-18', 1, 3, 1, '2017-08-17 23:54:53', '2017-08-17 23:54:53'),
(29, '2017-08-18', 1, 3, 1, '2017-08-17 23:55:27', '2017-08-17 23:55:27'),
(30, '2017-08-18', 1, 3, 1, '2017-08-17 23:56:00', '2017-08-17 23:56:00'),
(31, '2017-08-18', 1, 3, 1, '2017-08-17 23:56:18', '2017-08-17 23:56:18'),
(32, '2017-08-31', 1, 3, 12, '2017-08-31 05:30:58', '2017-08-31 05:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `stokopnames`
--

CREATE TABLE `stokopnames` (
  `NoNotaStokOpname` int(10) UNSIGNED NOT NULL,
  `Tanggal` date NOT NULL,
  `StatusTerdaftar` int(11) NOT NULL,
  `KaryawanID` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stokopnames`
--

INSERT INTO `stokopnames` (`NoNotaStokOpname`, `Tanggal`, `StatusTerdaftar`, `KaryawanID`, `created_at`, `updated_at`) VALUES
(1, '2017-01-01', 0, 1, NULL, NULL),
(2, '2016-01-01', 1, 1, NULL, NULL),
(3, '2017-07-25', 1, 1, '2017-07-31 04:14:31', '2017-07-31 04:14:31'),
(4, '2017-07-31', 1, 1, '2017-07-31 04:44:22', '2017-07-31 04:44:22'),
(5, '2017-07-31', 1, 1, '2017-07-31 04:45:28', '2017-07-31 04:45:28'),
(6, '2017-07-31', 1, 1, '2017-07-31 04:45:49', '2017-07-31 04:45:49'),
(7, '2017-07-31', 1, 1, '2017-07-31 04:54:46', '2017-07-31 04:54:46'),
(8, '2017-07-31', 1, 1, '2017-07-31 04:54:56', '2017-07-31 04:54:56'),
(9, '2017-07-31', 1, 1, '2017-07-31 06:10:18', '2017-07-31 06:10:18'),
(10, '2017-07-31', 1, 1, '2017-07-31 09:48:30', '2017-07-31 09:48:30'),
(11, '2017-08-01', 1, 1, '2017-07-31 17:58:58', '2017-07-31 17:58:58'),
(12, '2017-08-02', 1, 3, '2017-08-02 02:06:23', '2017-08-02 02:06:23'),
(13, '2017-08-09', 1, 3, '2017-08-09 01:23:44', '2017-08-09 01:23:44'),
(14, '2017-08-09', 1, 3, '2017-08-09 01:30:32', '2017-08-09 01:30:32'),
(15, '2017-08-09', 1, 3, '2017-08-09 01:32:13', '2017-08-09 01:32:13'),
(16, '2017-08-09', 1, 3, '2017-08-09 01:36:11', '2017-08-09 01:36:11'),
(17, '2017-08-09', 1, 3, '2017-08-09 01:40:03', '2017-08-09 01:40:03'),
(18, '2017-08-09', 1, 3, '2017-08-09 01:43:52', '2017-08-09 01:43:52'),
(19, '2017-08-09', 1, 3, '2017-08-09 01:57:48', '2017-08-09 01:57:48'),
(20, '2017-08-09', 1, 3, '2017-08-09 02:00:48', '2017-08-09 02:00:48'),
(21, '2017-08-09', 1, 3, '2017-08-09 02:02:31', '2017-08-09 02:02:31'),
(22, '2017-08-09', 1, 3, '2017-08-09 02:05:24', '2017-08-09 02:05:24'),
(23, '2017-08-09', 1, 3, '2017-08-09 02:05:51', '2017-08-09 02:05:51'),
(24, '2017-08-09', 1, 3, '2017-08-09 02:07:33', '2017-08-09 02:07:33'),
(25, '2017-08-09', 1, 3, '2017-08-09 03:34:37', '2017-08-09 03:34:37'),
(26, '2017-08-09', 1, 3, '2017-08-09 03:36:27', '2017-08-09 03:36:27'),
(27, '2017-08-09', 1, 3, '2017-08-09 03:48:20', '2017-08-09 03:48:20'),
(28, '2017-08-09', 1, 3, '2017-08-09 03:53:02', '2017-08-09 03:53:02'),
(29, '2017-08-09', 1, 3, '2017-08-09 03:53:23', '2017-08-09 03:53:23'),
(30, '2017-08-09', 1, 3, '2017-08-09 04:01:02', '2017-08-09 04:01:02'),
(31, '2017-08-09', 1, 3, '2017-08-09 04:01:32', '2017-08-09 04:01:32'),
(32, '2017-08-09', 1, 3, '2017-08-09 04:15:04', '2017-08-09 04:15:04'),
(33, '2017-08-09', 1, 3, '2017-08-09 04:15:20', '2017-08-09 04:15:20'),
(34, '2017-08-10', 1, 3, '2017-08-09 19:13:52', '2017-08-09 19:13:52'),
(35, '2017-08-10', 1, 3, '2017-08-09 19:19:33', '2017-08-09 19:19:33'),
(36, '2017-08-10', 1, 3, '2017-08-09 19:19:47', '2017-08-09 19:19:47'),
(37, '2017-08-10', 1, 3, '2017-08-09 19:20:10', '2017-08-09 19:20:10'),
(38, '2017-08-10', 1, 3, '2017-08-09 19:20:13', '2017-08-09 19:20:13'),
(39, '2017-08-10', 1, 3, '2017-08-09 19:21:16', '2017-08-09 19:21:16'),
(40, '2017-08-10', 1, 3, '2017-08-09 19:24:46', '2017-08-09 19:24:46'),
(41, '2017-08-10', 1, 3, '2017-08-09 19:26:23', '2017-08-09 19:26:23'),
(42, '2017-08-10', 1, 3, '2017-08-09 19:28:43', '2017-08-09 19:28:43'),
(43, '2017-08-10', 1, 3, '2017-08-09 19:29:08', '2017-08-09 19:29:08'),
(44, '2017-08-10', 1, 3, '2017-08-09 19:29:22', '2017-08-09 19:29:22'),
(45, '2017-08-10', 1, 3, '2017-08-09 19:30:20', '2017-08-09 19:30:20'),
(46, '2017-08-10', 1, 3, '2017-08-09 21:10:13', '2017-08-09 21:10:13'),
(47, '2017-08-10', 1, 3, '2017-08-10 03:30:35', '2017-08-10 03:30:35'),
(48, '2017-08-11', 1, 3, '2017-08-11 00:45:49', '2017-08-11 00:45:49'),
(49, '2017-08-11', 1, 3, '2017-08-11 00:49:00', '2017-08-11 00:49:00'),
(50, '2017-08-12', 1, 3, '2017-08-11 21:21:17', '2017-08-11 21:21:17'),
(51, '2017-08-14', 1, 3, '2017-08-13 21:56:28', '2017-08-13 21:56:28'),
(52, '2017-08-14', 1, 3, '2017-08-13 22:47:41', '2017-08-13 22:47:41'),
(53, '2017-08-14', 1, 3, '2017-08-13 22:48:25', '2017-08-13 22:48:25'),
(54, '2017-08-14', 1, 3, '2017-08-13 22:49:17', '2017-08-13 22:49:17'),
(55, '2017-08-14', 1, 3, '2017-08-13 22:59:31', '2017-08-13 22:59:31'),
(56, '2017-08-14', 1, 3, '2017-08-13 23:01:49', '2017-08-13 23:01:49'),
(57, '2017-08-14', 1, 3, '2017-08-13 23:07:49', '2017-08-13 23:07:49'),
(58, '2017-08-14', 1, 3, '2017-08-13 23:08:25', '2017-08-13 23:08:25'),
(59, '2017-08-15', 1, 3, '2017-08-15 00:28:25', '2017-08-15 00:28:25'),
(60, '2017-08-15', 1, 3, '2017-08-15 00:33:03', '2017-08-15 00:33:03'),
(61, '2017-08-15', 1, 3, '2017-08-15 00:35:20', '2017-08-15 00:35:20'),
(62, '2017-08-15', 1, 3, '2017-08-15 00:36:24', '2017-08-15 00:36:24'),
(63, '2017-08-15', 1, 3, '2017-08-15 00:37:36', '2017-08-15 00:37:36'),
(64, '2017-08-15', 1, 3, '2017-08-15 03:57:05', '2017-08-15 03:57:05'),
(65, '2017-08-15', 1, 3, '2017-08-15 04:16:16', '2017-08-15 04:16:16'),
(66, '2017-08-15', 1, 3, '2017-08-15 04:16:40', '2017-08-15 04:16:40'),
(67, '2017-08-15', 1, 3, '2017-08-15 04:21:32', '2017-08-15 04:21:32'),
(68, '2017-08-15', 1, 3, '2017-08-15 07:23:49', '2017-08-15 07:23:49'),
(69, '2017-08-15', 1, 3, '2017-08-15 07:24:03', '2017-08-15 07:24:03'),
(70, '2017-08-15', 1, 3, '2017-08-15 07:24:23', '2017-08-15 07:24:23'),
(71, '2017-08-15', 1, 3, '2017-08-15 08:24:18', '2017-08-15 08:24:18'),
(72, '2017-08-18', 1, 3, '2017-08-17 21:05:08', '2017-08-17 21:05:08'),
(73, '2017-08-18', 1, 3, '2017-08-17 21:07:49', '2017-08-17 21:07:49'),
(74, '2017-08-18', 1, 3, '2017-08-17 21:14:23', '2017-08-17 21:14:23'),
(75, '2017-08-18', 1, 3, '2017-08-17 21:18:23', '2017-08-17 21:18:23'),
(76, '2017-08-18', 1, 3, '2017-08-17 21:19:14', '2017-08-17 21:19:14'),
(77, '2017-08-31', 1, 3, '2017-08-31 05:39:41', '2017-08-31 05:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `IDUser` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangcatatnotabelis`
--
ALTER TABLE `barangcatatnotabelis`
  ADD PRIMARY KEY (`NotaBeliNo`,`BarangID`),
  ADD KEY `barangcatatnotabelis_barangid_foreign` (`BarangID`) USING BTREE,
  ADD KEY `NotaBeliNo` (`NotaBeliNo`) USING BTREE;

--
-- Indexes for table `barangcatatnotajuals`
--
ALTER TABLE `barangcatatnotajuals`
  ADD PRIMARY KEY (`NotaJualNo`,`BarangID`),
  ADD KEY `barangcatatnotajuals_barangid_foreign` (`BarangID`),
  ADD KEY `NotaJualNo` (`NotaJualNo`) USING BTREE;

--
-- Indexes for table `barangcatatreturbelis`
--
ALTER TABLE `barangcatatreturbelis`
  ADD PRIMARY KEY (`ReturBeliID`,`BarangID`),
  ADD KEY `barangcatatreturbelis_barangid_foreign` (`BarangID`),
  ADD KEY `ReturBeliID` (`ReturBeliID`) USING BTREE;

--
-- Indexes for table `barangcatatreturjuals`
--
ALTER TABLE `barangcatatreturjuals`
  ADD PRIMARY KEY (`ReturJualID`,`BarangID`),
  ADD KEY `barangcatatreturjuals_barangid_foreign` (`BarangID`),
  ADD KEY `ReturJualID` (`ReturJualID`) USING BTREE;

--
-- Indexes for table `barangcatatstokopnames`
--
ALTER TABLE `barangcatatstokopnames`
  ADD PRIMARY KEY (`NotaStokOpnameNo`,`BarangID`),
  ADD KEY `barangcatatstokopnames_barangid_foreign` (`BarangID`),
  ADD KEY `StokOpnameNotaNo` (`NotaStokOpnameNo`) USING BTREE;

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`IDBarang`),
  ADD KEY `barangs_kategoriid_foreign` (`KategoriID`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`IDKaryawan`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`IDKategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notabelis`
--
ALTER TABLE `notabelis`
  ADD PRIMARY KEY (`NoNotaBeli`),
  ADD KEY `notabelis_karyawanid_foreign` (`KaryawanID`),
  ADD KEY `notabelis_pemasokid_foreign` (`PemasokID`);

--
-- Indexes for table `notajuals`
--
ALTER TABLE `notajuals`
  ADD PRIMARY KEY (`NoNotaJual`),
  ADD KEY `notajuals_karyawanid_foreign` (`KaryawanID`),
  ADD KEY `notajuals_pembeliid_foreign` (`PembeliID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pemasoks`
--
ALTER TABLE `pemasoks`
  ADD PRIMARY KEY (`IDPemasok`);

--
-- Indexes for table `pembelis`
--
ALTER TABLE `pembelis`
  ADD PRIMARY KEY (`IDPembeli`);

--
-- Indexes for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  ADD PRIMARY KEY (`IDPengeluaran`),
  ADD KEY `pengeluarans_karyawanid_foreign` (`KaryawanID`);

--
-- Indexes for table `returbelis`
--
ALTER TABLE `returbelis`
  ADD PRIMARY KEY (`IDReturBeli`),
  ADD KEY `returbelis_karyawanid_foreign` (`KaryawanID`),
  ADD KEY `returbelis_notabelino_foreign` (`NotaBeliNo`) USING BTREE;

--
-- Indexes for table `returjuals`
--
ALTER TABLE `returjuals`
  ADD PRIMARY KEY (`IDReturJual`),
  ADD KEY `returjuals_karyawanid_foreign` (`KaryawanID`),
  ADD KEY `returjuals_notajualno_foreign` (`NotaJualNo`) USING BTREE;

--
-- Indexes for table `stokopnames`
--
ALTER TABLE `stokopnames`
  ADD PRIMARY KEY (`NoNotaStokOpname`),
  ADD KEY `stokopnames_karyawanid_foreign` (`KaryawanID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IDUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `IDBarang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `IDKaryawan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `IDKategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `notabelis`
--
ALTER TABLE `notabelis`
  MODIFY `NoNotaBeli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `notajuals`
--
ALTER TABLE `notajuals`
  MODIFY `NoNotaJual` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `pemasoks`
--
ALTER TABLE `pemasoks`
  MODIFY `IDPemasok` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pembelis`
--
ALTER TABLE `pembelis`
  MODIFY `IDPembeli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  MODIFY `IDPengeluaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `returbelis`
--
ALTER TABLE `returbelis`
  MODIFY `IDReturBeli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `returjuals`
--
ALTER TABLE `returjuals`
  MODIFY `IDReturJual` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `stokopnames`
--
ALTER TABLE `stokopnames`
  MODIFY `NoNotaStokOpname` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `IDUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barangcatatnotabelis`
--
ALTER TABLE `barangcatatnotabelis`
  ADD CONSTRAINT `barangcatatnotabelis_barangid_foreign` FOREIGN KEY (`BarangID`) REFERENCES `barangs` (`IDBarang`),
  ADD CONSTRAINT `barangcatatnotabelis_notabeliid_foreign` FOREIGN KEY (`NotaBeliNo`) REFERENCES `notabelis` (`NoNotaBeli`);

--
-- Constraints for table `barangcatatnotajuals`
--
ALTER TABLE `barangcatatnotajuals`
  ADD CONSTRAINT `barangcatatnotajuals_barangid_foreign` FOREIGN KEY (`BarangID`) REFERENCES `barangs` (`IDBarang`),
  ADD CONSTRAINT `barangcatatnotajuals_notajualid_foreign` FOREIGN KEY (`NotaJualNo`) REFERENCES `notajuals` (`NoNotaJual`);

--
-- Constraints for table `barangcatatreturbelis`
--
ALTER TABLE `barangcatatreturbelis`
  ADD CONSTRAINT `barangcatatreturbelis_barangid_foreign` FOREIGN KEY (`BarangID`) REFERENCES `barangs` (`IDBarang`),
  ADD CONSTRAINT `barangcatatreturbelis_returbeliid_foreign` FOREIGN KEY (`ReturBeliID`) REFERENCES `returbelis` (`IDReturBeli`);

--
-- Constraints for table `barangcatatreturjuals`
--
ALTER TABLE `barangcatatreturjuals`
  ADD CONSTRAINT `barangcatatreturjuals_barangid_foreign` FOREIGN KEY (`BarangID`) REFERENCES `barangs` (`IDBarang`),
  ADD CONSTRAINT `barangcatatreturjuals_returjualid_foreign` FOREIGN KEY (`ReturJualID`) REFERENCES `returjuals` (`IDReturJual`);

--
-- Constraints for table `barangcatatstokopnames`
--
ALTER TABLE `barangcatatstokopnames`
  ADD CONSTRAINT `barangcatatstokopnames_barangid_foreign` FOREIGN KEY (`BarangID`) REFERENCES `barangs` (`IDBarang`),
  ADD CONSTRAINT `barangcatatstokopnames_stokopnameid_foreign` FOREIGN KEY (`NotaStokOpnameNo`) REFERENCES `stokopnames` (`NoNotaStokOpname`);

--
-- Constraints for table `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_kategoriid_foreign` FOREIGN KEY (`KategoriID`) REFERENCES `kategoris` (`IDKategori`);

--
-- Constraints for table `notabelis`
--
ALTER TABLE `notabelis`
  ADD CONSTRAINT `notabelis_karyawanid_foreign` FOREIGN KEY (`KaryawanID`) REFERENCES `karyawans` (`IDKaryawan`),
  ADD CONSTRAINT `notabelis_pemasokid_foreign` FOREIGN KEY (`PemasokID`) REFERENCES `pemasoks` (`IDPemasok`);

--
-- Constraints for table `notajuals`
--
ALTER TABLE `notajuals`
  ADD CONSTRAINT `notajuals_karyawanid_foreign` FOREIGN KEY (`KaryawanID`) REFERENCES `karyawans` (`IDKaryawan`),
  ADD CONSTRAINT `notajuals_pembeliid_foreign` FOREIGN KEY (`PembeliID`) REFERENCES `pembelis` (`IDPembeli`);

--
-- Constraints for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  ADD CONSTRAINT `pengeluarans_karyawanid_foreign` FOREIGN KEY (`KaryawanID`) REFERENCES `karyawans` (`IDKaryawan`);

--
-- Constraints for table `returbelis`
--
ALTER TABLE `returbelis`
  ADD CONSTRAINT `returbelis_karyawanid_foreign` FOREIGN KEY (`KaryawanID`) REFERENCES `karyawans` (`IDKaryawan`),
  ADD CONSTRAINT `returbelis_notabeliid_foreign` FOREIGN KEY (`NotaBeliNo`) REFERENCES `notabelis` (`NoNotaBeli`);

--
-- Constraints for table `returjuals`
--
ALTER TABLE `returjuals`
  ADD CONSTRAINT `returjuals_karyawanid_foreign` FOREIGN KEY (`KaryawanID`) REFERENCES `karyawans` (`IDKaryawan`),
  ADD CONSTRAINT `returjuals_notajualid_foreign` FOREIGN KEY (`NotaJualNo`) REFERENCES `notajuals` (`NoNotaJual`);

--
-- Constraints for table `stokopnames`
--
ALTER TABLE `stokopnames`
  ADD CONSTRAINT `stokopnames_karyawanid_foreign` FOREIGN KEY (`KaryawanID`) REFERENCES `karyawans` (`IDKaryawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
