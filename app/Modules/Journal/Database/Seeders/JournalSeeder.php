<?php

namespace App\Modules\Journal\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Journal\Models\Journal;

class JournalSeeder extends Seeder
{
    public function run(): void
    {
        Journal::create(['name' => 'Sample Journal']);

        // Uncomment to use factory if available
        // Journal::factory()->count(10)->create();
    }
}
