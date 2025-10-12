<?php

use App\Enums\AddressType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('landmark')->nullable();
            $table->string('post_office')->nullable();
            $table->string('district')->nullable();
            $table->string('city');

            // Foreign keys
            $table->foreignId('state_id');
            $table->foreignId('country_id');

            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Enum for address_type
            $table->string('address_type')->nullable();
            // $table->enum('address_type', array_column(AddressType::cases(), 'value'))
            //     ->default(AddressType::Other->value);

            $table->boolean('is_primary')->default(false);

            // Polymorphic relation using short type
            $table->unsignedBigInteger('addressable_id');
            $table->string('addressable_type'); // 'customer', 'employee', 'vendor', 'agent'



            // Polymorphic relation
            // $table->morphs('addressable'); // creates addressable_id + addressable_type
            $table->timestamps();
            $table->index(['addressable_id', 'addressable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
