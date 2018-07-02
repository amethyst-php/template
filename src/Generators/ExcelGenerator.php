<?php

namespace Railken\LaraOre\Generators;

use MewesK\TwigExcelBundle\Twig\TwigExcelExtension;
use Twig;

class ExcelGenerator extends BaseGenerator
{
    public function __construct()
    {
        Twig::addExtension(new TwigExcelExtension());
    }

    public function render($content, $data)
    {
        $filename = $this->generateViewFile($content);

        $rendered = Twig::render($filename, $data);

        $this->remove($filename);

        return $rendered;
    }
}
