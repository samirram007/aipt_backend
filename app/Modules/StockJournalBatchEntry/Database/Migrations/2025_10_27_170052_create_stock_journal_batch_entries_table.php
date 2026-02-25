<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_journal_batch_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_entry_id');

            // Optional: if batches are tied to a specific godown split
            $table->unsignedBigInteger('stock_journal_godown_entry_id')->nullable();

            $table->enum('movement_type', ['in', 'out'])->default('in');
            // Batch details
            $table->string('batch_no')->nullable();
            $table->date('mfg_date')->nullable();
            $table->date('expiry_date')->nullable();

            // Serial tracking
            $table->string('serial_no')->nullable(); // used if serial tracking is enabled

            // Quantity
            $table->decimal('quantity', 15, 4)->default(0);

            // Cost
            $table->decimal('rate', 15, 4)->default(0);
            $table->decimal('amount', 18, 4)->virtualAs('quantity * rate');
            $table->timestamps();
            $table->blamable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_batch_entries');
    }
};
