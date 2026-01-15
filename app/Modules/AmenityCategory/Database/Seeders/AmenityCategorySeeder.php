<?php

namespace App\Modules\AmenityCategory\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AmenityCategory\Models\AmenityCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AmenityCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('amenity_categories')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Patient Comfort',
                'code' => 'PATIENT_COMFORT',
                'description' => 'Amenities that enhance physical comfort and convenience for patients and attendants',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Accessibility',
                'code' => 'ACCESSIBILITY',
                'description' => 'Amenities ensuring barrier-free and inclusive access for all individuals',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Convenience',
                'code' => 'CONVENIENCE',
                'description' => 'Amenities that provide ease of access to essential services within the hospital',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Information & Support',
                'code' => 'INFORMATION_SUPPORT',
                'description' => 'Amenities related to guidance, communication, and patient assistance services',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Safety & Security',
                'code' => 'SAFETY_SECURITY',
                'description' => 'Amenities that ensure safety, protection, and emergency preparedness',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Housekeeping & Hygiene',
                'code' => 'HOUSEKEEPING_HYGIENE',
                'description' => 'Amenities supporting cleanliness, infection control, and waste management',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Family & Visitor',
                'code' => 'FAMILY_VISITOR',
                'description' => 'Amenities designed to support attendants and visitors during hospital visits',
                'status' => 'active',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Wellness & Spiritual',
                'code' => 'WELLNESS_SPIRITUAL',
                'description' => 'Amenities that support mental, emotional, and spiritual well-being',
                'status' => 'active'

            ],
            [
                'id' => Str::uuid(),
                'name' => 'Transport & Parking',
                'code' => 'TRANSPORT_PARKING',
                'description' => 'Amenities related to patient transport, vehicle access, and parking facilities',
                'status' => 'active',
            ],
        ]);
    }
}
