<?php

namespace App\Modules\StockItemBrand\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockItemBrand\Models\StockItemBrand;

class StockItemBrandSeeder extends Seeder
{
    public function run(): void
    {
        StockItemBrand::create([
            [
                'name' => 'UltraTech',
                'code' => 'UT',
                'description' => 'A leading brand of cement and construction materials by UltraTech Cement Limited',
                'status' => 'active',
                'icon' => 'FaCubes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Uncomment to use factory if available
        // StockItemBrand::factory()->count(10)->create();
    }
}
