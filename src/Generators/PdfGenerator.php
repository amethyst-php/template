<?php

namespace Railken\LaraOre\Generators;

use Dompdf\Dompdf;
use Twig;

class PdfGenerator extends BaseGenerator
{
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
        $html = Twig::render($filename, $data);

        $dompdf = new Dompdf(['enable_remote' => true]);
        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->output();
    }
}
