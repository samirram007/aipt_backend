<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('source_place_id');
            $table->unsignedBigInteger('destination_place_id');
            $table->decimal('estimated_time_in_minutes', 10, 2)->nullable();
            $table->decimal('distance_km', 10, 2);
            $table->decimal('rate', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_routes');
    }
};
