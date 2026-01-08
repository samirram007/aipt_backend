<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_treatment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_treatment_id');
            $table->string('result')->nullable();
            $table->string('remarks')->nullable();
            $table->datetime('performed_at')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_treatment_details');
    }
};