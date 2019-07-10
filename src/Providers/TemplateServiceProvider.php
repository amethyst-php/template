<?php

namespace Amethyst\Providers;

use Amethyst\Api\Support\Router;
use Amethyst\Common\CommonServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;

class TemplateServiceProvider extends CommonServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();
        $this->loadExtraRoutes();

        $this->app->register(\Amethyst\Providers\DataBuilderServiceProvider::class);
        $this->app->register(\Railken\Template\TemplateServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        parent::boot();
        $this->loadViews();

        Event::listen([\Amethyst\Events\TemplateViewUpdated::class], function ($event) {
            Artisan::call('queue:restart');
        });
    }

    /**
     * Load views.
     */
    public function loadViews()
    {
        $m = new \Amethyst\Managers\TemplateManager();
        $path = $m->getPathTemplates();

        if (Schema::hasTable(Config::get('amethyst.template.data.template.table'))) {
            $m->loadViews();
        }

        $this->loadViewsFrom($path, 'amethyst');
    }

    /**
     * Load extras routes.
     */
    public function loadExtraRoutes()
    {
        $config = Config::get('amethyst.template.http.admin.template');

        if (Arr::get($config, 'enabled')) {
            Router::group('admin', Arr::get($config, 'router'), function ($router) use ($config) {
                $controller = Arr::get($config, 'controller');

                $router->post('/render', ['as' => 'render', 'uses' => $controller.'@render']);
            });
        }
    }
}
