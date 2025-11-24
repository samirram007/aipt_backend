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
            $table->unsignedBigInteger('stock_item_id');
            $table->unsignedBigInteger('stock_unit_id')->nullable();
            $table->unsignedBigInteger('alternate_unit_id')->nullable();
            $table->decimal('unit_ratio', 15, 4)->default(1.00);
            $table->decimal('item_cost', 15, 4)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('quantity', 15, 4)->default(1);
            $table->decimal('rate', 15, 2)->default(0);
            $table->decimal('discount_percentage', 15, 2)->default(0);
            $table->decimal('discount_value', 15, 2)->default(0);
            $table->decimal('amount', 15, 2)->virtualAs('quantity * rate - discount_value');
            $table->string('movement_type')->default('in'); // 'in', 'out'
            $table->unsignedBigInteger('godown_id')->nullable();
            $table->boolean('is_cancelled')->default(false);
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_entries');
    }
};
