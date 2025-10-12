<?php

namespace App\Modules\SalaryStructure\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\SalaryStructure\Models\SalaryStructure;

class SalaryStructureSeeder extends Seeder
{
    public function run(): void
    {
        SalaryStructure::create(['name' => 'Sample SalaryStructure']);

        // Uncomment to use factory if available
        // SalaryStructure::factory()->count(10)->create();
    }
}
