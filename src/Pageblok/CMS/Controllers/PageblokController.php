<?php

namespace Pageblok\CMS\Controllers;


/**
 * Class BaseController
 *
 * @package Pageblok\Pageblok\Controllers
 * @author  Adis Corovic <adis@live.nl>
 */
abstract class PageblokController extends \Controller
{

    /**
     * Theme name that the user is using.
     *
     * @var string
     */
    protected $theme;

    /**
     * Default constructor, must be called from child controllers!
     */
    public function __construct()
    {
        $this->theme = \Config::get("pageblok::settings.theme");
    }

} 