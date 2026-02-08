<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('boms', function (Blueprint $table) {
             $table->id();
            $table->string('name');
            $table->bigInteger('stock_item_id');
            $table->string('status')->default('active');
            $table->timestamps();

            $table->unique(['name','stock_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boms');
    }
};
