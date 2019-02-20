<?php

namespace app\modules\admin\helpers;

use Yii;
use yii\helpers\ArrayHelper;

class ThemeHelper
{
    const MENU_ITEM_COLOR = 'yellow';

    /**
     * Get bootstrap class
     * @return string
     */
    public static function boxClass()
    {
        $currentAction = explode('/', Yii::$app->controller->route)[1];
        $options = ['index' => 'box-default', 'update' => 'box-info', 'create' => 'box-success'];
        return ArrayHelper::getValue($options, $currentAction);
    }

}