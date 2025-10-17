<?php

namespace App\Modules\DiscountType\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\DiscountType\Models\DiscountType;

class DiscountTypeSeeder extends Seeder
{
    public function run(): void
    {
        $discounts = [
            ["name" => "Promotional Discount","code"=>"PRD-001","is_percentage"=>true,"value" => 2.34 ],
            ["name" => "Festive Discount","code"=>"FES-002","is_percentage"=>false,"value" => 600 ],
            ["name" => "Loyalty Discount","code"=>"LOY-001","is_percentage"=>true,"value" => 4.34 ],
            ["name" => "Seasonal Health Discount","code"=>"SHD-001","is_percentage"=>false,"value" => 400 ],
            ["name" => "Online Discount","code"=>"OND-001","is_percentage"=>true,"value" => 3.34 ]
        ];


        foreach($discounts as $discount){
            DiscountType::create($discount);
        };

        // DiscountType::create(['name' => 'Sample DiscountType']);

        // Uncomment to use factory if available
        // DiscountType::factory()->count(10)->create();
    }
}
