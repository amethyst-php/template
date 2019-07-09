<?php

namespace Amethyst\Exceptions;

use Railken\Lem\Exceptions\ModelException;

class GeneratorNotFoundException extends ModelException
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
