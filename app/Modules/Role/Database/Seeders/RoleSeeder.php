<?php

namespace App\Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Role\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Sample Role']);

        // Uncomment to use factory if available
        // Role::factory()->count(10)->create();
    }
}
