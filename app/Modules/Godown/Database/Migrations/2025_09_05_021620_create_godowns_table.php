<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('godowns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            // $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('godowns')->onDelete('set null');
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
            $table->boolean('our_stock_with_third_party')->default(false);
            $table->boolean('third_party_stock_with_us')->default(false);
            $table->json('address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('godowns');
    }
};
