<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $sql = file_get_contents(database_path('sql/sample_data.sql'));
        DB::unprepared($sql);
    }
}
