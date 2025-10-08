<?php

namespace App\Modules\Discipline\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Discipline\Models\Discipline;

class DisciplineSeeder extends Seeder
{
    public function run(): void
    {
        $disciplines = [
            "Cardiologists" => "Specialize in heart conditions.",
            "Dermatologists" => "Treat skin, hair, and nail disorders.",
            "Gastroenterologists" => " Manage the digestive system",
            "Neurologists" => "Focus on the brain and nervous system.",
            "Oncologists" => "Diagnose and treat cancer.",
            "Ophthalmologists" => "Specialize in eye conditions.",
            "Obstetricians and Gynecologists (Ob/Gyns)" => "Provide care for women's reproductive health, pregnancy, and childbirth. "
        ];

        foreach($disciplines as $key => $value){
            Discipline::create([
                "name" => $key,
                "description" => $value
            ]);
        }

        // Uncomment to use factory if available
        // Discipline::factory()->count(10)->create();
    }
}
