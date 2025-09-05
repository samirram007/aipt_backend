<?php

namespace App\Modules\StockCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockCategory\Models\StockCategory;

class StockCategorySeeder extends Seeder
{
    public function run(): void
    {
        StockCategory::create(['name' => 'Sample StockCategory']);

        // Uncomment to use factory if available
        // StockCategory::factory()->count(10)->create();
    }
}
