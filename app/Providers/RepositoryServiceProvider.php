<?php

namespace App\Providers;

use App\Repositories\Settings\Provider\{ ProviderRepository, ProviderRepositoryInterface };
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Setting Repositories
        $this->app->bind(ProviderRepositoryInterface::class, ProviderRepository::class);
    }
}
