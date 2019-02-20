<?php

namespace app\modules\admin\components;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class BackendController extends \yii\web\Controller
{
    /** Current model object */
    public $currentObject = null;

    /** Custom params for form views */
    public $renderParams = ['create' => [], 'update' => []];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @param $model object
     * @return mixed
     */
    public function createTemplate($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $params = (empty($this->renderParams['create'])) ?
                ['model' => $model] : ArrayHelper::merge(['model' => $model], $this->renderParams['create']);
            return $this->render('create', $params);
        }
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param $model object
     * @return mixed
     */
    public function updateTemplate($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                $response = Yii::$app->getResponse();
                $response->data['success'] = true;
                $response->format = Response::FORMAT_JSON;

                return $response;
            }

            return $this->redirect(['index']);
        }

        $params = (empty($this->renderParams['update'])) ?
            ['model' => $model] : ArrayHelper::merge(['model' => $model], $this->renderParams['update']);
        return (Yii::$app->request->isAjax) ?
            $this->renderAjax('update', $params) : $this->render('update', $params);
    }

    /**
     * Deletes an existing Language model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function deleteTemplate()
    {
        if (Yii::$app->request->isAjax) {
            $response = Yii::$app->getResponse();
            $response->data['success'] = true;
            $response->format = Response::FORMAT_JSON;
            return $response;
        }

        return $this->redirect(['index']);
    }
}