<?php

namespace App\Modules\TransactionInstrument\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TransactionInstrument\Models\TransactionInstrument;

class TransactionInstrumentSeeder extends Seeder
{
    public function run(): void
    {
        TransactionInstrument::create(['name' => 'Sample TransactionInstrument']);

        // Uncomment to use factory if available
        // TransactionInstrument::factory()->count(10)->create();
    }
}
