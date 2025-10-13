<?php

namespace App\Modules\RoleUser\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\RoleUser\Models\RoleUser;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        RoleUser::create(['name' => 'Sample RoleUser']);

        // Uncomment to use factory if available
        // RoleUser::factory()->count(10)->create();
    }
}
