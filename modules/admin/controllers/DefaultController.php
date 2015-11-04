<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\modules\admin\models\LoginForm;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        Yii::$app->setHomeUrl('/admin');
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack('/admin');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->setHomeUrl('/admin');
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
