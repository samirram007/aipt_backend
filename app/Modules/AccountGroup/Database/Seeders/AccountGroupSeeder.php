<?php

namespace App\Modules\AccountGroup\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AccountGroup\Models\AccountGroup;

class AccountGroupSeeder extends Seeder
{
    public function run(): void
    {
        AccountGroup::create(['name' => 'Sample AccountGroup']);

        // Uncomment to use factory if available
        // AccountGroup::factory()->count(10)->create();
    }
}
