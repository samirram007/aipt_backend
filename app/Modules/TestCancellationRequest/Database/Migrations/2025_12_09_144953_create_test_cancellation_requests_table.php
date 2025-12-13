<?php

use App\Enums\TestCancellation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_cancellation_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_entry_id');
            $table->enum('status', TestCancellation::getValues())->default('request');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_cancellation_requests');
    }
};
