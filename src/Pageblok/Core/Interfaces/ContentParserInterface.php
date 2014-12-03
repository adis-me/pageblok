<?php

namespace Pageblok\Core\Interfaces;

/**
 * Interface ContentParserInterface
 * @package Pageblok\Core\Interfaces
 */
interface ContentParserInterface
{

    /**
     * Get content as string. Means already parsed.s
     *
     * @param string unparsed content
     * @return string parsed content as string
     */
    public function text($content);
} 