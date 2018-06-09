<?php

namespace Railken\LaraOre\Template\Generators;

use Twig;

class TextGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $content = strip_tags($content);

        $filename = $this->generateViewFile($content);

        return Twig::render($filename, $data);
    }
}
