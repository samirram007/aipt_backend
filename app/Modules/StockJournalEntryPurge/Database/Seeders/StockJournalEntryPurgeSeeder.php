<?php

namespace App\Modules\StockJournalEntryPurge\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockJournalEntryPurge\Models\StockJournalEntryPurge;

class StockJournalEntryPurgeSeeder extends Seeder
{
    public function run(): void
    {
        StockJournalEntryPurge::create(['name' => 'Sample StockJournalEntryPurge']);

        // Uncomment to use factory if available
        // StockJournalEntryPurge::factory()->count(10)->create();
    }
}
