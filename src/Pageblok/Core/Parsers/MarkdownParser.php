<?php

namespace Pageblok\Pageblok\Parsers;

use Pageblok\Pageblok\Interfaces\ContentParserInterface;

class MarkdownParser implements ContentParserInterface
{

    private $parser = null;


    /**
     * Construct new Markdown parser
     * @param $parser A Markdown parser.
     */
    public function __construct($parser)
    {
        $this->parser = $parser;
    }

    /**
     * Get content as string. Means already parsed.
     *
     * @param string unparsed content
     * @return string parsed content as string
     */
    public function text($content)
    {
        return $this->parser->text($content);
    }
} 