<?php

namespace Railken\LaraOre\Template\Tests;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Support\Testing\ApiTestableTrait;
use Railken\LaraOre\Template\TemplateFaker;

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
        return Config::get('ore.api.router.prefix').Config::get('ore.template.http.admin.router.prefix');
    }

    /**
     * Test common requests.
     */
    public function testSuccessCommon()
    {
        $this->commonTest($this->getBaseUrl(), TemplateFaker::make()->parameters());
    }

    public function testRender()
    {
        $response = $this->post($this->getBaseUrl().'/render', [
            'filetype' => 'text/plain',
            'content'  => 'Hello {{ message }}',
            'data'     => [
                'message' => 'dear',
            ],
        ]);

        $this->assertOrPrint($response, 200);
        $body = json_decode($response->getContent());

        $this->assertEquals(base64_decode($body->resource), 'Hello dear');
    }

    public function testRenderError()
    {
        $response = $this->post($this->getBaseUrl().'/render', [
            'filetype' => 'text/plain',
            'content'  => 'Hello {{ message',
            'data'     => [
                'message' => 'dear',
            ],
        ]);

        $this->assertOrPrint($response, 400);
        $body = json_decode($response->getContent());

        $this->assertEquals('SYNTAX_ERROR', $body->errors[0]->code);
    }
}
