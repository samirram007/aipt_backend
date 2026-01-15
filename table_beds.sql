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
-- Table structure for table `beds`
--

DROP TABLE IF EXISTS `beds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `beds` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('available','occupied','booked','maintenance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `beds_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beds`
--

LOCK TABLES `beds` WRITE;
/*!40000 ALTER TABLE `beds` DISABLE KEYS */;
INSERT INTO `beds` VALUES ('7e8a6441-0173-4d3a-a819-0c306949a757','Bed A','BED-101-A','Left side bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('f8f4b107-1ec0-4dbf-bfc4-c974cefda46c','Bed B','BED-101-B','Right side bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('1d012652-8b87-4b0a-b670-51aac9dec8fb','Bed A','BED-102-A','Near window bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('f7b72c64-ed02-4576-bf25-17176ad068bf','Bed B','BED-102-B','Near door bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('a785e3b3-e17a-4a9c-baec-c65a2bcede5d','Bed A','BED-103-A','Standard bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('395cc060-09f5-4680-ab8a-6934603617da','Bed B','BED-103-B','Standard bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('7fd54af2-9104-4cef-9cdf-9015968dc471','Bed 1','ICU-301-1','Ventilator-supported bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('11f8a9f3-9c55-443a-9ca1-b035fc052f90','Bed 2','ICU-301-2','Monitoring-supported bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('7d2e6aef-6943-4460-bc5b-5d8910129be9','Recovery Bed 1','REC-401-1','Post-operation recovery bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46'),('d9ece7f6-7de5-4708-96e3-1033e41fdeba','Recovery Bed 2','REC-401-2','Post-operation recovery bed','available','2026-01-09 16:27:46','2026-01-09 16:27:46');
/*!40000 ALTER TABLE `beds` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-09 22:19:11
