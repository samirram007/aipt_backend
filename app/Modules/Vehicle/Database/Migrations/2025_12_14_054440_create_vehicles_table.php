<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transporter_id');
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_no')->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');

            $table->timestamps();
            $table->unique(['transporter_id', 'vehicle_no'], 'unique_transporter_vehicle');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
