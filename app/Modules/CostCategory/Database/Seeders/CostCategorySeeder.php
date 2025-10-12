<?php

namespace App\Modules\CostCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CostCategory\Models\CostCategory;

class CostCategorySeeder extends Seeder
{
    public function run(): void
    {
        CostCategory::create(['name' => 'Sample CostCategory']);

        // Uncomment to use factory if available
        // CostCategory::factory()->count(10)->create();
    }
}
