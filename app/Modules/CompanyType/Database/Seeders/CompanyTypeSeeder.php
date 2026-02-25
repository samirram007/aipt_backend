<?php

namespace App\Modules\CompanyType\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CompanyType\Models\CompanyType;

class CompanyTypeSeeder extends Seeder
{
    public function run(): void
    {
        CompanyType::create([
            'name' => 'Transport',
            'code' => 'TRAN',
            'description' => 'Transport industry',
            'status' => 'active'
        ]);

        // Uncomment to use factory if available
        // CompanyType::factory()->count(10)->create();
    }
}
