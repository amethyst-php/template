<?php

namespace Railken\LaraOre\Template;

use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

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
        Attributes\Checksum\ChecksumAttribute::class,
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

        return $generator->generateAndRender($content, $this->convertSchemeIntoMockData($data));
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
     * Parse schema.
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

    /**
     * Retrieve path templates.
     *
     * @return string
     */
    public function getPathTemplates()
    {
        return storage_path().Config::get('ore.template.views');
    }

    /**
     * Calculate checksum by path file.
     *
     * @param string $path
     *
     * @return string|null
     */
    public function checksumByPath(string $path)
    {
        return file_exists($path) ? $this->checksum((string) file_get_contents($path)) : null;
    }

    /**
     * Calculate checksum by content file.
     *
     * @param string $content
     *
     * @return string
     */
    public function checksum(string $content)
    {
        return sha1($content);
    }

    /**
     * Load views.
     */
    public function loadViews()
    {
        $path = $this->getPathTemplates();

        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }

        $templates = $this->getRepository()->newQuery()->get();

        $files = collect(glob($path.'/*'));

        foreach ($templates as $template) {
            if ($this->checksumByPath($template->getPath()) !== $template->checksum) {
                file_put_contents($template->getPath(), $template->content);
            }

            $files->splice($files->search(function ($file) use ($template) {
                return basename($file) === basename($template->getPath());
            }), 1);
        }

        $files->map(function ($file) {
            unlink($file);
        });
    }
}
