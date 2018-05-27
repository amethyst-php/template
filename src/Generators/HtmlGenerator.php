<?php

namespace Railken\LaraOre\Template\Generators;

use Railken\LaraOre\Template\Template;
use Illuminate\Support\Facades\App; 
use Twig; 

class HtmlGenerator extends BaseGenerator
{
	public function render($content, $data) 
    {
        $name = 'tmp-'.md5(microtime());

        $filename = $this->generateViewFile($content, $name); 

        return Twig::render($filename, $data); 
    } 
}