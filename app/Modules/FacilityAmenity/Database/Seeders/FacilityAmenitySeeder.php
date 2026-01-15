<?php

namespace App\Modules\FacilityAmenity\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\FacilityAmenity\Models\FacilityAmenity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FacilityAmenitySeeder extends Seeder
{
    public function run(): void
    {
        $facilityId = '9cf972ea-7860-4e77-91bb-fc252b534fcb';

        $amenityIds = [
            '1af7e29f-4e70-4e45-9b38-b1c48e6e5d99',
            '2492d694-435e-42af-8914-13c10c18c20a',
            '2f57d8a1-b25f-4780-9816-53d5acf08d1a',
            '3ae7de24-058f-449e-9aa3-c0708175d6a1',
            '575a8577-df07-49e4-9940-15253f78f318', // Cafeteria
            '5efc7fed-5146-46ac-9041-034bc4c6ccdd', // Digital Signage
            '611a67d1-6f76-4482-a68b-dcfcd40044d0', // Elevators
            '931abbaa-2f71-47e4-89c5-abbf65896486', // Waiting Area
            '955a30cd-746e-4dc4-b576-eb3d2822010e', // Climate Comfort
            'a049c654-b755-478e-a1fc-ebab281633d7', // Housekeeping
            'a520f046-dcb2-4896-a2a3-c98ac1e64294', // Visitor Parking
            'ac6df309-362a-434c-a51e-082a6fe15860', // Free Wi-Fi
            'bdfb2b95-0339-4d64-ac71-f78db63ebd08', // Ambulance Access
            'c7732eca-b45b-4f0e-b190-6cd44eb856b6', // Pharmacy Access
            'cdff5255-c29c-4108-b4d7-a7ea1160dce7', // Wheelchair Access
            'df93ea6e-35eb-4723-bb20-57b92813b493', // Attendant Waiting
            'e990d131-cb98-4999-adc5-62ac93d45ce9', // Drinking Water
            'f24093e3-f206-4fbe-8010-d2bfc9427682', // Prayer Room
            'f6f5c3c7-72a3-4eba-949e-da9d6d866e68', // Ramps & Handrails
        ];

        $rows = [];

        foreach ($amenityIds as $amenityId) {
            $rows[] = [
                'id' => Str::uuid(),
                'facility_id' => $facilityId,
                'amenity_id' => $amenityId,
            ];
        }

        DB::table('facility_amenities')->insert($rows);
    }
}
