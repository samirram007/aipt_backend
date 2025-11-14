<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_nos', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->nullable();
            $table->unsignedBigInteger('voucher_type_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('fiscal_year_id')->nullable();
            $table->integer('starting_no')->default(0);
            $table->integer('current_no')->default(0);
            $table->unique(['voucher_type_id', 'company_id', 'branch_id', 'fiscal_year_id'], 'unique_voucher_no');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_nos');
    }
};
