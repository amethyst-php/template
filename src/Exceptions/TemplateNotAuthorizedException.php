<?php

namespace Railken\LaraOre\Template\Exceptions;

class TemplateNotAuthorizedException extends TemplateException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_NOT_AUTHORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
