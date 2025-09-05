<?php

namespace App\Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Auth\Models\Auth;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        Auth::create(['name' => 'Sample Auth']);

        // Uncomment to use factory if available
        // Auth::factory()->count(10)->create();
    }
}
