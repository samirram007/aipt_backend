<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique()->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('stock_groups')->onDelete('set null');

            $table->boolean('should_quantities_of_items_be_added')->default(true)
                ->comment('for Service: false, goods: true');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_groups');
    }
};
