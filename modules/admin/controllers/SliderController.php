<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\BackendController;
use app\modules\admin\components\traits\ActionsTrait;
use sergios\uploadFile\actions\DeleteFileAction;
use sergios\uploadFile\actions\UploadFileAction;
use Yii;
use app\modules\admin\models\Slider;
use app\modules\admin\models\search\SliderSearch;
use yii\helpers\ArrayHelper;

/**
 * SliderController implements the CRUD actions for Slider model.
 */
class SliderController extends BackendController
{
    use ActionsTrait;

    public function init()
    {
        $this->currentObject = new Slider();
        parent::init();
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'upload-file' => ['class' => UploadFileAction::class], //event for custom uploading file
            'delete-file' => ['class' => DeleteFileAction::class], //event for custom deleting file
            'sorting' => [
                'class' => \kotchuprik\sortable\actions\Sorting::class,
                'query' => Slider::find(),
                'orderAttribute' => 'sort_order'
            ],
        ]);
    }

    /**
     * Lists all Slider models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SliderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
