<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->enum('user_type', ['admin', 'user'])->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->unsignedBigInteger('userable_id')->nullable();
            $table->string('userable_type')->default('employee');
            $table->string('status')->default('active');
            // SOCIALITE FIELDS (add these)
            $table->string('provider')->nullable();        // 'password', 'google', 'github', 'apple'
            $table->string('provider_id')->nullable()->unique(); // Google ID, GitHub ID, etc.
            $table->string('avatar')->nullable();
            $table->text('provider_token')->nullable();         // encrypted if you store it
            $table->text('provider_refresh_token')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['userable_id', 'userable_type']);
            $table->unique(['provider', 'provider_id']); // crucial!
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
