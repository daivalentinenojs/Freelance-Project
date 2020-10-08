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
-- Table structure for table `Mahasiswa`
--

DROP TABLE IF EXISTS `Mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mahasiswa` (
  `NRP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Nama` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ThnAkademikTerima` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `SemesterTerima` enum('Gasal','Genap') COLLATE utf8_unicode_ci NOT NULL,
  `IdUser` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`NRP`),
  KEY `mahasiswa_iduser_foreign` (`IdUser`),
  CONSTRAINT `mahasiswa_iduser_foreign` FOREIGN KEY (`IdUser`) REFERENCES `User` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Mahasiswa`
--

LOCK TABLES `Mahasiswa` WRITE;
/*!40000 ALTER TABLE `Mahasiswa` DISABLE KEYS */;
INSERT INTO `Mahasiswa` VALUES ('6134004','Andreas Teja','2012','Gasal',19,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134020','Hadi Kusuma Poernomo','2012','Gasal',20,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134021','Michael Poernomo','2012','Gasal',17,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134030','Aloysius Wiranata','2012','Gasal',16,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134040','Christian Alexander','2012','Gasal',18,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134059','Daivalentineno Janitra Salim','2012','Gasal',11,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134087','Ika Suryani Kusuma','2012','Gasal',14,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134108','Christine Tandiwijaya','2012','Gasal',15,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134111','Steven Brian Susantio','2012','Gasal',12,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('6134115','Eduardus Aldo','2012','Gasal',13,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `Mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-05 17:11:41
