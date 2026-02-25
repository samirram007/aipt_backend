<?php

namespace App\Modules\FiscalYear\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\FiscalYear\Models\FiscalYear;

class FiscalYearSeeder extends Seeder
{
    public function run(): void
    {
        FiscalYear::create([
            'name' => 'Fiscal Year 2025-26',
            'start_date' => '2025-04-01',
            'end_date' => '2026-03-31',
            'status' => 'active',
            'company_id' => 1
        ]);

        // Uncomment to use factory if available
        // FiscalYear::factory()->count(10)->create();
    }
}
