<?php

namespace App\Modules\Designation\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Designation\Models\Designation;

class DesignationSeeder extends Seeder
{
    public function run(): void
    {

        $designations = [['name' => 'SeniorDoctor', 'code' => 'SDO'], ['name' => 'JuniorDoctor', 'code' => 'JDO'], ['name' => 'Nurse', 'code' => 'NUR'],  ['name' => 'Therapist', 'code' => 'THE'], ['name' => 'Pharmacist', 'code' => 'PHA'], ['name' => 'SupportStaff', 'code' => 'SUP'], ['name' => 'Surgeon', 'code' => 'SUR'], ['name' => 'Specialist', 'code' => 'SPL']];

        Designation::create(['id' => '101', 'name' => 'Primary', 'code' => 'PRI', 'status' => 'active']);


         $id = 102;
foreach ($designations as $desn) {
    Designation::updateOrCreate(
        ['code' => $desn['code']],   // prevents duplicates
        [
            'id'          => $id++,
            'name'        => $desn['name'],

        ]
    );
    }
}
}
