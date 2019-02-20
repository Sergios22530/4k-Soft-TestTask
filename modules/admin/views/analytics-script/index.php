<?php

use app\modules\admin\models\AnalyticsScript;
use app\modules\admin\models\search\AnalyticsScriptSearch;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\Status;
use app\modules\admin\overrides\CustomGridView;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel AnalyticsScriptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скрипти систем аналітики';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= AsyncGridViewWidget::widget([
    'pjaxContainerId' => 'index-page-grid',
    'indexUrl' => Url::to([Yii::$app->controller->id . '/index'])
]); ?>

<div id='modalContent' class="box box-solid <?= \app\modules\admin\helpers\ThemeHelper::boxClass() ?>">
    <div class="box-header">
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <?php Pjax::begin(['id' => 'index-page-grid', 'enablePushState' => false, 'timeout' => 25000]); ?>
        <p>
            <?= Html::a('Додати скрипт', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= CustomGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function($model){
                if($model->status == Status::STATUS_INACTIVE){
                    return ['class' => 'danger'];
                }else{
                    return ['class' => 'success'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'description:ntext',
                [
                    'attribute' => 'position',
                    'value' => function ($model) {
                        /* @var $model AnalyticsScript */
                        return $model->getPosition($model->position);
                    },
                    'filter' => $searchModel->getPosition()
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        /* @var $model AnalyticsScript */
                        return Status::getStatus($model->status);
                    },
                    'filter' => Status::getStatus()
                ],
                // 'created_at',
                // 'updated_at',
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
