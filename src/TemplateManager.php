<?php

namespace Railken\LaraOre\Template;

use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\Tokens;

class TemplateManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity = Template::class;
    
    /**
     * List of all attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class, 
        Attributes\Name\NameAttribute::class, 
        Attributes\CreatedAt\CreatedAtAttribute::class, 
        Attributes\UpdatedAt\UpdatedAtAttribute::class, 
        Attributes\Filename\FilenameAttribute::class, 
        Attributes\Filetype\FiletypeAttribute::class,
        Attributes\Description\DescriptionAttribute::class, 
        Attributes\MockData\MockDataAttribute::class, 
        Attributes\Content\ContentAttribute::class
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\TemplateNotAuthorizedException::class,
    ];

    /**
     * Construct.
     *
     * @param AgentContract $agent
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->setRepository(new TemplateRepository($this));
        $this->setSerializer(new TemplateSerializer($this));
        $this->setValidator(new TemplateValidator($this));
        $this->setAuthorizer(new TemplateAuthorizer($this));

        parent::__construct($agent);
    }
}
