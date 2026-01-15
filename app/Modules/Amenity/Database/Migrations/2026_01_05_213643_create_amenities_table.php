<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('code');
            $table->uuid('amenity_category_id');
            $table->enum('status', ['active', 'inactive']);
            // $table->uuid('parent_id')->nullable();
            // $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');

            // $table->string('amenityable_type');
            // $table->uuid('amenityable_id');
            // $table->timestamps();

            // $table->index(['amenityable_type', 'amenityable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
