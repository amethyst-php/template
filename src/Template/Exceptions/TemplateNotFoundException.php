<?php

namespace Railken\LaraOre\Template\Exceptions;

class TemplateNotFoundException extends TemplateException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_NOT_FOUND';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'Not found';
}
