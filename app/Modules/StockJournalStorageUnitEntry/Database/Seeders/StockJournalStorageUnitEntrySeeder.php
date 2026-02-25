<?php

namespace App\Modules\StockJournalStorageUnitEntry\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockJournalStorageUnitEntry\Models\StockJournalStorageUnitEntry;

class StockJournalStorageUnitEntrySeeder extends Seeder
{
    public function run(): void
    {
        StockJournalStorageUnitEntry::create(['name' => 'Sample StockJournalStorageUnitEntry']);

        // Uncomment to use factory if available
        // StockJournalStorageUnitEntry::factory()->count(10)->create();
    }
}
