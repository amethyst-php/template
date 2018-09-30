<?php

namespace Railken\Amethyst\Exceptions;

use Railken\Lem\Exceptions\ModelException;

class TemplateRenderException extends ModelException
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
