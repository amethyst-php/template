<?php

namespace Railken\Amethyst\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Events\TemplateViewUpdated;
use Railken\Amethyst\Exceptions;
use Railken\Amethyst\Models\DataBuilder;
use Railken\Amethyst\Models\Template;
use Railken\Bag;
use Railken\Lem\Manager;
use Railken\Lem\Result;

class TemplateManager extends Manager
{
    /**
     * Describe this manager.
     *
     * @var string
     */
    public $comment = '...';

    /**
     * Register Classes.
     */
    public function registerClasses()
    {
        return Config::get('amethyst.template.managers.template');
    }

    /**
     * Retrieve the generator given the template or throw exception.
     *
     * @param string $filetype
     *
     * @return \Railken\Template\Generators\GeneratorContract
     */
    public function getGeneratorOrFail(string $filetype)
    {
        $generators = config('amethyst.template.generators', []);

        $generator = isset($generators[$filetype]) ? $generators[$filetype] : null;

        if (!$generator) {
            throw new Exceptions\GeneratorNotFoundException(sprintf('No generator found for: %s', $filetype));
        }

        return $generator;
    }

    /**
     * Render an email.
     *
     * @param DataBuilder $data_builder
     * @param string      $filetype
     * @param array       $parameters
     * @param array       $data
     *
     * @return \Railken\Lem\Contracts\ResultContract
     */
    public function render(DataBuilder $data_builder, string $filetype, $parameters, array $data = [])
    {
        $result = new Result();

        try {
            $bag = new Bag($parameters);

            $bag->set('content', $this->renderRaw($filetype, strval($bag->get('content')), $data));

            $result->setResources(new Collection([$bag->toArray()]));
        } catch (\Twig_Error $e) {
            $e = new Exceptions\TemplateRenderException($e->getRawMessage().' on line '.$e->getTemplateLine());

            $result->addErrors(new Collection([$e]));
        }

        return $result;
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

        return $generator->generateAndRender($content, $data);
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
        return $this->render($template->data_builder, $template->filetype, ['content' => $template->content], (array) $template->data_builder->mock_data);
    }

    /**
     * Retrieve path templates.
     *
     * @return string
     */
    public function getPathTemplates()
    {
        return storage_path().Config::get('amethyst.template.views');
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

        $updated = false;

        foreach ($templates as $template) {
            if ($this->checksumByPath($template->getPath()) !== $template->checksum) {
                file_put_contents($template->getPath(), $template->content);
                $updated = true;
            }

            $files->splice($files->search(function ($file) use ($template) {
                return basename($file) === basename($template->getPath());
            }), 1);
        }

        $files->map(function ($file) {
            unlink($file);
            $updated = true;
        });

        if ($updated) {
            event(new TemplateViewUpdated());
        }
    }
}
