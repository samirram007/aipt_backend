<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('capital_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('code')->unique();
            $table->string('print_name')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();

            $table->unsignedBigInteger('capital_item_category_id')->nullable(); // e.g., ICU Equip, Imaging, Furniture
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();

            $table->string('manufacturer')->nullable();
            $table->string('model_no')->nullable();
            $table->string('serial_no')->nullable();

            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 15, 2)->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('invoice_no')->nullable();

            $table->date('warranty_start_date')->nullable();
            $table->date('warranty_end_date')->nullable();
            $table->boolean('is_under_amc')->default(false);
            $table->date('amc_start_date')->nullable();
            $table->date('amc_end_date')->nullable();

            $table->enum('depreciation_method', ['none', 'slm', 'wdv'])->default('none');
            $table->decimal('depreciation_rate', 8, 2)->nullable();
            $table->integer('useful_life_years')->nullable();

            $table->enum('status', [
                'active',
                'in_use',
                'in_repair',
                'under_maintenance',
                'retired',
                'disposed',
                'inactive'
            ])->default('active');

            $table->string('status_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['name']);
            $table->index(['capital_item_category_id']);
            $table->index(['brand_id']);
            $table->index(['department_id']);
            $table->index(['serial_no']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capital_items');
    }
};
