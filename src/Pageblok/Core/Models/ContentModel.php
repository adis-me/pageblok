<?php


namespace Pageblok\Core\Models;

use Pageblok\Core\Interfaces\BaseModelInterface;
use Pageblok\Core\Interfaces\Parsable;
use Pageblok\Core\Traits\ContentableModel;
use Pageblok\Core\Traits\PagableModel;


/**
 * Class ContentModel
 * @package Pageblok\Core\Models
 */
abstract class ContentModel extends \Eloquent implements BaseModelInterface, Parsable
{

    /**
     * Import Paging methods
     */
    use PagableModel;

    /**
     * Contentable model contains method that implements Parsable interface.
     */
    use ContentableModel;
} 