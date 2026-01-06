<?php

namespace App\Modules\Doctor\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Doctor\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name'           => 'Dr. Anil Kumar',
                'email'          => 'anil.kumar@example.com',
                'description'    => 'Senior Cardiologist with 10+ years experience',
                'designation_id' => 101,
                'department_id'  => 102,
                'gender'         => 'male',
                'dob'            => '1980-05-15',
                'doj'            => '2015-06-01',
                'status'         => 'active',
                'contact_no'     => '9876543211',
                'icon'           => null,
                'image'          => null,
            ],
            [
                'name'           => 'Dr. Sneha Paul',
                'email'          => 'sneha.paul@example.com',
                'description'    => 'Gynecologist and Obstetrics specialist',
                'designation_id' => 101,
                'department_id'  => 102,
                'gender'         => 'female',
                'dob'            => '1985-09-20',
                'doj'            => '2018-03-10',
                'status'         => 'active',
                'contact_no'     => '9123456781',
                'icon'           => null,
                'image'          => null,
            ],
            [
                'name'           => 'Dr. Rakesh Singh',
                'email'          => 'rakesh.singh@example.com',
                'description'    => 'Orthopedic surgeon',
                'designation_id' => 101,
                'department_id'  => 102,
                'gender'         => 'male',
                'dob'            => '1978-11-02',
                'doj'            => '2012-01-15',
                'status'         => 'active',
                'contact_no'     => '9988776651',
                'icon'           => null,
                'image'          => null,
            ],
            [
                'name'           => 'Dr. Priyanka Sen',
                'email'          => 'priyanka.sen@example.com',
                'description'    => 'Dermatologist',
                'designation_id' => 101,
                'department_id'  => 102,
                'gender'         => 'female',
                'dob'            => '1990-02-12',
                'doj'            => '2020-08-01',
                'status'         => 'active',
                'contact_no'     => '9090909091',
                'icon'           => null,
                'image'          => null,
            ],
            [
                'name'           => 'Dr. Amit Roy',
                'email'          => 'amit.roy@example.com',
                'description'    => 'General Physician',
                'designation_id' => 101,
                'department_id'  => 102,
                'gender'         => 'male',
                'dob'            => '1982-07-30',
                'doj'            => '2016-11-05',
                'status'         => 'inactive',
                'contact_no'     => '9012345671',
                'icon'           => null,
                'image'          => null,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
