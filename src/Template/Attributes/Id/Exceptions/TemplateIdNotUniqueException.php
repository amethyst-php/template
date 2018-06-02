<?php

namespace Railken\LaraOre\Template\Attributes\Id\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateIdNotUniqueException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_ID_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
