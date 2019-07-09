<?php

namespace Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class TemplateFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', 'a common name'.microtime());
        $bag->set('filename', 'test.pdf');
        $bag->set('filetype', 'application/pdf');
        $bag->set('description', 'A description');
        $bag->set('content', 'The cake is a {{ message }}');
        $bag->set('data_builder', DataBuilderFaker::make()->parameters()->toArray());

        return $bag;
    }
}
