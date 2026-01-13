<?php

namespace App\Modules\PatientSurgicalHistory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientSurgicalHistory\Models\PatientSurgicalHistory;

class PatientSurgicalHistorySeeder extends Seeder
{
    public function run(): void
    {
        PatientSurgicalHistory::create(['name' => 'Sample PatientSurgicalHistory']);

        // Uncomment to use factory if available
        // PatientSurgicalHistory::factory()->count(10)->create();
    }
}
