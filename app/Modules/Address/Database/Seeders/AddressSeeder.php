<?php

namespace App\Modules\Address\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Address\Models\Address;
use App\Modules\Patient\Models\Patient;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        // Address::create(['name' => 'Sample Address']);
                $patients = Patient::all();

        $addresses = [
            [
                'line1' => 'A-101, Green Park',
                'city' => 'New Delhi',
                'district' => 'South Delhi',
                'state_id' => 7, // example
                'country_id' => 1, // India
                'postal_code' => '110016',
                'latitude' => 28.5535,
                'longitude' => 77.2001,
                'address_type' => 'home',
                'is_primary' => true,
            ],
            [
                'line1' => '221B Baker Street',
                'city' => 'London',
                'district' => 'Marylebone',
                'state_id' => null,
                'country_id' => 2, // UK
                'postal_code' => 'NW16XE',
                'latitude' => 51.5237,
                'longitude' => -0.1585,
                'address_type' => 'home',
                'is_primary' => true,
            ],
            [
                'line1' => 'Flat 5B, Rosewood Apartments',
                'city' => 'Mumbai',
                'district' => 'Andheri',
                'state_id' => 21,
                'country_id' => 1,
                'postal_code' => '400053',
                'latitude' => 19.118,
                'longitude' => 72.8467,
                'address_type' => 'office',
                'is_primary' => true,
            ],
            [
                'line1' => 'Plot 22, Whitefield',
                'city' => 'Bengaluru',
                'district' => 'Bangalore Urban',
                'state_id' => 29,
                'country_id' => 1,
                'postal_code' => '560066',
                'latitude' => 12.9699,
                'longitude' => 77.7500,
                'address_type' => 'home',
                'is_primary' => true,
            ],
            [
                'line1' => 'G-12, Sunrise Residency',
                'city' => 'Pune',
                'district' => 'Pune',
                'state_id' => 21,
                'country_id' => 1,
                'postal_code' => '411045',
                'latitude' => 18.5204,
                'longitude' => 73.8567,
                'address_type' => 'home',
                'is_primary' => true,
            ],
        ];

        foreach ($patients as $index => $patient) {
            $addressData = $addresses[$index % count($addresses)];
            $addressData['addressable_id'] = $patient->id;
            $addressData['addressable_type'] = 'patient';

            Address::create($addressData);
        }

        // Uncomment to use factory if available
        // Address::factory()->count(10)->create();
    }
}
