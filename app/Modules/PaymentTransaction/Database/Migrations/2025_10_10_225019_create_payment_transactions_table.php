<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_entry_id');
            $table->unsignedBigInteger('payment_mode_id');
            $table->unsignedBigInteger('account_ledger_id');
            $table->string('payment_card_no');
            $table->string('cheque_no');
            $table->string('tid_no')->nullable();
            $table->string('transaction_no')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
