<?php

namespace Railken\LaraOre\Template\Exceptions;

class TemplateRenderException extends TemplateException
{
    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'TEMPLATE_RENDER_ERROR';

    /**
     * Construct.
     *
     * @param mixed $message
     */
    public function __construct($message = null)
    {
        $this->message = $message;

        parent::__construct();
    }
}
