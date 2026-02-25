<?php

namespace App\Modules\SalaryComponent\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\SalaryComponent\Models\SalaryComponent;

class SalaryComponentSeeder extends Seeder
{
    public function run(): void
    {
        SalaryComponent::create(['name' => 'Sample SalaryComponent']);

        // Uncomment to use factory if available
        // SalaryComponent::factory()->count(10)->create();
    }
}
