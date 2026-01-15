<?php

namespace App\Modules\Facility\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Facility\Models\Facility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('facilities')->insert([
            [
                'id' => "9cf972ea-7860-4e77-91bb-fc252b534fcb",
                "parent_id" => null,
                "status" => "active",
                "facilityable_type" => "building",
                "facilityable_id" =>  "78f7bb19-4ecd-4712-8396-1c422260d31a",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "75e5ead3-6366-42de-96cd-19025e606377",
                "parent_id" => "9cf972ea-7860-4e77-91bb-fc252b534fcb",
                "status" => "active",
                "facilityable_type" => "floor",
                "facilityable_id" =>  "629a3074-f95f-4cbe-b330-23824d088e8c",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "20eee16c-8479-4561-9faf-2c9f24e94bfe",
                "parent_id" => "9cf972ea-7860-4e77-91bb-fc252b534fcb",
                "status" => "active",
                "facilityable_type" => "floor",
                "facilityable_id" =>  "4247b27c-4711-494f-8f09-172bd9557d37",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "22a7abb6-896f-4df4-a84a-e5da033d1fa2",
                "parent_id" => "9cf972ea-7860-4e77-91bb-fc252b534fcb",
                "status" => "active",
                "facilityable_type" => "floor",
                "facilityable_id" =>  "d881f591-eabc-4b04-9ae3-80922b5dbb9a",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "3de1c34f-da14-40eb-b7bc-73816d615377",
                "parent_id" => "9cf972ea-7860-4e77-91bb-fc252b534fcb",
                "status" => "active",
                "facilityable_type" => "floor",
                "facilityable_id" =>  "2a0d6f69-cd32-4d80-9e6c-699f4c157aab",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "19ccde85-4132-49a8-9ca1-175b6e5167a7",
                "parent_id" => "75e5ead3-6366-42de-96cd-19025e606377",
                "status" => "active",
                "facilityable_type" => "room",
                "facilityable_id" =>  "6ccb563b-31bd-433d-8a84-2295ae2a172e",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "7ad4491f-55fe-4c84-aeee-55276333a0ac",
                "parent_id" => "75e5ead3-6366-42de-96cd-19025e606377",
                "status" => "active",
                "facilityable_type" => "room",
                "facilityable_id" =>  "99c5cb3a-ac99-4c73-96a5-f7c01cc0fb7a",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                "parent_id" => "75e5ead3-6366-42de-96cd-19025e606377",
                "status" => "active",
                "facilityable_type" => "room",
                "facilityable_id" =>  "36677887-8d2c-42d6-abab-3255c72212ed",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "1a986979-c645-4094-8ffe-0835e0f4d4f6",
                "parent_id" => "20eee16c-8479-4561-9faf-2c9f24e94bfe",
                "status" => "active",
                "facilityable_type" => "room",
                "facilityable_id" =>  "eb708a0b-9131-4c28-a8d7-d28a0f87d389",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "583b6a24-6723-48c1-8da7-e3197c4e769f",
                "parent_id" => "20eee16c-8479-4561-9faf-2c9f24e94bfe",
                "status" => "active",
                "facilityable_type" => "room",
                "facilityable_id" =>  "36677887-8d2c-42d6-abab-3255c72212ed",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => "a3943fba-faff-47e7-bdd2-2264c2958371",
                "parent_id" => "20eee16c-8479-4561-9faf-2c9f24e94bfe",
                "status" => "active",
                "facilityable_type" => "room",
                "facilityable_id" =>  "36677887-8d2c-42d6-abab-3255c72212ed",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'id' => Str::uuid(),
            //     "parent_id" => null,
            //     "status" => "active",
            //     "facilityable_type" => "building",
            //     "facilityable_id" =>  "8b282891-069a-4a67-b90b-c8a0fa90c1dd",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'id' => Str::uuid(),
            //     "parent_id" => null,
            //     "status" => "active",
            //     "facilityable_type" => "building",
            //     "facilityable_id" =>  "304a13ec-d2db-4fd1-85c0-36b376e2a4d2",
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
