<?php

namespace Railken\LaraOre\Template\Tests;

use Railken\Bag;
use Railken\LaraOre\Template\TemplateManager;
use Illuminate\Support\Facades\Storage;

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
        
        $bag->set('name', 'a common name');
        $bag->set('filename', 'test.pdf');
        $bag->set('filetype', 'pdf');
        $bag->set('description', 'A description');
        $bag->set('content', 'A {{ message }}');
        $bag->set('mock_data', ['message' => 'Uhm']);

        return $bag;
    }

    public function testSuccessCommon()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }

}
