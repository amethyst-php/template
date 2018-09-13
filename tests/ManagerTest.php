<?php

namespace Railken\LaraOre\Template\Tests;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\Template\TemplateFaker;
use Railken\LaraOre\Template\TemplateManager;
use Spatie\PdfToText\Pdf;

class ManagerTest extends BaseTest
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

    public function testIni()
    {
        $this->assertEquals(1, 1);
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), TemplateFaker::make()->parameters());
    }

    public function testPdfRender()
    {
        $parameters = TemplateFaker::make()->parameters()
            ->set('filetype', 'application/pdf')
            ->set('content', 'The cake is a {{ message }}')
            ->set('data_builder.mock_data', ['message' => 'lie']);

        $resource = $this->getManager()->create($parameters)->getResource();
        $rendered = $this->getManager()->renderMock($resource)->getResource()['content'];

        $tmpfile = __DIR__.'/../var/cache/dummy.pdf';

        if (!file_exists(dirname($tmpfile))) {
            mkdir(dirname($tmpfile), 0755, true);
        }

        file_put_contents($tmpfile, $rendered);

        $this->assertEquals('The cake is a lie', Pdf::getText($tmpfile));
    }

    public function testHtmlRender()
    {
        $parameters = TemplateFaker::make()->parameters()
            ->set('filetype', 'text/html')
            ->set('content', 'The cake is a <b>{{ message }}</b>')
            ->set('data_builder.mock_data', ['message' => 'lie']);

        $resource = $this->getManager()->create($parameters)->getResource();
        $rendered = $this->getManager()->renderMock($resource)->getResource()['content'];

        $this->assertEquals('The cake is a <b>lie</b>', $rendered);
    }

    public function testExcelRender()
    {
        $parameters = TemplateFaker::make()->parameters()
            ->set('filetype', 'application/xls')
            ->set('content', '{% xlsdocument %}
                {% xlssheet %}
                    {% xlsrow %}
                        {% xlscell %}1{% endxlscell %}{# A1 #}
                        {% xlscell %}2{% endxlscell %}{# B1 #}
                    {% endxlsrow %}
                    {% xlsrow %}
                        {% xlscell %}=A1*B1{% endxlscell %}
                    {% endxlsrow %}
                    {% xlsrow %}
                        {% xlscell %}=SUM(A1:B1){% endxlscell %}
                    {% endxlsrow %}
                {% endxlssheet %}
            {% endxlsdocument %}
            ')
            ->set('mock_data', ['message' => 'lie']);

        $resource = $this->getManager()->create($parameters)->getResource();
        $rendered = $this->getManager()->renderMock($resource)->getResource()['content'];

        $tmpfile = __DIR__.'/../var/cache/dummy.xlsx';

        if (!file_exists(dirname($tmpfile))) {
            mkdir(dirname($tmpfile), 0755, true);
        }

        file_put_contents($tmpfile, $rendered);
    }
}
