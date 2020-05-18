<?php

namespace Mbroersen\LaravelDatabaseMigrate;

use Illuminate\Support\ServiceProvider;
use Mbroersen\LaravelDatabase\Console\Commands\CreateMigrations;

class LaravelDatabaseMigrateDataProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Mbroersen\LaravelDatabaseMigrate\Console\Commands\CreateMigrations::class,
            ]);
        }

    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
