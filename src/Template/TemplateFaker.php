<?php

namespace Railken\LaraOre\Template;

use Faker\Factory;
use Railken\Bag;
use Railken\Laravel\Manager\BaseFaker;

class TemplateFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = TemplateManager::class;

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
        $bag->set('mock_data', ['message' => 'text']);

        return $bag;
    }
}
