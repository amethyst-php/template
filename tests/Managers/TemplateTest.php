<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\TemplateFaker;
use Amethyst\Managers\TemplateManager;
use Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;
use Spatie\PdfToText\Pdf;
use Symfony\Component\Yaml\Yaml;

class TemplateTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = TemplateManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = TemplateFaker::class;

    public function testPdfRender()
    {
        /** @var \Amethyst\Managers\TemplateManager */
        $manager = $this->getManager();

        $parameters = TemplateFaker::make()->parameters()
            ->set('filetype', 'application/pdf')
            ->set('content', 'The cake is a {{ message }}')
            ->set('data_builder.mock_data', Yaml::dump(['message' => 'lie']));

        $resource = $manager->create($parameters)->getResource();
        $rendered = $manager->renderMock($resource)->getResource()['content'];

        $tmpfile = __DIR__.'/../../var/cache/dummy.pdf';

        if (!file_exists(dirname($tmpfile))) {
            mkdir(dirname($tmpfile), 0755, true);
        }

        file_put_contents($tmpfile, $rendered);

        $this->assertEquals('The cake is a lie', Pdf::getText($tmpfile));
    }

    public function testHtmlRender()
    {
        /** @var \Amethyst\Managers\TemplateManager */
        $manager = $this->getManager();

        $parameters = TemplateFaker::make()->parameters()
            ->set('filetype', 'text/html')
            ->set('content', 'The cake is a <b>{{ message }}</b>')
            ->set('data_builder.mock_data', Yaml::dump(['message' => 'lie']));

        $resource = $manager->create($parameters)->getResource();
        $rendered = $manager->renderMock($resource)->getResource()['content'];

        $this->assertEquals('The cake is a <b>lie</b>', $rendered);
    }

    public function testExcelRender()
    {
        /** @var \Amethyst\Managers\TemplateManager */
        $manager = $this->getManager();

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
            ->set('mock_data', Yaml::dump(['message' => 'lie']));

        $resource = $manager->create($parameters)->getResource();
        $rendered = $manager->renderMock($resource)->getResource()['content'];

        $tmpfile = __DIR__.'/../../var/cache/dummy.xlsx';

        if (!file_exists(dirname($tmpfile))) {
            mkdir(dirname($tmpfile), 0755, true);
        }

        file_put_contents($tmpfile, $rendered);
    }
}
