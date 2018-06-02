<?php

namespace Railken\LaraOre\Template\Attributes\Filetype\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateFiletypeNotValidException extends TemplateAttributeException
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
    protected $code = 'TEMPLATE_FILETYPE_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
