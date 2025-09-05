<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            // $table->foreignIdFor('account_types');
            $table->foreignId('account_group_id');
            // $table->foreignId('account_type_id')
            //     ->constrained('account_types')
            //     ->onDelete('cascade');

            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('account_ledgers', function (Blueprint $table) {
            $table->dropForeign(['account_group_id']);
        });
        Schema::dropIfExists('account_ledgers');
    }
};
