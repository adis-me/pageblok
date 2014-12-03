<?php


namespace Pageblok\Blocks\Models;


use Pageblok\Core\Models\ContentModel;

class Block extends ContentModel
{

    /**
     * Table name
     */
    protected $table = 'blocks';

    /**
     * Guarded properties cannot be assigned
     */
    protected $quarded = array('id');

    /**
     * Fillable properties
     */
    protected $fillable
        = array(
            'title',
            'subtitle',
            'image_ref',
            'hyperlink',
            'css_classes',
            'pb_name',
            'description',
            'template',
            'content_type',
            'content',
            'published',
            'group',
            'start_datetime',
            'end_datetime',
            'latitude',
            'longitude',
            'updated_at',
            'created_at',
            'created_by',
        );

    /**
     * @inheritdoc
     */
    public function getPluralModelName()
    {
        return "blocks";
    }

    /**
     * @inheritdoc
     */
    public function getModelName()
    {
        return "block";
    }
}