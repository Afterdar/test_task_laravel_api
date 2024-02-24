<?php

declare(strict_types=1);

use App\Services\User\Http\Controller\PersonalAccessTokenController;
use App\Services\User\Http\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('users')->group(
            function (): void {
                Route::post('/register', [UserController::class, 'register'])->middleware('guest');
                Route::post('/login', [UserController::class, 'login'])->middleware('guest');
                Route::delete('/logout', [UserController::class, 'logout'])->middleware('auth');

                Route::post('/getToken', [PersonalAccessTokenController::class, 'getToken']);

            }
        );
    }
);

Route::middleware('auth:sanctum')->prefix('v1')->group(
    function (): void {
        Route::prefix('token')->group(
            function (): void {
                Route::get('/testAuthApi', [UserController::class, 'testAuthApi']);

                Route::delete('/deleteToken/{token}', [PersonalAccessTokenController::class, 'deleteToken']);
            }
        );
    }
);
