<?php

namespace App\Modules\PhysicalStock\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PhysicalStock\Models\PhysicalStock;

class PhysicalStockSeeder extends Seeder
{
    public function run(): void
    {
        PhysicalStock::create(['name' => 'Sample PhysicalStock']);

        // Uncomment to use factory if available
        // PhysicalStock::factory()->count(10)->create();
    }
}
