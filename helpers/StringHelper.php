<?php
namespace app\helpers;

use yii\helpers\StringHelper as BaseStringHelper;
use Yii;

class StringHelper extends BaseStringHelper
{
    /**
     * @param mixed $search
     * @param mixed $replace
     * @param mixed $subject
     * @param mixed $position replacement position when the string has many search items
     * @return string
     */
    public static function replace($search, $replace, $subject, $position = 0)
    {
        $text = mb_convert_encoding(trim($subject), 'utf-8', mb_detect_encoding(trim($subject)));
        if ($position > 0) {
            $stringArray = explode($search, $subject);
            $count = count($stringArray);
            if (($count - 1) > $position) {
                $start = array_slice($stringArray, 0, -($count - $position));
                $end = array_slice($stringArray, $position);
                $string = implode($start, $search) . $replace . implode($end, $search);
                return $string;
            }
        }
        return str_replace($search, $replace, $text);
    }

    /**
     * Truncates a string to the number of words specified.
     *
     * @param string $str
     * @param integer $count How many words from original string to include into truncated string.
     * @param string $suffix String to append to the end of truncated string.
     * @param boolean $asHtml Whether to treat the string being truncated as HTML and preserve proper HTML tags.
     * @return string the truncated string.
     */
    public static function truncateText($str, $count = 4, $suffix = '...', $asHtml = false)
    {
        return StringHelper::truncateWords($str, $count, $suffix, $asHtml);
    }

    /**
     * @param $content
     * @param int $count
     * @param string $suffix
     * @param bool $asHtml
     * @return string
     * truncate content field for search page
     */
    public static function truncateContentForSearch($content, $count = 20, $suffix = '...', $asHtml = true){

        $query = Yii::$app->request->get('query');
        $maxLength = 163;
        $searchPosition = strpos($content,$query);
        $contentLength = strlen($content);

        if($contentLength > $maxLength){
            return StringHelper::truncateWords($content, $count, $suffix, $asHtml);
        }else{
            $subStr = substr($content,$searchPosition-350,$searchPosition+350);
            return StringHelper::truncateWords($subStr, $count, $suffix, $asHtml);
        }
    }
}