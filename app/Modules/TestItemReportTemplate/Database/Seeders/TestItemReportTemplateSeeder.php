<?php

namespace App\Modules\TestItemReportTemplate\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\TestItemReportTemplate\Models\TestItemReportTemplate;

class TestItemReportTemplateSeeder extends Seeder
{
    public function run(): void
    {
        TestItemReportTemplate::create(['name' => 'Sample TestItemReportTemplate']);

        // Uncomment to use factory if available
        // TestItemReportTemplate::factory()->count(10)->create();
    }
}
