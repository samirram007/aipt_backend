<?php

namespace App\Modules\State\Database\Seeders;

use App\Modules\Country\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Modules\State\Models\State;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    public function run(): void
    {

        $timestamp = Carbon::now();

        $states = [
            ['name' => 'Andaman and Nicobar Islands', 'code' => 'AN', 'gst_code' => '35'],
            ['name' => 'Andhra Pradesh', 'code' => 'AP', 'gst_code' => '37'],
            ['name' => 'Arunachal Pradesh', 'code' => 'AR', 'gst_code' => '12'],
            ['name' => 'Assam', 'code' => 'AS', 'gst_code' => '18'],
            ['name' => 'Bihar', 'code' => 'BR', 'gst_code' => '10'],
            ['name' => 'Chandigarh', 'code' => 'CH', 'gst_code' => '04'],
            ['name' => 'Chhattisgarh', 'code' => 'CG', 'gst_code' => '22'],
            ['name' => 'Dadra and Nagar Haveli and Daman and Diu', 'code' => 'DN', 'gst_code' => '26'],
            ['name' => 'Delhi', 'code' => 'DL', 'gst_code' => '07'],
            ['name' => 'Goa', 'code' => 'GA', 'gst_code' => '30'],
            ['name' => 'Gujarat', 'code' => 'GJ', 'gst_code' => '24'],
            ['name' => 'Haryana', 'code' => 'HR', 'gst_code' => '06'],
            ['name' => 'Himachal Pradesh', 'code' => 'HP', 'gst_code' => '02'],
            ['name' => 'Jammu and Kashmir', 'code' => 'JK', 'gst_code' => '01'],
            ['name' => 'Jharkhand', 'code' => 'JH', 'gst_code' => '20'],
            ['name' => 'Karnataka', 'code' => 'KA', 'gst_code' => '29'],
            ['name' => 'Kerala', 'code' => 'KL', 'gst_code' => '32'],
            ['name' => 'Ladakh', 'code' => 'LA', 'gst_code' => '38'],
            ['name' => 'Lakshadweep', 'code' => 'LD', 'gst_code' => '31'],
            ['name' => 'Madhya Pradesh', 'code' => 'MP', 'gst_code' => '23'],
            ['name' => 'Maharashtra', 'code' => 'MH', 'gst_code' => '27'],
            ['name' => 'Manipur', 'code' => 'MN', 'gst_code' => '14'],
            ['name' => 'Meghalaya', 'code' => 'ML', 'gst_code' => '17'],
            ['name' => 'Mizoram', 'code' => 'MZ', 'gst_code' => '15'],
            ['name' => 'Nagaland', 'code' => 'NL', 'gst_code' => '13'],
            ['name' => 'Odisha', 'code' => 'OR', 'gst_code' => '21'],
            ['name' => 'Puducherry', 'code' => 'PY', 'gst_code' => '34'],
            ['name' => 'Punjab', 'code' => 'PB', 'gst_code' => '03'],
            ['name' => 'Rajasthan', 'code' => 'RJ', 'gst_code' => '08'],
            ['name' => 'Sikkim', 'code' => 'SK', 'gst_code' => '11'],
            ['name' => 'Tamil Nadu', 'code' => 'TN', 'gst_code' => '33'],
            ['name' => 'Telangana', 'code' => 'TS', 'gst_code' => '36'],
            ['name' => 'Tripura', 'code' => 'TR', 'gst_code' => '16'],
            ['name' => 'Uttar Pradesh', 'code' => 'UP', 'gst_code' => '09'],
            ['name' => 'Uttarakhand', 'code' => 'UK', 'gst_code' => '05'],
            ['name' => 'West Bengal', 'code' => 'WB', 'gst_code' => '19'],
            ['name' => 'Others Territory', 'code' => 'OT', 'gst_code' => '97'],
            ['name' => 'Center Jurisdiction', 'code' => 'CJ', 'gst_code' => '99'],
        ];


        $countryId = Country::where('name', 'India')->pluck('id')->first();
        foreach ($states as $state) {
            DB::table('states')->insert([
                'name' => $state['name'],
                'code' => $state['code'],
                'country_id' => $countryId, // assuming 1 = India in countries table
                'gst_code' => $state['gst_code'],
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
