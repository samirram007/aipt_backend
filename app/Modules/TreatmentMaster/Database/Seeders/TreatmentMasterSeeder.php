<?php

namespace App\Modules\TreatmentMaster\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TreatmentMaster\Models\TreatmentMaster;

class TreatmentMasterSeeder extends Seeder
{
    public function run(): void
    {
        TreatmentMaster::create(['name' => 'Sample TreatmentMaster']);

        // Uncomment to use factory if available
        // TreatmentMaster::factory()->count(10)->create();
    }
}
