<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_journal_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_id');
            $table->integer('entry_order')->default(0);
            $table->unsignedBigInteger('stock_item_id');
            $table->unsignedBigInteger('stock_unit_id')->nullable();
            $table->unsignedBigInteger('alternate_unit_id')->nullable();
            $table->decimal('unit_ratio', 15, 4)->default(1.00);
            $table->decimal('item_cost', 15, 4)->default(0);
            $table->decimal('order_quantity', 15, 4)->nullable();
            $table->decimal('snapshot_quantity', 15, 4)->nullable();
            $table->decimal('counted_quantity', 15, 4)->nullable();
            $table->decimal('actual_quantity', 15, 4)->nullable();
            $table->decimal('billing_quantity', 15, 4)->nullable();
            $table->decimal('rate', 15, 2)->default(0);
            $table->unsignedBigInteger('rate_unit_id')->default(0);
            $table->decimal('rate_unit_ratio', 15, 4)->default(1);
            $table->decimal('discount_percentage', 15, 4)->default(0);
            $table->decimal('discount', 15, 4)->default(0);
            $table->decimal('amount', 18, 4)->default(0);
            $table->string('movement_type')->default('in'); // 'in', 'out'

            $table->timestamps();
            $table->blamable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_entries');
    }
};
