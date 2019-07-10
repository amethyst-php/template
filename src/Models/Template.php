<?php

namespace Amethyst\Models;

use Amethyst\Common\ConfigurableModel;
use Amethyst\Managers\TemplateManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Railken\Lem\Contracts\EntityContract;

/**
 * @property string      $name
 * @property string      $description
 * @property string      $filename
 * @property string      $filetype
 * @property string      $content
 * @property array       $mock_data
 * @property string      $checksum
 * @property DataBuilder $data_builder
 */
class Template extends Model implements EntityContract
{
    use SoftDeletes;
    use ConfigurableModel;

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->ini('amethyst.template.data.template');
        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        $m = new TemplateManager();

        return $m->getPathTemplates().'/'.$this->filename.'.twig';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function data_builder(): BelongsTo
    {
        return $this->belongsTo(config('amethyst.data-builder.data.data-builder.model'));
    }
}
