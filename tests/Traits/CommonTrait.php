<?php

namespace Railken\LaraOre\Template\Tests\Traits;

trait CommonTrait
{
    public function commonTest($manager, $parameters)
    {
        $result = $manager->create($parameters);

        if (!$result->ok()) {
            print_r($result->getSimpleErrors());
        }
        
        $this->assertEquals(true, $result->ok());

        $resource = $result->getResource();

        $result = $manager->update($resource, $parameters);
        $this->assertEquals(true, $result->ok());

        $resource = $result->getResource();

        $this->assertEquals($resource->id, $manager->getRepository()->findOneById($resource->id)->id);


        $result = $manager->remove($resource);
        $this->assertEquals(true, $result->ok());
    }
}
