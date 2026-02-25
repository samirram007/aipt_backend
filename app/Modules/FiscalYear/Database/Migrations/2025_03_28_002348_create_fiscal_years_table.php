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
        Schema::create('fiscal_years', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('name'); // e.g. "FY 2025-26"
            $table->date('start_date'); // e.g. 2025-04-01
            $table->date('end_date');   // e.g. 2026-03-31
            $table->string('assessment_year')->nullable(); // e.g. "AY 2026-27"

            $table->enum(
                'status',
                array_map(fn($case) => $case->value, ActiveInactive::cases())
            )
                ->default(ActiveInactive::Active->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_years');
    }

};
