<?php

namespace App\Modules\OrderJournal\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\OrderJournal\Models\OrderJournal;

class OrderJournalSeeder extends Seeder
{
    public function run(): void
    {
        OrderJournal::create(['name' => 'Sample OrderJournal']);

        // Uncomment to use factory if available
        // OrderJournal::factory()->count(10)->create();
    }
}
