<?php

namespace App\Modules\Building\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Building\Models\Building;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BuildingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('buildings')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Main Hospital Building',
                'code' => 'BLD-MAIN',
                'status' => 'active',
                'icon' => 'hospital',

                // physical attributes
                'building_type' => 'clinical',
                'total_area_sqft' => 250000.00,
                'covered_area_sqft' => 220000.00,
                'year_of_construction' => 2015,
                'sesmic_zone_compliance' => true,
                'structural_type' => 'RCC',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Emergency & Trauma Block',
                'code' => 'BLD-ER',
                'status' => 'active',
                'icon' => 'emergency',

                // physical attributes
                'building_type' => 'emergency',
                'total_area_sqft' => 120000.00,
                'covered_area_sqft' => 105000.00,
                'year_of_construction' => 2018,
                'sesmic_zone_compliance' => true,
                'structural_type' => 'Steel + RCC',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Research & Administration Block',
                'code' => 'BLD-RES-ADM',
                'status' => 'active',
                'icon' => 'office',

                // physical attributes
                'building_type' => 'administrative',
                'total_area_sqft' => 90000.00,
                'covered_area_sqft' => 82000.00,
                'year_of_construction' => 2012,
                'sesmic_zone_compliance' => true,
                'structural_type' => 'RCC',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
