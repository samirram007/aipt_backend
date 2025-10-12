<?php

namespace App\Modules\PaymentTransaction\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\PaymentTransaction\Models\PaymentTransaction;

class PaymentTransactionSeeder extends Seeder
{
    public function run(): void
    {
        PaymentTransaction::create(['name' => 'Sample PaymentTransaction']);

        // Uncomment to use factory if available
        // PaymentTransaction::factory()->count(10)->create();
    }
}
