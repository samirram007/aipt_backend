<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bom_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bom_id');
            $table->bigInteger('stock_item_id');
            $table->decimal('qty', 15, 4)->nullable();
            $table->decimal('rate', 15, 4)->nullable();
            $table->decimal('amount', 15, 4)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bom_details');
    }
};
