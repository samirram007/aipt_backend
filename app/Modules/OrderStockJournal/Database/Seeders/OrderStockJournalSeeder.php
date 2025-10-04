<?php

namespace App\Modules\OrderStockJournal\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\OrderStockJournal\Models\OrderStockJournal;

class OrderStockJournalSeeder extends Seeder
{
    public function run(): void
    {
        OrderStockJournal::create(['name' => 'Sample OrderStockJournal']);

        // Uncomment to use factory if available
        // OrderStockJournal::factory()->count(10)->create();
    }
}
