<?php

namespace app\modules\admin\helpers;

use app\helpers\Path;

class FileUploadHelper
{
    const MAX_UPLOAD_FILE_SIZE = 2; //2 mb
    const MAX_UPLOAD_VIDEO_SIZE = 3; //3 mb
    const MAX_UPLOAD_IMAGE_SIZE = 3; //3 mb
    const MAX_UPLOAD_PDF_FILE_SIZE = 2; //2 mb

    /**
     * Check existing file
     * @param $path
     * @param $fileName
     * @return bool
     */
    public static function fileExist($path, $fileName)
    {
        return is_file(Path::getUploadPath($path) . $fileName);
    }

    /**
     * Unlink file by directory options
     * @param $folder
     * @param $name
     * @return bool
     */
    public static function unlinkFile($folder, $name)
    {
        if (!$name) return false;
        if (self::fileExist($folder, $name)) {
            return unlink(Path::getUploadPath($folder) . $name);
        }
    }
}