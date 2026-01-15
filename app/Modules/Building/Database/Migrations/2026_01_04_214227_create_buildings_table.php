<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->string('icon')->nullable();

            // physical attributes
            $table->string('building_type');
            $table->decimal('total_area_sqft', 15, 2)->nullable();
            $table->decimal('covered_area_sqft', 15, 2)->nullable();
            $table->integer('year_of_construction');
            $table->boolean('sesmic_zone_compliance')->default(true);
            $table->string('structural_type');

            $table->boolean('has_fire_safety_certificate')->default(false);
            $table->boolean('has_lift')->default(false);
            $table->date('fire_certificate_valid_upto');
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
