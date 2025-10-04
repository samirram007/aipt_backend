<?php

namespace App\Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Patient\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        Patient::create(['name' => 'Sample Patient']);

        // Uncomment to use factory if available
        // Patient::factory()->count(10)->create();
    }
}
