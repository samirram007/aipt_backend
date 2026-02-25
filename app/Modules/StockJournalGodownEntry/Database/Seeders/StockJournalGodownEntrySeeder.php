<?php

namespace App\Modules\StockJournalGodownEntry\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;

class StockJournalGodownEntrySeeder extends Seeder
{
    public function run(): void
    {
        StockJournalGodownEntry::create(['name' => 'Sample StockJournalGodownEntry']);

        // Uncomment to use factory if available
        // StockJournalGodownEntry::factory()->count(10)->create();
    }
}
