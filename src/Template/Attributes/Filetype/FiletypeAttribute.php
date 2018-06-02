<?php

namespace Railken\LaraOre\Template\Attributes\Filetype;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;
use Illuminate\Support\Facades\Config;

class FiletypeAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'filetype';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = true;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\TemplateFiletypeNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\TemplateFiletypeNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\TemplateFiletypeNotAuthorizedException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'template.attributes.filetype.fill',
        Tokens::PERMISSION_SHOW => 'template.attributes.filetype.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return in_array($value, array_keys(Config::get("ore.template.generators", [])));
    }
}
