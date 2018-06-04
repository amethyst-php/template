<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class TemplateServiceProvider extends ServiceProvider
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    public $app;

    /**
     * Current version.
     *
     * @var string
     */
    public $version;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->publishes([
            __DIR__.'/../config/ore.template.php' => config_path('ore.template.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Barryvdh\DomPDF\ServiceProvider::class);
        $this->app->register(\TwigBridge\ServiceProvider::class);
        AliasLoader::getInstance()->alias('Twig', \TwigBridge\Facade\Twig::class);

        $this->mergeConfigFrom(__DIR__.'/../config/ore.template.php', 'ore.template');
    }
}
