<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment("e.g., 'Simple', 'Compound', 'Primary'");

            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->string('status')->default('active');
            $table->string('icon')->nullable();

            $table->foreignId('voucher_type_id')->comment("Link to voucher types");
            $table->json('rules')->nullable()->comment('JSON for automation (e.g., {"tax_rate": 18})');


            $table->timestamps();

            // Indexes for performance
            $table->index('name');
            $table->index('voucher_type_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_classifications');
    }
};
