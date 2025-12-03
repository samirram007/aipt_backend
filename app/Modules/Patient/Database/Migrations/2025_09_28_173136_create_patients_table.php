<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->string('contact_no');
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'others']);
            $table->string('status')->default('active');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('physician_id')->nullable();
            $table->unsignedBigInteger('discount_type_id')->default(1);
            $table->unique(['name', 'contact_no']);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });


        // Sample Collectors is another kind of agent or delivery person for a lab

        // Referenced Person

    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
