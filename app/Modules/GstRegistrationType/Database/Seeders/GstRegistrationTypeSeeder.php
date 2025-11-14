<?php

namespace App\Modules\GstRegistrationType\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\GstRegistrationType\Models\GstRegistrationType;

class GstRegistrationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            1 => 'Unknown',
            2 => 'Composition',
            3 => 'Regular',
            4 => 'Unregistered/Consumer',
            5 => 'Government entity / TDS',
            6 => 'Regular - SEZ',
            7 => 'Regular - Deemed Exporter',
            8 => 'Regular - Exports (EOU)',
            9 => 'e-Commerce Operator',
            10 => 'Input Service Distributor',
            11 => 'Embassy/UN Body',
            12 => 'Non-Resident Taxpayer',
        ];

        foreach ($types as $id => $name) {

            GstRegistrationType::updateOrCreate(
                ['id' => $id],
                [
                    'name' => $name,
                    'status' => in_array($id, [1, 2, 3, 4]) ? 'active' : 'inactive',
                ]
            );
        }

    }
}
