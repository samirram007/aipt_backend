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

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_dispatch_details');
    }
};
