<?php

namespace App\Modules\AccountingPeriod\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AccountingPeriod\Models\AccountingPeriod;

class AccountingPeriodSeeder extends Seeder
{
    public function run(): void
    {
        AccountingPeriod::create(['name' => 'Sample AccountingPeriod']);

        // Uncomment to use factory if available
        // AccountingPeriod::factory()->count(10)->create();
    }
}
