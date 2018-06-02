<?php

namespace Railken\LaraOre\Template\Exceptions;

class GeneratorNotFoundException extends TemplateException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'GENERATOR_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Generator not found';
}
