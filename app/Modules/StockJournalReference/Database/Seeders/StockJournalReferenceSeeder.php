<?php

namespace App\Modules\StockJournalReference\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\StockJournalReference\Models\StockJournalReference;

class StockJournalReferenceSeeder extends Seeder
{
    public function run(): void
    {
        StockJournalReference::create(['name' => 'Sample StockJournalReference']);

        // Uncomment to use factory if available
        // StockJournalReference::factory()->count(10)->create();
    }
}
