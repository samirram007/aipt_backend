<?php

namespace App\Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\User\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Sample User']);

        // Uncomment to use factory if available
        // User::factory()->count(10)->create();
    }
}
