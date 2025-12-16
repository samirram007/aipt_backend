<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->integer('entry_order')->default(0); // Ledger/GL account
            $table->unsignedBigInteger('account_ledger_id'); // Ledger/GL account
            $table->decimal('debit', 15, 2)->default(0)->nullable();
            $table->decimal('credit', 15, 2)->default(0)->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->index(['voucher_id', 'account_ledger_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_entries');
    }
};
