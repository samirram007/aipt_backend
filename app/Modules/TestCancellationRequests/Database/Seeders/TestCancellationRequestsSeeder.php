<?php

namespace App\Modules\TestCancellationRequests\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TestCancellationRequests\Models\TestCancellationRequests;

class TestCancellationRequestsSeeder extends Seeder
{
    public function run(): void
    {
        TestCancellationRequests::create(['name' => 'Sample TestCancellationRequests']);

        // Uncomment to use factory if available
        // TestCancellationRequests::factory()->count(10)->create();
    }
}
