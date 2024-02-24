<?php

declare(strict_types=1);

use App\Services\Notions\Http\Controller\NotionsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('v1')->group(
    function (): void {
        Route::prefix('notions')->group(
            function (): void {
                Route::get('/list', [NotionsController::class, 'getListNotions']);
                Route::get('/detail/{id}', [NotionsController::class, 'getNotionById']);
                Route::post('/addNotion', [NotionsController::class, 'addNotion']);
                Route::put('/updateNotion/{id}', [NotionsController::class, 'updateNotion']);
                Route::delete('/deleteNotion/{id}', [NotionsController::class, 'deleteNotion']);
            }
        );
    }
);
