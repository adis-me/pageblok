<?php


namespace Pageblok\CMS\Controllers;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Pageblok\Pageblok\Exceptions\PageblokException;

class AssetController extends PageblokController
{

    protected $themesAssetsPath;
    protected $adminAssetsPath;
    protected $mimeMap;

    public function __construct()
    {
        $this->themesAssetsPath = \Pageblok::getCurrentThemePath() . '/assets/';
        $this->mimeMap = array(
            'pdf' => 'application/pdf',
            'zip' => 'application/zip',
            'gif' => 'image/gif',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'css' => 'text/css',
            'html' => 'text/html',
            'js' => 'text/javascript',
            'map' => 'text/javascript',
            'txt' => 'text/plain',
            'xml' => 'text/xml',
            'svg' => 'image/svg+xml',
            'ttf' => 'application/x-font-ttf',
            'otf' => 'application/x-font-opentype',
            'woff' => 'application/x-font-woff',
            'eot' => 'application/vnd.ms-fontobject',
            'ico' => 'image/x-icon',
        );
    }

    public function assets($file = null)
    {

        if (!is_null($file) && \File::isDirectory($this->themesAssetsPath)) {
            if (!\File::exists($this->themesAssetsPath . $file)) {
                return \Response::make("Not found!", 404);
            }
            $requestedFile = \File::get($this->themesAssetsPath . $file);

            return \Response::make(
                $requestedFile,
                200,
                array('Content-Type' => $this->mimeMap[\Str::lower(\File::extension($this->themesAssetsPath . $file))])
            );
        }

        return \Redirect::route('app.home');
    }

    /**
     * Upload an asset.
     * @throws PageblokException
     */
    public function uploadAsset()
    {
        $date = \Carbon::today();
        $file = \Input::file('file');
        $originalName = $file->getClientOriginalName();

        $extension = $file->getClientOriginalExtension();
        // if extension cannot be found a negative 4 is given
        $extensionPosition = (strpos($originalName, '.' . $extension)) ?: -4;
        $basename = \Str::slug(substr($file->getClientOriginalName(), 0, $extensionPosition));
        // we always save it like .jpg
        $fileName = $date->toDateString() . '-' . $basename . '.jpg';

        if (!$file->isValid()) {
            throw new PageblokException("No file to upload!", 12);
        }

        $uploadedFilePath = \Pageblok::getUploadPath() . '/' . $fileName;
        \Image::make($file)->save($uploadedFilePath, 75 /* quality compression */);

        // check if file exists
        if (\File::get($uploadedFilePath)) {
            // file url is the relative url
            $fileUrl = '/' . \Config::get('pageblok::settings.upload.folder') . '/' . $fileName;

            return \Response::json(array('status' => true, 'message' => $fileUrl));
        }

        return \Response::json(array('status' => false, 'message' => 'Error during upload'));

    }

} 