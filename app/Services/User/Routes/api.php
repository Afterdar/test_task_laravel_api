<?php

declare(strict_types=1);

use App\Services\User\Http\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(
    function (): void {
        Route::prefix('users')->group(
            function (): void {
                Route::post('/register', [UserController::class, 'register']);
            }
        );
        Route::post('/tokens/create', function (Request $request) {
            $token = $request->user()->createToken($request->token_name);

            return ['token' => $token->plainTextToken];
        });
    }
);
