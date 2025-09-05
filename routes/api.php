<?php

use App\Http\Controllers\Api\AccountGroupController;
use App\Http\Controllers\Api\AccountLedgerController;
use App\Http\Controllers\Api\AccountTypeController;
use App\Http\Controllers\APi\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyTypeController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\FiscalYearController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\VoucherTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;





// Route::controller(AuthController::class)
//     ->middleware('api')
//     ->prefix('auth')
//     ->group(function () {
//         Route::post('login', 'login');
//         Route::post('register', 'register');
//         Route::post('logout', 'logout');
//         Route::post('refresh', 'refresh');
//     });
// Route::post('reload', function () {
//     Artisan::call('migrate:refresh --seed');
// });
// Route::middleware('auth:api')->group(function () {
//     Route::get('user', [AuthController::class, 'profile']);
//     Route::post('logout', [AuthController::class, 'logout']);
// });



Route::post('reload', function () {
    Artisan::call('migrate:refresh --seed');
});
Route::middleware(['jwt.cookies'])->group(function () {


    // Route::apiResource('account_types', AccountTypeController::class);
    // Route::apiResource('account_groups', AccountGroupController::class);
    // Route::apiResource('account_ledgers', AccountLedgerController::class);
    // Route::apiResource('voucher_types', VoucherTypeController::class);
    // Route::apiResource('vouchers', VoucherController::class);
    // Route::apiResource('journals', JournalController::class);
    // Route::apiResource('fiscal_years', FiscalYearController::class);
    // Route::apiResource('companies', CompanyController::class);
    // Route::apiResource('company_types', CompanyTypeController::class);
    // Route::apiResource('countries', CountryController::class);
    // Route::apiResource('states', StateController::class);
    // Route::apiResource('users', UserController::class);
    // Route::apiResource('currencies', CurrencyController::class);
    // Route::apiResource('languages', LanguageController::class);
    // Route::apiResource('roles', RoleController::class);
    // Route::apiResource('permissions', PermissionController::class);
    // Route::apiResource('settings', SettingController::class);
    // Route::apiResource('taxes', TaxController::class);
    // Route::apiResource('tax_groups', TaxGroupController::class);
    // Route::apiResource('tax_rates', TaxRateController::class);
    // Route::apiResource('tax_types', TaxTypeController::class);

    Route::get('/cookie-test', function () {
        return response()->json(['cookie' => request()->cookie('token')]);
    });
});
