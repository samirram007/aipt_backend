<?php

namespace App\Modules\Bed\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Bed\Models\Bed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BedSeeder extends Seeder
{
    public function run(): void
    {
        $beds = [
            // Room 101
            [
                'name' => 'Bed A',
                'code' => 'BED-101-A',
                'description' => 'Left side bed',
            ],
            [
                'name' => 'Bed B',
                'code' => 'BED-101-B',
                'description' => 'Right side bed',
            ],

            // Room 102
            [
                'name' => 'Bed A',
                'code' => 'BED-102-A',
                'description' => 'Near window bed',
            ],
            [
                'name' => 'Bed B',
                'code' => 'BED-102-B',
                'description' => 'Near door bed',
            ],

            // Room 103
            [
                'name' => 'Bed A',
                'code' => 'BED-103-A',
                'description' => 'Standard bed',
            ],
            [
                'name' => 'Bed B',
                'code' => 'BED-103-B',
                'description' => 'Standard bed',
            ],

            // ICU Room 301
            [
                'name' => 'Bed 1',
                'code' => 'ICU-301-1',
                'description' => 'Ventilator-supported bed',
            ],
            [
                'name' => 'Bed 2',
                'code' => 'ICU-301-2',
                'description' => 'Monitoring-supported bed',
            ],

            // OT Recovery
            [
                'name' => 'Recovery Bed 1',
                'code' => 'REC-401-1',
                'description' => 'Post-operation recovery bed',
            ],
            [
                'name' => 'Recovery Bed 2',
                'code' => 'REC-401-2',
                'description' => 'Post-operation recovery bed',
            ],
        ];

        foreach ($beds as $bed) {
            DB::table('beds')->insert([
                'id' => Str::uuid(),
                'name' => $bed['name'],
                'code' => $bed['code'],
                'description' => $bed['description'],
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
