<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_item_prices', function (Blueprint $table) {
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
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('customer_group_id')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->enum('channel', ['retail', 'wholesale', 'online', 'export'])->nullable();

            // Effective dates
            $table->date('effective_from');
            $table->date('effective_to')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_item_prices');
    }
};
