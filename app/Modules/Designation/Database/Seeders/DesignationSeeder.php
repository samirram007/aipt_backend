<?php

namespace App\Modules\Designation\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Designation\Models\Designation;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {
        Designation::create(['name' => 'Sample Designation']);

        // Uncomment to use factory if available
        // Designation::factory()->count(10)->create();
    }
}
