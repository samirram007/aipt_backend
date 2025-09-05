<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voucher_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment("e.g., 'Purchase Voucher', 'Payment Voucher'");
            $table->string('code')->unique()->nullable();
            $table->foreignId('voucher_category_id')->comment('Link to categories');
            $table->boolean('is_financial')->default(true)->comment('Indicates if it affects ledger');
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('voucher_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('voucher_types');
    }
};
