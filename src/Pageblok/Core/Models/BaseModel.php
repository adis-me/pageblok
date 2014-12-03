<?php


namespace Pageblok\Core\Models;

use Pageblok\Core\Interfaces\BaseModelInterface;
use Pageblok\Core\Traits\PagableModel;

/**
 * Base model
 * @property mixed system_name
 * @package Pageblok\Core\Models
 * @author Adis Corovic <adis@live.nl>
 */
abstract class BaseModel extends \Eloquent implements BaseModelInterface
{

    /**
     * Import Paging methods
     */
    use PagableModel;
}
