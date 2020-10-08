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
-- Table structure for table `SemesterAktif`
--

DROP TABLE IF EXISTS `SemesterAktif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SemesterAktif` (
  `ThnAkademik` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `Semester` enum('Gasal','Genap','Pendek','Trimester3') COLLATE utf8_unicode_ci NOT NULL,
  `GenerateBayar` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `TglAwalKuliah` date NOT NULL,
  `TglAkhirKuliah` date NOT NULL,
  `TglAwalLulus` date NOT NULL,
  `TglAkhirLulus` date NOT NULL,
  `TglPembagianKHS` date DEFAULT NULL,
  `SudahProsesTilang` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL,
  `BatasInputNTS` date NOT NULL,
  `BatasInputNAS` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ThnAkademik`,`Semester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SemesterAktif`
--

LOCK TABLES `SemesterAktif` WRITE;
/*!40000 ALTER TABLE `SemesterAktif` DISABLE KEYS */;
INSERT INTO `SemesterAktif` VALUES ('2015','Gasal','','2015-08-18','2015-12-04','2015-08-17','2016-05-12','0000-00-00','','2016-01-19','2016-01-19','0000-00-00 00:00:00','0000-00-00 00:00:00'),('2015','Genap','','2016-02-15','2016-06-03','2016-05-24','2016-08-12','0000-00-00','','2016-07-25','2016-07-25','0000-00-00 00:00:00','0000-00-00 00:00:00'),('2016','Gasal','','2016-08-15','2016-12-02','2016-08-19','2017-02-10','0000-00-00','','2016-11-20','2017-01-06','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `SemesterAktif` ENABLE KEYS */;
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
