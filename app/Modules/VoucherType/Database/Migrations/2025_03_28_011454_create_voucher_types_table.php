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
            $table->foreignId('parent_id')->nullable();
            $table->string('name')->unique()->comment("e.g., 'Purchase Voucher', 'Payment Voucher'");
            $table->string('code')->unique()->nullable();
            $table->string('print_name')->nullable();
            $table->foreignId('voucher_category_id')->comment('Link to categories');
            $table->boolean('is_financial')->default(true)->comment('Indicates if it affects ledger');
            $table->boolean('is_effecting')->default(true)->comment('Effecting the sub entries');
            $table->boolean('is_hidden')->default(false)->comment('Indicates if it is hidden');
            $table->boolean('is_system')->default(false)->comment('Indicates if it is a system voucher');
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();

            $table->string('default_voucher_number_prefix')->nullable()->comment('Prefix for auto-generated voucher numbers (e.g., P-, SJ-)');
            $table->integer('default_voucher_number_length')->nullable()->comment('Length of auto-generated voucher number (e.g., 4 for P0001)');
            $table->boolean('requires_approval')->default(false)->comment('Indicates if approval is required before posting');
            $table->enum('voucher_number_period', ['continuously', 'daily', 'weekly', 'monthly', 'quarterly', 'half-yearly', 'yearly'])
                ->default('yearly')
                ->comment('Period for voucher number reset: daily, monthly, yearly');
            $table->timestamps();

            $table->index('name');
            $table->index('voucher_category_id');
            $table->index('status');
            $table->index(['is_financial', 'is_hidden']);
            // $table->index('morphable_type');
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
