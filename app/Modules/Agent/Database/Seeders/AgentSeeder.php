<?php

namespace App\Modules\Agent\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Agent\Models\Agent;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        Agent::create([
            'name' => 'Rahul Verma',
            'email' => 'rahul.verma@example.com',
            'contact_no' => '9876543210',
            'commission_percent' => 10.50,
            'is_active' => true,
        ]);

        Agent::create([
            'name' => 'Sneha Patel',
            'email' => 'sneha.patel@example.com',
            'contact_no' => '9123456789',
            'commission_percent' => 8.25,
            'is_active' => true,
        ]);

        Agent::create([
            'name' => 'Amit Kumar',
            'email' => 'amit.kumar@example.com',
            'contact_no' => '9988776655',
            'commission_percent' => 12.00,
            'is_active' => false,
        ]);


    }
}
