<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Modules\Company\Database\Seeders\CompanySeeder;
use App\Modules\CompanyType\Database\Seeders\CompanyTypeSeeder;
use App\Modules\CompanyType\Models\CompanyType;
use App\Modules\FiscalYear\Database\Seeders\FiscalYearSeeder;
use App\Modules\VoucherCategory\Database\Seeders\VoucherCategorySeeder;
use App\Modules\VoucherClassification\Database\Seeders\VoucherClassificationSeeder;
use App\Modules\VoucherClassification\Models\VoucherClassification;

use App\Modules\VoucherType\Database\Seeders\VoucherTypeSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            SampleDataSeeder::class,
            AccountNatureSeeder::class,
            AccountGroupSeeder::class,
            AccountLedgerSeeder::class,
            CompanyTypeSeeder::class,
            FiscalYearSeeder::class,
            CompanySeeder::class,

            VoucherCategorySeeder::class,
            VoucherTypeSeeder::class,
            VoucherClassificationSeeder::class,
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => static::$password ??= Hash::make('password'),
        // ]);
        // \App\Models\User::create([
        //     'name' => 'Admin User',
        //     'user_type'=>'admin',
        //     'email' => 'admin@admin.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);
        // \App\Models\User::create([
        //     'name' => 'Manager User',
        //     'user_type'=>'user',
        //     'email' => 'manager@admin.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

    }
}
