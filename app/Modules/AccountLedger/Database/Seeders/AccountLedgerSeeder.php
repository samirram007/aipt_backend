<?php

namespace App\Modules\AccountLedger\Database\Seeders;

use App\Modules\AccountGroup\Models\AccountGroup;
use Illuminate\Database\Seeder;
use App\Modules\AccountLedger\Models\AccountLedger;

class AccountLedgerSeeder extends Seeder
{
    public function run(): void
    {
        $ledgers = [
            'CASH' => [
                ['id' => 1, 'name' => 'Cash in Hand', 'code' => 'CASH_HAND', 'description' => 'Cash held physically'],
                ['id' => 2, 'name' => 'Cash at Bank', 'code' => 'CASH_BANK', 'description' => 'Cash in bank accounts'],
            ],
            'AR' => [
                ['id' => 3, 'name' => 'Customer A Receivable', 'code' => 'AR_CUST_A', 'description' => 'Receivable from Customer A'],
                ['id' => 4, 'name' => 'Customer B Receivable', 'code' => 'AR_CUST_B', 'description' => 'Receivable from Customer B'],
                ['id' => 5, 'name' => 'Other Trade Receivables', 'code' => 'AR_OTHERS', 'description' => 'Receivable from other customers'],
            ],
            'AP' => [
                ['id' => 6, 'name' => 'Vendor X Payable', 'code' => 'AP_VENDOR_X', 'description' => 'Payable to Vendor X'],
                ['id' => 7, 'name' => 'Vendor Y Payable', 'code' => 'AP_VENDOR_Y', 'description' => 'Payable to Vendor Y'],
                ['id' => 8, 'name' => 'Other Trade Payables', 'code' => 'AP_OTHERS', 'description' => 'Payable to other vendors'],
            ],
            'SR' => [
                ['id' => 9, 'name' => 'Product Sales', 'code' => 'SALE_PROD', 'description' => 'Revenue from products'],
                ['id' => 10, 'name' => 'Service Income', 'code' => 'SALE_SERV', 'description' => 'Revenue from services'],
                ['id' => 11, 'name' => 'Export Sales', 'code' => 'SALE_EXPORT', 'description' => 'Revenue from exports'],
            ],
            'PUR' => [
                ['id' => 12, 'name' => 'Raw Material Purchases', 'code' => 'PUR_RAW', 'description' => 'Purchase of raw materials'],
                ['id' => 13, 'name' => 'Finished Goods Purchases', 'code' => 'PUR_FINISH', 'description' => 'Purchase of finished goods'],
                ['id' => 14, 'name' => 'Service Purchases', 'code' => 'PUR_SERV', 'description' => 'Expenses for purchased services'],
            ],
            'INV' => [
                ['id' => 15, 'name' => 'Raw Material Inventory', 'code' => 'INV_RAW', 'description' => 'Stock of raw materials'],
                ['id' => 16, 'name' => 'Work in Progress Inventory', 'code' => 'INV_WIP', 'description' => 'Stock of work in progress'],
                ['id' => 17, 'name' => 'Finished Goods Inventory', 'code' => 'INV_FINISH', 'description' => 'Stock of finished goods'],
            ],
            'COGS' => [
                ['id' => 18, 'name' => 'Cost of Goods Sold', 'code' => 'COGS_MAIN', 'description' => 'Direct cost of goods sold'],
                ['id' => 19, 'name' => 'Production Overheads', 'code' => 'COGS_OVER', 'description' => 'Overheads allocated to production'],
            ],
            'EXP' => [
                ['id' => 20, 'name' => 'Rent Expense', 'code' => 'EXP_RENT', 'description' => 'Office or warehouse rent'],
                ['id' => 21, 'name' => 'Utilities Expense', 'code' => 'EXP_UTIL', 'description' => 'Electricity, water, internet, etc.'],
                ['id' => 22, 'name' => 'Office Supplies Expense', 'code' => 'EXP_OFF_SUPP', 'description' => 'Stationery and supplies'],
            ],
            'SAL' => [
                ['id' => 23, 'name' => 'Monthly Salaries', 'code' => 'SAL_MONTHLY', 'description' => 'Regular monthly salaries'],
                ['id' => 24, 'name' => 'Overtime Payments', 'code' => 'SAL_OT', 'description' => 'Overtime wages'],
                ['id' => 25, 'name' => 'Bonus Payments', 'code' => 'SAL_BONUS', 'description' => 'Annual/periodic bonuses'],
            ],
            'CAP' => [
                ['id' => 26, 'name' => 'Initial Capital', 'code' => 'CAP_INIT', 'description' => 'Initial owner capital'],
                ['id' => 27, 'name' => 'Additional Capital', 'code' => 'CAP_ADD', 'description' => 'Extra funds added'],
                ['id' => 28, 'name' => 'Drawings', 'code' => 'CAP_DRAW', 'description' => 'Owner withdrawals'],
            ],
            'TAX' => [
                ['id' => 29, 'name' => 'Input GST/VAT', 'code' => 'TAX_INPUT', 'description' => 'GST/VAT paid on purchases'],
                ['id' => 30, 'name' => 'Output GST/VAT', 'code' => 'TAX_OUTPUT', 'description' => 'GST/VAT collected on sales'],
                ['id' => 31, 'name' => 'Income Tax Payable', 'code' => 'TAX_IT_PAY', 'description' => 'Corporate income tax liability'],
            ],
            'FA' => [
                ['id' => 32, 'name' => 'Machinery', 'code' => 'FA_MACHINE', 'description' => 'Machinery & equipment'],
                ['id' => 33, 'name' => 'Furniture & Fixtures', 'code' => 'FA_FURN', 'description' => 'Office furniture and fixtures'],
                ['id' => 34, 'name' => 'Vehicles', 'code' => 'FA_VEH', 'description' => 'Company-owned vehicles'],
            ],
            'LOAN' => [
                ['id' => 35, 'name' => 'Bank Loan', 'code' => 'LOAN_BANK', 'description' => 'Loans from banks'],
                ['id' => 36, 'name' => 'Loan from Director', 'code' => 'LOAN_DIR', 'description' => 'Funds borrowed from director'],
            ],
        ];


        foreach ($ledgers as $groupCode => $entries) {
            $group = AccountGroup::where('code', $groupCode)->first();

            if (!$group) {
                continue;
            }

            foreach ($entries as $ledger) {
                AccountLedger::updateOrCreate(
                    ['code' => $ledger['code']],
                    [
                        'name' => $ledger['name'],
                        'description' => $ledger['description'],
                        'account_group_id' => $group->id,
                        'status' => 'active',
                        'icon' => null,
                    ]
                );
            }
        }
    }
}
