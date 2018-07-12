<?php

namespace Railken\LaraOre\Template\Attributes\Checksum\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateChecksumNotValidException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'checksum';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_CHECKSUM_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
