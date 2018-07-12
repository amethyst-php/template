<?php

namespace Railken\LaraOre\Generators;

use Twig;

class TextGenerator extends BaseGenerator
{
    public function generateViewFile($content)
    {
        return parent::generateViewFile(strip_tags($content));
    }

    public function render($filename, $data)
    {
        return Twig::render($filename, $data);
    }
}
