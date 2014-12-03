<?php


namespace Pageblok\Settings\Models;


use Pageblok\Core\Models\BaseModel;

/**
 * Class Setting
 * @package Pageblok\Settings\Models
 * @author Adis Corovic <adis@live.nl>
 */
class Setting extends BaseModel
{

    protected $table = "settings";

    protected $fillable = [
        'environment',
        'key',
        'value',
        'description',
        'created_by',
        'updated_at',
        'created_at'
    ];

    /**
     * Get the entity name for this model
     * @return string
     */
    public function getModelName()
    {
        return "setting";
    }

    /**
     * Get the plural model name
     * @return mixed
     */
    public function getPluralModelName()
    {
        return "settings";
    }
}