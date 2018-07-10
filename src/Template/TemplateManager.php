<?php

namespace Railken\LaraOre\Template;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;
use Illuminate\Support\Facades\Config;

class TemplateManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = Template::class;

    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\Name\NameAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\Filename\FilenameAttribute::class,
        Attributes\Filetype\FiletypeAttribute::class,
        Attributes\Description\DescriptionAttribute::class,
        Attributes\MockData\MockDataAttribute::class,
        Attributes\Content\ContentAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\TemplateNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->entity = Config::get('ore.template.entity');
        $this->attributes = array_merge($this->attributes, array_values(Config::get('ore.template.attributes')));
        
        $classRepository = Config::get('ore.template.repository');
        $this->setRepository(new $classRepository($this));

        $classSerializer = Config::get('ore.template.serializer');
        $this->setSerializer(new $classSerializer($this));

        $classAuthorizer = Config::get('ore.template.authorizer');
        $this->setAuthorizer(new $classAuthorizer($this));

        $classValidator = Config::get('ore.template.validator');
        $this->setValidator(new $classValidator($this));

        parent::__construct($agent);
    }

    /**
     * Retrieve the generator given the template or throw exception.
     *
     * @param string $filetype
     *
     * @return \Railken\LaraOre\Generators\GeneratorContract
     */
    public function getGeneratorOrFail(string $filetype)
    {
        $generators = config('ore.template.generators', []);

        $generator = isset($generators[$filetype]) ? $generators[$filetype] : null;

        if (!$generator) {
            throw new Exceptions\GeneratorNotFoundException(sprintf('No generator found for: %s', $filetype));
        }

        return $generator;
    }

    /**
     * Render given template with data.
     *
     * @param Template $template
     * @param array    $data
     *
     * @return mixed
     */
    public function render(Template $template, array $data)
    {
        return $this->renderRaw($template->filetype, $template->content, $data);
    }

    /**
     * Render given template with data.
     *
     * @param string $filetype
     * @param string $content
     * @param array  $data
     *
     * @return mixed
     */
    public function renderRaw(string $filetype, string $content, array $data)
    {
        $generator = $this->getGeneratorOrFail($filetype);
        $generator = new $generator();

        return $generator->render($content, $this->convertSchemeIntoMockData($data));
    }

    /**
     * Render mock template.
     *
     * @param Template $template
     *
     * @return mixed
     */
    public function renderMock(Template $template)
    {
        return $this->render($template, $template->mock_data);
    }

    /**
     * Parse schema
     *
     * @param array $schema
     *
     * @return array
     */
    public function convertSchemeIntoMockData(array $schema)
    {
        $data = [];
        $faker = \Faker\Factory::create();

        foreach ($schema as $name => $record) {
            if (is_array($record) || is_object($record)) {
                $value = $record;
            } elseif (is_string($record)) {
                try {
                    $value = $faker->{$record};
                } catch (\Exception $e) {
                    $value = $record;
                }

                if (class_exists($record)) {
                    $value = $record::make()->entity();
                }
            } else {
                $value = $record;
            }

            $data[$name] = $value;
        }

        return $data;
    }
}
