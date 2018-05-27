<?php

namespace Railken\LaraOre\Template\Tests;

use Illuminate\Support\Facades\File;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\Laravel\Manager\ManagerServiceProvider::class,
            \Railken\LaraOre\Template\TemplateServiceProvider::class,
            \Barryvdh\DomPDF\ServiceProvider::class, 
            \TwigBridge\ServiceProvider::class, 
        ];
    }

    protected function getPackageAliases($app) 
    { 
        return [ 
            'Twig' => \TwigBridge\Facade\Twig::class, 
        ]; 
    } 

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        File::cleanDirectory(database_path("migrations/"));

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\Template\TemplateServiceProvider',
            '--force' => true,
        ]);

        $this->artisan('migrate:fresh');
        $this->artisan('migrate');
    }
}
