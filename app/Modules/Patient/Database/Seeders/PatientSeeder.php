<?php

namespace App\Modules\Patient\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Patient\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        Patient::create([
            'name' => 'Abhijeet',
            'status' => 'active',
            'gender' => 'male',
            'age' => 34,
            'contact_no' => '6200000000',
            'agent_id' => 1,
            'physician_id' => 1,
        ]);

        Patient::create([
            'name' => 'Priya Sharma',
            'status' => 'active',
            'gender' => 'female',
            'age' => 29,
            'contact_no' => '9876543210',
            'agent_id' => 2,
            'physician_id' => 1,
        ]);

        Patient::create([
            'name' => 'Rohit Mehra',
            'status' => 'inactive',
            'gender' => 'male',
            'age' => 41,
            'contact_no' => '9988776655',
            'agent_id' => 3,
            'physician_id' => 2,
        ]);

        // ✅ New patients
        Patient::create([
            'name' => 'Nisha Verma',
            'status' => 'active',
            'gender' => 'female',
            'age' => 36,
            'contact_no' => '9812233445',
            'agent_id' => 1,
            'physician_id' => 2,
        ]);

        Patient::create([
            'name' => 'Arjun Patel',
            'status' => 'active',
            'gender' => 'male',
            'age' => 27,
            'contact_no' => '9821345678',
            'agent_id' => 2,
            'physician_id' => 3,
        ]);

        Patient::create([
            'name' => 'Sneha Iyer',
            'status' => 'active',
            'gender' => 'female',
            'age' => 32,
            'contact_no' => '9876512345',
            'agent_id' => 1,
            'physician_id' => 2,
        ]);

        Patient::create([
            'name' => 'Vikram Sethi',
            'status' => 'inactive',
            'gender' => 'male',
            'age' => 45,
            'contact_no' => '9955112233',
            'agent_id' => 3,
            'physician_id' => 3,
        ]);

        Patient::create([
            'name' => 'Meena Gupta',
            'status' => 'active',
            'gender' => 'female',
            'age' => 54,
            'contact_no' => '9788899777',
            'agent_id' => 2,
            'physician_id' => 4,
        ]);

        Patient::create([
            'name' => 'Deepak Rao',
            'status' => 'active',
            'gender' => 'male',
            'age' => 38,
            'contact_no' => '9898989898',
            'agent_id' => 1,
            'physician_id' => 1,
        ]);

        Patient::create([
            'name' => 'Aarav Khanna',
            'status' => 'active',
            'gender' => 'male',
            'age' => 22,
            'contact_no' => '9000001111',
            'agent_id' => 3,
            'physician_id' => 2,
        ]);

        Patient::create([
            'name' => 'Ritu Malhotra',
            'status' => 'inactive',
            'gender' => 'female',
            'age' => 48,
            'contact_no' => '9090909090',
            'agent_id' => 1,
            'physician_id' => 3,
        ]);
    }
}
