<?php

namespace Railken\LaraOre\Template;

use Railken\Laravel\Manager\ModelAuthorizer;
use Railken\Laravel\Manager\Tokens;

class TemplateAuthorizer extends ModelAuthorizer
{
    /**
     * List of all permissions.
     *
     * @var array
     */
    protected $permissions = [
        Tokens::PERMISSION_CREATE => 'template.create',
        Tokens::PERMISSION_UPDATE => 'template.update',
        Tokens::PERMISSION_SHOW   => 'template.show',
        Tokens::PERMISSION_REMOVE => 'template.remove',
    ];
}
