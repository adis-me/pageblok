<?php


namespace Pageblok\Navigation\Models;

use Pageblok\Core\Models\BaseModel;


/**
 * Class NavigationModel
 * @package Pageblok\Navigation\Models
 */
class Navigation extends BaseModel
{

    /**
     * Table name
     */
    protected $table = 'navigation';

    /**
     * Guarded properties cannot be assigned
     */
    protected $quarded = array('id');

    /**
     * Fillable properties
     */
    protected $fillable
        = array(
            'name',
            'title',
            'description',
            'order',
            'href',
            'route_name',
            'css_classes',
            'parent_id',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * Parent of this menu
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('\Pageblok\Navigation\Models\Navigation', 'parent_id');
    }

    /**
     * Children of this menu
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('\Pageblok\Navigation\Models\Navigation', 'parent_id');
    }

    /**
     * Get the entity name for this model
     * @return string
     */
    public function getModelName()
    {
        return "navigation";
    }

    /**
     * Get the plural model name
     * @return mixed
     */
    public function getPluralModelName()
    {
        return "navigations";
    }
}