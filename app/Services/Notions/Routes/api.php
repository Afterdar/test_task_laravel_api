<?php

declare(strict_types=1);

use App\Services\Notions\Http\Controller\NotionsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('v1')->group(
    function (): void {
        Route::prefix('notions')->group(
            function (): void {
                Route::get('/list', [NotionsController::class, 'getListNotions']);
                Route::get('/detail', [NotionsController::class, 'getNotionById']);
            }
        );
    }
);
