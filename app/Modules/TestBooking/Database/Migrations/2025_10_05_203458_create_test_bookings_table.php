<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();

            $table->timestamps();
        });

        $refundRequests = "
            drop procedure if exists refundRequests;
            create procedure refundRequests()
            begin
                select v.voucher_no as booking_no,
                any_value(v.id) as voucher_id,
                any_value(vr.voucher_reference_id) as voucher_parent_id,
                any_value(v.voucher_date) as booking_date,
                any_value(v.remarks) as remarks,
                any_value(sje.amount) as amount,
                any_value(sje.start_date) as test_date,
                any_value(sje.end_date) as report_date,
                any_value(sti.print_name) as test_name,
                any_value(p.name) as patient_name,
                any_value(p.age) as patient_age,
                any_value(p.gender) as patient_gender,
                any_value(p.contact_no) as patient_contact,
                any_value(a.name) as agent_name,
                any_value(phy.name) as physician_name
                from vouchers v
                left join voucher_references vr on vr.voucher_id = v.id
                left join voucher_patients vp on vp.voucher_id = vr.voucher_reference_id
                left join patients p on p.id = vp.patient_id
                left join agents a on a.id = vp.agent_id
                left join physicians phy on phy.id = vp.physician_id
                left join voucher_entries ve on ve.voucher_id = v.id
                left join account_ledgers al on al.id = ve.account_ledger_id
                left join stock_journal_entries sje on sje.stock_journal_id = v.stock_journal_id
                left join stock_items sti on sti.id = sje.stock_item_id
                where v.voucher_type_id = 1008 and al.ledgerable_type = 'patient' group by v.voucher_no;
            end
        ";
        DB::unprepared($refundRequests);
    }

    public function down(): void
    {
        Schema::dropIfExists('test_bookings');
        DB::unprepared("DROP PROCEDURE IF EXISTS `refundRequests`");
    }
};
