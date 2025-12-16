<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_journal_entry_purges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_entry_id');
            $table->unsignedBigInteger('purged_by')->nullable();
            $table->timestamp('purged_at')->nullable();
            $table->string('reason')->nullable();

            // $table->foreign('stock_journal_entry_id')->references('id')->on('stock_journal_entries')->onDelete('cascade');
            // $table->foreign('purged_by')->references('id')->on('users')->onDelete('set null');
            $table->index('stock_journal_entry_id');
            $table->index('purged_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_entry_purges');
    }
};
