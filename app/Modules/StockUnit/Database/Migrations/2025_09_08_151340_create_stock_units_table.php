<?php

use App\Enums\QuantityType;
use App\Enums\UnitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->enum('unit_type', array_column(UnitType::cases(), 'value'))
                ->default(UnitType::Simple->value);
            $table->enum('quantity_type', array_column(QuantityType::cases(), 'value'))
                ->default(QuantityType::Measure->value);

            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();

            $table->unsignedBigInteger('unique_quantity_code_id')->nullable();
            $table->unsignedBigInteger('primary_stock_unit_id')->nullable();
            $table->unsignedBigInteger('secondary_stock_unit_id')->nullable();
            $table->decimal('conversion_factor', 15, 6)->nullable()->comment('Conversion from primary unit to secondary unit');
            $table->integer('no_of_decimal_places')->default(0);
            $table->boolean('is_base')->default(false)->comment('Mark this as base unit for the item');
            $table->timestamps();

            $table->index(['unique_quantity_code_id', 'primary_stock_unit_id', 'secondary_stock_unit_id'], 'stock_units_qty_unit_idx');
            $table->index(['unique_quantity_code_id', 'primary_stock_unit_id', 'secondary_stock_unit_id'], 'unique_stock_unit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_units');
    }
};
