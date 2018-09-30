<?php

namespace Railken\Amethyst\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Managers\TemplateManager;
use Railken\Amethyst\Schemas\TemplateSchema;
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

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('amethyst.template.managers.template.table');
        $this->fillable = (new TemplateSchema())->getNameFillableAttributes();
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
