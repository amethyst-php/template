<?php

namespace Railken\LaraOre\Generators;

use Dompdf\Dompdf;
use Twig;

class PdfGenerator extends BaseGenerator
{
    public function render($content, $data)
    {
        $filename = $this->generateViewFile($content);

        $html = Twig::render($filename, $data);

        $dompdf = new Dompdf(['enable_remote' => true]);
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->output();
    }
}
