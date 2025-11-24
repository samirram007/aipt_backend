<?php

namespace App\Modules\BusinessReport\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\BusinessReport\Models\BusinessReport;

class BusinessReportSeeder extends Seeder
{
    public function run(): void
    {
        // BusinessReport::create(['name' => 'Sample BusinessReport']);


        $businessReports = [
            [
                "id" => 9001,
                "name" => "Test Summary",
                "code" => "TEST_SUMMARY",
                "status" => "active",
                "description" => "TEST_SUMMARY"
            ],
            [
                "id" => 9002,
                "name" => "Test Summary [Self]",
                "code" => "TEST_SUMMARY_SELF",
                "status" => "active",
                "description" => "TEST_SUMMARY_SELF"
            ],
            [
                "id" => 9003,
                "name" => "Refund Report",
                "code" => "REFUND_REPORT",
                "status" => "active",
                "description" => "REFUND_REPORT"
            ],
            [
                "id" => 9004,
                "name" => "Commission",
                "code" => "COMMISSION",
                "status" => "active",
                "description" => "COMMISSION"
            ],
            [
                "id" => 9005,
                "name" => "Daily Collection Report",
                "code" => "DAILY_COLLECTION_REPORT",
                "status" => "active",
                "description" => "DAILY_COLLECTION_REPORT"
            ],
            [
                "id" => 9006,
                "name" => "Daily Collection Report [Self]",
                "code" => "DAILY_COLLECTION_REPORT_SELF",
                "status" => "active",
                "description" => "DAILY_COLLECTION_REPORT_SELF"
            ],
            [
                "id" => 9007,
                "name" => "Daily Collection Report [Dept]",
                "code" => "DAILY_COLLECTION_REPORT_DEPT",
                "status" => "active",
                "description" => "DAILY_COLLECTION_REPORT_DEPT"
            ],
            [
                "id" => 9008,
                "name" => "Daily Business Report",
                "code" => "DAILY_BUSINESS_REPORT",
                "status" => "active",
                "description" => "DAILY_BUSINESS_REPORT"
            ],
            [
                "id" => 9009,
                "name" => "Refer-Doctor Report",
                "code" => "REFER_DOCTOR_REPORT",
                "status" => "active",
                "description" => "REFER_DOCTOR_REPORT"
            ],
            [
                "id" => 9010,
                "name" => "Agent Report",
                "code" => "AGENT_REPORT",
                "status" => "active",
                "description" => "AGENT_REPORT"
            ],
            [
                "id" => 9011,
                "name" => "Outstanding Report [USER-WISE]",
                "code" => "OUTSTANDING_REPORT_USER_WISE",
                "status" => "active",
                "description" => "OUTSTANDING_REPORT_USER_WISE"
            ],
        ];

        foreach ($businessReports as $businessReport) {
            BusinessReport::create($businessReport);
        }

        // Uncomment to use factory if available
        // BusinessReport::factory()->count(10)->create();
    }
}
