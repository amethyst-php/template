<?php

namespace Railken\LaraOre\Template\Attributes\DataBuilderId\Exceptions;

use Railken\LaraOre\Template\Exceptions\TemplateAttributeException;

class TemplateDataBuilderIdNotUniqueException extends TemplateAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'data_builder_id';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_DATA_BUILDER_ID_NOT_UNIQUE';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not unique';
}
