<?php

namespace App\Modules\AccountGroup\Database\Seeders;

use App\Modules\AccountNature\Models\AccountNature;
use Illuminate\Database\Seeder;
use App\Modules\AccountGroup\Models\AccountGroup;

class AccountGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            // Asset Groups
            [
                'type_code' => 'AST',
                'groups' => [
                    ['name' => 'Cash', 'code' => 'CASH', 'description' => 'Cash on hand and in banks'],
                    ['name' => 'Accounts Receivable', 'code' => 'AR', 'description' => 'Customer receivables'],
                    ['name' => 'Inventory', 'code' => 'INV', 'description' => 'Goods held for sale'],
                ]
            ],

            // Liability Groups
            [
                'type_code' => 'LIA',
                'groups' => [
                    ['name' => 'Accounts Payable', 'code' => 'AP', 'description' => 'Amounts owed to suppliers'],
                    ['name' => 'Loans Payable', 'code' => 'LOAN', 'description' => 'Outstanding loans'],
                ]
            ],

            // Income Groups
            [
                'type_code' => 'INC',
                'groups' => [
                    ['name' => 'Sales Revenue', 'code' => 'SR', 'description' => 'Revenue from product sales'],
                    ['name' => 'Service Revenue', 'code' => 'SERV', 'description' => 'Revenue from services'],
                ]
            ],

            // Expense Groups
            [
                'type_code' => 'EXP',
                'groups' => [
                    ['name' => 'Salaries & Wages', 'code' => 'SAL', 'description' => 'Employee compensation'],
                    ['name' => 'Rent Expense', 'code' => 'RENT', 'description' => 'Office/shop rent'],
                    ['name' => 'Utilities', 'code' => 'UTIL', 'description' => 'Electricity, water, etc.'],
                ]
            ],

            // Equity Groups
            [
                'type_code' => 'EQY',
                'groups' => [
                    ['name' => 'Owner’s Capital', 'code' => 'CAP', 'description' => 'Owner contributions'],
                    ['name' => 'Retained Earnings', 'code' => 'RE', 'description' => 'Undistributed profits'],
                ]
            ],
        ];

        foreach ($groups as $section) {
            $accountNature = AccountNature::where('code', $section['type_code'])->first();

            if (!$accountNature) {
                continue;
            }

            foreach ($section['groups'] as $group) {
                AccountGroup::updateOrCreate(
                    ['code' => $group['code']],
                    [
                        'name' => $group['name'],
                        'description' => $group['description'],
                        'account_nature_id' => $accountNature->id,
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}
