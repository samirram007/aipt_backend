<?php



use App\Http\Controllers\Api\EnumController;
use App\Http\Controllers\Api\FileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;









Route::post('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');

});

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
    Route::get('enums/{enum}', [EnumController::class, 'index']);
    Route::get('report_template_files', [FileController::class, 'report_template_files']);

    Route::get('/cookie-test', function () {
        return response()->json(['cookie' => request()->cookie('token')]);
    });
});
