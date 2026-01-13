<?php

namespace App\Modules\PatientVital\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientVital\Models\PatientVital;

class PatientVitalSeeder extends Seeder
{
    public function run(): void
    {
        PatientVital::create(['name' => 'Sample PatientVital']);

        // Uncomment to use factory if available
        // PatientVital::factory()->count(10)->create();
    }
}
