<?php

namespace Pageblok\Pages\Models;


use Pageblok\Core\Models\ContentModel;

class Page extends ContentModel
{

    /**
     * @var string database table name
     */
    protected $table = 'pages';

    /**
     * @var array with guarded props
     */
    protected $guarded = array('id');

    /**
     * @var array with fillable properties
     */
    protected $fillable
        = array(
            'pb_name',
            'title',
            'subtitle',
            'image_ref',
            'css_classes',
            'description',
            'page_type',
            'template',
            'content_type',
            'content',
            'published',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * Get system name of current model
     *
     * @return string System name
     */
    public function getSystemName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "page";
    }

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "pages";
    }
}