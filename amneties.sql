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
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenity_category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;

/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amenity_categories`
--

DROP TABLE IF EXISTS `amenity_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenity_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `amenity_categories_name_unique` (`name`),
  UNIQUE KEY `amenity_categories_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenity_categories`
--

LOCK TABLES `amenity_categories` WRITE;
/*!40000 ALTER TABLE `amenity_categories` DISABLE KEYS */;
INSERT INTO `amenity_categories` VALUES ('0eb25884-dffd-42fa-9769-1972a669c8da','Patient Comfort','PATIENT_COMFORT','Amenities that enhance physical comfort and convenience for patients and attendants','active',NULL,NULL,NULL),('27f0dee5-15bf-4309-9977-97d001528840','Transport & Parking','TRANSPORT_PARKING','Amenities related to patient transport, vehicle access, and parking facilities','active',NULL,NULL,NULL),('3013c541-60d0-434d-a711-27b47a93684e','Wellness & Spiritual','WELLNESS_SPIRITUAL','Amenities that support mental, emotional, and spiritual well-being','active',NULL,NULL,NULL),('607a09e2-7813-4b10-bf9b-aa6903bb73c3','Housekeeping & Hygiene','HOUSEKEEPING_HYGIENE','Amenities supporting cleanliness, infection control, and waste management','active',NULL,NULL,NULL),('63c6978b-15a8-42d7-aacb-2160240254eb','Information & Support','INFORMATION_SUPPORT','Amenities related to guidance, communication, and patient assistance services','active',NULL,NULL,NULL),('6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad','Safety & Security','SAFETY_SECURITY','Amenities that ensure safety, protection, and emergency preparedness','active',NULL,NULL,NULL),('cfeede7f-48e5-4bee-82e5-96d19cfc6763','Accessibility','ACCESSIBILITY','Amenities ensuring barrier-free and inclusive access for all individuals','active',NULL,NULL,NULL),('d54fdae8-d3e4-4591-8071-0da784215bb3','Convenience','CONVENIENCE','Amenities that provide ease of access to essential services within the hospital','active',NULL,NULL,NULL),('e46bba3a-a752-4b4b-822d-86b53ccda679','Family & Visitor','FAMILY_VISITOR','Amenities designed to support attendants and visitors during hospital visits','active',NULL,NULL,NULL);
/*!40000 ALTER TABLE `amenity_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-10 19:06:03
