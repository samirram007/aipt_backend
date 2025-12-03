<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            // $table->foreignIdFor('account_types');
            $table->foreignId('account_group_id')->nullable();

            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();
            $table->boolean('is_system')->default(false);
            $table->boolean('is_hidden')->default(false);
            $table->unsignedBigInteger('ledgerable_id')->nullable();
            $table->string('ledgerable_type')->nullable();

            $table->timestamps();
            $table->index(['ledgerable_id', 'ledgerable_type']);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
