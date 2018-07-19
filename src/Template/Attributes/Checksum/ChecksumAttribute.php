<?php

namespace Railken\LaraOre\Template\Attributes\Checksum;

use Illuminate\Support\Collection;
use Railken\Bag;
use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;

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
     * Update entity value.
     *
     * @param \Railken\LaraOre\Template\Template $entity
     * @param \Railken\Bag                       $parameters
     *
     * @return Collection
     */
    public function update(EntityContract $entity, Bag $parameters)
    {
        /** @var \Railken\LaraOre\Template\TemplateManager */
        $manager = $this->getManager();

        if (!empty($entity->content)) {
            $entity->checksum = $manager->checksum($entity->content);
        }

        return new Collection();
    }
}
