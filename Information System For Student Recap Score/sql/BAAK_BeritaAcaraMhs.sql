CREATE DATABASE  IF NOT EXISTS `BAAK` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `BAAK`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: BAAK
-- ------------------------------------------------------
-- Server version	5.7.12-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `BeritaAcaraMhs`
--

DROP TABLE IF EXISTS `BeritaAcaraMhs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BeritaAcaraMhs` (
  `NRP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `IdBeritaAcara` bigint(20) NOT NULL,
  `Jenis` enum('Tidak Hadir','Izin') COLLATE utf8_unicode_ci NOT NULL,
  `NoSuratIjin` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `TglSuratIjin` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `beritaacaramhs_nrp_foreign` (`NRP`),
  KEY `beritaacaramhs_idberitaacara_foreign` (`IdBeritaAcara`),
  CONSTRAINT `beritaacaramhs_idberitaacara_foreign` FOREIGN KEY (`IdBeritaAcara`) REFERENCES `BeritaAcara` (`IdBeritaAcara`) ON DELETE CASCADE,
  CONSTRAINT `beritaacaramhs_nrp_foreign` FOREIGN KEY (`NRP`) REFERENCES `Mahasiswa` (`NRP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BeritaAcaraMhs`
--

LOCK TABLES `BeritaAcaraMhs` WRITE;
/*!40000 ALTER TABLE `BeritaAcaraMhs` DISABLE KEYS */;
INSERT INTO `BeritaAcaraMhs` VALUES ('6134020',21,'Tidak Hadir','','0000-00-00','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004',21,'Tidak Hadir','','0000-00-00','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111',36,'Tidak Hadir','','0000-00-00','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115',36,'Izin','FX/02/01/2016','2016-12-10','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004',36,'Tidak Hadir','','0000-00-00','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `BeritaAcaraMhs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-05 17:11:42
