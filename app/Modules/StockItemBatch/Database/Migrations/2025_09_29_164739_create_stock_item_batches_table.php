<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_item_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_item_id');
            $table->string('batch_no');
            $table->decimal('quantity', 15, 3);
            $table->unsignedBigInteger('stock_unit_id');
            $table->date('manufacture_date');
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');


            $table->foreign('stock_item_id')->references('id')->on('stock_items')->onDelete('cascade');
            $table->foreign('stock_unit_id')->references('id')->on('stock_units')->onDelete('restrict');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_item_batches');
    }
};
