-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: cmc_app_db
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Sport'),(2,'Politika'),(3,'Tehnologija');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `guest_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,9,2,'super!','2024-10-30 22:33:05',''),(2,9,2,':)','2024-10-30 22:33:37',''),(3,11,2,'.','2024-10-30 22:42:16',''),(4,9,2,',,,,\r\n','2024-10-30 22:49:33','');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(45) DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Vesti o Sportu','Danas se održava važna fudbalska utakmica.','2024-10-28 09:54:27','Sport',0),(2,'Tehnološke inovacije','Novi pametni telefon je predstavljen.','2024-10-28 09:54:27','Tehnologija',0),(3,'Vremenska prognoza','Sutra nas očekuje sunčano vreme.','2024-10-28 09:54:27','Vreme',0),(4,'Vremenska prognoza za sutra','Sutra se očekuje sunčano vreme sa temperaturama do 25°C. Idealno za aktivnosti na otvorenom!','2024-10-28 09:56:42','Vreme',0),(5,'Oblačno i kišovito tokom vikenda','Vikend donosi oblačno vreme sa mogućim padavinama, posebno u subotu. Ne zaboravite kišobrane!','2024-10-28 09:56:42','Vreme',0),(6,'Toplotni talas stiže','Meteorolozi najavljuju topao period sa temperaturama iznad 30°C. Preporučuje se izbegavanje boravka na suncu tokom najtoplijih sati.','2024-10-28 09:56:42','Vreme',0),(7,'Vremenska prognoza za narednu nedelju','Naredne nedelje očekuje se promenljivo vreme sa sunčanim i oblačnim danima. Temperatura će varirati od 18°C do 28°C.','2024-10-28 09:56:42','Vreme',0),(8,'Sneg na planinama','U planinskim područjima očekuje se prvi sneg ove zime. Ski centri su spremni za novu sezonu!','2024-10-28 09:56:42','Vreme',0),(9,'\"Fudbalska reprezentacija ostvarila pobedu protiv rivala\"','Fudbalska reprezentacija je u subotu naveče odigrala izvanredan meč protiv svog glavnog rivala. U uzbudljivoj utakmici koja je završila rezultatom 3:1, naši igrači su pokazali izuzetnu tehniku i timsku hemiju. Prvi gol postigao je napadač Marko Jovanović u 15. minutu, dok je kapiten ekipe, Aleksandar Petrović, povisio na 2:0 pre nego što su gosti smanjili razliku. U drugom poluvremenu, naš tim je zadržao kontrolu nad igrom, a treći gol postigao je talentovani vezista Luka Savić. Ova pobeda donosi dodatno samopouzdanje pred predstojeće kvalifikacije za Svetsko prvenstvo','2024-10-30 21:09:10',NULL,1),(10,'\"Nova politika vlade o zaštiti životne sredine\"','Vlada je danas najavila novu politiku usmerenu ka zaštiti životne sredine i smanjenju zagađenja. Ova inicijativa obuhvata niz mera, uključujući povećanje subvencija za obnovljive izvore energije i smanjenje upotrebe plastike. Ministarka za životnu sredinu istakla je važnost očuvanja prirodnih resursa i zdravlja građana. Kritičari su, međutim, izrazili zabrinutost zbog mogućih troškova implementacije ovih mera. Očekuje se da će nova politika biti predstavljena na narednom sastanku u Skupštini, gde će biti dodatno razmatrana.','2024-10-30 21:09:53',NULL,2),(11,'\"Nova generacija pametnih telefona stiže na tržište\"','Jedan od najpoznatijih proizvođača pametnih telefona najavio je lansiranje nove generacije uređaja sa revolucionarnim funkcijama. Ova serija telefona će sadržati unapređene kamere sa većim senzorima i naprednim mogućnostima snimanja videa. Pored toga, uređaji će biti opremljeni najnovijim procesorima koji će omogućiti brže performanse i duži vek trajanja baterije. Očekuje se da će pametni telefoni biti dostupni za kupovinu u narednih mesec dana. Fanovi tehnologije jedva čekaju da isprobaju sve inovacije koje nova serija donosi.','2024-10-30 21:10:36',NULL,3);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$your_hashed_password_here','admin'),(2,'admin2','$2y$10$PzVFnIDF.fiLu9G5Xmu0XeJ5v8E2GKHQbNqrVSyYnIDela1uEMRIK','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-30 22:50:46
