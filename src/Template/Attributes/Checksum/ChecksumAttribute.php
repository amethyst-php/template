<?php

namespace Railken\LaraOre\Template\Attributes\Checksum;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class ChecksumAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'checksum';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = false;

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
        Tokens::NOT_DEFINED    => Exceptions\TemplateChecksumNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\TemplateChecksumNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\TemplateChecksumNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\TemplateChecksumNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'template.attributes.checksum.fill',
        Tokens::PERMISSION_SHOW => 'template.attributes.checksum.show',
    ];

    /**
     * Retrieve default value
     *
     * @param \Railken\Laravel\Manager\Contracts\EntityContract $entity
     *
     * @return mixed
     */
    public function getDefault(EntityContract $entity)
    {
        return $this->getManager()->checksum($entity->content);
    }
}
