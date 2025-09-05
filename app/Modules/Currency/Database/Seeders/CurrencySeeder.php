<?php

namespace App\Modules\Currency\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Currency\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        Currency::create(['name' => 'Sample Currency']);

        // Uncomment to use factory if available
        // Currency::factory()->count(10)->create();
    }
}
