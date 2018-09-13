<?php

namespace Railken\LaraOre\Template;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Railken\LaraOre\DataBuilder\DataBuilder;
use Railken\Laravel\Manager\Contracts\EntityContract;

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
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'filename',
        'filetype',
        'content',
        'hash',
        'checksum',
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = \Illuminate\Support\Facades\Config::get('ore.template.table');
        $this->fillable = array_merge($this->fillable, array_keys(Config::get('ore.template.attributes')));
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
