-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: mob_db
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `mobiteli`
--

DROP TABLE IF EXISTS `mobiteli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mobiteli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proizvodjac_id` int NOT NULL,
  `model` varchar(45) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `godina_proizvodnje` varchar(45) NOT NULL,
  `datum_unosa` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `proizvodjac_id` (`proizvodjac_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobiteli`
--

LOCK TABLES `mobiteli` WRITE;
/*!40000 ALTER TABLE `mobiteli` DISABLE KEYS */;
INSERT INTO `mobiteli` VALUES (1,1,'J5',510.00,'2015','2024-10-30 20:14:28'),(2,2,'11',1200.00,'2020','2024-10-30 20:17:56');
/*!40000 ALTER TABLE `mobiteli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proizvođači`
--

DROP TABLE IF EXISTS `proizvođači`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proizvođači` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ime_proizvođača` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ime_proizvođača` (`ime_proizvođača`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proizvođači`
--

LOCK TABLES `proizvođači` WRITE;
/*!40000 ALTER TABLE `proizvođači` DISABLE KEYS */;
INSERT INTO `proizvođači` VALUES (1,'Samsung'),(2,'Apple'),(3,'Xiaomi'),(4,'Nokia'),(5,'Huawei');
/*!40000 ALTER TABLE `proizvođači` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-30 20:29:37
