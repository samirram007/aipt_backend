<?php

namespace App\Modules\VoucherPatient\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherPatient\Models\VoucherPatient;

class VoucherPatientSeeder extends Seeder
{
    public function run(): void
    {
        VoucherPatient::create(['name' => 'Sample VoucherPatient']);

        // Uncomment to use factory if available
        // VoucherPatient::factory()->count(10)->create();
    }
}
