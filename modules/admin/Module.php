<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use Yii;

class Module extends \yii\base\Module
{
    public $layout = '@app/modules/admin/views/layouts/main.php';

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->getResponse()->redirect(['/admin/default/login']);
                }
            ],
        ];
    }

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->session->setName('_adminSessionId');
    }
}
