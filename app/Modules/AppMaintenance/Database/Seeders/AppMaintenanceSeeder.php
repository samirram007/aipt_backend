<?php

namespace App\Modules\AppMaintenance\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AppMaintenance\Models\AppMaintenance;

class AppMaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        AppMaintenance::create(['name' => 'Sample AppMaintenance']);

        // Uncomment to use factory if available
        // AppMaintenance::factory()->count(10)->create();
    }
}
