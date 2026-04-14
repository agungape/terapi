<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AnakApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes – v1 (React Native Expo)
|--------------------------------------------------------------------------
|
| Base URL: /api/v1
| Auth: Laravel Sanctum Token (Bearer Token di header Authorization)
|
| Public:
|   POST /api/v1/auth/login
|
| Protected (requires: Authorization: Bearer {token}):
|   POST   /api/v1/auth/logout
|   GET    /api/v1/auth/me
|   GET    /api/v1/anak/profile
|   GET    /api/v1/anak/kunjungan
|   GET    /api/v1/anak/kunjungan/{id}
|   GET    /api/v1/anak/assessment
|   GET    /api/v1/anak/assessment/{id}
|   GET    /api/v1/anak/observasi
|   GET    /api/v1/anak/payment
|   GET    /api/v1/anak/paket
|   GET    /api/v1/anak/jadwal
|   GET    /api/v1/informasi
|
*/

Route::prefix('v1')->group(function () {

    // =========================================================
    // PUBLIC: Autentikasi
    // =========================================================
    Route::post('/auth/login', [AuthController::class, 'login']);

    // =========================================================
    // PROTECTED: Harus login (Sanctum token)
    // =========================================================
    Route::middleware('auth:sanctum')->group(function () {

        // Auth
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        // Anak / Parent data
        Route::prefix('anak')->group(function () {
            Route::get('/profile',              [AnakApiController::class, 'profile']);
            Route::get('/kunjungan',            [AnakApiController::class, 'kunjungan']);
            Route::get('/kunjungan/{id}',       [AnakApiController::class, 'kunjunganDetail']);
            Route::get('/assessment',           [AnakApiController::class, 'assessment']);
            Route::get('/assessment/{id}',      [AnakApiController::class, 'assessmentDetail']);
            Route::get('/observasi',            [AnakApiController::class, 'observasi']);
            Route::get('/payment',              [AnakApiController::class, 'payment']);
            Route::get('/paket',                [AnakApiController::class, 'paket']);
            Route::get('/jadwal',               [AnakApiController::class, 'jadwal']);
        });

        // Informasi klinik (umum, bisa diakses semua role)
        Route::get('/informasi', [AnakApiController::class, 'informasi']);
    });

});
