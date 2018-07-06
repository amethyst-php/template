<?php

namespace Railken\LaraOre\Template;

use Railken\Bag;
use Faker\Factory;

class TemplateFaker
{
    /**
     * @return Bag
     */
    public static function make()
    {
        $faker = Factory::create();
        
        $bag = new Bag();
        $bag->set('name', 'a common name'.microtime());
        $bag->set('filename', 'test.pdf');
        $bag->set('filetype', 'application/pdf');
        $bag->set('description', 'A description');
        $bag->set('content', 'The cake is a {{ message }}');
        $bag->set('mock_data', ['message' => 'text']);

        return $bag;
    }
}
