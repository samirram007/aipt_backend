<?php

namespace App\Modules\Agent\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Agent\Models\Agent;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        Agent::create([
            "name"=>"Tuhin",
            "email"=>"tuhin12@gmail.com",
            "contact_no"=>"1234567789",
            "commission_percent"=>15.00
        ]);

        // Uncomment to use factory if available
        // Agent::factory()->count(10)->create();


    }
}
