<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transporters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->string('gstin')->nullable();
            $table->string('pan')->nullable();
            $table->string('license_no')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Ledger binding
            $table->foreignId('account_ledger_id')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transporters');
    }
};
