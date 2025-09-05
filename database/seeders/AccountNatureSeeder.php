<?php
namespace Database\Seeders;
use App\Modules\AccountNature\Models\AccountNature;
use Illuminate\Database\Seeder;


class AccountNatureSeeder extends Seeder
{

    // php artisan db:seed --class=AccountNatureSeeder
    public function run(): void
    {
        $types = [
            [
                'name' => 'Assets',
                'code' => 'AST',
                'description' => 'Resources owned by the company',
                'status' => 'active',
                'icon' => 'fa-solid fa-landmark',
                'accounting_effect' => 'debit',
            ],
            [
                'name' => 'Liabilities',
                'code' => 'LIA',
                'description' => 'Obligations owed by the company',
                'status' => 'active',
                'icon' => 'fa-solid fa-scale-balanced',
                'accounting_effect' => 'credit',
            ],
            [
                'name' => 'Income',
                'code' => 'INC',
                'description' => 'Revenue generated from operations',
                'status' => 'active',
                'icon' => 'fa-solid fa-arrow-trend-up',
                'accounting_effect' => 'credit',
            ],
            [
                'name' => 'Expenses',
                'code' => 'EXP',
                'description' => 'Costs incurred by the business',
                'status' => 'active',
                'icon' => 'fa-solid fa-money-bill',
                'accounting_effect' => 'debit',
            ],
            [
                'name' => 'Equity',
                'code' => 'EQY',
                'description' => 'Owner’s interest in the company',
                'status' => 'active',
                'icon' => 'fa-solid fa-piggy-bank',
                'accounting_effect' => 'credit',
            ],
        ];

        foreach ($types as $type) {
            AccountNature::updateOrCreate(
                ['code' => $type['code']], // unique constraint
                $type
            );
        }
    }
}
