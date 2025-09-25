<?php

use App\Enums\CostingMethod;
use App\Enums\PricingMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {


        Schema::create('item_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_item_id')->constrained('stock_items')->cascadeOnDelete();

            // Pricing type
            $table->enum('pricing_method', [
                'mrp',
                'list',
                'cost_plus',
                'discount',
                'contract',
                'dynamic'
            ])->default('list');

            $table->decimal('price', 15, 2);
            $table->decimal('markup_percent', 5, 2)->nullable();   // for cost_plus
            $table->decimal('discount_percent', 5, 2)->nullable(); // for discount
            $table->string('currency', 10)->default('INR');

            // Multi-level context
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->foreignId('customer_group_id')->nullable()->constrained('customer_groups');
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->enum('channel', ['retail', 'wholesale', 'online', 'export'])->nullable();

            // Effective dates
            $table->date('effective_from');
            $table->date('effective_to')->nullable();

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
        // Schema::table('stock_items', function (Blueprint $table) {
        //     $table->dropForeign(['primary_stock_unit_id']);
        //     $table->dropForeign(['secondary_stock_unit_id']);
        //     $table->dropForeign(['invoice_stock_unit_id']);
        //     $table->dropForeign(['uqc_id']);
        //     $table->dropForeign(['costing_method_id']);
        //     $table->dropForeign(['pricing_method_id']);
        //     $table->dropForeign(['brand_id']);
        //     $table->dropForeign(['category_id']);
        // });

        Schema::dropIfExists('item_prices');
    }
};
