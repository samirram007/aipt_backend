<?php

use App\Enums\JobStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->unsignedBigInteger('stock_journal_id')->nullable();
            $table->unsignedBigInteger('stock_journal_entry_id');
            $table->date('expected_start_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->unsignedBigInteger('process_by')->nullable();
            $table->enum('status', JobStatus::getValues())->default(JobStatus::Booked->value);
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->string('report_file_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_orders');
    }
};
