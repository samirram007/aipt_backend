<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // get allDepartmentTestSummaryReport ---------- Procedure
        $allDepartmentTestSummaryReportProcedure = "
            drop procedure if exists allDepartmentTestSummaryReport;
            create procedure allDepartmentTestSummaryReport(In `startDate` date, In `endDate` date)
            begin
                select  v.voucher_no as voucher_no , p.name as patient_name, sti.print_name as code, sti.name as test_name, sti.standard_selling_price as amount, v.voucher_date as booking_date , jo.status
                from vouchers v
                inner join voucher_patients vp on vp.voucher_id = v.id
                inner join patients p on p.id = vp.patient_id
                inner join stock_journal_entries stje on stje.stock_journal_id = v.stock_journal_id
                inner join stock_items sti on sti.id = stje.stock_item_id
                inner join job_orders as jo on jo.stock_journal_entry_id = stje.id where v.voucher_date between startDate and endDate;
            end
        ";

        DB::unprepared($allDepartmentTestSummaryReportProcedure);

        // get allDepartmentTestSummaryReportCount --------- Procedure
        $allDepartmentTestSummaryCountProcedure = "
            drop procedure if exists allDepartmentTestSummaryCount;
            create procedure allDepartmentTestSummaryCount(In `startDate` date, In `endDate` date)
            begin
                select count(stje.id) as total_test ,
                sum(case when jo.status = 'cancelled' then 1 else 0 end) as cancelled_test,
                sum(case when jo.status = 'cancellation_requested' then 1 else 0 end) as cancellation_request,
                sum(case when jo.status = 'collect_specimen' then 1 else 0 end) as collect_specimen,
                sum(case when jo.status = 'sample_collected' then 1 else 0 end) as test_to_be_confirm,
                sum(case when jo.status = 'in_process' then 1 else 0 end) as report_under_process,
                sum(case when jo.status = 'deliver_to_desk' then 1 else 0 end) as delivery_pending,
                sum(case when jo.status = 'delivered' then 1 else 0 end) as report_delivered
                from stock_journal_entries stje
                left join job_orders jo on jo.stock_journal_entry_id = stje.id
                left join vouchers v on v.id = jo.voucher_id where stje.movement_type = 'out' and v.voucher_date between start_date and end_date;
            code
        ";

        DB::unprepared($allDepartmentTestSummaryCountProcedure);
    }

    public function down(): void
    {
        Schema::dropIfExists('business_reports');
        DB::unprepared("DROP PROCEDURE IF EXISTS `allDepartmentTestSummaryReport`");
        DB::unprepared("DROP PROCEDURE IF EXISTS `allDepartmentTestSummaryCount`");
    }
};
