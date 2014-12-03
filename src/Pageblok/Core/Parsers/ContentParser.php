<?php

namespace Pageblok\Core\Parsers;


use Pageblok\Core\Interfaces\ContentParserInterface;

/**
 * Class ContentParser
 * @package Pageblok\Core\Parsers
 * @author Adis Corovic <adis@live.nl>
 */
class ContentParser implements ContentParserInterface
{

    const MARKDOWN_PARSER = 'markdown';
    const HTML_PARSER = 'html';

    protected $parser = null;

    /**
     * Instantiate new TSParser based on parser type
     *
     * @param $parserType string
     */
    public function __construct($parserType)
    {
        switch ($parserType) {
            case self::MARKDOWN_PARSER:
                $this->parser = new \ParsedownExtra();
                break;
            case self::HTML_PARSER:
                $this->parser = new HTMLParser();
                break;
            default:
                $this->parser = new HTMLParser();
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public function text($content)
    {
        return $this->parser->text($content);
    }

} 