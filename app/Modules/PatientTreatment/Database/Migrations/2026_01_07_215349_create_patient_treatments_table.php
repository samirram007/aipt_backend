<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_treatments', function (Blueprint $table) {
            $table->id();
            $table->uuid('patient_id');
            $table->uuid('treatment_id');
            $table->unsignedBigInteger('patient_session_id');
            $table->unsignedBigInteger('treatment_master_id');
            $table->date('treatment_date');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_treatments');
    }
};