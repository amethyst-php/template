<?php

namespace Railken\LaraOre\Template\Attributes\CreatedAt\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateCreatedAtNotUniqueException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'created_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_CREATED_AT_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
