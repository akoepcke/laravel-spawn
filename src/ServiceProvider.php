<?php

namespace AKoepcke\LaravelSpawn;

use AKoepcke\LaravelSpawn\Commands\SpawnRole;
use AKoepcke\LaravelSpawn\Commands\SpawnTest;
use AKoepcke\LaravelSpawn\Commands\SpawnView;
use AKoepcke\LaravelSpawn\Commands\SpawnModel;
use AKoepcke\LaravelSpawn\Commands\SpawnRoute;
use AKoepcke\LaravelSpawn\Commands\SpawnPolicy;
use Illuminate\Support\ServiceProvider as Base;
use AKoepcke\LaravelSpawn\Commands\SpawnMonster;
use AKoepcke\LaravelSpawn\Commands\SpawnDatabase;
use AKoepcke\LaravelSpawn\Commands\SpawnController;

class ServiceProvider extends Base
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SpawnMonster::class,
                SpawnModel::class,
                SpawnController::class,
                SpawnPolicy::class,
                SpawnRole::class,
                SpawnView::class,
                SpawnDatabase::class,
                SpawnRoute::class,
                SpawnTest::class,
            ]);
        }

        $this->publishes([
            base_path('vendor/akoepcke/laravel-spawn/config/spawn.php') => config_path('spawn.php'),
        ], 'config');

        $this->publishes([
            base_path('vendor/akoepcke/laravel-spawn/resources/stubs') => resource_path('stubs'),
        ], 'stubs');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            base_path('vendor/akoepcke/laravel-spawn/config/spawn.php'), 'spawn'
        );
    }
}
