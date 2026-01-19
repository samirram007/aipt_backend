<?php

namespace App\Modules\CapitalItemMaintenanceLog\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CapitalItemMaintenanceLog\Models\CapitalItemMaintenanceLog;

class CapitalItemMaintenanceLogSeeder extends Seeder
{
    public function run(): void
    {
        CapitalItemMaintenanceLog::create(['name' => 'Sample CapitalItemMaintenanceLog']);

        // Uncomment to use factory if available
        // CapitalItemMaintenanceLog::factory()->count(10)->create();
    }
}
