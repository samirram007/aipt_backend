<?php

namespace App\Modules\AccountsJournal\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AccountsJournal\Models\AccountsJournal;

class AccountsJournalSeeder extends Seeder
{
    public function run(): void
    {
        AccountsJournal::create(['name' => 'Sample AccountsJournal']);

        // Uncomment to use factory if available
        // AccountsJournal::factory()->count(10)->create();
    }
}
