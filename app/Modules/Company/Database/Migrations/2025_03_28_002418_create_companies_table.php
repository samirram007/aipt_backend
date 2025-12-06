<?php

use App\Enums\ActiveInactive;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('mailing_name')->unique();
            $table->string('address')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('company_type_id');
            $table->string('cin_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('tan_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('currency_id')->default(1);
            $table->unsignedBigInteger('country_id')->default(76);
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->boolean('is_group_company')->default(false);
            $table->enum('status', array_column(ActiveInactive::cases(), 'value'))
                ->default(ActiveInactive::Active->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
