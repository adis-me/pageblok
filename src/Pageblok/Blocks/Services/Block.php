<?php


namespace Pageblok\Blocks\Services;

use Pageblok\Blocks\Interfaces\BlockRepositoryInterface;

/**
 * Class Block
 *
 * @package Pageblok\Blocks\Services
 * @author  Adis Corovic <adis@live.nl>
 */
class Block
{

    /**
     * Block repository
     *
     * @var mixed
     */
    protected $repository;

    /**
     * Contains all blocks
     *
     * @var Array
     */
    protected $bag;

    /**
     * Default constructor
     *
     * @param BlockRepositoryInterface $repository
     */
    public function __construct(BlockRepositoryInterface $repository)
    {
        $this->repository = $repository;

        $this->loadBlocksFromRepository();
    }

    /**
     * Load blocks from the repository.
     */
    public function loadBlocksFromRepository()
    {
        $this->repository->all()->each(
            function ($block) {
                $this->bag[$block->pb_name] = $block;
            }
        );
    }

    /**
     * Get block by name
     *
     * @param null $name
     *
     * @return \Pageblok\Blocks\Models\Block
     */
    public function get($name = null)
    {

        if (isset($this->bag[$name])) {
            return $this->bag[$name];
        }

        // else return a new instance, empty block
        return new \Pageblok\Blocks\Models\Block();
    }

    /**
     * Get an array of block by their group name
     *
     * @param $groupName
     *
     * @return arrayG
     */
    public function getByGroup($groupName)
    {
        $blocks = array();
        foreach ($this->bag as $block) {
            if ($groupName === $block->group) {
                $blocks[] = $block;
            }
        }

        if (is_null($blocks)) {
            $blocks[] = new \Pageblok\Blocks\Models\Block();
        }

        return $blocks;
    }

    /**
     * Get templates
     *
     * @return array
     */
    public function getTemplates()
    {
        $pageTemplates = array();
        $templatesFolder = \Pageblok::getTemplatesPath();
        $themeFolder = \Config::get('pageblok::settings.theme');
        $templateFolder = \Config::get('pageblok::settings.templates');

        // get all templates from templates folder
        $templates = \File::allFiles($templatesFolder);

        foreach ($templates as $template) {
            $fileNameWithoutExtension = substr(
                $template->getFileName(),
                0,
                strpos($template->getFileName(), '.blade.php')
            );
            $qualifiedTemplateName
                = "pageblok::" . $themeFolder . '.' . $templateFolder . '.' . $fileNameWithoutExtension;
            $pageTemplates[$qualifiedTemplateName] = $fileNameWithoutExtension;

        }

        return $pageTemplates;
    }

    public function getDefaultTemplate()
    {
        return \Config::get('pageblok::settings.default.block.template');
    }
}