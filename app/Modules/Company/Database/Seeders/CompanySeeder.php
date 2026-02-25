<?php

namespace App\Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Company\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::create([
            'name' => 'Sharma Hardware',
            'code' => 'C001',
            'mailing_name' => 'Sharma Hardware',
            'phone_no' => '03512-260342',
            'mobile_no' => '9805595288',
            'email' => 'sharma_hardware@gmail.com',
            'website' => 'www.sharma_hardware.com',
            'company_type_id' => 1,
            'cin_no' => '1234567890',
            'tin_no' => '1234567890',
            'tan_no' => '1234567890',
            'gst_no' => '19AAACL6442L1Z7',
            'pan_no' => '1234567890',
            'logo' => 'logo.png',
            'currency_id' => 1,
            'status' => 'active',
        ]);

        // Nested Address JSON
        $company->address()->create([
            'line1' => 'N.H.-34',
            'line2' => 'MangalBari',
            'landmark' => 'Near Bus Stand',
            'post_office' => 'Mangalbari',
            'district' => 'Malda',
            'city' => 'Malda',
            'state_id' => 36,
            'country_id' => 76,
            'postal_code' => '732142',
            'latitude' => null,
            'longitude' => null,
            'addressable_type' => 'company',
            'addressable_id' => $company->id,
            'address_type' => 'company',
            'is_primary' => 1,
        ]);
    }
}
