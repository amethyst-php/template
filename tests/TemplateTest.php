<?php

namespace Railken\LaraOre\Template\Tests;

use Railken\Bag;
use Railken\LaraOre\Template\TemplateManager;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

/**
 * Template
 */
class TemplateTest extends BaseTest
{
    use Traits\CommonTrait;
    
    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new TemplateManager();
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new Bag();
        
        $bag->set('name', 'a common name'.microtime());
        $bag->set('filename', 'test.pdf');
        $bag->set('filetype', 'application/pdf');
        $bag->set('description', 'A description');
        $bag->set('content', 'The cake is a {{ message }}');
        $bag->set('mock_data', ['message' => 'lie']);

        return $bag;
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }

    public function testRender()
    {

        $rendered = $this->getManager()->renderMock($this->getManager()->create($this->getParameters())->getResource());
             
        $tmpfile = __DIR__."/../var/cache/templatepdfrender.pdf"; 

        if (!file_exists(dirname($tmpfile))) {
            mkdir(dirname($tmpfile), 0755, true);
        }
 
        file_put_contents($tmpfile, $rendered); 
 
        $this->assertEquals("The cake is a lie", Pdf::getText($tmpfile)); 
 
    } 
 
}
