<?php

namespace Railken\LaraOre\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Railken\LaraOre\Api\Http\Controllers\RestConfigurableController;
use Railken\LaraOre\Api\Http\Controllers\Traits as RestTraits;
use Railken\LaraOre\Template\TemplateManager;

class TemplatesController extends RestConfigurableController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestRemoveTrait;

    /**
     * The config path.
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
     * Render raw template.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        $manager = new TemplateManager();

        try {
            $content = $manager->renderRaw(strval($request->input('filetype')), strval($request->input('content')), (array) $request->input('data'));
        } catch (\Twig_Error_Syntax $e) {
            return $this->error(['errors' => [['code' => 'SYNTAX_ERROR', 'message' => sprintf('%s at line %s', $e->getRawMessage(), $e->getTemplateLine())]]]);
        }

        return $this->success(['resource' => base64_encode($content)]);
    }
}
