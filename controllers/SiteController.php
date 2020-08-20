<?php

namespace app\controllers;

use app\actions\forms\FormsHandlerAction;
use app\models\forms\ContactForm;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'form1-handler' => ['class' => FormsHandlerAction::class, 'formProcess' => ContactForm::SCENARIO_FORM_1],
            'form2-handler' => ['class' => FormsHandlerAction::class, 'formProcess' => ContactForm::SCENARIO_FORM_2],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
