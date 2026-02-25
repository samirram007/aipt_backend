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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('symbol')->nullable()->comment(comment: 'Symbol for the currency (e.g., $, €, £)');
            $table->string('country')->nullable(); // Country associated with the currency
            $table->string('exchange_rate')->nullable(); // Exchange rate against a base currency
            $table->string('decimal_places')->default(2); // Number of decimal places for the currency
            $table->string('status')->default('active'); // Status of the currency (e.g., active, inactive)
            $table->string('format')->default('1,234.56'); // Format for displaying the currency (e.g., 1,234.56 or 1.234,56)
            $table->string('thousands_separator')->default(','); // Thousands separator (e.g., , or .)
            $table->string('decimal_separator')->default('.'); // Decimal separator (e.g., . or ,)
            $table->enum('symbol_position', ['before', 'after'])->default('before'); // Position of the symbol (e.g., before or after the amount)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
