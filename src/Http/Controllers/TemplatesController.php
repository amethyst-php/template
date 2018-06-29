<?php

namespace Railken\LaraOre\Http\Controllers;

use Railken\LaraOre\Api\Http\Controllers\RestConfigurableController;
use Railken\LaraOre\Api\Http\Controllers\Traits as RestTraits;
use Railken\LaraOre\Template\TemplateManager;
use Illuminate\Http\Request;

class TemplatesController extends RestConfigurableController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestRemoveTrait;

    /**
     * The config path
     *
     * @var string
     */
    public $config = 'ore.template';

    /**
     * The attributes that are queryable.
     *
     * @var array
     */
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

    /**
     * The attributes that are fillable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'filename',
        'filetype',
        'description',
        'content',
        'mock_data',
    ];

    /**
     * Render raw template
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        $content = $this->manager->renderRaw($request->input('filetype'), $request->input('content'), $request->input('data'));
        
        return $this->success(['resource' => base64_encode($content)]);
    }
}
