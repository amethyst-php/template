<?php

namespace Railken\LaraOre\Template\Attributes\DeletedAt\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateDeletedAtNotDefinedException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'deleted_at';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_DELETED_AT_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
