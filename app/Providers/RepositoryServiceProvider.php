<?php

namespace App\Providers;

use App\Interfaces\DriverRepositoryInterface;
use App\Repositories\DriverRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DriverRepositoryInterface::class, DriverRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
