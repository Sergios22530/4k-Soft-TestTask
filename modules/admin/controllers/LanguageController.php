<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\traits\ActionsTrait;
use Yii;
use app\models\systemModels\Language;
use app\modules\admin\models\search\LanguageSearch;
use app\modules\admin\components\BackendController;

/**
 * LanguageController implements the CRUD actions for Language model.
 */
class LanguageController extends BackendController
{
    use ActionsTrait;

    public function init()
    {
        $this->currentObject = new Language();
        parent::init();
    }

    /**
     * Lists all Language models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LanguageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
