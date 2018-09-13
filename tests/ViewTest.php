<?php

namespace Railken\LaraOre\Template\Tests;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\Template\TemplateFaker;
use Railken\LaraOre\Template\TemplateManager;

class ViewTest extends BaseTest
{
    use ManagerTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return \Railken\LaraOre\Template\TemplateManager
     */
    public function getManager()
    {
        return new TemplateManager();
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), TemplateFaker::make()->parameters());
    }

    public function testHtmlExtendsRender()
    {
        $parameters = TemplateFaker::make()->parameters()
            ->set('filename', 'html-test-base')
            ->set('filetype', 'text/html')
            ->set('content', 'The following is a block: {% block content %} {% endblock %}')
            ->set('mock_data', []);

        $result = $this->getManager()->create($parameters);
        $this->assertEquals(true, $result->ok());

        $this->getManager()->loadViews();

        $parameters = TemplateFaker::make()->parameters()
            ->set('filename', 'html-test')
            ->set('filetype', 'text/html')
            ->set('content', "{% extends 'ore::html-test-base' %}{% block content %}{{ message }}{% endblock %}")
            ->set('data_builder.mock_data', ['message' => 'lie']);

        $result = $this->getManager()->create($parameters);
        $this->assertEquals(true, $result->ok());
        $resource = $result->getResource();

        $rendered = $this->getManager()->renderMock($resource)->getResource()['content'];

        $this->assertEquals('The following is a block: lie', $rendered);
    }
}
