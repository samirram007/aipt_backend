<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('gender_allowed', ['male', 'female', 'any'])->default('any');
            $table->boolean('isolation_supported')->default(false);
            $table->string('description')->nullable();
            $table->string('room_number')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintainence', 'under_cleaning', 'isolation', 'reserved_for_emergency'])->default('active');
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
