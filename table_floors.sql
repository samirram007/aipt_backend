-- MySQL dump 10.13  Distrib 8.0.43, for macos15 (arm64)
--
-- Host: localhost    Database: aipt_online
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `floors`
--

DROP TABLE IF EXISTS `floors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `floors` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','maintenance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `floor_number` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `floors_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floors`
--

LOCK TABLES `floors` WRITE;
/*!40000 ALTER TABLE `floors` DISABLE KEYS */;
INSERT INTO `floors` VALUES ('4247b27c-4711-494f-8f09-172bd9557d37','First Floor','FLOOR-1','Main inpatient floor','active',1,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('d881f591-eabc-4b04-9ae3-80922b5dbb9a','Second Floor','FLOOR-2','General wards','active',2,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('2a0d6f69-cd32-4d80-9e6c-699f4c157aab','Third Floor','FLOOR-3','ICU and critical care','active',3,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('77262084-b88d-4d50-ba38-840b09348817','Fourth Floor','FLOOR-4','Operation theatres','active',4,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('7ef4a210-206a-4234-8f1a-09de3d697f94','Fifth Floor','FLOOR-5','Private rooms','active',5,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('ba6a1538-0fdc-4670-b650-6fef19d7d476','Sixth Floor','FLOOR-6','Administration offices','active',6,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('c9c6f86d-637a-4594-afe0-6dfc33f40bd4','Seventh Floor','FLOOR-7','Staff accommodation','active',7,'2026-01-09 16:27:46','2026-01-09 16:27:46'),('629a3074-f95f-4cbe-b330-23824d088e8c','Ground Floor','FLOOR-G','Reception and emergency services','active',0,'2026-01-09 16:27:46','2026-01-09 16:27:46');
/*!40000 ALTER TABLE `floors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-09 22:19:47
