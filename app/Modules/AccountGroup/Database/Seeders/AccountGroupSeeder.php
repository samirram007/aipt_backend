<?php

namespace App\Modules\AccountGroup\Database\Seeders;

use App\Modules\AccountNature\Models\AccountNature;
use Illuminate\Database\Seeder;
use App\Modules\AccountGroup\Models\AccountGroup;
use Illuminate\Support\Facades\DB;

class AccountGroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('account_groups')->truncate();

        $now = now();

        $groups = [

            // ==============================
            // 🟩 ASSETS (10000–19999)
            // ==============================
            ['id' => 10001, 'name' => 'Assets', 'code' => 'AS', 'parent_id' => null, 'account_nature_id' => 1, 'description' => 'All asset accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],

            ['id' => 10002, 'name' => 'Fixed Assets', 'code' => 'FA', 'parent_id' => 10001, 'account_nature_id' => 1, 'description' => 'Tangible and intangible fixed assets', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10003, 'name' => 'Current Assets', 'code' => 'CA', 'parent_id' => 10001, 'account_nature_id' => 1, 'description' => 'Liquid or short-term assets', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10004, 'name' => 'Bank Accounts', 'code' => 'BA', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Bank ledgers', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10005, 'name' => 'Cash-in-Hand', 'code' => 'CH', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Cash accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10006, 'name' => 'Deposits (Assets)', 'code' => 'DA', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Deposits given', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10007, 'name' => 'Loans & Advances (Assets)', 'code' => 'LAA', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Loans and advances receivable', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10008, 'name' => 'Sundry Debtors', 'code' => 'SD', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Customer accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10009, 'name' => 'Stock-in-Hand', 'code' => 'SIH', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Inventory and closing stock', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10010, 'name' => 'Misc Expenses (Asset)', 'code' => 'MEA', 'parent_id' => 10003, 'account_nature_id' => 1, 'description' => 'Prepaid or deferred expenses', 'status' => 'active', 'is_system' => true, 'is_hidden' => true, 'created_at' => $now, 'updated_at' => $now],


            // ==============================
            // 🟥 LIABILITIES (20000–29999)
            // ==============================
            ['id' => 20001, 'name' => 'Liabilities', 'code' => 'LB', 'parent_id' => null, 'account_nature_id' => 2, 'description' => 'All liability accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],

            ['id' => 20002, 'name' => 'Current Liabilities', 'code' => 'CL', 'parent_id' => 20001, 'account_nature_id' => 2, 'description' => 'Short-term obligations', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20003, 'name' => 'Sundry Creditors', 'code' => 'SC', 'parent_id' => 20002, 'account_nature_id' => 2, 'description' => 'Supplier accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20004, 'name' => 'Duties & Taxes', 'code' => 'DT', 'parent_id' => 20002, 'account_nature_id' => 2, 'description' => 'Government dues', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20005, 'name' => 'Provisions', 'code' => 'PR', 'parent_id' => 20002, 'account_nature_id' => 2, 'description' => 'Accrued expenses and provisions', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20006, 'name' => 'Loans (Liability)', 'code' => 'LL', 'parent_id' => 20001, 'account_nature_id' => 2, 'description' => 'Loans payable', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20007, 'name' => 'Secured Loans', 'code' => 'SL', 'parent_id' => 20006, 'account_nature_id' => 2, 'description' => 'Loans secured by assets', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20008, 'name' => 'Unsecured Loans', 'code' => 'UL', 'parent_id' => 20006, 'account_nature_id' => 2, 'description' => 'Unsecured borrowings', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20009, 'name' => 'Suspense Account', 'code' => 'SUS', 'parent_id' => 20001, 'account_nature_id' => 2, 'description' => 'Temporary adjustment account', 'status' => 'active', 'is_system' => true, 'is_hidden' => true, 'created_at' => $now, 'updated_at' => $now],


            // ==============================
            // 🟨 EQUITY (50000–59999)
            // ==============================
            ['id' => 50001, 'name' => 'Capital Account', 'code' => 'CAP', 'parent_id' => null, 'account_nature_id' => 5, 'description' => 'Owners and partners capital', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 50002, 'name' => 'Reserves & Surplus', 'code' => 'RS', 'parent_id' => 50001, 'account_nature_id' => 5, 'description' => 'Retained earnings and reserves', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 50003, 'name' => 'Drawings', 'code' => 'DR', 'parent_id' => 50001, 'account_nature_id' => 5, 'description' => 'Withdrawals by owner', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],


            // ==============================
            // 🟦 INCOME (30000–39999)
            // ==============================
            ['id' => 30001, 'name' => 'Income', 'code' => 'INC', 'parent_id' => null, 'account_nature_id' => 3, 'description' => 'All income accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 30002, 'name' => 'Direct Income', 'code' => 'DI', 'parent_id' => 30001, 'account_nature_id' => 3, 'description' => 'Operational income', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 30003, 'name' => 'Indirect Income', 'code' => 'II', 'parent_id' => 30001, 'account_nature_id' => 3, 'description' => 'Non-operational income', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 30004, 'name' => 'Sales Accounts', 'code' => 'SA', 'parent_id' => 30002, 'account_nature_id' => 3, 'description' => 'Sales ledgers', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 30005, 'name' => 'Other Income', 'code' => 'OI', 'parent_id' => 30003, 'account_nature_id' => 3, 'description' => 'Interest, commission, rent, etc.', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],


            // ==============================
            // 🟧 EXPENSES (40000–49999)
            // ==============================
            ['id' => 40001, 'name' => 'Expenses', 'code' => 'EXP', 'parent_id' => null, 'account_nature_id' => 4, 'description' => 'All expense accounts', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 40002, 'name' => 'Direct Expenses', 'code' => 'DE', 'parent_id' => 40001, 'account_nature_id' => 4, 'description' => 'Manufacturing or purchase related', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 40003, 'name' => 'Indirect Expenses', 'code' => 'IE', 'parent_id' => 40001, 'account_nature_id' => 4, 'description' => 'Administrative and selling expenses', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 40004, 'name' => 'Purchases Accounts', 'code' => 'PA', 'parent_id' => 40002, 'account_nature_id' => 4, 'description' => 'Purchase ledgers', 'status' => 'active', 'is_system' => true, 'is_hidden' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 40005, 'name' => 'Cost of Goods Sold', 'code' => 'COGS', 'parent_id' => 40002, 'account_nature_id' => 4, 'description' => 'Expense group for traded items', 'status' => 'active', 'is_system' => true, 'is_hidden' => true, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('account_groups')->insert($groups);
    }
}
