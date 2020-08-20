<?php

namespace app\widgets\preloader;

use yii\base\Widget;

class PreloaderWidget extends Widget
{

    public function run()
    {
        return $this->render('preloader');
    }
}