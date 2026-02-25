<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stock_journal_entries', function (Blueprint $table) {
            $table->decimal('order_quantity', 15, 4)->nullable()->after('item_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_journal_entries', function (Blueprint $table) {
             $table->dropColumn('order_quantity');
        });
    }
};
