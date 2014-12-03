<?php


namespace Pageblok\Core\Services;


use Pageblok\Core\Exceptions\PageblokException;

class Pageblok
{

    const DIR_SEPARATOR = '/';

    /**
     * Base path.
     * @var string
     */
    protected $basePath;

    /**
     * Theme name that is used. This is also a folder in {@var $themesFolder}.
     * @var string Must be all lowercase without white spaces
     */
    protected $themeName;

    /**
     * Folder that contains all our theme files.
     * @var string
     */
    protected $themesFolder;

    /**
     * Get templates folder for this theme.
     * @var string
     */
    protected $templatesFolder;

    /**
     * Upload folder.
     * @var
     */
    protected $uploadFolder;

    /**
     * Thumbnail folder
     * @var
     */
    protected $thumbnailFolder;

    /**
     * Set some path variables.
     */
    public function __construct()
    {
        $this->basePath = base_path();

        $this->themeName = \Config::get('pageblok::settings.theme');
        $this->themesFolder = \Config::get('pageblok::settings.theme.folder');
        $this->templatesFolder = \Config::get('pageblok::settings.templates');
        $this->uploadFolder = \Config::get('pageblok::settings.upload.folder');
        $this->thumbnailFolder = \Config::get('pageblok::settings.upload.thumbnails.folder');
    }

    /**
     * Return absolute theme path with ending slash
     * @return string
     */
    public function getCurrentThemePath()
    {
        return $this->getThemesDirectory() . self::DIR_SEPARATOR . $this->themeName;
    }

    /**
     * Get absolute templates folder for current theme.
     *
     * @return string Templates folder for current theme (with ending slash).
     */
    public function getTemplatesPath()
    {
        return $this->getCurrentThemePath() . self::DIR_SEPARATOR . $this->templatesFolder;
    }

    /**
     * Get allowed content types.
     *
     * @return array With the allowed content types
     */
    public function getContentTypes()
    {
        return array(
            'html' => 'html',
            'markdown' => 'markdown',
        );
    }

    /**
     * Get upload folder for current theme.
     * @return string
     */
    public function getUploadPath()
    {
        return $this->getCurrentThemePath() . self::DIR_SEPARATOR . $this->uploadFolder;
    }

    /**
     * Get thumbnail folder for current theme.
     * @return string
     */
    public function getThumbnailPath()
    {
        return $this->getCurrentThemePath() . self::DIR_SEPARATOR . $this->thumbnailFolder;
    }

    /**
     * Get the absolute path of the themes folder.
     * @return string
     */
    public function getThemesDirectory()
    {
        return $this->basePath . self::DIR_SEPARATOR . $this->themesFolder;
    }

    /**
     * Get templates for a given type. These templates are stored in a template directory. The name for this template dir
     * is defined in the config file.
     *
     * @param $templateType
     * @return array with template names.
     */
    public function getTemplates($templateType)
    {
        $templates = array();
        // always add a please select option
        $templates[""] = \Lang::get("pageblok::pageblok.please.select");

        /**
         * Get templates for template type. If template type is "blocks", we expect the user to have a directory "blocks" in his template folder.
         * The "blocks" folder contains templates for Blocks.
         */
        $templatesFolder = \Pageblok::getTemplatesPath() . "/" . $templateType;
        // TODO: check if directory exists for given template type, otherwise select template from main template folder
        $themeFolder = \Config::get('pageblok::settings.theme');
        $templateFolder = \Config::get('pageblok::settings.templates');

        // get all templates from templates folder
        $templateList = \File::allFiles($templatesFolder);

        // first template option is NO TEMPLATE
        $templates[""] = \Lang::get('pageblok::app.no.template');

        foreach ($templateList as $template) {
            $fileNameWithoutExtension = substr(
                $template->getFileName(), // get filename
                0, // start reading from first character
                strpos($template->getFileName(), '.blade.php') // do not include the blade part in the name
            );
            // construct fully qualified laravel view name
            $qualifiedTemplateName = "pageblok::" . $themeFolder . '.' . $templateFolder . '.' . $templateType . '.' . $fileNameWithoutExtension;
            // place it in a array
            $templates[$qualifiedTemplateName] = $fileNameWithoutExtension;

        }

        return $templates;
    }

    /**
     * Upload file
     *
     * @param $file
     * @return null|uploaded file url
     * @throws PageblokException if file is given but is not valid
     */
    public function uploadFile($file)
    {
        if (is_null($file)) {
            return null;
        }

        $date = \Carbon::today();
        $originalName = $file->getClientOriginalName();

        $extension = $file->getClientOriginalExtension();
        // if extension cannot be found a negative 4 is given
        $extensionPosition = (strpos($originalName, '.' . $extension)) ?: -4;
        $basename = substr($file->getClientOriginalName(), 0, $extensionPosition);
        // we always save it like .jpg
        $fileName = $date->toDateString() . '-' . $basename . '.jpg';

        if (!$file->isValid()) {
            throw new PageblokException("No file to upload!", 12);
        }

        $uploadedFilePath = $this->getUploadPath() . '/' . $fileName;
        \Image::make($file)->save($uploadedFilePath, 75 /* quality compression */);

        // check if file exists
        if (\File::get($uploadedFilePath)) {
            // return the relative file url
            $fileUrl = '/' . $this->uploadFolder . '/' . $fileName;

            return $fileUrl;
        }
        // Upload did not succeed...
        \Log::warning("Could not upload file '{$file}");

        return null;
    }
} 