<?php

namespace App\Modules\PatientSession\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PatientSession\Models\PatientSession;

class PatientSessionSeeder extends Seeder
{
    public function run(): void
    {
        PatientSession::create(['name' => 'Sample PatientSession']);

        // Uncomment to use factory if available
        // PatientSession::factory()->count(10)->create();
    }
}
