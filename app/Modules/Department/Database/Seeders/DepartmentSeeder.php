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
            ['id' => 101, 'name' => 'Primary', 'code' => 'PRI', 'status' => 'active'],
            ['id' => 102, 'name' => 'Biochemistry', 'code' => 'BIOC', 'status' => 'active'],
            ['id' => 103, 'name' => 'Microbiology', 'code' => 'MICR', 'status' => 'active'],
            ['id' => 104, 'name' => 'Hematology', 'code' => 'HEMA', 'status' => 'active'],
            ['id' => 105, 'name' => 'Pathology', 'code' => 'PATH', 'status' => 'active'],
            ['id' => 106, 'name' => 'Radiology', 'code' => 'RADI', 'status' => 'active'],
            ['id' => 107, 'name' => 'Immunology', 'code' => 'IMMU', 'status' => 'active'],
            ['id' => 108, 'name' => 'Pharmacology', 'code' => 'PHAR', 'status' => 'active'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

    }
}
