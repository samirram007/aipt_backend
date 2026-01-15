<?php

namespace App\Modules\Floor\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Floor\Models\Floor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FloorSeeder extends Seeder
{
    public function run(): void
    {
        $floors = [
            [
                'name' => 'Ground Floor',
                'code' => 'FLOOR-G',
                'description' => 'Reception and emergency services',
                'floor_number' => 0,
            ],
            [
                'name' => 'First Floor',
                'code' => 'FLOOR-1',
                'description' => 'Main inpatient floor',
                'floor_number' => 1,
            ],
            [
                'name' => 'Second Floor',
                'code' => 'FLOOR-2',
                'description' => 'General wards',
                'floor_number' => 2,
            ],
            [
                'name' => 'Third Floor',
                'code' => 'FLOOR-3',
                'description' => 'ICU and critical care',
                'floor_number' => 3,
            ],
            [
                'name' => 'Fourth Floor',
                'code' => 'FLOOR-4',
                'description' => 'Operation theatres',
                'floor_number' => 4,
            ],
            [
                'name' => 'Fifth Floor',
                'code' => 'FLOOR-5',
                'description' => 'Private rooms',
                'floor_number' => 5,
            ],
            [
                'name' => 'Sixth Floor',
                'code' => 'FLOOR-6',
                'description' => 'Administration offices',
                'floor_number' => 6,
            ],
            [
                'name' => 'Seventh Floor',
                'code' => 'FLOOR-7',
                'description' => 'Staff accommodation',
                'floor_number' => 7,
            ],
        ];

        foreach ($floors as $floor) {
            DB::table('floors')->insert([
                'id' => Str::uuid(),
                'name' => $floor['name'],
                'code' => $floor['code'],
                'description' => $floor['description'],
                'floor_number' => $floor['floor_number'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
