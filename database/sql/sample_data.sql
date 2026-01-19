-- drop database aipt_online;
-- create database aipt_online;
use aipt_online;


INSERT INTO `users` (`id`, `name`,`username`,`user_type`, `email`, `email_verified_at`, `password`, `remember_token`,`status`, `created_at`, `updated_at`) VALUES
	(1, 'Admin User', 'admin@admin.com','admin', 'admin@admin.com', '2025-06-14 17:39:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'yaQRzRT1BQ','active', '2025-06-14 17:39:14', '2025-06-14 17:39:14'),
	(2, 'Manager User', 'manager@admin.com', 'user','manager@admin.com', '2025-06-14 17:39:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zuUppGB7Bl','active', '2025-06-14 17:39:14', '2025-06-14 17:39:14');


INSERT INTO `shifts` (`id`, `name`, `code`, `status`, `icon`, `created_at`, `updated_at`) VALUES
	(101, 'Morning Shift', 'MS', 'active', NULL, '2025-10-12 22:03:40', '2025-10-12 22:03:40'),
	(102, 'Day Shift', 'DS', 'active', NULL, '2025-10-12 22:05:41', '2025-10-12 22:05:41'),
	(103, 'Evening Shift', 'ES', 'active', NULL, '2025-10-12 22:05:50', '2025-10-12 22:05:50'),
	(104, 'Night Shift', 'NS', 'active', NULL, '2025-10-12 22:06:02', '2025-10-12 22:06:02');



-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.8.3-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------



-- Dumping data for table aipt.app_modules: ~43 rows (approximately)
INSERT IGNORE INTO `app_modules` (`id`, `name`, `code`, `description`, `status`, `icon`, `created_at`, `updated_at`) VALUES
	(10000, 'AUTHENTICATION', 'AUTHENTICATION', 'Manage users, roles, and permissions', 'active', 'users', '2025-10-18 09:00:48', '2025-10-18 09:00:48'),
	(10001, 'Finance', 'FINANCE', 'Handles financial transactions, invoices, and ledgers', 'active', 'wallet', '2025-10-18 09:00:48', '2025-10-18 09:00:48'),
	(10002, 'Inventory', 'INVENTORY', 'Manages stock items, batches, and warehouse data', 'active', 'boxes', '2025-10-18 09:00:48', '2025-10-18 09:00:48'),
	(10003, 'Sales', 'SALES', 'Sales orders, customers, and billing operations', 'active', 'shopping-cart', '2025-10-18 09:00:48', '2025-10-18 09:00:48'),
	(10004, 'Purchase', 'PURCHASE', 'Supplier management and purchase order tracking', 'active', 'shopping-bag', '2025-10-18 09:00:48', '2025-10-18 09:00:48'),
	(10005, 'Reports', 'REPORTS', 'System-wide reporting and analytics', 'active', 'bar-chart', '2025-10-18 09:00:48', '2025-10-18 09:00:48'),
	(10006, 'Account Group', 'ACCOUNT_GROUP', 'ACCOUNT_GROUP', 'active', NULL, '2025-10-20 00:13:11', '2025-10-20 00:13:11'),
	(10007, 'Account Ledger', 'ACCOUNT_LEDGER', 'ACCOUNT_GROUP', 'active', NULL, '2025-10-20 00:13:32', '2025-10-20 00:13:32'),
	(10008, 'Accounting Period', 'ACCOUNTING_PERIOD', 'ACCOUNTING_PERIOD', 'active', NULL, '2025-10-20 00:14:17', '2025-10-20 00:14:17'),
	(10009, 'Account Nature', 'ACCOUNT_NATURE', 'ACCOUNT_NATURE', 'active', NULL, '2025-10-20 00:14:40', '2025-10-20 00:14:40'),
	(10010, 'Accounts Journal', 'ACCOUNTS_JOURNAL', 'ACCOUNTS_JOURNAL', 'active', NULL, '2025-10-20 00:15:02', '2025-10-20 00:15:02'),
	(10011, 'Address', 'ADDRESS', 'ADDRESS', 'active', NULL, '2025-10-20 00:15:16', '2025-10-20 00:15:16'),
	(10012, 'Agent', 'AGENT', 'Agent', 'active', NULL, '2025-10-20 00:15:55', '2025-10-20 00:15:55'),
	(10013, 'App Module', 'APP_MODULE', 'APP_MODULE', 'active', NULL, '2025-10-20 00:22:07', '2025-10-20 00:22:07'),
	(10014, 'App Module Feature', 'APP_MODULE_FEATURE', 'APP_MODULE_FEATURE', 'active', NULL, '2025-10-20 00:22:32', '2025-10-20 00:22:32'),
	(10015, 'Company', 'COMPANY', 'COMPANY', 'active', NULL, '2025-10-20 00:22:45', '2025-10-20 00:22:45'),
	(10016, 'Company Type', 'COMPANY_TYPE', 'COMPANY_TYPE', 'active', NULL, '2025-10-20 00:23:04', '2025-10-20 00:23:04'),
	(10017, 'Country', 'COUNTRY', 'COUNTRY', 'active', NULL, '2025-10-20 00:23:19', '2025-10-20 00:23:19'),
	(10018, 'Currency', 'CURRENCY', 'CURRENCY', 'active', NULL, '2025-10-20 00:23:32', '2025-10-20 00:23:32'),
	(10019, 'Department', 'DEPARTMENT', 'DEPARTMENT', 'active', NULL, '2025-10-20 00:23:46', '2025-10-20 00:23:46'),
	(10020, 'Designation', 'DESIGNATION', 'DESIGNATION', 'active', NULL, '2025-10-20 00:23:57', '2025-10-20 00:23:57'),
	(10021, 'Distributor', 'DISTRIBUTOR', 'DISTRIBUTOR', 'active', NULL, '2025-10-20 00:24:14', '2025-10-20 00:24:14'),
	(10022, 'Employee', 'EMPLOYEE', 'EMPLOYEE', 'active', NULL, '2025-10-20 00:24:30', '2025-10-20 00:24:30'),
	(10023, 'Employee Group', 'EMPLOYEE_GROUP', 'EMPLOYEE_GROUP', 'active', NULL, '2025-10-20 00:26:09', '2025-10-20 00:26:09'),
	(10024, 'Godown', 'GODOWN', 'GODOWN', 'active', NULL, '2025-10-20 00:26:17', '2025-10-20 00:26:27'),
	(10025, 'Grade', 'GRADE', 'GRADE', 'active', NULL, '2025-10-20 00:28:27', '2025-10-20 00:28:48'),
	(10026, 'Hsn Sac Code', 'HSN_SAC_CODE', 'HSN_SAC_CODE', 'active', NULL, '2025-10-20 00:29:18', '2025-10-20 00:30:45'),
	(10027, 'Permission', 'PERMISSION', 'PERMISSION', 'active', NULL, '2025-10-20 00:30:59', '2025-10-20 00:30:59'),
	(10028, 'Role', 'ROLE', 'ROLE', 'active', NULL, '2025-10-20 00:31:08', '2025-10-20 00:31:08'),
	(10029, 'Shift', 'SHIFT', 'SHIFT', 'active', NULL, '2025-10-20 00:31:17', '2025-10-20 00:31:17'),
	(10030, 'State', 'STATE', 'STATE', 'active', NULL, '2025-10-20 00:31:26', '2025-10-20 00:31:26'),
	(10031, 'Stock Category', 'STOCK_CATEGORY', 'STOCK_CATEGORY', 'active', NULL, '2025-10-20 00:31:41', '2025-10-20 00:31:41'),
	(10032, 'Stock Group', 'STOCK_GROUP', 'STOCK_GROUP', 'active', NULL, '2025-10-20 00:31:52', '2025-10-20 00:31:52'),
	(10033, 'Stock Item', 'STOCK_ITEM', 'STOCK_ITEM', 'active', NULL, '2025-10-20 00:32:03', '2025-10-20 00:32:03'),
	(10034, 'Stock Unit', 'STOCK_UNIT', 'STOCK_UNIT', 'active', NULL, '2025-10-20 00:32:15', '2025-10-20 00:32:15'),
	(10035, 'Supplier', 'SUPPLIER', 'SUPPLIER', 'active', NULL, '2025-10-20 00:32:28', '2025-10-20 00:32:28'),
	(10036, 'Transporter', 'TRANSPORTER', 'TRANSPORTER', 'active', NULL, '2025-10-20 00:32:38', '2025-10-20 00:32:38'),
	(10037, 'Unique Quantity Code', 'UNIQUE_QUANTITY_CODE', 'UNIQUE_QUANTITY_CODE', 'active', NULL, '2025-10-20 00:32:56', '2025-10-20 00:32:56'),
	(10038, 'User', 'USER', 'USER', 'active', NULL, '2025-10-20 00:33:08', '2025-10-20 00:33:08'),
	(10039, 'Voucher', 'VOUCHER', 'VOUCHER', 'active', NULL, '2025-10-20 00:33:22', '2025-10-20 00:33:22'),
	(10040, 'Voucher Category', 'VOUCHER_CATEGORY', 'VOUCHER_CATEGORY', 'active', NULL, '2025-10-20 00:33:35', '2025-10-20 00:33:35'),
	(10041, 'Voucher Classification', 'VOUCHER_CLASSIFICATION', 'VOUCHER_CLASSIFICATION', 'active', NULL, '2025-10-20 00:33:45', '2025-10-20 00:33:45'),
	(10042, 'Voucher Type', 'VOUCHER_TYPE', 'VOUCHER_TYPE', 'active', NULL, '2025-10-20 00:34:01', '2025-10-20 00:34:01');


INSERT IGNORE INTO `app_module_features` (`id`, `app_module_id`, `name`, `code`, `description`, `status`, `action`, `created_at`, `updated_at`) VALUES
	(1, 10000, 'Sign in', 'AUTHENTICATION_SIGN_IN', 'AUTHENTICATION_SIGN_IN', 'active', NULL, '2025-10-20 01:12:02', '2025-10-20 01:12:02'),
	(2, 10006, 'Create', 'ACCOUNT_GROUP_CREATE', 'ACCOUNT_GROUP_CREATE', 'active', NULL, '2025-10-20 01:16:35', '2025-10-20 02:16:05'),
	(6, 10006, 'Edit', 'ACCOUNT_GROUP_EDIT', 'ACCOUNT_GROUP_EDIT', 'active', NULL, '2025-10-20 02:03:48', '2025-10-20 02:03:48'),
	(7, 10006, 'Delete', 'ACCOUNT_GROUP_DELETE', 'ACCOUNT_GROUP_DELETE', 'active', NULL, '2025-10-20 02:03:54', '2025-10-20 02:03:54'),
	(8, 10007, 'Delete', 'ACCOUNT_LEDGER_DELETE', 'ACCOUNT_LEDGER_DELETE', 'active', NULL, '2025-10-20 02:14:19', '2025-10-20 02:16:29'),
	(9, 10008, 'Create', 'ACCOUNTING_PERIOD_CREATE', 'ACCOUNTING_PERIOD_CREATE', 'active', NULL, '2025-10-20 02:25:19', '2025-10-20 02:25:19'),
	(10, 10008, 'Edit', 'ACCOUNTING_PERIOD_EDIT', 'ACCOUNTING_PERIOD_EDIT', 'active', NULL, '2025-10-20 02:25:22', '2025-10-20 02:25:22'),
	(11, 10008, 'Delete', 'ACCOUNTING_PERIOD_DELETE', 'ACCOUNTING_PERIOD_DELETE', 'active', NULL, '2025-10-20 02:25:24', '2025-10-20 02:25:24'),
	(12, 10009, 'Create', 'ACCOUNT_NATURE_CREATE', 'ACCOUNT_NATURE_CREATE', 'active', NULL, '2025-10-20 02:25:39', '2025-10-20 02:25:39'),
	(13, 10009, 'Edit', 'ACCOUNT_NATURE_EDIT', 'ACCOUNT_NATURE_EDIT', 'active', NULL, '2025-10-20 02:25:41', '2025-10-20 02:25:41'),
	(14, 10009, 'Delete', 'ACCOUNT_NATURE_DELETE', 'ACCOUNT_NATURE_DELETE', 'active', NULL, '2025-10-20 02:25:43', '2025-10-20 02:25:43');



-- DROP TABLE IF EXISTS `account_groups`;
-- CREATE TABLE IF NOT EXISTS `account_groups` (
--   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
--   `name` varchar(191) NOT NULL,
--   `code` varchar(191) DEFAULT NULL,
--   `parent_id` bigint(20) unsigned DEFAULT NULL,
--   `account_nature_id` bigint(20) unsigned DEFAULT NULL,
--   `description` text DEFAULT NULL,
--   `status` varchar(191) NOT NULL DEFAULT 'active',
--   `icon` varchar(191) DEFAULT NULL,
--   `is_system` tinyint(1) NOT NULL DEFAULT 0,
--   `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `account_groups_name_unique` (`name`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=50004 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aipt.account_groups: ~32 rows (approximately)
INSERT IGNORE INTO `account_groups` (`id`, `name`, `code`, `parent_id`, `account_nature_id`, `description`, `status`, `icon`, `is_system`, `is_hidden`, `created_at`, `updated_at`) VALUES
	(10001, 'Assets', 'AS', NULL, 1, 'All asset accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10002, 'Fixed Assets', 'FA', 10001, 1, 'Tangible and intangible fixed assets', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10003, 'Current Assets', 'CA', 10001, 1, 'Liquid or short-term assets', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10004, 'Bank Accounts', 'BA', 10003, 1, 'Bank ledgers', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10005, 'Cash-in-Hand', 'CH', 10003, 1, 'Cash accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10006, 'Deposits (Assets)', 'DA', 10003, 1, 'Deposits given', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10007, 'Loans & Advances (Assets)', 'LAA', 10003, 1, 'Loans and advances receivable', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10008, 'Sundry Debtors', 'SD', 10003, 1, 'Customer accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10009, 'Stock-in-Hand', 'SIH', 10003, 1, 'Inventory and closing stock', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(10010, 'Misc Expenses (Asset)', 'MEA', 10003, 1, 'Prepaid or deferred expenses', 'active', NULL, 1, 1, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20001, 'Liabilities', 'LB', NULL, 2, 'All liability accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20002, 'Current Liabilities', 'CL', 20001, 2, 'Short-term obligations', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20003, 'Sundry Creditors', 'SC', 20002, 2, 'Supplier accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20004, 'Duties & Taxes', 'DT', 20002, 2, 'Government dues', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20005, 'Provisions', 'PR', 20002, 2, 'Accrued expenses and provisions', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20006, 'Loans (Liability)', 'LL', 20001, 2, 'Loans payable', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20007, 'Secured Loans', 'SL', 20006, 2, 'Loans secured by assets', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20008, 'Unsecured Loans', 'UL', 20006, 2, 'Unsecured borrowings', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(20009, 'Suspense Account', 'SUS', 20001, 2, 'Temporary adjustment account', 'active', NULL, 1, 1, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(30001, 'Income', 'INC', NULL, 3, 'All income accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(30002, 'Direct Income', 'DI', 30001, 3, 'Operational income', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(30003, 'Indirect Income', 'II', 30001, 3, 'Non-operational income', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(30004, 'Sales Accounts', 'SA', 30002, 3, 'Sales ledgers', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(30005, 'Other Income', 'OI', 30003, 3, 'Interest, commission, rent, etc.', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(40001, 'Expenses', 'EXP', NULL, 4, 'All expense accounts', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(40002, 'Direct Expenses', 'DE', 40001, 4, 'Manufacturing or purchase related', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(40003, 'Indirect Expenses', 'IE', 40001, 4, 'Administrative and selling expenses', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(40004, 'Purchases Accounts', 'PA', 40002, 4, 'Purchase ledgers', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(40005, 'Cost of Goods Sold', 'COGS', 40002, 4, 'Expense group for traded items', 'active', NULL, 1, 1, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(50001, 'Capital Account', 'CAP', NULL, 5, 'Owners and partners capital', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(50002, 'Reserves & Surplus', 'RS', 50001, 5, 'Retained earnings and reserves', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30'),
	(50003, 'Drawings', 'DR', 50001, 5, 'Withdrawals by owner', 'active', NULL, 1, 0, '2025-11-04 11:53:30', '2025-11-04 11:53:30');



-- DROP TABLE IF EXISTS `account_ledgers`;
-- CREATE TABLE IF NOT EXISTS `account_ledgers` (
--   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
--   `name` varchar(191) NOT NULL,
--   `code` varchar(191) NOT NULL,
--   `account_group_id` bigint(20) unsigned DEFAULT NULL,
--   `description` varchar(191) DEFAULT NULL,
--   `status` varchar(191) NOT NULL DEFAULT 'active',
--   `icon` varchar(191) DEFAULT NULL,
--   `is_system` tinyint(1) NOT NULL DEFAULT 0,
--   `is_hidden` tinyint(1) NOT NULL DEFAULT 0,
--   `ledgerable_id` bigint(20) unsigned DEFAULT NULL,
--   `ledgerable_type` varchar(191) DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `account_ledgers_name_unique` (`name`),
--   UNIQUE KEY `account_ledgers_code_unique` (`code`),
--   KEY `account_ledgers_ledgerable_id_ledgerable_type_index` (`ledgerable_id`,`ledgerable_type`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=5000005 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aipt.account_ledgers: ~29 rows (approximately)
INSERT IGNORE INTO `account_ledgers` (`id`, `name`, `code`, `account_group_id`, `description`, `status`, `icon`, `is_system`, `is_hidden`, `ledgerable_id`, `ledgerable_type`, `created_at`, `updated_at`) VALUES
	(1000001, 'Cash', 'CASH', 10001, 'Cash in hand', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000002, 'Bank Account', 'BANK', 10002, 'Default bank ledger', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000003, 'Accounts Receivable (Debtors)', 'DEBTORS', 10003, 'Receivable balances from customers', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000004, 'Stock-in-Hand', 'STOCK', 10009, 'Inventory of goods', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000005, 'Input CGST', 'INCGST', 20002, 'Input Central GST', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000006, 'Input SGST', 'INSGST', 20002, 'Input State GST', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000007, 'Input IGST', 'INIGST', 20002, 'Input Integrated GST', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(1000008, 'Opening Balance Adjustment', 'OPENBAL', 50001, 'Auto-adjustment for opening balances', 'active', NULL, 1, 1, NULL, NULL, NULL, NULL),
	(2000001, 'Accounts Payable (Creditors)', 'CREDITORS', 20001, 'Vendor accounts payable', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(2000002, 'Duties & Taxes Payable', 'TAXPAY', 20002, 'GST/VAT and statutory liabilities', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(2000003, 'Outstanding Expenses', 'OUTEXP', 40002, 'Accrued but unpaid expenses', 'active', NULL, 0, 0, NULL, NULL, NULL, '2025-11-05 06:03:13'),
	(2000004, 'Suspense Account', 'SUSPENSE', 20002, 'Auto-adjustment suspense ledger', 'active', NULL, 1, 1, NULL, NULL, NULL, '2025-11-05 06:02:11'),
	(2000005, 'Provision for Taxation', 'PROVTAX', 20002, 'Provision created for tax liability', 'active', NULL, 1, 0, NULL, NULL, NULL, '2025-11-05 06:01:07'),
	(2000006, 'Output CGST', 'OUTCGST', 20002, 'Output Central GST liability', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(2000007, 'Output SGST', 'OUTSGST', 20002, 'Output State GST liability', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(2000008, 'Output IGST', 'OUTIGST', 20002, 'Output Integrated GST liability', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(3000001, 'Sales Account', 'SALES', 30004, 'Sales of goods or services', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(3000002, 'Discount Received', 'DISCIN', 30002, 'Discounts received from suppliers', 'active', NULL, 0, 0, NULL, NULL, NULL, NULL),
	(3000003, 'Interest Income', 'INTINC', 30002, 'Interest earned on deposits or loans', 'active', NULL, 0, 0, NULL, NULL, NULL, NULL),
	(3000004, 'Foreign Exchange Gain', 'FXGAIN', 30002, 'Gain on currency revaluation', 'active', NULL, 1, 1, NULL, NULL, NULL, NULL),
	(4000001, 'Purchase Account', 'PURCHASE', 40004, 'Purchase of goods or materials', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(4000002, 'Freight & Carriage', 'FREIGHT', 40002, 'Freight and delivery charges', 'active', NULL, 0, 0, NULL, NULL, NULL, NULL),
	(4000003, 'Rent Expense', 'RENT', 40002, 'Rent for office or premises', 'active', NULL, 0, 0, NULL, NULL, NULL, NULL),
	(4000004, 'Rounding Off', 'ROUND', 40002, 'Minor rounding adjustments', 'active', NULL, 1, 1, NULL, NULL, NULL, NULL),
	(4000005, 'Exchange Difference Loss', 'FXLOSS', 40002, 'Loss due to currency revaluation', 'active', NULL, 1, 1, NULL, NULL, NULL, NULL),
	(4000006, 'Salary Expense', 'SALARY', 40002, 'Employee salary and wages', 'active', NULL, 0, 0, NULL, NULL, NULL, NULL),
	(5000001, 'Capital Account', 'CAPITAL', 50001, 'Owner’s capital', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(5000002, 'Drawings', 'DRAWING', 50001, 'Withdrawals by proprietor', 'active', NULL, 1, 0, NULL, NULL, NULL, NULL),
	(5000003, 'Profit & Loss Account', 'PLACC', 50002, 'System ledger for profit and loss summary', 'active', NULL, 1, 1, NULL, NULL, NULL, NULL);
	-- (5000004, 'UltraTech Cement Limited', 'UltraTech Cement Limited', 20003, NULL, 'active', NULL, 0, 0, 1, 'supplier', '2025-11-05 05:55:55', '2025-11-05 05:55:55');

-- Dumping structure for table aipt.companies
-- DROP TABLE IF EXISTS `companies`;
-- CREATE TABLE IF NOT EXISTS `companies` (
--   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
--   `name` varchar(191) NOT NULL,
--   `code` varchar(191) NOT NULL,
--   `mailing_name` varchar(191) NOT NULL,
--   `address` varchar(191) DEFAULT NULL,
--   `phone_no` varchar(191) DEFAULT NULL,
--   `mobile_no` varchar(191) DEFAULT NULL,
--   `email` varchar(191) DEFAULT NULL,
--   `website` varchar(191) DEFAULT NULL,
--   `company_type_id` bigint(20) unsigned NOT NULL,
--   `cin_no` varchar(191) DEFAULT NULL,
--   `tin_no` varchar(191) DEFAULT NULL,
--   `tan_no` varchar(191) DEFAULT NULL,
--   `gst_no` varchar(191) DEFAULT NULL,
--   `pan_no` varchar(191) DEFAULT NULL,
--   `logo` varchar(191) DEFAULT NULL,
--   `currency_id` bigint(20) unsigned NOT NULL DEFAULT 1,
--   `country_id` bigint(20) unsigned NOT NULL DEFAULT 76,
--   `state_id` bigint(20) unsigned DEFAULT NULL,
--   `city` varchar(191) DEFAULT NULL,
--   `zip_code` varchar(191) DEFAULT NULL,
--   `is_group_company` tinyint(1) NOT NULL DEFAULT 0,
--   `status` enum('active','inactive') NOT NULL DEFAULT 'active',
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   PRIMARY KEY (`id`),
--   UNIQUE KEY `companies_name_unique` (`name`),
--   UNIQUE KEY `companies_code_unique` (`code`),
--   UNIQUE KEY `companies_mailing_name_unique` (`mailing_name`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table aipt.companies: ~1 rows (approximately)
INSERT IGNORE INTO `companies`
(`id`, `name`, `code`, `mailing_name`, `address`, `phone_no`, `mobile_no`, `email`, `website`, `company_type_id`, `cin_no`, `tin_no`, `tan_no`, `gst_no`, `pan_no`, `logo`, `currency_id`, `country_id`, `state_id`, `city`, `zip_code`, `is_group_company`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sharma Hardware', 'C001', 'Sharma Hardware', 'N.H.-34, MangalBari, Malda', '03512-260342', '9805595288', 'sharma_hardware@gmail.com', 'www.sharma_hardware.com', 1, '1234567890', '1234567890', '1234567890', '19AAACL6442L1Z7', '1234567890', 'logo.png', 1, 76, 36, ' Malda', '732142', 0, 'active', '2025-11-04 11:53:30', '2025-11-04 11:53:30');

INSERT INTO `beds`
(`id`, `name`, `code`, `description`, `status`, `remark`, `created_at`, `updated_at`)
VALUES
('7e8a6441-0173-4d3a-a819-0c306949a757','Bed A','BED-101-A','Left side bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('f8f4b107-1ec0-4dbf-bfc4-c974cefda46c','Bed B','BED-101-B','Right side bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('1d012652-8b87-4b0a-b670-51aac9dec8fb','Bed A','BED-102-A','Near window bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('f7b72c64-ed02-4576-bf25-17176ad068bf','Bed B','BED-102-B','Near door bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('a785e3b3-e17a-4a9c-baec-c65a2bcede5d','Bed A','BED-103-A','Standard bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('395cc060-09f5-4680-ab8a-6934603617da','Bed B','BED-103-B','Standard bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('7fd54af2-9104-4cef-9cdf-9015968dc471','Bed 1','ICU-301-1','Ventilator-supported bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('11f8a9f3-9c55-443a-9ca1-b035fc052f90','Bed 2','ICU-301-2','Monitoring-supported bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('7d2e6aef-6943-4460-bc5b-5d8910129be9','Recovery Bed 1','REC-401-1','Post-operation recovery bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46'),
('d9ece7f6-7de5-4708-96e3-1033e41fdeba','Recovery Bed 2','REC-401-2','Post-operation recovery bed','available',NULL,'2026-01-09 16:27:46','2026-01-09 16:27:46');

INSERT INTO `buildings`
(
  `id`,
  `name`,
  `code`,
  `status`,
  `description`,
  `icon`,
  `building_type`,
  `total_area_sqft`,
  `covered_area_sqft`,
  `year_of_construction`,
  `sesmic_zone_compliance`,
  `structural_type`,
  `created_at`,
  `updated_at`
)
VALUES
(
  '78f7bb19-4ecd-4712-8396-1c422260d31a',
  'Emergency & Trauma Block',
  'BLD-ER',
  'active',
  'Emergency block',
  'emergency',
  'emergency_block',
  120000.00,
  105000.00,
  '2018-01-01',
  1,
  'Steel + RCC',
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '8b282891-069a-4a67-b90b-c8a0fa90c1dd',
  'Main Hospital Building',
  'BLD-MAIN',
  'active',
  'Main clinical hospital building',
  'hospital',
  'main_hospital_block',
  250000.00,
  220000.00,
  '2015-01-01',
  1,
  'RCC',
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '304a13ec-d2db-4fd1-85c0-36b376e2a4d2',
  'Research & Administration Block',
  'BLD-RES-ADM',
  'active',
  'Research and admin offices',
  'office',
  'admin_block',
  90000.00,
  82000.00,
  '2012-01-01',
  1,
  'RCC',
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
);

INSERT INTO `floors`
(
  `id`,
  `name`,
  `code`,
  `description`,
  `status`,
  `floor_number`,
  `remark`,
  `created_at`,
  `updated_at`
)
VALUES
(
  '4247b27c-4711-494f-8f09-172bd9557d37',
  'First Floor',
  'FLOOR-1',
  'Main inpatient floor',
  'active',
  1,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  'd881f591-eabc-4b04-9ae3-80922b5dbb9a',
  'Second Floor',
  'FLOOR-2',
  'General wards',
  'active',
  2,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '2a0d6f69-cd32-4d80-9e6c-699f4c157aab',
  'Third Floor',
  'FLOOR-3',
  'ICU and critical care',
  'active',
  3,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '77262084-b88d-4d50-ba38-840b09348817',
  'Fourth Floor',
  'FLOOR-4',
  'Operation theatres',
  'active',
  4,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '7ef4a210-206a-4234-8f1a-09de3d697f94',
  'Fifth Floor',
  'FLOOR-5',
  'Private rooms',
  'active',
  5,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  'ba6a1538-0fdc-4670-b650-6fef19d7d476',
  'Sixth Floor',
  'FLOOR-6',
  'Administration offices',
  'active',
  6,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  'c9c6f86d-637a-4594-afe0-6dfc33f40bd4',
  'Seventh Floor',
  'FLOOR-7',
  'Staff accommodation',
  'active',
  7,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '629a3074-f95f-4cbe-b330-23824d088e8c',
  'Ground Floor',
  'FLOOR-G',
  'Reception and emergency services',
  'active',
  0,
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
);

INSERT INTO `rooms`
(
  `id`,
  `name`,
  `code`,
  `gender_allowed`,
  `isolation_supported`,
  `description`,
  `room_number`,
  `status`,
  `remark`,
  `created_at`,
  `updated_at`
)
VALUES
(
  '16e3bb44-f489-44d9-adce-7e74accef7fa',
  'ICU 301',
  'ICU-301',
  'any',
  true,
  'ICU bed with ventilator',
  '301',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  'd5101c34-4f07-4f30-b7fc-6c9bcafc5215',
  'ICU 302',
  'ICU-302',
  'any',
  true,
  'ICU bed with monitoring',
  '302',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  'c360c994-2517-4245-a7de-e666800007b3',
  'OT 401',
  'OT-401',
  'any',
  false,
  'Major operation theatre',
  '401',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '786423a7-efbb-4ecc-8ff5-bf0856803681',
  'OT 402',
  'OT-402',
  'any',
  false,
  'Minor operation theatre',
  '402',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '36677887-8d2c-42d6-abab-3255c72212ed',
  'Room 101',
  'RM-101',
  'any',
  false,
  'General ward room',
  '101',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  'eb708a0b-9131-4c28-a8d7-d28a0f87d389',
  'Room 102',
  'RM-102',
  'any',
  false,
  'General ward room',
  '102',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '887f56eb-b6cf-4fd4-9361-2ce4f6b66e12',
  'Room 103',
  'RM-103',
  'any',
  false,
  'General ward room',
  '103',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '54177208-b9f2-489c-b2b7-9b837a5dcf9e',
  'Room 201',
  'RM-201',
  'any',
  false,
  'Semi-private room',
  '201',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '762daa08-558c-482f-b192-ed9a7e19e783',
  'Room 202',
  'RM-202',
  'any',
  false,
  'Semi-private room',
  '202',
  'active',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '6ccb563b-31bd-433d-8a84-2295ae2a172e',
  'Room G01',
  'RM-G01',
  'any',
  false,
  'Emergency consultation room',
  'G01',
  'reserved_for_emergency',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
),
(
  '99c5cb3a-ac99-4c73-96a5-f7c01cc0fb7a',
  'Room G02',
  'RM-G02',
  'any',
  false,
  'Triage room',
  'G02',
  'reserved_for_emergency',
  NULL,
  '2026-01-09 16:27:46',
  '2026-01-09 16:27:46'
);

INSERT INTO `amenity_categories` VALUES
('0eb25884-dffd-42fa-9769-1972a669c8da','Patient Comfort','PATIENT_COMFORT','Amenities that enhance physical comfort and convenience for patients and attendants','active',NULL,NULL,NULL),
('27f0dee5-15bf-4309-9977-97d001528840','Transport & Parking','TRANSPORT_PARKING','Amenities related to patient transport, vehicle access, and parking facilities','active',NULL,NULL,NULL),
('3013c541-60d0-434d-a711-27b47a93684e','Wellness & Spiritual','WELLNESS_SPIRITUAL','Amenities that support mental, emotional, and spiritual well-being','active',NULL,NULL,NULL),
('607a09e2-7813-4b10-bf9b-aa6903bb73c3','Housekeeping & Hygiene','HOUSEKEEPING_HYGIENE','Amenities supporting cleanliness, infection control, and waste management','active',NULL,NULL,NULL),
('63c6978b-15a8-42d7-aacb-2160240254eb','Information & Support','INFORMATION_SUPPORT','Amenities related to guidance, communication, and patient assistance services','active',NULL,NULL,NULL),
('6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad','Safety & Security','SAFETY_SECURITY','Amenities that ensure safety, protection, and emergency preparedness','active',NULL,NULL,NULL),
('cfeede7f-48e5-4bee-82e5-96d19cfc6763','Accessibility','ACCESSIBILITY','Amenities ensuring barrier-free and inclusive access for all individuals','active',NULL,NULL,NULL),
('d54fdae8-d3e4-4591-8071-0da784215bb3','Convenience','CONVENIENCE','Amenities that provide ease of access to essential services within the hospital','active',NULL,NULL,NULL),
('e46bba3a-a752-4b4b-822d-86b53ccda679','Family & Visitor','FAMILY_VISITOR','Amenities designed to support attendants and visitors during hospital visits','active',NULL,NULL,NULL);


INSERT INTO `amenities` VALUES
('1af7e29f-4e70-4e45-9b38-b1c48e6e5d99','Biomedical Waste Management','AMN_BMW','607a09e2-7813-4b10-bf9b-aa6903bb73c3','active'),
('2492d694-435e-42af-8914-13c10c18c20a','Reception & Help Desk','AMN_HELP_DESK','63c6978b-15a8-42d7-aacb-2160240254eb','active'),
('2f57d8a1-b25f-4780-9816-53d5acf08d1a','Fire Safety Systems','AMN_FIRE_SAFETY','6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad','active'),
('3ae7de24-058f-449e-9aa3-c0708175d6a1','CCTV Surveillance','AMN_CCTV','6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad','active'),
('575a8577-df07-49e4-9940-15253f78f318','Cafeteria / Food Court','AMN_CAFETERIA','d54fdae8-d3e4-4591-8071-0da784215bb3','active'),
('5efc7fed-5146-46ac-9041-034bc4c6ccdd','Digital Signage','AMN_DIGITAL_SIGNAGE','63c6978b-15a8-42d7-aacb-2160240254eb','active'),
('611a67d1-6f76-4482-a68b-dcfcd40044d0','Elevators / Lifts','AMN_ELEVATORS','cfeede7f-48e5-4bee-82e5-96d19cfc6763','active'),
('931abbaa-2f71-47e4-89c5-abbf65896486','Comfortable Waiting Areas','AMN_WAITING_AREA','0eb25884-dffd-42fa-9769-1972a669c8da','active'),
('955a30cd-746e-4dc4-b576-eb3d2822010e','Air Circulation / Climate Comfort','AMN_CLIMATE_COMFORT','0eb25884-dffd-42fa-9769-1972a669c8da','active'),
('a049c654-b755-478e-a1fc-ebab281633d7','Housekeeping Services','AMN_HOUSEKEEPING','607a09e2-7813-4b10-bf9b-aa6903bb73c3','active'),
('a520f046-dcb2-4896-a2a3-c98ac1e64294','Visitor Parking','AMN_VISITOR_PARKING','27f0dee5-15bf-4309-9977-97d001528840','active'),
('ac6df309-362a-434c-a51e-082a6fe15860','Free Wi-Fi','AMN_WIFI','d54fdae8-d3e4-4591-8071-0da784215bb3','active'),
('bdfb2b95-0339-4d64-ac71-f78db63ebd08','Ambulance Access Area','AMN_AMBULANCE_ACCESS','27f0dee5-15bf-4309-9977-97d001528840','active'),
('c7732eca-b45b-4f0e-b190-6cd44eb856b6','Pharmacy Access','AMN_PHARMACY','d54fdae8-d3e4-4591-8071-0da784215bb3','active'),
('cdff5255-c29c-4108-b4d7-a7ea1160dce7','Wheelchair Access','AMN_WHEELCHAIR_ACCESS','cfeede7f-48e5-4bee-82e5-96d19cfc6763','active'),
('df93ea6e-35eb-4723-bb20-57b92813b493','Attendant Waiting Area','AMN_ATTENDANT_WAITING','e46bba3a-a752-4b4b-822d-86b53ccda679','active'),
('e990d131-cb98-4999-adc5-62ac93d45ce9','Drinking Water Facility','AMN_DRINKING_WATER','0eb25884-dffd-42fa-9769-1972a669c8da','active'),
('f24093e3-f206-4fbe-8010-d2bfc9427682','Prayer / Meditation Room','AMN_PRAYER_ROOM','3013c541-60d0-434d-a711-27b47a93684e','active'),
('f6f5c3c7-72a3-4eba-949e-da9d6d866e68','Ramps & Handrails','AMN_RAMPS_HANDRAILS','cfeede7f-48e5-4bee-82e5-96d19cfc6763','active');
