<?php

namespace App\Modules\PatientTreatment\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientTreatment\Models\PatientTreatment;

class PatientTreatmentSeeder extends Seeder
{
    public function run(): void
    {
        PatientTreatment::create(['name' => 'Sample PatientTreatment']);

        // Uncomment to use factory if available
        // PatientTreatment::factory()->count(10)->create();
    }
}
