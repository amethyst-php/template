<?php

namespace Railken\LaraOre\Template;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

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

        if (!class_exists('CreateTemplatesTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_templates_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_templates_table.php'),
            ], 'migrations');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
