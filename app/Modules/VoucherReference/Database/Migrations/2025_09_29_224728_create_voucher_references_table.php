<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('ref_voucher_id');
            $table->string('type')->nullable();

            $table->timestamps();
            $table->unique(['voucher_id', 'ref_voucher_id', 'type'], 'unique_voucher_reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_references');
    }
};
