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
                ['name' => 'Cash in Hand', 'code' => 'CASH_HAND', 'description' => 'Cash held physically'],
                ['name' => 'Cash at Bank', 'code' => 'CASH_BANK', 'description' => 'Cash in bank accounts'],
            ],
            'AR' => [
                ['name' => 'Customer A Receivable', 'code' => 'AR_CUST_A', 'description' => 'Receivable from Customer A'],
                ['name' => 'Customer B Receivable', 'code' => 'AR_CUST_B', 'description' => 'Receivable from Customer B'],
            ],
            'AP' => [
                ['name' => 'Vendor X Payable', 'code' => 'AP_VENDOR_X', 'description' => 'Payable to Vendor X'],
                ['name' => 'Vendor Y Payable', 'code' => 'AP_VENDOR_Y', 'description' => 'Payable to Vendor Y'],
            ],
            'SR' => [
                ['name' => 'Product Sales', 'code' => 'SALE_PROD', 'description' => 'Revenue from products'],
                ['name' => 'Service Income', 'code' => 'SALE_SERV', 'description' => 'Revenue from services'],
            ],
            'SAL' => [
                ['name' => 'Monthly Salaries', 'code' => 'SAL_MONTHLY', 'description' => 'Regular monthly salaries'],
                ['name' => 'Overtime Payments', 'code' => 'SAL_OT', 'description' => 'Overtime wages'],
            ],
            'CAP' => [
                ['name' => 'Initial Capital', 'code' => 'CAP_INIT', 'description' => 'Initial owner capital'],
                ['name' => 'Additional Capital', 'code' => 'CAP_ADD', 'description' => 'Extra funds added'],
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
