<?php

namespace App\Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Patient\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name'       => 'Rahul Sharma',
                'email'      => 'rahul.sharma@example.com',
                'gender'     => 'male',
                'dob'        => '1995-03-12',
                'status'     => 'active',
                'contact_no' => '9876543210',
                'image'      => null,
            ],
            [

                'name'       => 'Anita Verma',
                'email'      => 'anita.verma@example.com',
                'gender'     => 'female',
                'dob'        => '1998-07-25',
                'status'     => 'active',
                'contact_no' => '9123456789',
                'image'      => null,
            ],
            [

                'name'       => 'Sourav Das',
                'email'      => 'sourav.das@example.com',
                'gender'     => 'male',
                'dob'        => '1992-11-08',
                'status'     => 'inactive',
                'contact_no' => '9988776655',
                'image'      => null,
            ],
            [

                'name'       => 'Priya Sen',
                'email'      => 'priya.sen@example.com',
                'gender'     => 'female',
                'dob'        => '2000-01-19',
                'status'     => 'active',
                'contact_no' => '9090909090',
                'image'      => null,
            ],
            [
                'name'       => 'Amit Roy',
                'email'      => 'amit.roy@example.com',
                'gender'     => 'male',
                'dob'        => '1989-09-30',
                'status'     => 'active',
                'contact_no' => '9012345678',
                'image'      => null,
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}