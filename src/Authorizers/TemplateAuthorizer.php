<?php

namespace Railken\Amethyst\Authorizers;

use Railken\Lem\Authorizer;
use Railken\Lem\Tokens;

class TemplateAuthorizer extends Authorizer
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
