<?php

namespace App\Modules\Vehicle\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Vehicle\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::create(['name' => 'Sample Vehicle']);

        // Uncomment to use factory if available
        // Vehicle::factory()->count(10)->create();
    }
}
