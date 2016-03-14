<?php
namespace frontend\helpers;

use app\helpers\PathHelper;

class ImageHelper
{
    const DEFAULT_IMAGE = 'default.png';
    const DEFAULT_PREVIEW = 'default-preview.png';

    /**
     * Get image base url
     * @param string $folder
     * @param string $fileName
     * @param string $default
     * @param string $uploadFolder
     * @return string
     */
    public static function baseUrl($folder, $fileName, $default = null, $uploadFolder = null)
    {
        $default = is_null($default) ? self::DEFAULT_IMAGE : $default;
        $file = PathHelper::uploadPath($folder, $uploadFolder) . $fileName;
        if (is_file($file)) {
            return PathHelper::baseUrl($folder, $fileName, $uploadFolder);
        }
        return PathHelper::baseUrl('default', $default, $uploadFolder);
    }

    /**
     * Get image absolute url
     * @param string $folder
     * @param string $fileName
     * @param string $default
     * @param string $uploadFolder
     * @return string
     */
    public static function absoluteUrl($folder, $fileName, $default = null, $uploadFolder = null)
    {
        $default = is_null($default) ? self::DEFAULT_IMAGE : $default;
        $file = PathHelper::uploadPath($folder, $uploadFolder) . $fileName;
        if (is_file($file)) {
            return PathHelper::absoluteUrl($folder, $fileName, $uploadFolder = null);
        }
        return PathHelper::absoluteUrl('default', $default, $uploadFolder = null);
    }
}