<?php

namespace App\Modules\StockJournalEntry\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;

class StockJournalEntrySeeder extends Seeder
{
    public function run(): void
    {
        // StockJournalEntry::create(['name' => 'Sample StockJournalEntry']);

        // Uncomment to use factory if available
        // StockJournalEntry::factory()->count(10)->create();
    }
}
