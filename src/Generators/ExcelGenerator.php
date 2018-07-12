<?php

namespace Railken\LaraOre\Generators;

use MewesK\TwigExcelBundle\Twig\TwigExcelExtension;
use Twig;

class ExcelGenerator extends BaseGenerator
{
    public function __construct()
    {
        Twig::addExtension(new TwigExcelExtension());
        parent::__construct();
    }

    public function render($filename, $data)
    {
        return Twig::render($filename, $data);
    }
}
