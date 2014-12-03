<?php


namespace Pageblok\Core\Traits;

use Pageblok\Core\Parsers\ContentParser;

/**
 * Class ContentableModel
 * @package Pageblok\Core\Traits
 */
trait ContentableModel
{

    /**
     * Verify if we have a custom template defined
     */
    protected function hasTemplate()
    {
        return !empty($this->template);
    }

    /**
     * Check if template exists
     */
    protected function templateExists()
    {
        return \View::exists($this->template);
    }

    /**
     * @inheritdoc
     */
    public function getContentType()
    {
        return $this->content_type;
    }

    /**
     * @inheritdoc
     */
    public function getParser()
    {
        return new ContentParser($this->getContentType());
    }

    /**
     * @inheritdoc
     */
    public function parseContent()
    {
        // return parsed content
        $contentParser = $this->getParser();

        return $contentParser->text($this->content);
    }

    /**
     * Render the template for this model.
     * @return View
     */
    public function render()
    {

        if ($this->hasTemplate()) {

            if ($this->templateExists()) {
                return \View::make(
                    $this->template,
                    array($this->getModelName() => $this)
                )->render();
            }
        }


        return $this->parseContent();
    }

    /**
     * Helper method to get parsed content. Used in views
     */
    public function write()
    {
        return $this->parseContent();
    }

} 