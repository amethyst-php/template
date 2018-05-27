<?php

namespace Railken\LaraOre\Template\Attributes\CreatedAt\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateCreatedAtNotAuthorizedException extends TemplateAttributeException
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
    protected $code = 'TEMPLATE_CREATED_AT_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
