<?php

namespace Amethyst\Tests\Http\Admin;

use Amethyst\Api\Support\Testing\TestableBaseTrait;
use Amethyst\Fakers\DataBuilderFaker;
use Amethyst\Fakers\TemplateFaker;
use Amethyst\Managers\DataBuilderManager;
use Amethyst\Tests\BaseTest;

class TemplateTest extends BaseTest
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
     * Route name.
     *
     * @var string
     */
    protected $route = 'admin.template';

    /**
     * Test correct render.
     */
    public function testRender()
    {
        $manager = new DataBuilderManager();

        $result = $manager->create(DataBuilderFaker::make()->parameters());
        $this->assertEquals(1, $result->ok());

        $response = $this->callAndTest('POST', route('admin.template.render'), [
            'filetype'        => 'text/plain',
            'content'         => 'Hello {{ message }}',
            'data_builder_id' => $result->getResource()->id,
            'data'            => [
                'message' => 'dear',
            ],
        ], 200);

        $body = json_decode($response->getContent());

        $this->assertEquals(base64_decode($body->resource->content, true), 'Hello dear');
    }

    /**
     * Test wrong render.
     */
    public function testRenderError()
    {
        $manager = new DataBuilderManager();

        $result = $manager->create(DataBuilderFaker::make()->parameters());
        $this->assertEquals(1, $result->ok());

        $response = $this->callAndTest('POST', route('admin.template.render'), [
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
