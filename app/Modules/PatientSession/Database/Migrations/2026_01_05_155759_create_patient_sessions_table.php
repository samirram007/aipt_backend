<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_sessions', function (Blueprint $table) {
             $table->id();
             $table->uuid('patient_id');
             $table->uuid('doctor_id')->nullable();
             $table->string('session_type')->nullable();
             $table->dateTime('session_start_time')->nullable();
             $table->dateTime('session_close_time')->nullable();
             $table->string('status')->default('active');
             $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_sessions');
    }
};
