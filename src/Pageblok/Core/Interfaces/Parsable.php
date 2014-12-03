<?php


namespace Pageblok\Core\Interfaces;

use Illuminate\View\View;

/**
 * Interface ParsableContent
 * @package Pageblok\Core\Interfaces
 */
interface Parsable
{

    /**
     * Get the content type that needs to be parsed.
     */
    public function getContentType();

    /**
     * Get parser for this type of content;
     * @return mixed
     */
    public function getParser();

    /**
     * Perform parsing of the content.
     * @return string
     */
    public function parseContent();

    /**
     * Render the template for this model.
     * @return View
     */
    public function render();

} 