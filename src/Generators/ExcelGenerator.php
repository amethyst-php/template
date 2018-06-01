<?php

namespace Railken\LaraOre\Template\Generators;

use Railken\LaraOre\Template\Template;
use Illuminate\Support\Facades\App;
use Twig;
use MewesK\TwigExcelBundle\Twig\TwigExcelExtension;

class ExcelGenerator extends BaseGenerator
{
    public function __construct()
    {
        Twig::addExtension(new TwigExcelExtension());
    }
    
    public function render($content, $data)
    {
        $filename = $this->generateViewFile($content);

        return Twig::render($filename, $data);
    }
}
