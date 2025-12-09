<?php

namespace App\Modules\TestCancellationRequest\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;

class TestCancellationRequestSeeder extends Seeder
{
    public function run(): void
    {
        TestCancellationRequest::create(['name' => 'Sample TestCancellationRequest']);

        // Uncomment to use factory if available
        // TestCancellationRequest::factory()->count(10)->create();
    }
}
