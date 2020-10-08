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
-- Table structure for table `MhsAmbilMk`
--

DROP TABLE IF EXISTS `MhsAmbilMk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MhsAmbilMk` (
  `NRP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `KodeMkBuka` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `KP` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `NTS` smallint(6) NOT NULL,
  `NAS` smallint(6) NOT NULL,
  `NA` double(6,3) NOT NULL,
  `KodeNisbi` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `HadirUTS` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `HadirUAS` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `StatusTilangPresensi` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `PesertaUTS` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `PesertaUAS` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `mhsambilmk_nrp_foreign` (`NRP`),
  KEY `mhsambilmk_kodemkbuka_foreign` (`KodeMkBuka`),
  CONSTRAINT `mhsambilmk_kodemkbuka_foreign` FOREIGN KEY (`KodeMkBuka`) REFERENCES `MkBuka` (`KodeMkBuka`) ON DELETE CASCADE,
  CONSTRAINT `mhsambilmk_nrp_foreign` FOREIGN KEY (`NRP`) REFERENCES `Mahasiswa` (`NRP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MhsAmbilMk`
--

LOCK TABLES `MhsAmbilMk` WRITE;
/*!40000 ALTER TABLE `MhsAmbilMk` DISABLE KEYS */;
INSERT INTO `MhsAmbilMk` VALUES ('6134059','1604A01120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1604A01120161','A',0,0,0.000,'','Y','N','Y','Y','N','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1604A01120161','A',0,0,0.000,'','Y','N','Y','Y','N','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1604A01120161','A',0,0,0.000,'','N','Y','N','N','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1604A01120161','A',0,0,0.000,'','N','N','N','N','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','1604A01120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','1604A01120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A01120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1604A01120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','1604A01120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1604A02120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1604A02120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1604A02120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','1604A02120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','1604A02120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1604A02120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1607A02120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1607A02120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1607A02120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1607A02120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1607A02120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1607A02120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','1607A02120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1604A05120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','1604A05120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','1604A05120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','1604A05120161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1604A05120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1604A05120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A05120161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1604A03220161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1604A03220161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1604A03220161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A03220161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','1604A03220161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1604A03120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1604A03120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1604A03120161','-',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1600A10420161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','1600A10420161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1600A10420161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1600A10420161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','1600A10420161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','1600A10420161','C',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1600A10420161','C',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1600A10420161','D',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1600A10420161','D',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1604A05520161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A05520161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1604A05520161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1604A03320161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','1604A03320161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','1604A03320161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','1604A03320161','A',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A03320161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1604A03320161','B',0,0,0.000,'','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A03220152','A',73,83,79.000,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1604A03220152','A',73,85,80.200,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1604A03120152','A',100,100,100.000,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1604A03120152','A',100,90,94.000,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1600A10420152','A',77,81,79.100,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','1600A10420152','A',81,75,76.900,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1600A10420152','B',80,80,80.000,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','1600A10420152','B',75,75,75.000,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','1604A05520152','A',90,70,78.000,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1604A05520152','A',70,70,70.000,'B','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134004','1604A03320152','A',80,80,80.000,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1604A03320152','A',90,90,90.000,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','1604A03320152','B',80,85,83.000,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','1604A03320152','B',70,75,73.000,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1604A03220151','-',90,95,93.000,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1604A03220151','-',80,85,83.000,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','1600A10420151','A',84,82,82.300,'A','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1600A10420151','A',74,83,79.020,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','1604A05520151','A',73,75,74.200,'AB','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','1604A05520151','A',75,70,72.000,'B','Y','Y','N','Y','Y','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `MhsAmbilMk` ENABLE KEYS */;
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
