<?php

namespace Railken\LaraOre\Template\Attributes\Content\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateContentNotAuthorizedException extends TemplateAttributeException
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
    protected $code = 'TEMPLATE_CONTENT_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
