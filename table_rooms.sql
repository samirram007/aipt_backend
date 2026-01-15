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
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','maintainence') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `rooms_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES ('16e3bb44-f489-44d9-adce-7e74accef7fa','ICU 301','ICU-301','ICU bed with ventilator','301','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('d5101c34-4f07-4f30-b7fc-6c9bcafc5215','ICU 302','ICU-302','ICU bed with monitoring','302','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('c360c994-2517-4245-a7de-e666800007b3','OT 401','OT-401','Major operation theatre','401','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('786423a7-efbb-4ecc-8ff5-bf0856803681','OT 402','OT-402','Minor operation theatre','402','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('36677887-8d2c-42d6-abab-3255c72212ed','Room 101','RM-101','General ward room','101','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('eb708a0b-9131-4c28-a8d7-d28a0f87d389','Room 102','RM-102','General ward room','102','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('887f56eb-b6cf-4fd4-9361-2ce4f6b66e12','Room 103','RM-103','General ward room','103','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('54177208-b9f2-489c-b2b7-9b837a5dcf9e','Room 201','RM-201','Semi-private room','201','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('762daa08-558c-482f-b192-ed9a7e19e783','Room 202','RM-202','Semi-private room','202','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('6ccb563b-31bd-433d-8a84-2295ae2a172e','Room G01','RM-G01','Emergency consultation room','G01','active','2026-01-09 16:27:46','2026-01-09 16:27:46'),('99c5cb3a-ac99-4c73-96a5-f7c01cc0fb7a','Room G02','RM-G02','Triage room','G02','active','2026-01-09 16:27:46','2026-01-09 16:27:46');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-09 22:07:52
