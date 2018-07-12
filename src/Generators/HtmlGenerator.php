<?php

namespace Railken\LaraOre\Generators;

use Twig;

class HtmlGenerator extends BaseGenerator
{
    /**
     * Render a file.
     *
     * @param string $filename
     * @param array $data
     *
     * @return string
     */
    public function render($filename, $data)
    {
        return Twig::render($filename, $data);
    }
}
