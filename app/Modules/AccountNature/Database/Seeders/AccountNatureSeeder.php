<?php

namespace App\Modules\AccountNature\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\AccountNature\Models\AccountNature;

class AccountNatureSeeder extends Seeder
{
    public function run(): void
    {
        AccountNature::create(['name' => 'Sample AccountNature']);

        // Uncomment to use factory if available
        // AccountNature::factory()->count(10)->create();
    }
}
