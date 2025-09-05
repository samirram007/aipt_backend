<?php

namespace App\Modules\Country\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Country\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::create(['name' => 'Sample Country']);

        // Uncomment to use factory if available
        // Country::factory()->count(10)->create();
    }
}
