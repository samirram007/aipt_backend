<?php

namespace App\Modules\CostCenter\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CostCenter\Models\CostCenter;

class CostCenterSeeder extends Seeder
{
    public function run(): void
    {
        CostCenter::create(['name' => 'Sample CostCenter']);

        // Uncomment to use factory if available
        // CostCenter::factory()->count(10)->create();
    }
}
