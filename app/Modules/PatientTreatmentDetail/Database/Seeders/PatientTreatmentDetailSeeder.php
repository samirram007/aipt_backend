<?php

namespace App\Modules\PatientTreatmentDetail\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientTreatmentDetail\Models\PatientTreatmentDetail;

class PatientTreatmentDetailSeeder extends Seeder
{
    public function run(): void
    {
        PatientTreatmentDetail::create(['name' => 'Sample PatientTreatmentDetail']);

        // Uncomment to use factory if available
        // PatientTreatmentDetail::factory()->count(10)->create();
    }
}
