<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminWalletController;
use Illuminate\Support\Facades\Route;
Route::prefix('auth')->group(function () {

    // Routes PUBLIQUES (pas de token requis)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    // Routes PROTÉGÉES (token JWT obligatoire)
    Route::middleware('auth:api')->group(function () {
        Route::get('/me',      [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

//Wallet
Route::middleware('auth:api')->prefix('wallet')->group(function () {
    Route::get('/',       [WalletController::class, 'balance']);
    Route::post('/spend', [WalletController::class, 'spend']);
});

//Admin
Route::middleware(['auth:api', 'checkrole:admin'])->prefix('admin/wallet')->group(function () {
    Route::post('/{user}/credit', [AdminWalletController::class, 'credit']);
    Route::post('/{user}/debit',  [AdminWalletController::class, 'debit']);
});
