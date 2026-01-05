<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\Api\AuthController;

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    //  Route::post('/swaggerLogin', [AuthController::class, 'swaggerLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/user-profile', function (): JsonResponse {
        return response()->json([
            'status' => 'success',
            'message' => 'User profile fetched successfully.',
            'data' => [],
        ]);
    });
    Route::post('/clean_logout', [AuthController::class, 'clean_logout']);
    // Social
    Route::get('/{provider}', [AuthController::class, 'socialRedirect'])
        ->where('provider', 'google|github');
    Route::get('/{provider}/callback', [AuthController::class, 'socialCallback'])
        ->where('provider', 'google|github');
});


Route::middleware(['jwt.cookies'])->group(function () {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/me', [AuthController::class, 'profile']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/user', [AuthController::class, 'profile']);

    });
});
