<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_journal_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_id');
            $table->unsignedBigInteger('stock_journal_reference_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->primary(['stock_journal_id', 'stock_journal_reference_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_references');
    }
};
