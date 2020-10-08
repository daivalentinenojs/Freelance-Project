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
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'dhiani@staff.ubaya.ac.id','dhiani',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'prijambodo','prijambodo@staff.ubaya.ac.id',0,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'susana@staff.ubaya.ac.id','susana',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'mayalouk@staff.ubaya.ac.id','mayalouk',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'ellysa@staff.ubaya.ac.id','ellysa',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'andre@staff.ubaya.ac.id','andre',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'daniel@staff.ubaya.ac.id','daniel',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'monica@staff.ubaya.ac.id','monica',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'ferdi@staff.ubaya.ac.id','ferdi',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'lisana@staff.ubaya.ac.id','lisana',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'s6134059@student.ubaya.ac.id','daiva',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'s6134111@student.ubaya.ac.id','steven',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'s6134115@student.ubaya.ac.id','aldo',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'s6134087@student.ubaya.ac.id','ika',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'s6134108@student.ubaya.ac.id','christine',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'s6134030@student.ubaya.ac.id','aloysius',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'s6134021@student.ubaya.ac.id','michael',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'s6134040@student.ubaya.ac.id','christian',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'s6134004@student.ubaya.ac.id','andreas',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'s6134020@student.ubaya.ac.id','hadi',1,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
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
