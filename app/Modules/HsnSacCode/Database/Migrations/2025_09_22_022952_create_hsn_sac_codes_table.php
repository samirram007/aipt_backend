<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hsn_sac_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // HSN or SAC code
            $table->string('description')->nullable(); // Name/description of the code
            $table->string('status')->default('active');
            $table->enum('type', ['hsn', 'sac'])->default('hsn')
                ->comment('Type of code: HSN or SAC');
            // GST related
            $table->unsignedBigInteger('gst_slab_id');
            $table->unsignedBigInteger('gst_category_id');
            $table->enum('gst_type', ['cgst_sgst', 'igst'])->nullable(); // default GST type
            $table->boolean('is_gst_inclusive')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hsn_sac_codes');
    }
};
