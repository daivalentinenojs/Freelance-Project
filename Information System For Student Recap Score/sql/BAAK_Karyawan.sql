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
-- Table structure for table `Karyawan`
--

DROP TABLE IF EXISTS `Karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Karyawan` (
  `NPK` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Nama` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `IdUser` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`NPK`),
  KEY `karyawan_iduser_foreign` (`IdUser`),
  CONSTRAINT `karyawan_iduser_foreign` FOREIGN KEY (`IdUser`) REFERENCES `User` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Karyawan`
--

LOCK TABLES `Karyawan` WRITE;
/*!40000 ALTER TABLE `Karyawan` DISABLE KEYS */;
INSERT INTO `Karyawan` VALUES ('187018','Ir. Bambang Prijambodo, M.MT.',2,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('197030','Susana Limanto, S.T., M.Si.',3,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('199013','Lisana, S.Kom., M.Inf.Tech.',10,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('202017','Dhiani Tresna Absari, S.T., M.Kom.',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('203014','Ellysa Tjandra, S.T., M.MT.',5,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('204027','Monica Widiasri, S.Kom., M.Kom.',8,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('208020','Andre, S.T., M.Sc.',6,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('209344','Daniel Soesanto, S.T., M.M',7,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('209345','Marcellinus Ferdinand Suciadi, S.T., M.C',9,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('215027','Maya Hilda Lestari Louk, S.T., M.Sc.',4,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `Karyawan` ENABLE KEYS */;
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
