<?php

namespace Railken\LaraOre\Generators;

use Twig;

class HtmlGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $filename = $this->generateViewFile($content);

        $rendered = Twig::render($filename, $data);

        $this->remove($filename);

        return $rendered;
    }
}
