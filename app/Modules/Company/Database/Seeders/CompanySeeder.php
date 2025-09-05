<?php

namespace App\Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Company\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'Abc Company',
            'code' => 'C001',
            'address' => '123 Main St',
            'phone' => '1234567890',
            'email' => 'info@example.com',
            'website' => 'www.example.com',
            'company_type_id' => 1,
            'fiscal_year_id' => 1,
            'tin' => '1234567890',
            'vat' => '1234567890',
            'logo' => 'logo.png',
            'currency' => 'INR',
            'country' => 'IN',
            'state' => 'Maharashtra',
            'city' => 'Mumbai',
            'zip' => '400001',
            'status' => 'active',
        ]);

        // Uncomment to use factory if available
        // Company::factory()->count(10)->create();
    }
}
