<?php

namespace Railken\LaraOre\Template\Tests;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Api\Support\Testing\TestableBaseTrait;
use Railken\LaraOre\Template\TemplateFaker;

class ApiTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = TemplateFaker::class;

    /**
     * Router group resource.
     *
     * @var string
     */
    protected $group = 'admin';

    /**
     * Base path config.
     *
     * @var string
     */
    protected $config = 'ore.template';

    /**
     * Test correct render.
     */
    public function testRender()
    {
        $response = $this->callAndTest('POST', $this->getResourceUrl().'/render', [
            'filetype' => 'text/plain',
            'content'  => 'Hello {{ message }}',
            'data'     => [
                'message' => 'dear',
            ],
        ], 200);

        $body = json_decode($response->getContent());

        $this->assertEquals(base64_decode($body->resource), 'Hello dear');
    }

    /**
     * Test wrong render.
     */
    public function testRenderError()
    {
        $response = $this->callAndTest('POST', $this->getResourceUrl().'/render', [
            'filetype' => 'text/plain',
            'content'  => 'Hello {{ message',
            'data'     => [
                'message' => 'dear',
            ],
        ], 400);

        $body = json_decode($response->getContent());

        $this->assertEquals('SYNTAX_ERROR', $body->errors[0]->code);
    }
}
