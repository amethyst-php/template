<?php

namespace Railken\LaraOre\Template\Attributes\MockData;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

class MockDataAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'mock_data';

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
        Tokens::NOT_DEFINED    => Exceptions\TemplateMockDataNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\TemplateMockDataNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\TemplateMockDataNotAuthorizedException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'template.attributes.mock_data.fill',
        Tokens::PERMISSION_SHOW => 'template.attributes.mock_data.show',
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
        return true;
    }

    /**
     * Retrieve default value.
     *
     * @param \Railken\Laravel\Manager\Contracts\EntityContract $entity
     *
     * @return mixed
     */
    public function getDefault(EntityContract $entity)
    {
        return (object) [];
    }
}
