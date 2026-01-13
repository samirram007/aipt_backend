<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_surgical_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('patient_id');
            $table->string('surgery_name');
            $table->date('surgery_date')->nullable();
            $table->string('hospital_name')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_surgical_histories');
    }
};
