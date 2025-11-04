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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_no');
            $table->date('voucher_date');

            $table->string('reference_no')->nullable();
            $table->date('reference_date')->nullable();

            // $table->foreignIdFor('account_types');
            $table->foreignId('voucher_type_id');
            $table->boolean('is_effecting')->default(true);
            $table->boolean('is_optional')->default(false);
            $table->boolean('effects_account')->default(true);
            $table->boolean('effects_stock')->default(false);

            $table->text('remarks')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('fiscal_year_id')->default(2025);
            $table->unsignedBigInteger('company_id')->default(1);
            $table->unsignedBigInteger('stock_journal_id')->nullable();

            $table->timestamps();
            $table->blamable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
