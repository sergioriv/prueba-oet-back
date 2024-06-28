<?php

namespace App\Providers;

use App\Interfaces\DriverRepositoryInterface;
use App\Interfaces\OwnerRepositoryInterface;
use App\Repositories\DriverRepository;
use App\Repositories\OwnerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DriverRepositoryInterface::class, DriverRepository::class);
        $this->app->bind(OwnerRepositoryInterface::class, OwnerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
