<?php

namespace Railken\LaraOre\Template\Generators;

use Twig;

class HtmlGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $filename = $this->generateViewFile($content);

        return Twig::render($filename, $data);
    }
}
