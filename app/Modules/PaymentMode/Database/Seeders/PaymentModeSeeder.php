<?php

namespace App\Modules\PaymentMode\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PaymentMode\Models\PaymentMode;

class PaymentModeSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMode::create(['name' => 'Sample PaymentMode']);

        // Uncomment to use factory if available
        // PaymentMode::factory()->count(10)->create();
    }
}
