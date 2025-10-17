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
//         [
//   {
//     "name": "Prashant",
//     "status": "active",
//     "gender": "male",
//     "age": 34,
//     "contact_no": "6200000000",
//     "agent_id": 1,
//     "physician_id": 1,
//     "address": {
//       "line1": "abasadsv",
//       "line2": "dafdfsdfdfa",
//       "city": "Kolkata",
//       "state_id": 1,
//       "is_primary": true,
//       "postal_code": ""
//     }
//   },
//   {
//     "name": "Rohit",
//     "status": "active",
//     "gender": "male",
//     "age": 28,
//     "contact_no": "6200000001",
//     "agent_id": 2,
//     "physician_id": 2,
//     "address": {
//       "line1": "Street 12",
//       "line2": "Block A",
//       "city": "Mumbai",
//       "state_id": 2,
//       "is_primary": true,
//       "postal_code": "400001"
//     }
//   },
//   {
//     "name": "Anjali",
//     "status": "active",
//     "gender": "female",
//     "age": 30,
//     "contact_no": "6200000002",
//     "agent_id": 1,
//     "physician_id": 3,
//     "address": {
//       "line1": "Street 34",
//       "line2": "Block B",
//       "city": "Delhi",
//       "state_id": 3,
//       "is_primary": true,
//       "postal_code": "110001"
//     }
//   },
//   {
//     "name": "Suman",
//     "status": "active",
//     "gender": "female",
//     "age": 26,
//     "contact_no": "6200000003",
//     "agent_id": 2,
//     "physician_id": 1,
//     "address": {
//       "line1": "Street 56",
//       "line2": "Block C",
//       "city": "Bangalore",
//       "state_id": 4,
//       "is_primary": true,
//       "postal_code": "560001"
//     }
//   },
//   {
//     "name": "Ravi",
//     "status": "active",
//     "gender": "male",
//     "age": 32,
//     "contact_no": "6200000004",
//     "agent_id": 3,
//     "physician_id": 2,
//     "address": {
//       "line1": "Street 78",
//       "line2": "Block D",
//       "city": "Chennai",
//       "state_id": 5,
//       "is_primary": true,
//       "postal_code": "600001"
//     }
//   }
// ]

    }
}
