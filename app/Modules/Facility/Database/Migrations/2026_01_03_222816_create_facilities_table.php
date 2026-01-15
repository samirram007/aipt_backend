<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');

            $table->string('facilityable_type');
            $table->uuid('facilityable_id');
            $table->timestamps();

            $table->index(['facilityable_id', 'facilityable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
