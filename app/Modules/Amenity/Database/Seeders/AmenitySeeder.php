<?php

namespace App\Modules\Amenity\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Amenity\Models\Amenity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('amenities')->insert([
            // Patient Comfort
            [
                'id' => Str::uuid(),
                'name' => 'Comfortable Waiting Areas',
                'code' => 'AMN_WAITING_AREA',
                'amenity_category_id' => '318f85e4-294a-4f35-9f06-e39d1e838298',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Air Circulation / Climate Comfort',
                'code' => 'AMN_CLIMATE_COMFORT',
                'amenity_category_id' => '318f85e4-294a-4f35-9f06-e39d1e838298',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Drinking Water Facility',
                'code' => 'AMN_DRINKING_WATER',
                'amenity_category_id' => '318f85e4-294a-4f35-9f06-e39d1e838298',
                'status' => 'active',
            ],

            // Accessibility
            [
                'id' => Str::uuid(),
                'name' => 'Wheelchair Access',
                'code' => 'AMN_WHEELCHAIR_ACCESS',
                'amenity_category_id' => 'faa9b98a-ca60-4935-9343-7dab667a2260',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ramps & Handrails',
                'code' => 'AMN_RAMPS_HANDRAILS',
                'amenity_category_id' => 'faa9b98a-ca60-4935-9343-7dab667a2260',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Elevators / Lifts',
                'code' => 'AMN_ELEVATORS',
                'amenity_category_id' => 'faa9b98a-ca60-4935-9343-7dab667a2260',
                'status' => 'active',
            ],

            // Convenience
            [
                'id' => Str::uuid(),
                'name' => 'Cafeteria / Food Court',
                'code' => 'AMN_CAFETERIA',
                'amenity_category_id' => 'a7feab79-c7b6-4d41-a5a1-9a811190f8c8',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Pharmacy Access',
                'code' => 'AMN_PHARMACY',
                'amenity_category_id' => 'a7feab79-c7b6-4d41-a5a1-9a811190f8c8',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Free Wi-Fi',
                'code' => 'AMN_WIFI',
                'amenity_category_id' => 'a7feab79-c7b6-4d41-a5a1-9a811190f8c8',
                'status' => 'active',
            ],

            // Information & Support
            [
                'id' => Str::uuid(),
                'name' => 'Reception & Help Desk',
                'code' => 'AMN_HELP_DESK',
                'amenity_category_id' => '90638275-3900-42b9-a36b-af9356901480',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Digital Signage',
                'code' => 'AMN_DIGITAL_SIGNAGE',
                'amenity_category_id' => '90638275-3900-42b9-a36b-af9356901480',
                'status' => 'active',
            ],

            // Safety & Security
            [
                'id' => Str::uuid(),
                'name' => 'CCTV Surveillance',
                'code' => 'AMN_CCTV',
                'amenity_category_id' => '005a048f-9fc1-46a2-aa25-3473e05eaef4',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Fire Safety Systems',
                'code' => 'AMN_FIRE_SAFETY',
                'amenity_category_id' => '005a048f-9fc1-46a2-aa25-3473e05eaef4',
                'status' => 'active',
            ],

            // Housekeeping & Hygiene
            [
                'id' => Str::uuid(),
                'name' => 'Housekeeping Services',
                'code' => 'AMN_HOUSEKEEPING',
                'amenity_category_id' => 'e3b25b72-bbc8-43b3-a6b3-93c281f3cfb2',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Biomedical Waste Management',
                'code' => 'AMN_BMW',
                'amenity_category_id' => 'e3b25b72-bbc8-43b3-a6b3-93c281f3cfb2',
                'status' => 'active',
            ],

            // Family & Visitor
            [
                'id' => Str::uuid(),
                'name' => 'Attendant Waiting Area',
                'code' => 'AMN_ATTENDANT_WAITING',
                'amenity_category_id' => '1b7380e5-e404-41c4-9908-faf3ab25d2c2',
                'status' => 'active',
            ],

            // Wellness & Spiritual
            [
                'id' => Str::uuid(),
                'name' => 'Prayer / Meditation Room',
                'code' => 'AMN_PRAYER_ROOM',
                'amenity_category_id' => '172e5e68-e5bd-4ce9-9b64-a00725e88b09',
                'status' => 'active',
            ],

            // Transport & Parking
            [
                'id' => Str::uuid(),
                'name' => 'Ambulance Access Area',
                'code' => 'AMN_AMBULANCE_ACCESS',
                'amenity_category_id' => 'ec538e47-623b-4e13-a744-4440f9359a2c',
                'status' => 'active',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Visitor Parking',
                'code' => 'AMN_VISITOR_PARKING',
                'amenity_category_id' => 'ec538e47-623b-4e13-a744-4440f9359a2c',
                'status' => 'active',
            ],
        ]);
    }
}
