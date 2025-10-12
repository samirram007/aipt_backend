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
            'address' => json_encode([
                'line1' => 'abasadsv',
                'line2' => 'dafdfsdfdfa',
                'city' => 'Kolkata',
                'state_id' => 1,
                'is_primary' => true,
                'postal_code' => ''
            ]),
        ]);

        Patient::create([
            'name' => 'Priya Sharma',
            'status' => 'active',
            'gender' => 'female',
            'age' => 29,
            'contact_no' => '9876543210',
            'agent_id' => 2,
            'physician_id' => 1,
            'address' => json_encode([
                'line1' => '45 Park Street',
                'line2' => 'Apt 5B',
                'city' => 'Kolkata',
                'state_id' => 1,
                'is_primary' => true,
                'postal_code' => '700016'
            ]),
        ]);

        Patient::create([
            'name' => 'Rohit Mehra',
            'status' => 'inactive',
            'gender' => 'male',
            'age' => 41,
            'contact_no' => '9988776655',
            'agent_id' => 3,
            'physician_id' => 2,
            'address' => json_encode([
                'line1' => 'Sector 21',
                'line2' => 'Palm Residency',
                'city' => 'Noida',
                'state_id' => 9,
                'is_primary' => true,
                'postal_code' => '201301'
            ]),
        ]);
    }
}
