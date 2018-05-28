<?php

namespace Railken\LaraOre\Template\Generators;

use Railken\LaraOre\Template\Template;
use Illuminate\Support\Facades\App;
use Twig;

class PdfGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $name = 'tmp-'.md5(microtime());

        $filename = $this->generateViewFile($content, $name);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHtml(Twig::render($filename, $data));
        return $pdf->stream();
    }
}
