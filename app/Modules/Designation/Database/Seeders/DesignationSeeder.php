<?php

namespace App\Modules\Designation\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Designation\Models\Designation;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {
             $designations = [
            ['name' => 'Lab Technician', 'code' => 'LT', 'status' => 'active'],
            ['name' => 'Lab Assistant', 'code' => 'LA', 'status' => 'active'],
            ['name' => 'Lab Manager', 'code' => 'LM', 'status' => 'active'],
            ['name' => 'Pathologist', 'code' => 'PATH', 'status' => 'active'],
            ['name' => 'Radiologist', 'code' => 'RAD', 'status' => 'active'],
            ['name' => 'Pharmacologist', 'code' => 'PHAR', 'status' => 'active'],
            ['name' => 'Microbiologist', 'code' => 'MICRO', 'status' => 'active'],
        ];

        foreach ($designations as $desig) {
            Designation::create($desig);
        }

        // Uncomment to use factory if available
        // Designation::factory()->count(10)->create();
    }
}
