<?php

namespace App\Modules\PatientMedicalHistory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientMedicalHistory\Models\PatientMedicalHistory;

class PatientMedicalHistorySeeder extends Seeder
{
    public function run(): void
    {
        PatientMedicalHistory::create(['name' => 'Sample PatientMedicalHistory']);

        // Uncomment to use factory if available
        // PatientMedicalHistory::factory()->count(10)->create();
    }
}
