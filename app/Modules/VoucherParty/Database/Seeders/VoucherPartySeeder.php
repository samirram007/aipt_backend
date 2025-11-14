<?php

namespace App\Modules\VoucherParty\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\VoucherParty\Models\VoucherParty;

class VoucherPartySeeder extends Seeder
{
    public function run(): void
    {
        VoucherParty::create(['name' => 'Sample VoucherParty']);

        // Uncomment to use factory if available
        // VoucherParty::factory()->count(10)->create();
    }
}
