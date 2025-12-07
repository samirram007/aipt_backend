-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table aipt.account_groups: ~0 rows (approximately)

-- Dumping data for table aipt.account_ledgers: ~0 rows (approximately)

-- Dumping data for table aipt.account_types: ~0 rows (approximately)

-- Dumping data for table aipt.cache: ~0 rows (approximately)

-- Dumping data for table aipt.cache_locks: ~0 rows (approximately)

-- Dumping data for table aipt.companies: ~0 rows (approximately)

-- Dumping data for table aipt.company_types: ~0 rows (approximately)

-- Dumping data for table aipt.countries: ~0 rows (approximately)

-- Dumping data for table aipt.currencies: ~0 rows (approximately)

-- Dumping data for table aipt.failed_jobs: ~0 rows (approximately)

-- Dumping data for table aipt.fiscal_years: ~0 rows (approximately)

-- Dumping data for table aipt.jobs: ~0 rows (approximately)

-- Dumping data for table aipt.job_batches: ~0 rows (approximately)

-- Dumping data for table aipt.journals: ~0 rows (approximately)

-- Dumping data for table aipt.languages: ~0 rows (approximately)

-- Dumping data for table aipt.migrations: ~1 rows (approximately)


-- Dumping data for table aipt.modules: ~0 rows (approximately)

-- Dumping data for table aipt.password_reset_tokens: ~0 rows (approximately)

-- Dumping data for table aipt.permissions: ~0 rows (approximately)

-- Dumping data for table aipt.personal_access_tokens: ~0 rows (approximately)

-- Dumping data for table aipt.roles: ~0 rows (approximately)

-- Dumping data for table aipt.sessions: ~0 rows (approximately)

-- Dumping data for table aipt.settings: ~0 rows (approximately)

-- Dumping data for table aipt.states: ~0 rows (approximately)

-- Dumping data for table aipt.telescope_entries: ~0 rows (approximately)

-- Dumping data for table aipt.telescope_entries_tags: ~0 rows (approximately)

-- Dumping data for table aipt.telescope_monitoring: ~0 rows (approximately)

-- Dumping data for table aipt.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`,`username`,`user_type`, `email`, `email_verified_at`, `password`, `remember_token`,`status`, `created_at`, `updated_at`) VALUES
	(1, 'Admin User', 'admin@admin.com','admin', 'admin@admin.com', '2025-06-14 17:39:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yaQRzRT1BQ','active', '2025-06-14 17:39:14', '2025-06-14 17:39:14'),
	(2, 'Manager User', 'manager@admin.com', 'user','manager@admin.com', '2025-06-14 17:39:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zuUppGB7Bl','active', '2025-06-14 17:39:14', '2025-06-14 17:39:14'),
    (3, 'Employee User', 'employee@employee.com','admin', 'employee@employee.com', '2025-06-14 17:39:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yaQRzRT1BQ','active', '2025-06-14 17:39:14', '2025-06-14 17:39:14'),
    (4, 'Priyanshu', 'priyanshu@employee.com','admin', 'priyanshu@employee.com', '2025-06-14 17:39:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yaQRzRT1BQ','active', '2025-06-14 17:39:14', '2025-06-14 17:39:14');



INSERT INTO `shifts` (`id`, `name`, `code`, `status`, `icon`, `created_at`, `updated_at`) VALUES
	(101, 'Morning Shift', 'MS', 'active', NULL, '2025-10-12 22:03:40', '2025-10-12 22:03:40'),
	(102, 'Day Shift', 'DS', 'active', NULL, '2025-10-12 22:05:41', '2025-10-12 22:05:41'),
	(103, 'Evening Shift', 'ES', 'active', NULL, '2025-10-12 22:05:50', '2025-10-12 22:05:50'),
	(104, 'Night Shift', 'NS', 'active', NULL, '2025-10-12 22:06:02', '2025-10-12 22:06:02');


-- Dumping data for table aipt.vouchers: ~0 rows (approximately)

-- Dumping data for table aipt.voucher_types: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
