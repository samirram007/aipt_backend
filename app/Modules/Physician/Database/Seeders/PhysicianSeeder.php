<?php

namespace App\Modules\Physician\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Physician\Models\Physician;

class PhysicianSeeder extends Seeder
{
    public function run(): void
    {
        Physician::create([
            'name' => 'Dr. Arjun Singh',
            'degree' => 'MBBS, MD (General Medicine)',
            'email' => 'arjun.singh@example.com',
            'contact_no' => '9876543210',
            'discipline_id' => 1,
            'status' => true,
        ]);

        Physician::create([
            'name' => 'Dr. Meera Nair',
            'degree' => 'MBBS, MS (Gynecology)',
            'email' => 'meera.nair@example.com',
            'contact_no' => '9123456789',
            'discipline_id' => 2,
            'status' => true,
        ]);

        Physician::create([
            'name' => 'Dr. Rajesh Kumar',
            'degree' => 'MBBS, DM (Cardiology)',
            'email' => 'rajesh.kumar@example.com',
            'contact_no' => '9988776655',
            'discipline_id' => 3,
            'status' => false,
        ]);
    }
}
