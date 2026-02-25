<?php

namespace App\Modules\OrderBook\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\OrderBook\Models\OrderBook;

class OrderBookSeeder extends Seeder
{
    public function run(): void
    {
        OrderBook::create(['name' => 'Sample OrderBook']);

        // Uncomment to use factory if available
        // OrderBook::factory()->count(10)->create();
    }
}
