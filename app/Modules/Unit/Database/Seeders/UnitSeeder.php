<?php

namespace App\Modules\Unit\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Unit\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::create(['name' => 'Sample Unit']);

        // Uncomment to use factory if available
        // Unit::factory()->count(10)->create();
    }
}
