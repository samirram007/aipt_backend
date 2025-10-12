<?php

namespace App\Modules\Department\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Department\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Biochemistry', 'code' => 'BIOC', 'status' => 'active'],
            ['name' => 'Microbiology', 'code' => 'MICR', 'status' => 'active'],
            ['name' => 'Hematology', 'code' => 'HEMA', 'status' => 'active'],
            ['name' => 'Pathology', 'code' => 'PATH', 'status' => 'active'],
            ['name' => 'Radiology', 'code' => 'RADI', 'status' => 'active'],
            ['name' => 'Immunology', 'code' => 'IMMU', 'status' => 'active'],
            ['name' => 'Pharmacology', 'code' => 'PHAR', 'status' => 'active'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }


        // Uncomment to use factory if available
        // Department::factory()->count(10)->create();
    }
}
