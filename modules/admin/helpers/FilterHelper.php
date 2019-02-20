<?php

namespace app\modules\admin\helpers;

use yii\helpers\ArrayHelper;

class FilterHelper
{
    const KEY_CLASS = '{%class%}';
    const KEY_FILTER_RESULT = '{%filter-result%}';

    /**
     * Using only for grid view and for drop down lists in admin panel (used for array values)
     * @param null $value integer (value for search)
     * @param $arrayValues  array (values for filtering)
     * @param $bootstrapClass string
     * @param $icon string
     * @return mixed
     */
    public static function filter($arrayValues, $value = null, $bootstrapClass = null, $icon = null)
    {
        $iconTemplate = (isset($icon)) ? "<span class='{$icon}' style='margin-right: 3px; font-size: 9pt;'></span>" : '';

        $mask = '<span class="' . self::KEY_CLASS . '">' . $iconTemplate . ' ' . self::KEY_FILTER_RESULT . '</span>';

        $filterResult = ArrayHelper::getValue($arrayValues, $value, $arrayValues);

        if ($bootstrapClass) {
            return strtr($mask, [
                self::KEY_CLASS => (!is_array($filterResult)) ? $bootstrapClass : 'label label-danger',
                self::KEY_FILTER_RESULT => $filterResult
            ]);
        }

        return $filterResult;
    }

    /**
     * Convert filtering value to html with custom bootstrap classes (user for one value)
     * @param $value
     * @param $bootstrapClass
     * @param $errorText
     * @return string
     */
    public static function htmlConverter($value, $bootstrapClass = null, $errorText)
    {
        $mask = '<span class="' . self::KEY_CLASS . '">' . self::KEY_FILTER_RESULT . '</span>';
        $resultValue = (isset($value)) ? $value : $errorText;

        return strtr($mask, [
            self::KEY_CLASS => (isset($value)) ? $bootstrapClass : 'label label-danger',
            self::KEY_FILTER_RESULT => $resultValue
        ]);
    }

}