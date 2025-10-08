<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // contact information
            $table->string('email')->nullable()->unique();
            $table->string('contact_no')->nullable();

            // details of commission
            $table->decimal('commission_percent', 5, 2)->default(0.00);

            // status of agent is active or deactive
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
