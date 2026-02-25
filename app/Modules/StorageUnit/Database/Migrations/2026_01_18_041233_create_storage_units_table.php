<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // php artisan migrate --path="app/Modules/StorageUnit/Database/Migrations/2026_01_18_041233_create_storage_units_table.php"

        Schema::create('storage_units', function (Blueprint $table) {
            $table->id();

            /* ===============================
             * Identity
             * =============================== */
            $table->string('name')->unique();
            $table->string('code')->nullable()->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();



            /* ===============================
             * Classification
             * =============================== */
            $table->string('storage_unit_type');        // StorageUnitType enum
            $table->string('storage_unit_category');    // StorageUnitCategory enum

            /* ===============================
             * Hierarchy (self-referencing)
             * =============================== */
            // $table->foreignId('parent_id')
            //     ->nullable()
            //     ->constrained('storage_units')
            //     ->nullOnDelete();
            $table->unsignedBigInteger('parent_id')->nullable();
            /* ===============================
             * Behavior flags
             * =============================== */
            $table->boolean('is_virtual')->default(false);
            $table->boolean('is_mobile')->default(false);

            /* ===============================
             * Capacity / Constraints
             * =============================== */
            $table->decimal('capacity_value', 12, 3)->nullable();
            $table->unsignedBigInteger('capacity_unit_id')->nullable();
            $table->decimal('temperature_min', 5, 2)->nullable();
            $table->decimal('temperature_max', 5, 2)->nullable();

            /* ===============================
             * Stock Handling Flags
             * =============================== */
            $table->boolean('our_stock_with_third_party')->default(false);
            $table->boolean('third_party_stock_with_us')->default(false);

            /* ===============================
             * Audit
             * =============================== */
            $table->timestamps();

            /* ===============================
             * Indexes & Constraints
             * =============================== */
            $table->unique(['parent_id', 'code']);
            $table->index('storage_unit_type');
            $table->index('storage_unit_category');

            $table->index('parent_id');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('storage_units');
    }
};
