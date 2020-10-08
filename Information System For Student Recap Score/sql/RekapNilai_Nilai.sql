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
-- Table structure for table `Nilai`
--

DROP TABLE IF EXISTS `Nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Nilai` (
  `KodeNilai` char(21) COLLATE utf8_unicode_ci NOT NULL,
  `KodeMkBuka` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `KP` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Jenis` enum('QuizUTS','QuizUAS','TugasUTS','TugasUAS','ProyekUTS','ProyekUAS','KeaktifanUTS’','KeaktifanUAS’','UTS','UAS') COLLATE utf8_unicode_ci NOT NULL,
  `Bobot` double(6,3) NOT NULL,
  `WaktuBuat` date NOT NULL,
  `WaktuValidasiDosen` date NOT NULL,
  `WaktuValidasiAdmik` date NOT NULL,
  `DosenPembuat` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `AdmikValidator` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `Status` enum('BelumInput','Daftar','TelahDiKalkulasi','SiapUpload','TelahDiUpload') COLLATE utf8_unicode_ci NOT NULL,
  `Syarat` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`KodeNilai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Nilai`
--

LOCK TABLES `Nilai` WRITE;
/*!40000 ALTER TABLE `Nilai` DISABLE KEYS */;
INSERT INTO `Nilai` VALUES ('001600A104201510AA004','1600A10420151','A','UAS',100.000,'2015-10-11','2015-10-12','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201510AT003','1600A10420151','A','UTS',100.000,'2015-10-11','2015-10-12','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AA004','1600A10420152','A','UTS',70.000,'2016-04-25','2016-04-26','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AA006','1600A10420152','A','UAS',70.000,'2016-06-08','2016-06-09','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AT003','1600A10420152','A','QuizUTS',30.000,'2016-04-25','2016-04-26','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520AT005','1600A10420152','A','QuizUAS',30.000,'2016-06-08','2016-06-09','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BA004','1600A10420152','B','UTS',70.000,'2016-04-25','2016-04-26','0000-00-00','197030','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BA006','1600A10420152','B','UAS',70.000,'2016-06-08','2016-06-09','0000-00-00','197030','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BT003','1600A10420152','B','QuizUTS',30.000,'2016-04-25','2016-04-26','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201520BT005','1600A10420152','B','QuizUAS',30.000,'2016-06-08','2016-06-09','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001600A104201610AT001','1600A10420161','A','QuizUTS',40.000,'2016-11-04','0000-00-00','0000-00-00','204027','','BelumInput',1,'2016-11-03 18:59:38','2016-11-03 18:59:38'),('001600A104201610BT001','1600A10420161','B','QuizUTS',40.000,'2016-11-04','0000-00-00','0000-00-00','204027','','BelumInput',1,'2016-11-03 18:59:38','2016-11-03 18:59:38'),('001600A104201610CT001','1600A10420161','C','QuizUTS',40.000,'2016-11-04','0000-00-00','0000-00-00','204027','','BelumInput',1,'2016-11-03 18:59:38','2016-11-03 18:59:38'),('001600A104201610DT001','1600A10420161','D','QuizUTS',40.000,'2016-11-04','0000-00-00','0000-00-00','204027','','BelumInput',1,'2016-11-03 18:59:38','2016-11-03 18:59:38'),('001604A031201520AA004','1604A03120152','A','UAS',100.000,'2016-06-08','2016-06-09','0000-00-00','197030','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A031201520AT003','1604A03120152','A','UTS',100.000,'2016-04-25','2016-04-26','0000-00-00','197030','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201510-A004','1604A03220151','-','UAS',100.000,'2015-10-11','2015-10-12','0000-00-00','215027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201510-T003','1604A03220151','-','UTS',100.000,'2015-10-11','2015-10-12','0000-00-00','215027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AA004','1604A03220152','A','UTS',70.000,'2016-04-25','2016-04-26','0000-00-00','209345','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AA005','1604A03220152','A','ProyekUAS',0.000,'2016-06-08','2016-06-09','0000-00-00','209345','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AA006','1604A03220152','A','UAS',60.000,'2016-06-08','2016-06-09','0000-00-00','209345','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A032201520AT003','1604A03220152','A','QuizUTS',30.000,'2016-04-25','2016-04-26','0000-00-00','209345','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520AA004','1604A03320152','A','ProyekUAS',100.000,'2016-06-08','2016-06-09','0000-00-00','208020','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520AT003','1604A03320152','A','ProyekUTS',100.000,'2016-04-25','2016-04-26','0000-00-00','208020','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520BA004','1604A03320152','B','ProyekUAS',100.000,'2016-06-08','2016-06-09','0000-00-00','208020','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A033201520BT003','1604A03320152','B','ProyekUTS',100.000,'2016-04-25','2016-04-26','0000-00-00','208020','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201510AA004','1604A05520151','A','UAS',100.000,'2015-10-11','2015-10-12','0000-00-00','197030','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201510AT003','1604A05520151','A','UTS',100.000,'2015-10-11','2015-10-12','0000-00-00','197030','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201520AA004','1604A05520152','A','UAS',100.000,'2016-06-08','2016-06-09','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),('001604A055201520AT003','1604A05520152','A','UTS',100.000,'2016-04-25','2016-04-26','0000-00-00','204027','','TelahDiUpload',1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `Nilai` ENABLE KEYS */;
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
