<?php

namespace Railken\LaraOre\Generators;

use MewesK\TwigExcelBundle\Twig\TwigExcelExtension;
use Twig;

class ExcelGenerator extends BaseGenerator
{
    /**
     * Create a new instance.
     */
    public function __construct()
    {
        Twig::addExtension(new TwigExcelExtension());
        parent::__construct();
    }

    /**
     * Render a file.
     *
     * @param string $filename
     * @param array  $data
     *
     * @return string
     */
    public function render($filename, $data)
    {
        return Twig::render($filename, $data);
    }
}
