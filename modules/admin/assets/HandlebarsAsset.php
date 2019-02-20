<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class HandlebarsAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/admin/assets/files';

    public $js = [
        'js/handlebars.min.js'
    ];

}