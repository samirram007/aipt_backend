<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_places', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->nullable()->unique();

            $table->string('place_type')->nullable();
            $table->boolean('is_active')->default(true);

            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_places');
    }
};
