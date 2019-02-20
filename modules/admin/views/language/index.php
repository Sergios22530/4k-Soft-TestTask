<?php

use app\helpers\Status;
use app\modules\admin\helpers\FilterHelper;
use app\modules\admin\overrides\CustomGridView;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\admin\models\search\LanguageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мови';
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
        <p class="add-btn">
            <?= Html::a('<span>Додати мову</span>', ['create'], ['class' => 'fa fa-plus btn btn-success btn-lg']) ?>
        </p>
        <?= CustomGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function ($model) {
                if ($model->status == Status::STATUS_INACTIVE) {
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                [
                    'attribute' => 'default',
                    'format' => 'html',
                    'value' => function ($model) {
                        $bootstrapClass = ($model->default == Status::STATUS_ACTIVE) ? 'label-default' : 'label-warning';
                        return FilterHelper::htmlConverter(Status::getStatus($model->default, 'Да', 'Нет'), 'label ' . $bootstrapClass, '');
                    },
                    'filter' => Status::getStatus(null, 'Да', 'Нет')
                ],
                'prefix',
                'local',
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return Status::getStatus($data->status);
                    },
                    'filter' => Status::getStatus()
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>


