<?php

namespace App\Modules\Physician\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Physician\Models\Physician;

class PhysicianSeeder extends Seeder
{
    public function run(): void
    {
        Physician::create([
            "name"=>"John",
            "degree"=>"M.B.B.S",
            "contact_no"=>"1234567890",
            "discipline_id"=>1,
        ]);

        // Uncomment to use factory if available
        // Physician::factory()->count(10)->create();
    }
}
