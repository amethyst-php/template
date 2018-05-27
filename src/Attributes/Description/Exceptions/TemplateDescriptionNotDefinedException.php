<?php

namespace Railken\LaraOre\Template\Attributes\Description\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateDescriptionNotDefinedException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'description';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_DESCRIPTION_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
