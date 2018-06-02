<?php

namespace Railken\LaraOre\Template\Exceptions;

abstract class TemplateAttributeException extends TemplateException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute;

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_ATTRIBUTE_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is invalid';

    /**
     * Construct.
     *
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        $this->label = $this->attribute;

        parent::__construct($value);
    }
}
