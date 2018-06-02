<?php

namespace Railken\LaraOre\Template\Attributes\Name\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateNameNotUniqueException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'name';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_NAME_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
