<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\traits\ActionsTrait;
use Yii;
use app\modules\admin\models\Post;
use app\modules\admin\models\search\PostSearch;
use yii\helpers\ArrayHelper;
use app\modules\admin\components\BackendController;
use kartik\grid\EditableColumnAction;
use sergios\uploadFile\actions\UploadFileAction;
use sergios\uploadFile\actions\DeleteFileAction;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BackendController
{
    use ActionsTrait;

    public function init()
    {
        $this->currentObject = new Post();

        parent::init();
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'upload-file' => ['class' => UploadFileAction::class], //event for custom uploading file

            'delete-file' => ['class' => DeleteFileAction::class], //event for custom deleting file

            'additable-action' => [
                'class' => EditableColumnAction::class,
                'modelClass' => Post::class,
                'outputValue' => function ($model, $attribute, $key, $index) {
                    //for additable plagin
                    if (Yii::$app->request->post('hasEditable')) {
                        $namespaceName = (new \ReflectionClass($model))->getName();
                        $modelName = (new \ReflectionClass($model))->getShortName();
                        $editableKey = Yii::$app->request->post('editableKey');
                        $model = $namespaceName::findOne($editableKey);
                        $posted = current(Yii::$app->request->post($modelName));
                        $model->{$attribute} = $posted[$attribute];
                        $model->save();
                        return $posted[$attribute];
                    }
                },
            ]
        ]);
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
