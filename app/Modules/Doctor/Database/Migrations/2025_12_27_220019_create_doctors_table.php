<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->uuid('doctor_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->unique('id','doctor_id');//doctor id unique constraint with id
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
