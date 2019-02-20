<?php
namespace app\helpers;

use yii\helpers\ArrayHelper;

class Status
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @param int $status
     * @param string $textActive
     * @param string $textInActive
     * @return array
     */
    public static function getStatus($status = null, $textActive = 'Активний', $textInActive = 'Не активний')
    {
        $data = [self::STATUS_ACTIVE => $textActive, self::STATUS_INACTIVE => $textInActive];
        return ArrayHelper::getValue($data, $status, $data);
    }

}