<?php

namespace App\Modules\CostAllocationRule\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CostAllocationRule\Models\CostAllocationRule;

class CostAllocationRuleSeeder extends Seeder
{
    public function run(): void
    {
        CostAllocationRule::create(['name' => 'Sample CostAllocationRule']);

        // Uncomment to use factory if available
        // CostAllocationRule::factory()->count(10)->create();
    }
}
