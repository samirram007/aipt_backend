<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_dispatch_details', function (Blueprint $table) {
            $table->id();

            // FK to voucher (receipt note, delivery note, purchase, etc.)
            $table->unsignedBigInteger('voucher_id')->unique();

            // ORDER DETAILS
            $table->string('order_number')->nullable();                     // Order No(s)
            $table->string('payment_terms')->nullable();                    // Mode/Terms of Payment
            $table->string('other_references')->nullable();                 // Other References
            $table->string('terms_of_delivery')->nullable();                // Terms of Delivery

            // RECEIPT DETAILS
            $table->string('receipt_doc_no')->nullable();                   // Receipt Doc No
            $table->string('dispatched_through')->nullable();               // Dispatched through
            $table->string('destination')->nullable();                      // Destination
            $table->string('carrier_name')->nullable();                     // Carrier Name/Agent
            $table->string('bill_of_lading_no')->nullable();                // Bill of Lading/LR-RR No
            $table->date('bill_of_lading_date')->nullable();                // Date
            $table->string('motor_vehicle_no')->nullable();                 // Motor Vehicle No
            $table->decimal('distance', 15, 4)->nullable();            // Distance
            $table->unsignedBigInteger('distance_unit_id')->nullable();          // Distance Unit
            $table->decimal('quantity', 15, 4)->nullable();            // Quantity
            $table->decimal('weight', 15, 4)->nullable();            // Weight
            $table->unsignedBigInteger('weight_unit_id')->nullable();          // Weight Unit
            $table->decimal('volume', 15, 4)->nullable();            // Volume
            $table->unsignedBigInteger('volume_unit_id')->nullable();          // Volume Unit

            $table->enum('freight_basis', ['WEIGHT', 'VOLUME', 'DISTANCE'])->nullable();
            $table->decimal('rate', 15, 2)->nullable();            // Rate
            $table->unsignedBigInteger('rate_unit_id')->nullable();            // Freight Unit


            $table->decimal('loading_charges', 15, 2)->nullable();            // Loading Charges
            $table->decimal('unloading_charges', 15, 2)->nullable();            // Unloading Charges
            $table->decimal('packing_charges', 15, 2)->nullable();            // Packing Charges
            $table->decimal('insurance_charges', 15, 2)->nullable();            // Insurance Charges
            $table->decimal('other_charges', 15, 2)->nullable();            // Other Charges
            $table->decimal('freight_charges', 15, 2)->nullable();            // Freight Charges
            $table->decimal('total_fare', 15, 4)->nullable();            // Total Fare

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_dispatch_details');
    }
};
