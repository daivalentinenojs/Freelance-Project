CREATE DATABASE  IF NOT EXISTS `myUbaya` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `myUbaya`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: myUbaya
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
-- Table structure for table `baak_NilaiMahasiswa`
--

DROP TABLE IF EXISTS `baak_NilaiMahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `baak_NilaiMahasiswa` (
  `KodeNilai` char(21) COLLATE utf8_unicode_ci NOT NULL,
  `NRP` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Nilai` smallint(6) NOT NULL,
  `KodeNisbi` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `baak_nilaimahasiswa_kodenilai_foreign` (`KodeNilai`),
  CONSTRAINT `baak_nilaimahasiswa_kodenilai_foreign` FOREIGN KEY (`KodeNilai`) REFERENCES `baak_Nilai` (`KodeNilai`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `baak_NilaiMahasiswa`
--

LOCK TABLES `baak_NilaiMahasiswa` WRITE;
/*!40000 ALTER TABLE `baak_NilaiMahasiswa` DISABLE KEYS */;
INSERT INTO `baak_NilaiMahasiswa` VALUES ('001604A032201520AT001','6134021',73,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AT001','6134040',73,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AA002','6134021',83,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AA002','6134040',85,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A031201520AT001','6134059',100,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A031201520AT001','6134111',100,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A031201520AA002','6134059',100,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A031201520AA002','6134111',90,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AT001','6134059',77,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AT001','6134040',81,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AA002','6134059',81,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AA002','6134040',75,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BT001','6134111',80,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BT001','6134020',75,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BA002','6134111',80,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BA002','6134020',75,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201520AT001','6134021',90,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201520AT001','6134059',70,'B','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201520AA002','6134021',70,'B','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201520AA002','6134059',70,'B','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520AT001','6134004',80,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520AT001','6134059',90,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520AA002','6134004',80,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520AA002','6134059',90,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520BT001','6134108',80,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520BT001','6134087',70,'B','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520BA002','6134108',85,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520BA002','6134087',75,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201510-T001','6134059',90,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201510-T001','6134111',80,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201510-A002','6134059',95,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201510-A002','6134111',85,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201510AT001','6134059',84,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201510AT001','6134115',74,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201510AA002','6134059',82,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201510AA002','6134115',83,'A','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201510AT001','6134111',73,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201510AT001','6134115',75,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201510AA002','6134111',75,'AB','0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201510AA002','6134115',70,'B','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `baak_NilaiMahasiswa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-05 17:11:40
