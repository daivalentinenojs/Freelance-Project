CREATE DATABASE  IF NOT EXISTS `RekapNilai` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `RekapNilai`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: RekapNilai
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
-- Table structure for table `NilaiPerubahan`
--

DROP TABLE IF EXISTS `NilaiPerubahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NilaiPerubahan` (
  `VersiUbah` bigint(20) NOT NULL,
  `KodeMkBuka` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `KP` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `TglUbah` date NOT NULL,
  `NoSurat` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `TglSurat` date NOT NULL,
  `NilaiLama` smallint(6) NOT NULL,
  `NilaiBaru` smallint(6) NOT NULL,
  `KodeNilai` char(21) COLLATE utf8_unicode_ci NOT NULL,
  `KodeNisbiLama` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `KodeNisbiBaru` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Keterangan` text COLLATE utf8_unicode_ci NOT NULL,
  `NRP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `NPK` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`VersiUbah`),
  KEY `nilaiperubahan_kodenilai_foreign` (`KodeNilai`),
  CONSTRAINT `nilaiperubahan_kodenilai_foreign` FOREIGN KEY (`KodeNilai`) REFERENCES `Nilai` (`KodeNilai`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NilaiPerubahan`
--

LOCK TABLES `NilaiPerubahan` WRITE;
/*!40000 ALTER TABLE `NilaiPerubahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `NilaiPerubahan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-05 17:11:43
