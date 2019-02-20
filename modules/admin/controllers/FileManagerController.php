<?php
namespace app\modules\admin\controllers;

use app\modules\admin\components\BackendController;

class FileManagerController extends BackendController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}