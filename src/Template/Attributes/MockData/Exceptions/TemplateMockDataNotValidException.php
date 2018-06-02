<?php

namespace Railken\LaraOre\Template\Attributes\MockData\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateMockDataNotValidException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'mock_data';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_MOCK_DATA_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
