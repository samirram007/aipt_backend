<?php

namespace App\Modules\Designation\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Designation\Models\Designation;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {
        $designations = [
            ['id' => 101, 'name' => 'Primary', 'code' => 'PRI', 'status' => 'active'],
            ['id' => 102, 'name' => 'Lab Technician', 'code' => 'LT', 'status' => 'active'],
            ['id' => 103, 'name' => 'Lab Assistant', 'code' => 'LA', 'status' => 'active'],
            ['id' => 104, 'name' => 'Lab Manager', 'code' => 'LM', 'status' => 'active'],
            ['id' => 105, 'name' => 'Pathologist', 'code' => 'PATH', 'status' => 'active'],
            ['id' => 106, 'name' => 'Radiologist', 'code' => 'RAD', 'status' => 'active'],
            ['id' => 107, 'name' => 'Pharmacologist', 'code' => 'PHAR', 'status' => 'active'],
            ['id' => 108, 'name' => 'Microbiologist', 'code' => 'MICRO', 'status' => 'active'],
        ];

        foreach ($designations as $desig) {
            Designation::create($desig);
        }
    }
}
