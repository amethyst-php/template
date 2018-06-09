<?php

namespace Railken\LaraOre\Template\Generators;

use Illuminate\Support\Facades\App;
use Twig;

class PdfGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $filename = $this->generateViewFile($content);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHtml(Twig::render($filename, $data));

        return $pdf->stream()->getContent();
    }
}
