<?php

namespace App\Modules\PatientAllergy\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientAllergy\Models\PatientAllergy;

class PatientAllergySeeder extends Seeder
{
    public function run(): void
    {
        PatientAllergy::create(['name' => 'Sample PatientAllergy']);

        // Uncomment to use factory if available
        // PatientAllergy::factory()->count(10)->create();
    }
}
