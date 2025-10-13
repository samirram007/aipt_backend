<?php

namespace App\Modules\RoleFeaturePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\RoleFeaturePermission\Models\RoleFeaturePermission;

class RoleFeaturePermissionSeeder extends Seeder
{
    public function run(): void
    {
        RoleFeaturePermission::create(['name' => 'Sample RoleFeaturePermission']);

        // Uncomment to use factory if available
        // RoleFeaturePermission::factory()->count(10)->create();
    }
}
