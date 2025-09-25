<?php

namespace App\Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Company\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'Sharma Hardware',
            'code' => 'C001',
            'mailing_name' => 'Sharma Hardware',
            'address' => 'N.H.-34, MangalBari, Malda',
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
            'country_id' => 76,
            'state_id' => 36,
            'city' => ' Malda',
            'zip_code' => '732142',
            'status' => 'active',
        ]);

        // Uncomment to use factory if available
        // Company::factory()->count(10)->create();
    }
}
