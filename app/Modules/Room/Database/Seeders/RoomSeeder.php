<?php

namespace App\Modules\Room\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            // Ground Floor
            [
                'name' => 'Room G01',
                'code' => 'RM-G01',
                'room_number' => 'G01',
                'description' => 'Emergency consultation room',
            ],
            [
                'name' => 'Room G02',
                'code' => 'RM-G02',
                'room_number' => 'G02',
                'description' => 'Triage room',
            ],

            // First Floor
            [
                'name' => 'Room 101',
                'code' => 'RM-101',
                'room_number' => '101',
                'description' => 'General ward room',
            ],
            [
                'name' => 'Room 102',
                'code' => 'RM-102',
                'room_number' => '102',
                'description' => 'General ward room',
            ],
            [
                'name' => 'Room 103',
                'code' => 'RM-103',
                'room_number' => '103',
                'description' => 'General ward room',
            ],

            // Second Floor
            [
                'name' => 'Room 201',
                'code' => 'RM-201',
                'room_number' => '201',
                'description' => 'Semi-private room',
            ],
            [
                'name' => 'Room 202',
                'code' => 'RM-202',
                'room_number' => '202',
                'description' => 'Semi-private room',
            ],

            // ICU Floor
            [
                'name' => 'ICU 301',
                'code' => 'ICU-301',
                'room_number' => '301',
                'description' => 'ICU bed with ventilator',
            ],
            [
                'name' => 'ICU 302',
                'code' => 'ICU-302',
                'room_number' => '302',
                'description' => 'ICU bed with monitoring',
            ],

            // Operation Theatre
            [
                'name' => 'OT 401',
                'code' => 'OT-401',
                'room_number' => '401',
                'description' => 'Major operation theatre',
            ],
            [
                'name' => 'OT 402',
                'code' => 'OT-402',
                'room_number' => '402',
                'description' => 'Minor operation theatre',
            ],
        ];

        foreach ($rooms as $room) {
            DB::table('rooms')->insert([
                'id' => Str::uuid(),
                'name' => $room['name'],
                'code' => $room['code'],
                'room_number' => $room['room_number'],
                'description' => $room['description'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
