<?php

namespace App\Modules\Department\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Department\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
    ['name' => 'Radiology', 'code' => 'RAD', 'description' => 'Medical imaging department'],
    ['name' => 'Cardiology', 'code' => 'CAR', 'description' => 'Heart-related treatments'],
    ['name' => 'Emergency', 'code' => 'EMR', 'description' => 'Immediate medical care'],
    ['name' => 'Neurology', 'code' => 'NEU', 'description' => 'Nervous system treatments'],
    ['name' => 'Pediatrics', 'code' => 'PED', 'description' => 'Child healthcare services'],
    ['name' => 'Psychiatry', 'code' => 'PSY', 'description' => 'Mental health treatments'],
    ['name' => 'Oncology', 'code' => 'ONC', 'description' => 'Cancer care services'],
    ['name' => 'Obstetrics and Gynecology', 'code' => 'OBG', 'description' => 'Women healthcare'],
    ['name' => 'Gastroenterology', 'code' => 'GAS', 'description' => 'Digestive system care'],
    ['name' => 'General Surgery', 'code' => 'SUR', 'description' => 'Surgical procedures'],
    ['name' => 'Anesthesiology', 'code' => 'ANE', 'description' => 'Anesthesia and pain control'],
    ['name' => 'Psychology', 'code' => 'PSL', 'description' => 'Behavioral counseling services'],
    ['name' => 'Laboratory', 'code' => 'LAB', 'description' => 'Clinical diagnostics'],
    ['name' => 'Nephrology', 'code' => 'NEP', 'description' => 'Kidney care services'],
    ['name' => 'Doctor-Chamber', 'code' => 'DOC', 'description' => 'Doctor consultation area'],
];


        // Primary Department
        Department::create([
            'id'          => 101,
            'name'        => 'Primary',
            'code'        => 'PRI',
            'description' => 'Primary and general medical services',
            'status'      => 'active',
        ]);

        // Other departments
        $id = 102;
foreach ($departments as $dept) {
    Department::updateOrCreate(
        ['code' => $dept['code']],   // prevents duplicates
        [
            'id'          => $id++,
            'name'        => $dept['name'],
            'description' => $dept['description'],
            'status'      => 'active',
        ]
    );
}

    }
}