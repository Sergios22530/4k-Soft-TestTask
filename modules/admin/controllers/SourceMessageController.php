<?php
namespace app\modules\admin\controllers;


use app\modules\admin\components\traits\ActionsTrait;
use Yii;
use app\models\systemModels\SourceMessage;
use app\modules\admin\models\search\SourceMessageSearch;
use app\modules\admin\components\BackendController;

/**
 * SourceMessageController implements the CRUD actions for SourceMessage model.
 */
class SourceMessageController extends BackendController
{
    use ActionsTrait;

    public function init()
    {
        $this->currentObject = new SourceMessage();
        parent::init();
    }
    /**
     * Lists all SourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SourceMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
