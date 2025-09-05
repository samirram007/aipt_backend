<?php

namespace App\Modules\StockItem\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockItem\Models\StockItem;

class StockItemSeeder extends Seeder
{
    public function run(): void
    {
        StockItem::create(['name' => 'Sample StockItem']);

        // Uncomment to use factory if available
        // StockItem::factory()->count(10)->create();
    }
}
