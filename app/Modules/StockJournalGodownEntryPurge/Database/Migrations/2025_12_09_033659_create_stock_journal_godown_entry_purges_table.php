<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_journal_godown_entry_purges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_journal_godown_entry_id');
            $table->unsignedBigInteger('purged_by')->nullable();
            $table->timestamp('purged_at')->nullable();
            $table->string('reason')->nullable();

            // $table->foreign('stock_journal_godown_entry_id')->references('id')->on('stock_journal_godown_entries')->onDelete('cascade');
            // $table->foreign('purged_by')->references('id')->on('users')->onDelete('set null');
<<<<<<< HEAD
            $table->index('stock_journal_godown_entry_id', 'sjgep_entry_idx');
            $table->index('purged_by', 'sjgep_purged_by_idx');
=======
            $table->index('stock_journal_godown_entry_id', 'idx_stock_journal_godown_entry_id');
            $table->index('purged_by', 'idx_purged_by');
>>>>>>> 834255e73cd7172752846e6d810856f53c86f4c7
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_journal_godown_entry_purges');
    }
};
