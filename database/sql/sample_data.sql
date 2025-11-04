
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
