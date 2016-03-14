<?php
namespace app\helpers;

use yii\helpers\ArrayHelper;

class RobotsHelper
{
    const INDEX_FOLLOW = 'index, follow';
    const INDEX_NOFOLLOW = 'index, nofollow';
    const NOINDEX_FOLLOW = 'noindex, follow';
    const NOINDEX_NOFOLLOW = 'noindex, nofollow';

    /**
     * Return value for meta tag robots
     * @param string $type
     * @return array|string
     */
    public static function get($type = null)
    {
        $data = [
            self::INDEX_FOLLOW => self::INDEX_FOLLOW,
            self::INDEX_NOFOLLOW => self::INDEX_NOFOLLOW,
            self::NOINDEX_FOLLOW => self::NOINDEX_FOLLOW,
            self::NOINDEX_NOFOLLOW => self::NOINDEX_NOFOLLOW
        ];

        return ArrayHelper::getValue($data, $type, $data);
    }
}