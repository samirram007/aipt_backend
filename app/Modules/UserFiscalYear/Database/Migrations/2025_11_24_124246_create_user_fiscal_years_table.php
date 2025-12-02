<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_fiscal_years', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('fiscal_year_id');

            // $table->timestamps();
            $table->unique(['user_id', 'fiscal_year_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_fiscal_years');
    }
};
