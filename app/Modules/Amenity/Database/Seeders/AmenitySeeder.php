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
            [
                'id' => '1af7e29f-4e70-4e45-9b38-b1c48e6e5d99',
                'name' => 'Biomedical Waste Management',
                'code' => 'AMN_BMW',
                'amenity_category_id' => '607a09e2-7813-4b10-bf9b-aa6903bb73c3',
                'status' => 'active',
            ],
            [
                'id' => '2492d694-435e-42af-8914-13c10c18c20a',
                'name' => 'Reception & Help Desk',
                'code' => 'AMN_HELP_DESK',
                'amenity_category_id' => '63c6978b-15a8-42d7-aacb-2160240254eb',
                'status' => 'active',
            ],
            [
                'id' => '2f57d8a1-b25f-4780-9816-53d5acf08d1a',
                'name' => 'Fire Safety Systems',
                'code' => 'AMN_FIRE_SAFETY',
                'amenity_category_id' => '6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad',
                'status' => 'active',
            ],
            [
                'id' => '3ae7de24-058f-449e-9aa3-c0708175d6a1',
                'name' => 'CCTV Surveillance',
                'code' => 'AMN_CCTV',
                'amenity_category_id' => '6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad',
                'status' => 'active',
            ],
            [
                'id' => '575a8577-df07-49e4-9940-15253f78f318',
                'name' => 'Cafeteria / Food Court',
                'code' => 'AMN_CAFETERIA',
                'amenity_category_id' => 'd54fdae8-d3e4-4591-8071-0da784215bb3',
                'status' => 'active',
            ],
            [
                'id' => '5efc7fed-5146-46ac-9041-034bc4c6ccdd',
                'name' => 'Digital Signage',
                'code' => 'AMN_DIGITAL_SIGNAGE',
                'amenity_category_id' => '63c6978b-15a8-42d7-aacb-2160240254eb',
                'status' => 'active',
            ],
            [
                'id' => '611a67d1-6f76-4482-a68b-dcfcd40044d0',
                'name' => 'Elevators / Lifts',
                'code' => 'AMN_ELEVATORS',
                'amenity_category_id' => 'cfeede7f-48e5-4bee-82e5-96d19cfc6763',
                'status' => 'active',
            ],
            [
                'id' => '931abbaa-2f71-47e4-89c5-abbf65896486',
                'name' => 'Comfortable Waiting Areas',
                'code' => 'AMN_WAITING_AREA',
                'amenity_category_id' => '0eb25884-dffd-42fa-9769-1972a669c8da',
                'status' => 'active',
            ],
            [
                'id' => '955a30cd-746e-4dc4-b576-eb3d2822010e',
                'name' => 'Air Circulation / Climate Comfort',
                'code' => 'AMN_CLIMATE_COMFORT',
                'amenity_category_id' => '0eb25884-dffd-42fa-9769-1972a669c8da',
                'status' => 'active',
            ],
            [
                'id' => 'a049c654-b755-478e-a1fc-ebab281633d7',
                'name' => 'Housekeeping Services',
                'code' => 'AMN_HOUSEKEEPING',
                'amenity_category_id' => '607a09e2-7813-4b10-bf9b-aa6903bb73c3',
                'status' => 'active',
            ],
            [
                'id' => 'a520f046-dcb2-4896-a2a3-c98ac1e64294',
                'name' => 'Visitor Parking',
                'code' => 'AMN_VISITOR_PARKING',
                'amenity_category_id' => '27f0dee5-15bf-4309-9977-97d001528840',
                'status' => 'active',
            ],
            [
                'id' => 'ac6df309-362a-434c-a51e-082a6fe15860',
                'name' => 'Free Wi-Fi',
                'code' => 'AMN_WIFI',
                'amenity_category_id' => 'd54fdae8-d3e4-4591-8071-0da784215bb3',
                'status' => 'active',
            ],
            [
                'id' => 'bdfb2b95-0339-4d64-ac71-f78db63ebd08',
                'name' => 'Ambulance Access Area',
                'code' => 'AMN_AMBULANCE_ACCESS',
                'amenity_category_id' => '27f0dee5-15bf-4309-9977-97d001528840',
                'status' => 'active',
            ],
            [
                'id' => 'c7732eca-b45b-4f0e-b190-6cd44eb856b6',
                'name' => 'Pharmacy Access',
                'code' => 'AMN_PHARMACY',
                'amenity_category_id' => 'd54fdae8-d3e4-4591-8071-0da784215bb3',
                'status' => 'active',
            ],
            [
                'id' => 'cdff5255-c29c-4108-b4d7-a7ea1160dce7',
                'name' => 'Wheelchair Access',
                'code' => 'AMN_WHEELCHAIR_ACCESS',
                'amenity_category_id' => 'cfeede7f-48e5-4bee-82e5-96d19cfc6763',
                'status' => 'active',
            ],
            [
                'id' => 'df93ea6e-35eb-4723-bb20-57b92813b493',
                'name' => 'Attendant Waiting Area',
                'code' => 'AMN_ATTENDANT_WAITING',
                'amenity_category_id' => 'e46bba3a-a752-4b4b-822d-86b53ccda679',
                'status' => 'active',
            ],
            [
                'id' => 'e990d131-cb98-4999-adc5-62ac93d45ce9',
                'name' => 'Drinking Water Facility',
                'code' => 'AMN_DRINKING_WATER',
                'amenity_category_id' => '0eb25884-dffd-42fa-9769-1972a669c8da',
                'status' => 'active',
            ],
            [
                'id' => 'f24093e3-f206-4fbe-8010-d2bfc9427682',
                'name' => 'Prayer / Meditation Room',
                'code' => 'AMN_PRAYER_ROOM',
                'amenity_category_id' => '3013c541-60d0-434d-a711-27b47a93684e',
                'status' => 'active',
            ],
            [
                'id' => 'f6f5c3c7-72a3-4eba-949e-da9d6d866e68',
                'name' => 'Ramps & Handrails',
                'code' => 'AMN_RAMPS_HANDRAILS',
                'amenity_category_id' => 'cfeede7f-48e5-4bee-82e5-96d19cfc6763',
                'status' => 'active',
            ],
        ]);
    }
}
