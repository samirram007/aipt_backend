<?php

use App\Enums\QuantityType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('uqcs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->enum('quantity_type', array_column(QuantityType::cases(), 'value'))
                ->default(QuantityType::Measure->value);

            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uqcs');
    }
};
