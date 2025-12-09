<?php

use App\Enums\TestCancellation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_cancellation_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_entry_id');
            $table->enum('status', TestCancellation::getValues())->default('request');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();
        });

        $testCancelledList = "
        drop procedure if exists refundRequestList;
            create procedure refundRequestList()
            begin
                select sje.id as id, tcr.status as status, v.voucher_no as booking_no, v.voucher_date as booking_date, coalesce(tcr.remarks,'No remarks provided') as remarks, sje.amount as amount,
                sje.start_date as test_date, sje.end_date as report_date, sti.print_name as test_name, p.name as patient_name,
                p.age as patient_age, p.gender as patient_gender, p.contact_no as patient_contact, a.name as agent_name, phy.name as physician_name
                from
                stock_journal_entries sje inner join test_cancellation_requests tcr on tcr.stock_journal_entry_id = sje.id
                left join vouchers v on v.stock_journal_id = sje.stock_journal_id
                left join stock_items sti on sti.id = sje.stock_item_id
                left join voucher_patients vp on vp.voucher_id = v.id
                left join patients p on p.id = vp.patient_id
                left join agents a on a.id = vp.agent_id
                left join physicians phy on phy.id = vp.physician_id;
            end
        ";

        DB::unprepared($testCancelledList);
    }

    public function down(): void
    {
        Schema::dropIfExists('test_cancellation_requests');
        DB::unprepared("DROP PROCEDURE IF EXISTS `refundRequestList`");
    }
};
