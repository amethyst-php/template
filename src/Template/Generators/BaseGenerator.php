<?php

namespace Railken\LaraOre\Template\Generators;

use Twig;

class BaseGenerator implements GeneratorContract
{
    /**
     * Generate a view file.
     *
     * @param string $html
     *
     * @return string
     */
    public function generateViewFile($html)
    {
        $name = $this->getRandomName();

        $path = config('view.paths.0');

        $view = 'cache/'.$name.'-'.hash('sha1', $name);

        $filename = $path.'/'.$view.'.twig';

        !file_exists(dirname($filename)) && mkdir(dirname($filename), 0777, true);

        file_put_contents($filename, $html);

        return $filename;
    }

    /**
     * Get random file.
     *
     * @return string
     */
    public function getRandomName()
    {
        return 'tmp-'.sha1(microtime(true));
    }
}