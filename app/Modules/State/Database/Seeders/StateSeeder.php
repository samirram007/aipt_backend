<?php

namespace App\Modules\State\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\State\Models\State;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        State::create(['name' => 'Sample State']);

        // Uncomment to use factory if available
        // State::factory()->count(10)->create();
    }
}
