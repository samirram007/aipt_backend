<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transporter_id');
            $table->unsignedBigInteger('source_place_id');
            $table->unsignedBigInteger('destination_place_id');
            $table->string('vehicle_no')->nullable();
            $table->decimal('estimated_time_in_minutes', 10, 2)->nullable();
            $table->decimal('distance_km', 10, 2)->nullable();
            $table->decimal('rate', 10, 2)->nullable();
            $table->unsignedBigInteger('rate_unit_id')->default(16);
            $table->timestamps();
            $table->unique(['transporter_id', 'source_place_id', 'destination_place_id', 'vehicle_no'], 'unique_delivery_route');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_routes');
    }
};
