<?php

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets/files';

    public $css = [
        'css/site.css',

    ];
    public $js = [
        'js/common.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
