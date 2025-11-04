<?php

namespace App\Modules\StockJournalSerialNoEntry\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockJournalSerialNoEntry\Models\StockJournalSerialNoEntry;

class StockJournalSerialNoEntrySeeder extends Seeder
{
    public function run(): void
    {
        StockJournalSerialNoEntry::create(['name' => 'Sample StockJournalSerialNoEntry']);

        // Uncomment to use factory if available
        // StockJournalSerialNoEntry::factory()->count(10)->create();
    }
}
