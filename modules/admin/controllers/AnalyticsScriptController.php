<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\traits\ActionsTrait;
use Yii;
use app\modules\admin\models\AnalyticsScript;
use app\modules\admin\models\search\AnalyticsScriptSearch;
use app\modules\admin\components\BackendController;

/**
 * AnalyticsScriptController implements the CRUD actions for AnalyticsScript model.
 */
class AnalyticsScriptController extends BackendController
{
    use ActionsTrait;

    public function init()
    {
        $this->currentObject = new AnalyticsScript();
        parent::init();
    }

    /**
     * Lists all AnalyticsScript models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalyticsScriptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
