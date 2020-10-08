-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 19, 2017 at 11:29 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mmckbeau_mmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bank`
--

CREATE TABLE `Bank` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaPemilikRekening` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomorRekening` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Bank`
--

INSERT INTO `Bank` (`ID`, `Nama`, `NamaPemilikRekening`, `NomorRekening`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'Daiva', '123456', 1, '2017-08-28 09:39:16', '2017-08-28 09:39:16'),
(2, 'BRI', 'Daiva', '123889', 1, '2017-08-29 02:12:17', '2017-08-29 02:12:17'),
(3, 'Danamon', 'Daiva', '4589785', 1, '2017-08-29 02:12:28', '2017-08-29 02:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `Barang`
--

CREATE TABLE `Barang` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Stok` int(11) NOT NULL,
  `Berat` int(11) NOT NULL,
  `HargaBeli` int(11) NOT NULL,
  `HargaJual` int(11) NOT NULL,
  `HargaJualPromo` int(11) NOT NULL,
  `IDSubKategori` int(10) UNSIGNED NOT NULL,
  `IDMerk` int(10) UNSIGNED NOT NULL,
  `IDStatusBarang` int(10) UNSIGNED NOT NULL,
  `IsPromo` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BarangXNotaJual`
--

CREATE TABLE `BarangXNotaJual` (
  `ID` int(10) UNSIGNED NOT NULL,
  `IDBarang` int(10) UNSIGNED NOT NULL,
  `IDNotaJual` int(10) UNSIGNED NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `HargaReal` int(11) NOT NULL,
  `SubTotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `DeskripsiPerusahaan`
--

CREATE TABLE `DeskripsiPerusahaan` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Negara` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BatasStock` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `DeskripsiPerusahaan`
--

INSERT INTO `DeskripsiPerusahaan` (`ID`, `Nama`, `Keterangan`, `Alamat`, `Kota`, `Negara`, `Telepon`, `Handphone`, `Email`, `BatasStock`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'MMCKBeauty', 'est 2017\r\nwe sell good quality products.\r\nsafe packaging and free bubble wrap.', 'jalan carina sayang II blok D nomor 4 pluit, penjaringan, jakarta utara', 'Jakarta', 'Indonesia', '0333461451', '081332457044', 'mmckbeauty@gmail.com', 1000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Jabatan`
--

CREATE TABLE `Jabatan` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Jabatan`
--

INSERT INTO `Jabatan` (`ID`, `Nama`, `Keterangan`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Administrator', 1, '2017-08-28 09:03:35', '2017-08-28 09:03:35'),
(2, 'Employee', 'Employee', 1, '2017-08-28 09:08:21', '2017-08-28 09:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `Karyawan`
--

CREATE TABLE `Karyawan` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDUser` int(11) DEFAULT NULL,
  `IDJabatan` int(10) UNSIGNED NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Karyawan`
--

INSERT INTO `Karyawan` (`ID`, `Nama`, `Alamat`, `Kota`, `Telepon`, `Handphone`, `IDUser`, `IDJabatan`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Daiva', 'Ngaglik 17 /16', 'Surabaya', '03137173851', '0', 1, 1, 1, '2017-08-29 08:44:10', '2017-08-29 08:44:10'),
(2, 'Mellysa', 'Jln', 'Jakarta', '031', '0', 19, 1, 1, '2017-11-03 14:08:19', '2017-11-03 14:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `Kategori`
--

CREATE TABLE `Kategori` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Kategori`
--

INSERT INTO `Kategori` (`ID`, `Nama`, `Keterangan`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Eyes', 'Product for eyes', 1, '2017-08-28 06:53:39', '2017-08-28 06:53:39'),
(2, 'Lips', 'Product for lips', 1, '2017-08-28 07:51:09', '2017-08-28 07:51:09'),
(3, 'Face', 'Face', 1, '2017-08-30 03:41:01', '2017-08-30 03:41:01'),
(4, 'Beauty And Skin Care', 'Beauty And Skin Care', 1, '2017-08-30 03:41:08', '2017-08-30 03:41:08'),
(5, 'Sample Size', 'Sample Size', 1, '2017-08-30 03:41:16', '2017-08-30 03:41:16'),
(6, 'The Saem', 'inspired by nature the SAEM', 0, '2017-11-18 09:26:57', '2017-11-18 09:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `Kota`
--

CREATE TABLE `Kota` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDProvinsi` int(10) UNSIGNED NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Merk`
--

CREATE TABLE `Merk` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Merk`
--

INSERT INTO `Merk` (`ID`, `Nama`, `Keterangan`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'The Saem', '', 1, '2017-11-18 09:34:41', '2017-11-18 09:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_08_25_110810_Create_Bank_Table', 1),
(4, '2017_08_25_120122_Create_StatusBarang_Table', 1),
(5, '2017_08_25_120215_Create_Kategori_Table', 1),
(6, '2017_08_25_120216_Create_Sub_Kategori_Table', 1),
(7, '2017_08_25_120232_Create_Merk_Table', 1),
(8, '2017_08_25_120251_Create_Barang_Table', 1),
(9, '2017_08_25_120302_Create_Jabatan_Table', 1),
(10, '2017_08_25_120308_Create_Karyawan_Table', 1),
(11, '2017_08_25_120319_Create_Pembeli_Table', 1),
(12, '2017_08_25_120347_Create_StatusNotaJual_Table', 1),
(13, '2017_08_25_120352_Create_Provinsi_Table', 1),
(14, '2017_08_25_120357_Create_Kota_Table', 1),
(15, '2017_08_25_120406_Create_NotaJual_Table', 1),
(16, '2017_08_25_120457_Create_DeskripsiPerusahaan_Table', 1),
(17, '2017_08_25_120506_Create_SosialMedia_Table', 1),
(18, '2017_08_25_120514_Create_Slider_Table', 1),
(19, '2017_08_25_135244_Create_BarangXNotaJual_Table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `NotaJual`
--

CREATE TABLE `NotaJual` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TanggalBuat` datetime NOT NULL,
  `TotalBarang` int(11) NOT NULL,
  `TotalBerat` int(11) NOT NULL,
  `BiayaKirim` int(11) NOT NULL,
  `TotalAkhir` int(11) NOT NULL,
  `NamaPenerima` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `AlamatPenerima` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Provinsi` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(100) NOT NULL,
  `Kecamatan` varchar(100) DEFAULT NULL,
  `Kelurahan` varchar(100) DEFAULT NULL,
  `KodePos` varchar(10) DEFAULT NULL,
  `Keterangan` varchar(250) DEFAULT NULL,
  `TeleponPenerima` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `HandphonePenerima` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomorRekening` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NamaPemilikRekening` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TanggalTransfer` datetime DEFAULT NULL,
  `TanggalKirim` datetime DEFAULT NULL,
  `TanggalTerima` datetime DEFAULT NULL,
  `NomorResi` varchar(45) DEFAULT NULL,
  `NamaDropshipper` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TeleponDropshipper` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HandphoneDropshipper` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IDBank` int(10) UNSIGNED NOT NULL,
  `IDStatusNotaJual` int(10) UNSIGNED NOT NULL,
  `IDPembeli` int(10) UNSIGNED NOT NULL,
  `IDKaryawan` int(10) UNSIGNED DEFAULT NULL,
  `IsDropship` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Pembeli`
--

CREATE TABLE `Pembeli` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Alamat` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kota` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Handphone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDUser` int(11) DEFAULT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Pembeli`
--

INSERT INTO `Pembeli` (`ID`, `Nama`, `Alamat`, `Kota`, `Telepon`, `Handphone`, `IDUser`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Steven', 'Jln Kapasari I', 'Surabaya', '0313587956', '0848586368', 3, 1, '2017-08-30 05:56:14', '2017-08-30 05:56:14'),
(2, 'Daiva', 'Jln Ngaglik 17 / 16', 'Surabaya', '0358596358', '085635465686', 4, 1, '2017-08-31 01:31:14', '2017-08-31 01:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `Provinsi`
--

CREATE TABLE `Provinsi` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Slider`
--

CREATE TABLE `Slider` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Judul` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Slider`
--

INSERT INTO `Slider` (`ID`, `Nama`, `Judul`, `Keterangan`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'MMC Shopper', 'Korean Beauty Shop', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 1, '2017-08-29 06:15:07', '2017-08-29 06:15:07'),
(2, 'Beauty Korea', 'MMC Shop', 'Promo Summer Sale', 1, '2017-08-29 06:18:51', '2017-08-29 06:18:51'),
(3, 'Daiva Developer', 'Cheap Price', 'Winter Sale', 1, '2017-08-29 06:20:32', '2017-08-29 06:20:32'),
(4, 'Korea Product', 'Korea Product', 'Spring Sale Up To 50%', 1, '2017-08-29 06:25:51', '2017-08-29 06:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `SosialMedia`
--

CREATE TABLE `SosialMedia` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(800) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `SosialMedia`
--

INSERT INTO `SosialMedia` (`ID`, `Nama`, `Keterangan`, `Link`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Instagram', '@mmc.shop', 'http://instagram.com/', 1, '2017-08-29 04:13:18', '2017-08-29 04:13:18'),
(2, 'Line', '@mmc.shop', 'http://line.com/', 1, '2017-08-29 04:13:34', '2017-08-29 04:13:34'),
(3, 'Whatsapp', 'Whatsapp', 'http://whatsapp.com/', 1, '2017-08-29 04:14:03', '2017-08-29 04:14:03'),
(4, 'Facebook', 'mmc.shop', 'http://facebook.com/', 1, '2017-08-29 04:14:24', '2017-08-29 04:14:24'),
(5, 'GooglePlus', 'GooglePlus', 'http:/googleplus.com/', 1, '2017-08-29 04:14:35', '2017-08-29 04:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `StatusBarang`
--

CREATE TABLE `StatusBarang` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `StatusBarang`
--

INSERT INTO `StatusBarang` (`ID`, `Nama`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Netral', 1, '2017-08-29 02:24:32', '2017-08-29 02:24:32'),
(2, 'New', 1, '2017-08-29 02:24:38', '2017-08-29 02:24:38'),
(3, 'Sale', 1, '2017-08-29 02:24:43', '2017-08-29 02:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `StatusNotaJual`
--

CREATE TABLE `StatusNotaJual` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `StatusNotaJual`
--

INSERT INTO `StatusNotaJual` (`ID`, `Nama`, `IsActive`, `created_at`, `updated_at`) VALUES
(1, 'Canceled', 1, '2017-08-29 03:12:33', '2017-08-29 03:12:33'),
(2, 'Waiting For Payment', 1, '2017-08-29 03:12:47', '2017-08-29 03:12:47'),
(3, 'On Process', 1, '2017-08-29 03:13:04', '2017-08-29 03:13:04'),
(4, 'On Delivery', 1, '2017-08-29 03:13:26', '2017-08-29 03:13:26'),
(5, 'Finished', 1, '2017-08-29 03:13:36', '2017-08-29 03:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `SubKategori`
--

CREATE TABLE `SubKategori` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Keterangan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDKategori` int(10) UNSIGNED NOT NULL,
  `IsActive` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'daivalentinenojs@gmail.com', '$2y$10$3/2SPTiwSQTZ/4ksduz4rez56tAF9mXl6NPVZNkcHmh/HEZ6DfgY.', 'eNOrhQQnBBK3BhrkGnPPOquQqPn0MHKnjXNtjndRZUX0zrx98eSZZjckv12z', '2017-08-29 08:44:10', '2017-08-29 08:44:10'),
(3, 'steven@gmail.com', '$2y$10$WcUNoxYsYtq68ikHNkS4HuXampSrzqwOeVuUHCi6Y2mAxD0ewKyU.', NULL, '2017-08-30 05:56:14', '2017-08-30 05:56:14'),
(4, 'daiva@gmail.com', '$2y$10$rhkY9TlmWAAyYY1mj3ta7Oh633A63aOoOL6n7Km8ay/oQgV78BwTm', 'tTEA2UIHOdYlvxPXLoL3sMlHbRYRYWjeP2zS1dUecsl3ZwpoSV52ytVZo5wk', '2017-08-31 01:31:14', '2017-08-31 01:31:14'),
(19, 'mmckbeauty@gmail.com', '$2y$10$.tLiN.koWHBmS.o6.JUZoeOEP.8zMLLy7ZLlqn7heePuhkmpxBt3K', NULL, '2017-11-03 14:08:19', '2017-11-03 14:08:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Bank`
--
ALTER TABLE `Bank`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Barang`
--
ALTER TABLE `Barang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `barang_idsubkategori_foreign` (`IDSubKategori`),
  ADD KEY `barang_idmerk_foreign` (`IDMerk`),
  ADD KEY `barang_idstatusbarang_foreign` (`IDStatusBarang`);

--
-- Indexes for table `BarangXNotaJual`
--
ALTER TABLE `BarangXNotaJual`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `barangxnotajual_idbarang_foreign` (`IDBarang`),
  ADD KEY `barangxnotajual_idnotajual_foreign` (`IDNotaJual`);

--
-- Indexes for table `DeskripsiPerusahaan`
--
ALTER TABLE `DeskripsiPerusahaan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Jabatan`
--
ALTER TABLE `Jabatan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Karyawan`
--
ALTER TABLE `Karyawan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `karyawan_idjabatan_foreign` (`IDJabatan`);

--
-- Indexes for table `Kategori`
--
ALTER TABLE `Kategori`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Kota`
--
ALTER TABLE `Kota`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `kota_idprovinsi_foreign` (`IDProvinsi`);

--
-- Indexes for table `Merk`
--
ALTER TABLE `Merk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `NotaJual`
--
ALTER TABLE `NotaJual`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `notajual_idbank_foreign` (`IDBank`),
  ADD KEY `notajual_idstatusnotajual_foreign` (`IDStatusNotaJual`),
  ADD KEY `notajual_idpembeli_foreign` (`IDPembeli`),
  ADD KEY `notajual_idkaryawan_foreign` (`IDKaryawan`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191)),
  ADD KEY `password_resets_token_index` (`token`(191));

--
-- Indexes for table `Pembeli`
--
ALTER TABLE `Pembeli`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Provinsi`
--
ALTER TABLE `Provinsi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Slider`
--
ALTER TABLE `Slider`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SosialMedia`
--
ALTER TABLE `SosialMedia`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `StatusBarang`
--
ALTER TABLE `StatusBarang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `StatusNotaJual`
--
ALTER TABLE `StatusNotaJual`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `SubKategori`
--
ALTER TABLE `SubKategori`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `subkategori_idkategori_foreign` (`IDKategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Bank`
--
ALTER TABLE `Bank`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Barang`
--
ALTER TABLE `Barang`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BarangXNotaJual`
--
ALTER TABLE `BarangXNotaJual`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `DeskripsiPerusahaan`
--
ALTER TABLE `DeskripsiPerusahaan`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Jabatan`
--
ALTER TABLE `Jabatan`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Karyawan`
--
ALTER TABLE `Karyawan`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Kategori`
--
ALTER TABLE `Kategori`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Kota`
--
ALTER TABLE `Kota`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Merk`
--
ALTER TABLE `Merk`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `NotaJual`
--
ALTER TABLE `NotaJual`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Pembeli`
--
ALTER TABLE `Pembeli`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Provinsi`
--
ALTER TABLE `Provinsi`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Slider`
--
ALTER TABLE `Slider`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `SosialMedia`
--
ALTER TABLE `SosialMedia`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `StatusBarang`
--
ALTER TABLE `StatusBarang`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `StatusNotaJual`
--
ALTER TABLE `StatusNotaJual`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `SubKategori`
--
ALTER TABLE `SubKategori`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Barang`
--
ALTER TABLE `Barang`
  ADD CONSTRAINT `barang_idmerk_foreign` FOREIGN KEY (`IDMerk`) REFERENCES `Merk` (`ID`),
  ADD CONSTRAINT `barang_idstatusbarang_foreign` FOREIGN KEY (`IDStatusBarang`) REFERENCES `StatusBarang` (`ID`),
  ADD CONSTRAINT `barang_idsubkategori_foreign` FOREIGN KEY (`IDSubKategori`) REFERENCES `SubKategori` (`ID`);

--
-- Constraints for table `BarangXNotaJual`
--
ALTER TABLE `BarangXNotaJual`
  ADD CONSTRAINT `barangxnotajual_idbarang_foreign` FOREIGN KEY (`IDBarang`) REFERENCES `Barang` (`ID`),
  ADD CONSTRAINT `barangxnotajual_idnotajual_foreign` FOREIGN KEY (`IDNotaJual`) REFERENCES `NotaJual` (`ID`);

--
-- Constraints for table `Karyawan`
--
ALTER TABLE `Karyawan`
  ADD CONSTRAINT `karyawan_idjabatan_foreign` FOREIGN KEY (`IDJabatan`) REFERENCES `Jabatan` (`ID`);

--
-- Constraints for table `Kota`
--
ALTER TABLE `Kota`
  ADD CONSTRAINT `kota_idprovinsi_foreign` FOREIGN KEY (`IDProvinsi`) REFERENCES `Provinsi` (`ID`);

--
-- Constraints for table `NotaJual`
--
ALTER TABLE `NotaJual`
  ADD CONSTRAINT `notajual_idbank_foreign` FOREIGN KEY (`IDBank`) REFERENCES `Bank` (`ID`),
  ADD CONSTRAINT `notajual_idkaryawan_foreign` FOREIGN KEY (`IDKaryawan`) REFERENCES `Karyawan` (`ID`),
  ADD CONSTRAINT `notajual_idpembeli_foreign` FOREIGN KEY (`IDPembeli`) REFERENCES `Pembeli` (`ID`),
  ADD CONSTRAINT `notajual_idstatusnotajual_foreign` FOREIGN KEY (`IDStatusNotaJual`) REFERENCES `StatusNotaJual` (`ID`);

--
-- Constraints for table `SubKategori`
--
ALTER TABLE `SubKategori`
  ADD CONSTRAINT `subkategori_idkategori_foreign` FOREIGN KEY (`IDKategori`) REFERENCES `Kategori` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
