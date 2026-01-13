<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_medical_histories', function (Blueprint $table) {
             $table->id();
            $table->uuid('patient_id');
            $table->string('condition_name');
            $table->string('condition_type')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_medical_histories');
    }
};
