<?php

namespace Pageblok\Core\Parsers;


use Pageblok\Core\Interfaces\ContentParserInterface;

class HTMLParser implements ContentParserInterface
{

    /**
     * Get content as string. Means already parsed.
     *
     * @param string unparsed content
     * @return string parsed content as string
     */
    public function text($content)
    {
        // no need to parse HTML content, perhaps in future
        return $content;
    }
}