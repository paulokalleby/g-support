<?php

use App\Http\Controllers\Auth\{
    AuthController,
    ResetPasswordController,
};

use App\Http\Controllers\{
    CategoryController,
    SupportController,
};

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    //Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['guest'])->group(function () {

        Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink']);
        Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

    });

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware(['auth:sanctum'])
    ->group(function () {

    Route::get('/supports', [SupportController::class, 'index']);
    Route::get('/supports/{id}', [SupportController::class, 'show']);
    Route::post('/supports', [SupportController::class, 'store']);

    Route::get('/categories', [CategoryController::class, 'index']);

});

Route::get('/', function () {
    return response()->json(['status' => 'connected']);
});
