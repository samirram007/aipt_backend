<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('my_stored_procedure', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        // $procedure = "
        //     DROP PROCEDURE IF EXISTS `allUsers`;
        //     create procedure allUsers()
        //     begin
        //         select * from users;
        //     end
        // ";

        // DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('my_stored_procedure');
        DB::unprepared("DROP PROCEDURE IF EXISTS `allUsers`");
    }
};
