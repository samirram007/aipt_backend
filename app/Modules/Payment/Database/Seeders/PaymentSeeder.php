<?php

namespace App\Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Payment\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create(['name' => 'Sample Payment']);

        // Uncomment to use factory if available
        // Payment::factory()->count(10)->create();
    }
}
