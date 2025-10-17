<?php

use App\Enums\DiscountValueType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique()->nullable();
            $table->boolean('is_percentage')->default(true);
            $table->decimal('value',10,2)->default(0.00);
            // $table->enum('type',DiscountValueType::getValues())->default(DiscountValueType::Percentage->value);
            // $table->decimal('value',10,2)->default(0.00);
            // $table->boolean('is_global')->default(false);
            // $table->boolean('is_stackable')->default(false);
            // $table->string('description')->nullable();
            // $table->string('status')->default('active');
            // $table->string('icon')->nullable();

            // // polymorphic relation using short type
            // $table->unsignedBigInteger('discountable_id');
            // $table->string('discountable_type');
            // $table->index(['discountable_id','discountable_type']);


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_types');
    }
};
