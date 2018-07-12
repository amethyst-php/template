<?php

namespace Railken\LaraOre\Generators;

use Twig;

class HtmlGenerator extends BaseGenerator
{
    public function render($filename, $data)
    {
        return Twig::render($filename, $data);
    }
}
