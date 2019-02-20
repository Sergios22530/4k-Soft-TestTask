<?php

namespace app\modules\admin\widgets\asyncGridView\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AsyncGridViewAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/widgets/asyncGridView/assets/files';
    public $css = [
        'css/async-grid-view.css'
    ];
    public $js = [
//        'js/async-grid-view.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'xj\bootbox\BootboxAsset'
    ];
}
