<?php

namespace App\Modules\Room\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'id' => '16e3bb44-f489-44d9-adce-7e74accef7fa',
                'name' => 'ICU 301',
                'code' => 'ICU-301',
                'description' => 'ICU bed with ventilator',
                'room_number' => '301',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => 'd5101c34-4f07-4f30-b7fc-6c9bcafc5215',
                'name' => 'ICU 302',
                'code' => 'ICU-302',
                'description' => 'ICU bed with monitoring',
                'room_number' => '302',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => 'c360c994-2517-4245-a7de-e666800007b3',
                'name' => 'OT 401',
                'code' => 'OT-401',
                'description' => 'Major operation theatre',
                'room_number' => '401',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '786423a7-efbb-4ecc-8ff5-bf0856803681',
                'name' => 'OT 402',
                'code' => 'OT-402',
                'description' => 'Minor operation theatre',
                'room_number' => '402',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '36677887-8d2c-42d6-abab-3255c72212ed',
                'name' => 'Room 101',
                'code' => 'RM-101',
                'description' => 'General ward room',
                'room_number' => '101',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => 'eb708a0b-9131-4c28-a8d7-d28a0f87d389',
                'name' => 'Room 102',
                'code' => 'RM-102',
                'description' => 'General ward room',
                'room_number' => '102',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '887f56eb-b6cf-4fd4-9361-2ce4f6b66e12',
                'name' => 'Room 103',
                'code' => 'RM-103',
                'description' => 'General ward room',
                'room_number' => '103',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '54177208-b9f2-489c-b2b7-9b837a5dcf9e',
                'name' => 'Room 201',
                'code' => 'RM-201',
                'description' => 'Semi-private room',
                'room_number' => '201',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '762daa08-558c-482f-b192-ed9a7e19e783',
                'name' => 'Room 202',
                'code' => 'RM-202',
                'description' => 'Semi-private room',
                'room_number' => '202',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '6ccb563b-31bd-433d-8a84-2295ae2a172e',
                'name' => 'Room G01',
                'code' => 'RM-G01',
                'description' => 'Emergency consultation room',
                'room_number' => 'G01',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
            [
                'id' => '99c5cb3a-ac99-4c73-96a5-f7c01cc0fb7a',
                'name' => 'Room G02',
                'code' => 'RM-G02',
                'description' => 'Triage room',
                'room_number' => 'G02',
                'status' => 'active',
                'created_at' => '2026-01-09 16:27:46',
                'updated_at' => '2026-01-09 16:27:46',
            ],
        ]);
    }
}
