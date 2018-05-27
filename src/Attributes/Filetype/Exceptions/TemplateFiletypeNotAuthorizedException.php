<?php

namespace Railken\LaraOre\Template\Attributes\Filetype\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateFiletypeNotAuthorizedException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'filetype';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_FILETYPE_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
