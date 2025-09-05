<?php

namespace App\Modules\StockGroup\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockGroup\Models\StockGroup;

class StockGroupSeeder extends Seeder
{
    public function run(): void
    {
        StockGroup::create(['name' => 'Sample StockGroup']);

        // Uncomment to use factory if available
        // StockGroup::factory()->count(10)->create();
    }
}
