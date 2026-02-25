<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_journals', function (Blueprint $table) {
            $table->id();
            $table->string('journal_no');
            $table->date('journal_date');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->string('type'); // 'in', 'out', 'transfer', 'production'
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journals');
    }
};
