<?php
namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\base\InvalidCallException;
use yii\helpers\Url;

class PathHelper
{
    private static $UPLOAD_FOLDER = 'uploads';

    /**
     * Return path
     * @param string $folder
     * @param string $uploadFolder
     * @return string
     */
    public static function uploadPath($folder = '', $uploadFolder = null)
    {
        $uploadFolder = is_null($uploadFolder) ? self::$UPLOAD_FOLDER : $uploadFolder;
        $path = Yii::getAlias('@app/web/' . $uploadFolder);
        if (!empty($folder)) {
            $path .= '/' . trim($folder, '/');
            if (!FileHelper::createDirectory(FileHelper::normalizePath($path))) {
                throw new InvalidCallException("Directory specified in 'path' attribute doesn't exist or cannot be created.");
            }
        }
        return $path . '/';
    }

    /**
     * Return base url
     * @param string $folder
     * @param string $file
     * @param string $uploadFolder
     * @return string
     */
    public static function baseUrl($folder = null, $file = null, $uploadFolder = null)
    {
        $uploadFolder = is_null($uploadFolder) ? self::$UPLOAD_FOLDER : $uploadFolder;
        $DS = DIRECTORY_SEPARATOR;
        $path = '@web/' . $uploadFolder;
        if ($folder) {
            $path .= $DS . trim($folder, '\\/');
        }
        if ($file) {
            $path .= $DS . trim($file, '\\/');
        }
        return Url::to($path);
    }

    /**
     * Return absolute url with http | https
     * @param string $folder
     * @param string $file
     * @param string $uploadFolder
     * @return string
     */
    public static function absoluteUrl($folder = null, $file = null, $uploadFolder = null)
    {
        $uploadFolder = is_null($uploadFolder) ? self::$UPLOAD_FOLDER : $uploadFolder;
        $DS = DIRECTORY_SEPARATOR;
        $path = '@web/' . $uploadFolder;
        if ($folder) {
            $path .= $DS . trim($folder, '\\/');
        }
        if ($file) {
            $path .= $DS . trim($file, '\\/');
        }
        $domain = ArrayHelper::getValue(Yii::$app->params, 'domain');
        if ($domain) {
            return rtrim($domain, '/') . '/' . self::baseUrl($folder, $file, $uploadFolder);
        }
        return Url::to($path, true);
    }
}