<?php

declare(strict_types=1);

use App\Services\User\Http\Controller\PersonalAccessTokenController;
use App\Services\User\Http\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('users')->group(
            function (): void {
                Route::get('/sanctum/csrf-cookie', [UserController::class, 'setCookie']);
                Route::post('/register', [UserController::class, 'register']);

                Route::post('/getToken', [PersonalAccessTokenController::class, 'getToken']);

            }
        );
    }
);
Route::middleware('auth:sanctum')->prefix('v1')->group(
    function (): void {
        Route::prefix('users')->group(
            function (): void {
                Route::get('/test', [UserController::class, 'test']);

                Route::delete('/deleteToken/{token}', [PersonalAccessTokenController::class, 'deleteToken']);
            }
        );
    }
);
