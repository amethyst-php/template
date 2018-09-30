<?php

namespace Railken\Amethyst\Tests\Http\Admin;

use Railken\Amethyst\Api\Support\Testing\TestableBaseTrait;
use Railken\Amethyst\Fakers\DataBuilderFaker;
use Railken\Amethyst\Fakers\TemplateFaker;
use Railken\Amethyst\Managers\DataBuilderManager;
use Railken\Amethyst\Tests\BaseTest;

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
     * Base path config.
     *
     * @var string
     */
    protected $config = 'amethyst.template.http.admin.template';

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
