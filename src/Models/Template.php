<?php

namespace Railken\Amethyst\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Railken\Amethyst\Common\ConfigurableModel;
use Railken\Amethyst\Managers\TemplateManager;
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
    use SoftDeletes, ConfigurableModel;

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
    public function data_builder()
    {
        return $this->belongsTo(DataBuilder::class);
    }
}
