<?php

declare(strict_types=1);

namespace App\Services\Notions;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class NotionServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Services\News\Http\Controller';

    public function boot(): void
    {
        if ($this->app->runningInConsole())
        {
            $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        }

        parent::boot();
    }

    public function map(): void
    {
        $this->mapRoutes();
    }

    protected function mapRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->namespace($this->namespace)
            ->group(base_path('app/Services/Notions/Routes/api.php'));
    }
}
