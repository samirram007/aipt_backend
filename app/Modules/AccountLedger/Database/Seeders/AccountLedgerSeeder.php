<?php

namespace App\Modules\AccountLedger\Database\Seeders;

use App\Modules\AccountGroup\Models\AccountGroup;
use Illuminate\Database\Seeder;
use App\Modules\AccountLedger\Models\AccountLedger;
use Illuminate\Support\Facades\DB;

class AccountLedgerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('account_ledgers')->truncate();

        $ledgers = [

            // ==============================
            // 🔹 ASSETS (1000001–)
            // ==============================
            [
                'id' => 1000001,
                'name' => 'Cash',
                'code' => 'CASH',
                'account_group_id' => 10001, // Cash-in-Hand
                'description' => 'Cash in hand',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000002,
                'name' => 'Bank Account',
                'code' => 'BANK',
                'account_group_id' => 10002, // Bank Accounts
                'description' => 'Default bank ledger',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000003,
                'name' => 'Accounts Receivable (Debtors)',
                'code' => 'DEBTORS',
                'account_group_id' => 10003, // Sundry Debtors
                'description' => 'Receivable balances from customers',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000004,
                'name' => 'Stock-in-Hand',
                'code' => 'STOCK',
                'account_group_id' => 10004,
                'description' => 'Inventory of goods',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000005,
                'name' => 'Input CGST',
                'code' => 'INCGST',
                'account_group_id' => 20002,
                'description' => 'Input Central GST',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000006,
                'name' => 'Input SGST',
                'code' => 'INSGST',
                'account_group_id' => 20002,
                'description' => 'Input State GST',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000007,
                'name' => 'Input IGST',
                'code' => 'INIGST',
                'account_group_id' => 20002,
                'description' => 'Input Integrated GST',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 1000008,
                'name' => 'Opening Balance Adjustment',
                'code' => 'OPENBAL',
                'account_group_id' => 50001, // Equity adjustment
                'description' => 'Auto-adjustment for opening balances',
                'is_system' => true,
                'is_hidden' => true,
            ],

            // ==============================
            // 🔹 LIABILITIES (2000001–)
            // ==============================
            [
                'id' => 2000001,
                'name' => 'Accounts Payable (Creditors)',
                'code' => 'CREDITORS',
                'account_group_id' => 20001, // Sundry Creditors
                'description' => 'Vendor accounts payable',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 2000002,
                'name' => 'Duties & Taxes Payable',
                'code' => 'TAXPAY',
                'account_group_id' => 20002, // Duties & Taxes
                'description' => 'GST/VAT and statutory liabilities',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 2000003,
                'name' => 'Outstanding Expenses',
                'code' => 'OUTEXP',
                'account_group_id' => 20003,
                'description' => 'Accrued but unpaid expenses',
                'is_system' => false,
                'is_hidden' => false,
            ],
            [
                'id' => 2000004,
                'name' => 'Suspense Account',
                'code' => 'SUSPENSE',
                'account_group_id' => 20003,
                'description' => 'Auto-adjustment suspense ledger',
                'is_system' => true,
                'is_hidden' => true,
            ],
            [
                'id' => 2000005,
                'name' => 'Provision for Taxation',
                'code' => 'PROVTAX',
                'account_group_id' => 20003,
                'description' => 'Provision created for tax liability',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 2000006,
                'name' => 'Output CGST',
                'code' => 'OUTCGST',
                'account_group_id' => 20002,
                'description' => 'Output Central GST liability',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 2000007,
                'name' => 'Output SGST',
                'code' => 'OUTSGST',
                'account_group_id' => 20002,
                'description' => 'Output State GST liability',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 2000008,
                'name' => 'Output IGST',
                'code' => 'OUTIGST',
                'account_group_id' => 20002,
                'description' => 'Output Integrated GST liability',
                'is_system' => true,
                'is_hidden' => false,
            ],

            // ==============================
            // 🔹 INCOME (3000001–)
            // ==============================
            [
                'id' => 3000001,
                'name' => 'Sales Account',
                'code' => 'SALES',
                'account_group_id' => 30001,
                'description' => 'Sales of goods or services',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 3000002,
                'name' => 'Discount Received',
                'code' => 'DISCIN',
                'account_group_id' => 30002,
                'description' => 'Discounts received from suppliers',
                'is_system' => false,
                'is_hidden' => false,
            ],
            [
                'id' => 3000003,
                'name' => 'Interest Income',
                'code' => 'INTINC',
                'account_group_id' => 30002,
                'description' => 'Interest earned on deposits or loans',
                'is_system' => false,
                'is_hidden' => false,
            ],
            [
                'id' => 3000004,
                'name' => 'Foreign Exchange Gain',
                'code' => 'FXGAIN',
                'account_group_id' => 30002,
                'description' => 'Gain on currency revaluation',
                'is_system' => true,
                'is_hidden' => true,
            ],

            // ==============================
            // 🔹 EXPENSES (4000001–)
            // ==============================
            [
                'id' => 4000001,
                'name' => 'Purchase Account',
                'code' => 'PURCHASE',
                'account_group_id' => 40001,
                'description' => 'Purchase of goods or materials',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 4000002,
                'name' => 'Freight & Carriage',
                'code' => 'FREIGHT',
                'account_group_id' => 40002,
                'description' => 'Freight and delivery charges',
                'is_system' => false,
                'is_hidden' => false,
            ],
            [
                'id' => 4000003,
                'name' => 'Rent Expense',
                'code' => 'RENT',
                'account_group_id' => 40002,
                'description' => 'Rent for office or premises',
                'is_system' => false,
                'is_hidden' => false,
            ],
            [
                'id' => 4000004,
                'name' => 'Rounding Off',
                'code' => 'ROUND',
                'account_group_id' => 40002,
                'description' => 'Minor rounding adjustments',
                'is_system' => true,
                'is_hidden' => true,
            ],
            [
                'id' => 4000005,
                'name' => 'Exchange Difference Loss',
                'code' => 'FXLOSS',
                'account_group_id' => 40002,
                'description' => 'Loss due to currency revaluation',
                'is_system' => true,
                'is_hidden' => true,
            ],
            [
                'id' => 4000006,
                'name' => 'Salary Expense',
                'code' => 'SALARY',
                'account_group_id' => 40002,
                'description' => 'Employee salary and wages',
                'is_system' => false,
                'is_hidden' => false,
            ],
            [
                'id' => 4000007,
                'name' => 'Discount Allowed',
                'code' => 'DISCALW',
                'account_group_id' => 40002,
                'description' => 'Discounts allowed from suppliers',
                'is_system' => false,
                'is_hidden' => false,
            ],

            // ==============================
            // 🔹 EQUITY (5000001–)
            // ==============================
            [
                'id' => 5000001,
                'name' => 'Capital Account',
                'code' => 'CAPITAL',
                'account_group_id' => 50001,
                'description' => 'Owner’s capital',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 5000002,
                'name' => 'Drawings',
                'code' => 'DRAWING',
                'account_group_id' => 50001,
                'description' => 'Withdrawals by proprietor',
                'is_system' => true,
                'is_hidden' => false,
            ],
            [
                'id' => 5000003,
                'name' => 'Profit & Loss Account',
                'code' => 'PLACC',
                'account_group_id' => 50002,
                'description' => 'System ledger for profit and loss summary',
                'is_system' => true,
                'is_hidden' => true,
            ],
        ];

        DB::table('account_ledgers')->insert($ledgers);
    }
}
