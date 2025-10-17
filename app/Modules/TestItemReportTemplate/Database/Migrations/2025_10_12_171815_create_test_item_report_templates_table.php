<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_item_report_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_item_id');
            $table->string('code')->unique()->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('report_template_name');
            $table->unique(
                ['test_item_id', 'doctor_id', 'report_template_name'],
                'unique_test_item_doctor_template_name'
            );
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_item_report_templates');
    }
};
