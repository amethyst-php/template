<?php

namespace Railken\LaraOre\Template\Attributes\Filename\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateFilenameNotDefinedException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'filename';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_FILENAME_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
