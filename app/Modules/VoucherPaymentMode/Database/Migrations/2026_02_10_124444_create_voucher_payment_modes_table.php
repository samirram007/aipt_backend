<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_payment_modes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->string('payment_mode', 20);



            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_payment_modes');
    }
};
