<?php

namespace Railken\LaraOre\Template\Attributes\MockData\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateMockDataNotAuthorizedException extends TemplateAttributeException
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
    protected $code = 'TEMPLATE_MOCK_DATA_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
