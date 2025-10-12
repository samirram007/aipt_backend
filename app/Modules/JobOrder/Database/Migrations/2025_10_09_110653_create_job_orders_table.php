<?php

use App\Enums\JobStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('stock_journal_id');
            $table->unsignedBigInteger('stock_journal_entry_id');
            $table->enum('status',JobStatus::getValues())->default(JobStatus::Booked->value);
            $table->enum('payment_status',PaymentStatus::getValues())->default(PaymentStatus::Pending->value);
            $table->date('report_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_orders');
    }
};
