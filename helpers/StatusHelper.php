<?php
namespace app\helpers;

use yii\helpers\ArrayHelper;

class StatusHelper
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @param int $status
     * @param string $textActive
     * @param string $textInActive
     * @return array
     */
    public static function getStatus($status = null, $textActive = 'Активный', $textInActive = 'Не активный')
    {
        $data = [
            self::STATUS_ACTIVE => $textActive,
            self::STATUS_INACTIVE => $textInActive
        ];

        return ArrayHelper::getValue($data, $status, $data);
    }

}