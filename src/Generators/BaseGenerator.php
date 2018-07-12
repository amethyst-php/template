<?php

namespace Railken\LaraOre\Generators;

use Illuminate\Support\Facades\Config;
use Twig;

class BaseGenerator implements GeneratorContract
{

    /**
     * Construct.
     */
    public function __construct()
    {
    }
    
    /**
     * Generate a view file.
     *
     * @param string $content
     *
     * @return string
     */
    public function generateViewFile($content)
    {
        $name = $this->getRandomName();

        $path = storage_path() . Config::get('ore.template.cache');

        $filename = $path.'/'.$name.'.twig';

        if (!file_exists(dirname($filename))) {
            mkdir(dirname($filename), 0755, true);
        }

        file_put_contents($filename, $content);

        return $filename;
    }

    /**
     * Get random file.
     *
     * @return string
     */
    public function getRandomName()
    {
        return sha1(microtime() . str_random(20));
    }

    public function remove(string $filename)
    {
        unlink($filename);
    }

    public function render($filename, $data)
    {
        return Twig::render($filename, $data);
    }

    public function generateAndRender($content, $data)
    {
        $filename = $this->generateViewFile($content);
        try {
            $rendered = $this->render($filename, $data);
        } catch (\Exception $e) {
            $this->remove($filename);
            throw $e;
        }

        $this->remove($filename);

        return $rendered;
    }
}
