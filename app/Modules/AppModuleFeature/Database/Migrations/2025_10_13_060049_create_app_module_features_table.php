<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('app_module_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_module_id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('action')->nullable(); // optional, like 'GET', 'POST'
            $table->timestamps();
            $table->unique(['app_module_id', 'code']);
            $table->unique(['app_module_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_module_features');
    }
};
