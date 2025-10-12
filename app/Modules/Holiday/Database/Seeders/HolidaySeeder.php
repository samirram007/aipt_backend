<?php

namespace App\Modules\Holiday\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Holiday\Models\Holiday;

class HolidaySeeder extends Seeder
{
    public function run(): void
    {
        Holiday::create(['name' => 'Sample Holiday']);

        // Uncomment to use factory if available
        // Holiday::factory()->count(10)->create();
    }
}
