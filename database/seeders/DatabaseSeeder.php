<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Modules\Currency\Database\Seeders\CurrencySeeder;
use App\Modules\Voucher\Database\Seeders\VoucherSeeder;
use App\Modules\VoucherEntry\Database\Seeders\VoucherEntrySeeder;
use Illuminate\Support\Str;
use App\Modules\Uqc\Models\Uqc;
use Illuminate\Database\Seeder;
use App\Modules\Unit\Models\Unit;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\SampleDataSeeder;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockGroup\Models\StockGroup;
use App\Modules\CompanyType\Models\CompanyType;
use App\Modules\Uqc\Database\Seeders\UqcSeeder;
use App\Modules\Unit\Database\Seeders\UnitSeeder;
use App\Modules\State\Database\Seeders\StateSeeder;
use App\Modules\StockCategory\Models\StockCategory;
use App\Modules\Godown\Database\Seeders\GodownSeeder;
use App\Modules\Company\Database\Seeders\CompanySeeder;
use App\Modules\Country\Database\Seeders\CountrySeeder;
use App\Modules\Purchase\Database\Seeders\PurchaseSeeder;
use App\Modules\StockItem\Database\Seeders\StockItemSeeder;
use App\Modules\StockUnit\Database\Seeders\StockUnitSeeder;
use App\Modules\FiscalYear\Database\Seeders\FiscalYearSeeder;
use App\Modules\StockGroup\Database\Seeders\StockGroupSeeder;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;
use App\Modules\CompanyType\Database\Seeders\CompanyTypeSeeder;
use App\Modules\VoucherType\Database\Seeders\VoucherTypeSeeder;

use App\Modules\AccountGroup\Database\Seeders\AccountGroupSeeder;
use App\Modules\AccountLedger\Database\Seeders\AccountLedgerSeeder;
use App\Modules\AccountNature\Database\Seeders\AccountNatureSeeder;
use App\Modules\Agent\Database\Seeders\AgentSeeder;
use App\Modules\Discipline\Database\Seeders\DisciplineSeeder;
use App\Modules\Physician\Database\Seeders\PhysicianSeeder;
use App\Modules\StockCategory\Database\Seeders\StockCategorySeeder;
use App\Modules\VoucherClassification\Models\VoucherClassification;
use App\Modules\VoucherCategory\Database\Seeders\VoucherCategorySeeder;
use App\Modules\UniqueQuantityCode\Database\Seeders\UniqueQuantityCodeSeeder;
use App\Modules\VoucherClassification\Database\Seeders\VoucherClassificationSeeder;


class DatabaseSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            CurrencySeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
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

            UniqueQuantityCodeSeeder::class,
            StockUnitSeeder::class,
            StockGroupSeeder::class,
            StockCategorySeeder::class,

            StockItemSeeder::class,
                // PurchaseSeeder::class
            GodownSeeder::class,

            // VoucherSeeder::class,
            // VoucherEntrySeeder::class,
            DisciplineSeeder::class,
            AgentSeeder::class,
            PhysicianSeeder::class

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
