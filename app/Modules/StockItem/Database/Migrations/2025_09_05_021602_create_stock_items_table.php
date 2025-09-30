<?php

use App\Enums\CostingMethod;
use App\Enums\PricingMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {


        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();

            // Identity
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->string('print_name')->nullable();
            $table->string('sku')->nullable();
            $table->string('article_no')->nullable();
            $table->string('part_no')->nullable();
            $table->text('description')->nullable();

            // Units
            $table->unsignedBigInteger('stock_unit_id')->nullable();
            $table->unsignedBigInteger('alternate_stock_unit_id')->nullable();
            $table->decimal('base_unit_value', 15, 6)->nullable()->comment('Base quantity of primary unit (e.g., 1 KG or 1000 GM) in the conversion pair');
            $table->decimal('alternate_unit_value', 15, 6)->nullable()->comment('Corresponding quantity of alternate unit (e.g., 200 PC or 10 Pack) in the conversion pair');

            $table->unsignedBigInteger('uqc_id')->nullable();

            // Inventory / stock behavior
            $table->enum('type_of_supply', ['capital_goods', 'goods', 'services'])->default('goods');
            $table->boolean('is_negative_sales_allow')->default(false);
            $table->boolean('is_maintain_batch')->default(false);
            $table->boolean('is_maintain_serial')->default(false);
            $table->boolean('is_expiry_item')->default(false);

            // Manufacturing / type
            $table->boolean('is_finish_goods')->default(true);
            $table->boolean('is_raw_material')->default(false);
            $table->boolean('is_unfinished_goods')->default(false);

            // Costing & pricing
            $table->enum('costing_method', CostingMethod::getValues())->nullable();
            $table->enum('pricing_method', PricingMethod::getValues())->nullable();
            $table->decimal('reorder_level', 15, 6)->default(0);
            $table->decimal('minimum_stock', 15, 6)->default(0);
            $table->decimal('maximum_stock', 15, 6)->default(0);

            // Purchase / sales behavior flags
            $table->boolean('is_sales_as_new_manufacture')->default(false);
            $table->boolean('is_purchase_as_consumed')->default(false);
            $table->boolean('is_rejection_as_scrap')->default(false);

            // GST / tax
            $table->boolean('is_gst_applicable')->nullable();
            $table->decimal('rate_of_duty', 15, 6)->default(false);
            $table->string('hsn_sac_code')->nullable();
            $table->boolean('is_gst_inclusive')->default(false);
            $table->enum('gst_type', ['cgst_sgst', 'igst'])->nullable();

            // Classification / categories
            $table->unsignedBigInteger('stock_item_brand_id')->nullable();
            $table->unsignedBigInteger('stock_category_id')->nullable();
            $table->unsignedBigInteger('stock_group_id')->nullable();


            // E-commerce readiness
            $table->decimal('mrp', 15, 2)->nullable();
            $table->decimal('item_cost', 15, 2)->nullable();

            // Metadata
            $table->string('icon')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Apply all foreign key constraints at the end
        // Schema::table('stock_items', function (Blueprint $table) {
        //     $table->foreign('stock_unit_id')->references('id')->on('stock_units')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('alternative_stock_unit_id')->references('id')->on('stock_units')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('invoice_stock_unit_id')->references('id')->on('stock_units')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('uqc_id')->references('id')->on('uqcs')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('costing_method_id')->references('id')->on('costing_methods')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('pricing_method_id')->references('id')->on('pricing_methods')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnUpdate()->restrictOnDelete();
        //     $table->foreign('category_id')->references('id')->on('stock_categories')->cascadeOnUpdate()->restrictOnDelete();
        // });


    }

    public function down(): void
    {
        Schema::table('stock_items', function (Blueprint $table) {
            $table->dropForeign(['primary_stock_unit_id']);
            $table->dropForeign(['secondary_stock_unit_id']);
            $table->dropForeign(['invoice_stock_unit_id']);
            $table->dropForeign(['uqc_id']);
            $table->dropForeign(['costing_method_id']);
            $table->dropForeign(['pricing_method_id']);
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('stock_items');
    }
};
