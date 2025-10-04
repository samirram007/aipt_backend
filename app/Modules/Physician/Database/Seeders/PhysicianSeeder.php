<?php

namespace App\Modules\Physician\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Physician\Models\Physician;

class PhysicianSeeder extends Seeder
{
    public function run(): void
    {
        Physician::create(['name' => 'Sample Physician']);

        // Uncomment to use factory if available
        // Physician::factory()->count(10)->create();
    }
}
