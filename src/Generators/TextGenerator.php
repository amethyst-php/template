<?php

namespace Railken\LaraOre\Generators;

class TextGenerator extends BaseGenerator
{
    /**
     * Generate a view file.
     *
     * @param string $content
     *
     * @return string
     */
    public function generateViewFile($content)
    {
        return parent::generateViewFile(strip_tags($content));
    }
}
