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
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });

        // get allDepartmentTestSummaryReport ---------- Procedure
        $allDepartmentTestSummaryReportProcedure = "
            drop procedure if exists allDepartmentTestSummaryReport;
            create procedure allDepartmentTestSummaryReport(In `startDate` date, In `endDate` date)
            begin
                select  v.voucher_no as voucher_no , p.name as patient_name, sti.code as code, sti.print_name as print_name, sti.name as test_name, sti.standard_selling_price as amount, v.voucher_date as booking_date , jo.status
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
            create procedure allDepartmentTestSummaryCount(In `start_date` date, In `end_date` date)
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
            end
        ";


        $dailyCollectionSummaryReport = "
         drop procedure if exists dailyCollectionSummaryReport;
            create procedure dailyCollectionSummaryReport()
            begin
                select v.created_by as id,
                u.name as name,
                u.status as status,
                coalesce(any_value(vou.total_booking),0) as total_booking_amount,
                coalesce(any_value(vou2.total_discount),0) as total_discount_amount ,
                coalesce(any_value(vou3.total_cancellation),0) as total_cancellation_amount,
                coalesce(any_value(vou6.refund_amount),0) as refund,
                coalesce(any_value(vou7.discount_return),0) as discount_return,
                coalesce(any_value(vou4.total_cash_paid),0) as curr_total_cash,
                coalesce(any_value(vou.total_booking - vou4.total_cash_paid),0) as due_cash_amount,
                coalesce(any_value(vou.total_booking - vou5.total_bank_paid),0) as due_bank_amount,
                coalesce(any_value(vou5.total_bank_paid),0) as curr_bank_amount,
                coalesce(any_value(vou4.total_cash_paid  - vou6.refund_amount),0) as net_balance
                from vouchers v
                left join (select created_by, sum(credit)as total_booking from voucher_entries where account_ledger_id = 3000001 group by created_by) vou on vou.created_by = v.created_by
                left join(select created_by, sum(debit) as total_discount from voucher_entries where account_ledger_id = 4000007 group by created_by) vou2 on vou2.created_by = v.created_by
                left join(select created_by, sum(debit) as total_cancellation from voucher_entries where account_ledger_id = 3000005 group by created_by) vou3 on vou3.created_by = v.created_by
                left join(select created_by, sum(debit) as total_cash_paid from voucher_entries where account_ledger_id = 1000001 group by created_by) vou4 on vou4.created_by = v.created_by
                left join(select created_by, sum(debit) as total_bank_paid from voucher_entries where account_ledger_id = 1000002 group by created_by) vou5 on vou5.created_by = v.created_by
                left join(select v.created_by, sum(vre.credit) as refund_amount from
                voucher_references vr
                inner join vouchers v on vr.voucher_reference_id = v.id
                inner join voucher_entries vre on vre.voucher_id = vr.voucher_id
                where v.voucher_type_id = 1008 and account_ledger_id = 1000001 group by v.created_by)  vou6 on vou6.created_by = v.created_by
                left join (
                select v.created_by, sum(vr.credit) as discount_return from vouchers v inner join voucher_entries vr on vr.voucher_id = v.id
                where v.voucher_type_id = 1008 and vr.account_ledger_id = 4000007 group by v.created_by
                ) vou7 on vou7.created_by = v.created_by
                left join users u on u.id = v.created_by
                group by v.created_by order by v.created_by asc;
            end
        ";

        DB::unprepared($allDepartmentTestSummaryCountProcedure);
        DB::unprepared($dailyCollectionSummaryReport);
    }

    public function down(): void
    {
        Schema::dropIfExists('business_reports');
        DB::unprepared("DROP PROCEDURE IF EXISTS `allDepartmentTestSummaryReport`");
        DB::unprepared("DROP PROCEDURE IF EXISTS `allDepartmentTestSummaryCount`");
        DB::unprepared("DROP PROCEDURE IF EXISTS `dailyCollectionSummaryReport`");
    }
};
