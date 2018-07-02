<?php

namespace Railken\LaraOre\Generators;

use Twig;

class TextGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $content = strip_tags($content);

        $filename = $this->generateViewFile($content);

        $rendered = Twig::render($filename, $data);

        $this->remove($filename);

        return $rendered;
    }
}
