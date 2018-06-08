<?php

namespace Railken\LaraOre\Template\Tests;

use Illuminate\Support\Facades\File;
use Railken\Bag;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\TemplateServiceProvider::class,
        ];
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new Bag();
        
        $bag->set('name', 'a common name'.microtime());
        $bag->set('filename', 'test.pdf');
        $bag->set('filetype', 'application/pdf');
        $bag->set('description', 'A description');
        $bag->set('content', 'The cake is a {{ message }}');
        $bag->set('mock_data', ['message' => 'lie']);

        return $bag;
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        parent::setUp();

        $this->artisan('migrate:fresh');
        $this->artisan('vendor:publish', ['--provider' => 'Railken\LaraOre\TemplateServiceProvider', '--force' => true]);
        $this->artisan('lara-ore:user:install');
        $this->artisan('migrate');
    }
}
