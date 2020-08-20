<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * RequestAsset asset bundle.
 */
class RequestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/request.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}
