<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physicians', function (Blueprint $table) {
            $table->id();
            // for accounts

            // core info / common info
            $table->string('name');
            $table->string('degree')->nullable();

            // contact info
            $table->string('email')->nullable()->unique();
            $table->string('contact_no')->nullable();
            $table->unsignedBigInteger('discipline_id')->nullable();

            // to continue data in the list
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physicians');
    }
};
