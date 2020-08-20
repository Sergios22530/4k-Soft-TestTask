<?php

namespace app\assets;

use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://coderoad.ru/49572786/Bootstrap-4-datepicker'
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ru.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}