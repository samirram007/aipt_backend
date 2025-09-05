<?php

namespace App\Modules\AccountLedger\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AccountLedger\Models\AccountLedger;

class AccountLedgerSeeder extends Seeder
{
    public function run(): void
    {
        AccountLedger::create(['name' => 'Sample AccountLedger']);

        // Uncomment to use factory if available
        // AccountLedger::factory()->count(10)->create();
    }
}
