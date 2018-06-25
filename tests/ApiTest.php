<?php

namespace Railken\LaraOre\Template\Tests;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Config::get('ore.api.router.prefix').Config::get('ore.template.router.prefix');
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testSuccessCommon()
    {
        $this->signIn();
        $this->commonTest($this->getBaseUrl(), $parameters = $this->getParameters());
    }

    /**
     * @return void
     */
    public function testRender()
    {
        $this->signIn();
        $response = $this->post($this->getBaseUrl() . "/render", [
            'filetype' => 'text/plain',
            'content' => 'Hello {{ message }}',
            'data' => [
                'message' => 'dear'
            ],
        ]); 

        $this->assertOrPrint($response, 200);
        $body = json_decode($response->getContent());

        $this->assertEquals($body->resource, "Hello dear");

    }
}
