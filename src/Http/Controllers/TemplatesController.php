<?php

namespace Railken\LaraOre\Http\Controllers;

use Railken\LaraOre\Api\Http\Controllers\RestController;
use Railken\LaraOre\Api\Http\Controllers\Traits as RestTraits;
use Railken\LaraOre\Template\TemplateManager;
use Illuminate\Http\Request;

class TemplatesController extends RestController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestRemoveTrait;

    public $queryable = [
        'id',
        'name',
        'filename',
        'filetype',
        'description',
        'content',
        'mock_data',
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'name',
        'filename',
        'filetype',
        'description',
        'content',
        'mock_data',
    ];

    /**
     * Construct.
     */
    public function __construct(TemplateManager $manager)
    {
        $this->manager = $manager;
        $this->manager->setAgent($this->getUser());
        parent::__construct();
    }

    /**
     * Create a new instance for query.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQuery()
    {
        return $this->manager->repository->getQuery();
    }

    /**
     * Render raw template
     *
     * @param \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        $content = $this->manager->renderRaw($request->input('filetype'), $request->input('content'), $request->input('data'));

        $type = $request->input('filetype');
        
        return response($content)
            ->header('Content-Type', $type);
    }
}
