<?php

namespace Railken\LaraOre\Template\Tests;

use Illuminate\Support\Facades\Config;
use Railken\LaraOre\Api\Support\Testing\TestableBaseTrait;
use Railken\LaraOre\DataBuilder\DataBuilderFaker;
use Railken\LaraOre\DataBuilder\DataBuilderManager;
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
        $manager = new DataBuilderManager();

        $result = $manager->create(DataBuilderFaker::make()->parameters());
        $this->assertEquals(1, $result->ok());

        $response = $this->callAndTest('POST', $this->getResourceUrl().'/render', [
            'filetype'        => 'text/plain',
            'content'         => 'Hello {{ message }}',
            'data_builder_id' => $result->getResource()->id,
            'data'            => [
                'message' => 'dear',
            ],
        ], 200);

        $body = json_decode($response->getContent());

        $this->assertEquals(base64_decode($body->resource->content), 'Hello dear');
    }

    /**
     * Test wrong render.
     */
    public function testRenderError()
    {
        $manager = new DataBuilderManager();

        $result = $manager->create(DataBuilderFaker::make()->parameters());
        $this->assertEquals(1, $result->ok());

        $response = $this->callAndTest('POST', $this->getResourceUrl().'/render', [
            'filetype'        => 'text/plain',
            'content'         => 'Hello {{ message',
            'data_builder_id' => $result->getResource()->id,
            'data'            => [
                'message' => 'dear',
            ],
        ], 400);

        $body = json_decode($response->getContent());

        $this->assertEquals('TEMPLATE_RENDER_ERROR', $body->errors[0]->code);
    }
}
