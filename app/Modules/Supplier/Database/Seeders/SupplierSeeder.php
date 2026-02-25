<?php

namespace App\Modules\Supplier\Database\Seeders;

use App\Modules\Supplier\Requests\SupplierRequest;
use App\Modules\Supplier\Services\SupplierService;
use Illuminate\Database\Seeder;
use App\Modules\Supplier\Models\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierSeeder extends Seeder
{
    protected SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function run(): void
    {
        $rows = [
            // id, code, name, contact_no, phone, line1, postal_code
            [1, "UTCL", "UltraTech Cement Limited", "19AAACL6442L1Z7", "", "", "SONAR BANGLA CEMENT WORKS", "ULTRATECH CEMENT LIMITED", "P.O. GANKAR", "MURSHIDABAD", "742227"],
        ];

        foreach ($rows as $row) {

            [$id, $code, $name, $gstin, $contact_no, $phone, $line1, $line2, $landmark, $city, $postal] = $row;

            $payload = [
                "name" => $name,
                "code" => $code,
                "status" => "active",
                "gstin" => $gstin,
                "pan" => "",
                "contact_person" => "",
                "contact_no" => $contact_no,
                "phone" => $phone,
                "email" => "",
                "account_group_id" => 20003,
                "address" => [
                    "line1" => $line1,
                    "line2" => $line2,
                    "landmark" => $landmark,
                    "city" => $city,
                    "state_id" => 36,
                    "country_id" => 76,
                    "postal_code" => $postal,
                    "is_primary" => true,
                    "addressable" => [
                        "addressable_id" => null,
                        "addressable_type" => ""
                    ]
                ],
                "is_edit" => false
            ];


            $rules = (new SupplierRequest())->rules();
            $validatedData = Validator::make($payload, $rules)->validate();

            $this->supplierService->store($validatedData);
        }
    }
}
