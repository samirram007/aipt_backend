<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('physician_id')->nullable();
            $table->unsignedBigInteger('discount_type_id')->nullable();
            $table->unsignedBigInteger('sample_collector_id')->nullable();
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_patients');
    }
};
