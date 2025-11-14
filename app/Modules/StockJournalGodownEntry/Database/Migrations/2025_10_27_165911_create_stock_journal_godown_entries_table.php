<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_journal_godown_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_entry_id');

            // Reference to godown
            $table->unsignedBigInteger('godown_id');
            $table->string('batch_no')->nullable();
            $table->date('mfg_date')->nullable();
            $table->date('expiry_date')->nullable();

            // Serial tracking
            $table->string('serial_no')->nullable();
            // Quantities
            $table->decimal('actual_quantity', 15, 4)->default(1);
            $table->decimal('billing_quantity', 15, 4)->default(1);
            $table->decimal('rate', 15, 4)->default(0);
            $table->decimal('discount_percentage', 15, 4)->default(0);
            $table->decimal('discount', 15, 4)->default(0);
            $table->decimal('amount', 15, 4)->default(0);
            // $table->decimal('amount', 18, 4)->virtualAs('billing_quantity * rate - discount');

            // Movement direction: in / out
            $table->enum('movement_type', ['in', 'out'])->default('in');

            // Optional remarks
            $table->string('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_godown_entries');
    }
};
