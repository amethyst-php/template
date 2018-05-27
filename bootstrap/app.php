<?php

class AppTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();
        parent::setUp();
    } 

    protected function getPackageProviders($app)
    {
        return [
            \Railken\Laravel\Manager\ManagerServiceProvider::class,
        ];
    }

    /**
     * Retrieve app
     */
    public function getApp()
    {
    	return $this->app;
    }
}

$t = new AppTest();
$t->setUp();

return $t->getApp();

