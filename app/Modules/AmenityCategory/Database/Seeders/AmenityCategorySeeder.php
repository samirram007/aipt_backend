<?php

namespace App\Modules\AmenityCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AmenityCategory\Models\AmenityCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AmenityCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('amenity_categories')->insert([
            [
                'id' => '0eb25884-dffd-42fa-9769-1972a669c8da',
                'name' => 'Patient Comfort',
                'code' => 'PATIENT_COMFORT',
                'description' => 'Amenities that enhance physical comfort and convenience for patients and attendants',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => '27f0dee5-15bf-4309-9977-97d001528840',
                'name' => 'Transport & Parking',
                'code' => 'TRANSPORT_PARKING',
                'description' => 'Amenities related to patient transport, vehicle access, and parking facilities',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => '3013c541-60d0-434d-a711-27b47a93684e',
                'name' => 'Wellness & Spiritual',
                'code' => 'WELLNESS_SPIRITUAL',
                'description' => 'Amenities that support mental, emotional, and spiritual well-being',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => '607a09e2-7813-4b10-bf9b-aa6903bb73c3',
                'name' => 'Housekeeping & Hygiene',
                'code' => 'HOUSEKEEPING_HYGIENE',
                'description' => 'Amenities supporting cleanliness, infection control, and waste management',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => '63c6978b-15a8-42d7-aacb-2160240254eb',
                'name' => 'Information & Support',
                'code' => 'INFORMATION_SUPPORT',
                'description' => 'Amenities related to guidance, communication, and patient assistance services',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => '6f4f8db0-1dcf-4113-8ff7-7b2c9f9cb8ad',
                'name' => 'Safety & Security',
                'code' => 'SAFETY_SECURITY',
                'description' => 'Amenities that ensure safety, protection, and emergency preparedness',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => 'cfeede7f-48e5-4bee-82e5-96d19cfc6763',
                'name' => 'Accessibility',
                'code' => 'ACCESSIBILITY',
                'description' => 'Amenities ensuring barrier-free and inclusive access for all individuals',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => 'd54fdae8-d3e4-4591-8071-0da784215bb3',
                'name' => 'Convenience',
                'code' => 'CONVENIENCE',
                'description' => 'Amenities that provide ease of access to essential services within the hospital',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'id' => 'e46bba3a-a752-4b4b-822d-86b53ccda679',
                'name' => 'Family & Visitor',
                'code' => 'FAMILY_VISITOR',
                'description' => 'Amenities designed to support attendants and visitors during hospital visits',
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,

            ],
        ]);
    }
}
