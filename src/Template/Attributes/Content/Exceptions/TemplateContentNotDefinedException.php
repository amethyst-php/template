<?php

namespace Railken\LaraOre\Template\Attributes\Content\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateContentNotDefinedException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'content';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_CONTENT_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
