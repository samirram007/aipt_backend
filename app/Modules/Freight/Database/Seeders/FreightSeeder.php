<?php

namespace App\Modules\Freight\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Freight\Models\Freight;

class FreightSeeder extends Seeder
{
    public function run(): void
    {
        Freight::create(['name' => 'Sample Freight']);

        // Uncomment to use factory if available
        // Freight::factory()->count(10)->create();
    }
}
