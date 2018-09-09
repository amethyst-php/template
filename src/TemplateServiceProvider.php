<?php

namespace Railken\LaraOre;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;

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
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->publishes([
            __DIR__.'/../config/ore.template.php' => config_path('ore.template.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutes();

        $this->loadViews();

        config(['ore.managers' => array_merge(Config::get('ore.managers', []), [
            \Railken\LaraOre\Template\TemplateManager::class,
        ])]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\TwigBridge\ServiceProvider::class);
        AliasLoader::getInstance()->alias('Twig', \TwigBridge\Facade\Twig::class);

        $this->mergeConfigFrom(__DIR__.'/../config/ore.template.php', 'ore.template');
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        $config = Config::get('ore.template.http.admin');

        if (Arr::get($config, 'enabled')) {
            Router::group('admin', Arr::get($config, 'router'), function ($router) use ($config) {
                $controller = Arr::get($config, 'controller');

                $router->post('/render', ['uses' => $controller.'@render']);
                $router->get('/', ['uses' => $controller.'@index']);
                $router->post('/', ['uses' => $controller.'@create']);
                $router->put('/{id}', ['uses' => $controller.'@update']);
                $router->delete('/{id}', ['uses' => $controller.'@remove']);
                $router->get('/{id}', ['uses' => $controller.'@show']);
            });
        }
    }

    /**
     * Load views.
     */
    public function loadViews()
    {
        $m = new \Railken\LaraOre\Template\TemplateManager();
        $path = $m->getPathTemplates();

        if (Schema::hasTable(Config::get('ore.template.table'))) {
            $m->loadViews();
        }

        $this->loadViewsFrom($path, 'ore');
    }
}
