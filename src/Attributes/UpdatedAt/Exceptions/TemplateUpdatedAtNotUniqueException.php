<?php

namespace Railken\LaraOre\Template\Attributes\UpdatedAt\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateUpdatedAtNotUniqueException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'updated_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_UPDATED_AT_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
