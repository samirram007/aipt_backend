<?php

namespace App\Modules\Employee\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Employee\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::insert([
            [
                'name' => 'Dr. Rohan Verma',
                'code' => 'EMP-DOC-101',
                'dob' => '1985-03-22',
                'doj' => '2012-07-15',
                'email' => 'rohan.verma@hospital.com',
                'contact_no' => '9810000001',
                'education' => 'MBBS, MD (Biochemistry)',
                'pan' => 'ABCDE1234F',
                'department_id' => 102,
                'designation_id' => 105,
                'shift_id' => 1,
                'grade_id' => 1,
                'employee_group_id' => 1,
                'status' => 'active',
                'image' => null,
            ],
            [
                'name' => 'Dr. Meera Khanna',
                'code' => 'EMP-DOC-102',
                'dob' => '1988-05-14',
                'doj' => '2014-11-10',
                'email' => 'meera.khanna@hospital.com',
                'contact_no' => '9820000002',
                'education' => 'MBBS, MD (Hematology)',
                'pan' => 'XYZAB5678C',
                'department_id' => 104,
                'designation_id' => 106,
                'shift_id' => 1,
                'grade_id' => 2,
                'employee_group_id' => 1,
                'status' => 'active',
                'image' => null,
            ],
            [
                'name' => 'Dr. Aditya Rao',
                'code' => 'EMP-DOC-103',
                'dob' => '1982-12-09',
                'doj' => '2010-05-20',
                'email' => 'aditya.rao@hospital.com',
                'contact_no' => '9830000003',
                'education' => 'MBBS, MD (Pathology)',
                'pan' => 'LMNOP4321Z',
                'department_id' => 105,
                'designation_id' => 107,
                'shift_id' => 2,
                'grade_id' => 2,
                'employee_group_id' => 1,
                'status' => 'active',
                'image' => null,
            ],
            [
                'name' => 'Dr. Kavita Nair',
                'code' => 'EMP-DOC-104',
                'dob' => '1990-07-01',
                'doj' => '2016-09-05',
                'email' => 'kavita.nair@hospital.com',
                'contact_no' => '9840000004',
                'education' => 'MBBS, MD (Radiology)',
                'pan' => 'QWERT1234P',
                'department_id' => 106,
                'designation_id' => 108,
                'shift_id' => 3,
                'grade_id' => 3,
                'employee_group_id' => 1,
                'status' => 'active',
                'image' => null,
            ],
            [
                'name' => 'Dr. Aarav Sharma',
                'code' => 'EMP-DOC-105',
                'dob' => '1986-09-18',
                'doj' => '2011-03-10',
                'email' => 'aarav.sharma@hospital.com',
                'contact_no' => '9850000005',
                'education' => 'MBBS, MD (Immunology)',
                'pan' => 'ASDFG5678L',
                'department_id' => 107,
                'designation_id' => 108,
                'shift_id' => 1,
                'grade_id' => 1,
                'employee_group_id' => 1,
                'status' => 'active',
                'image' => null,
            ],
        ]);
    }
}
