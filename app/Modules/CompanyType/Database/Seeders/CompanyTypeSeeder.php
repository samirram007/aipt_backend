<?php

namespace App\Modules\CompanyType\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\CompanyType\Models\CompanyType;

class CompanyTypeSeeder extends Seeder
{
    public function run(): void
    {
        CompanyType::create([
            'name' => 'Manufacturing',
            'code' => 'MAN',
            'description' => 'Manufacturing industry',
        ]);

        // Uncomment to use factory if available
        // CompanyType::factory()->count(10)->create();
    }
}
