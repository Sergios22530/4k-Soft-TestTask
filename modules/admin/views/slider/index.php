<?php

use app\modules\admin\helpers\FileUploadHelper;
use app\modules\admin\helpers\FilterHelper;
use app\helpers\Status;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\helpers\StringHelper;
use yii\widgets\Pjax;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\helpers\Url;
use app\modules\admin\overrides\CustomGridView;
use app\modules\admin\models\Slider;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\admin\models\search\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайдер головна';
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
            <?= Html::a('<span>Додати запис</span>', ['create'], ['class' => 'fa fa-plus btn btn-success btn-lg']) ?>
        </p>
        <?= CustomGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions' => function ($model) {
                $sortOptions = ['data-sortable-id' => $model->id];
                if ($model->status == Status::STATUS_INACTIVE) {
                    return ArrayHelper::merge($sortOptions,['class' => 'danger']);
                }

                return $sortOptions;
            },
            'options' => [
                'data' => [
                    'sortable-widget' => 1,
                    'sortable-url' => Url::toRoute([Yii::$app->controller->id . '/sorting']),
                ],
            ],
            'columns' => [
                ['class' => \kotchuprik\sortable\grid\Column::class],
                [
                    'attribute' => 'title',
                    'label' => 'Заголовок банера',
                    'format' => 'html',
                    'value' => function ($model) {
                        $class = 'danger';
                        $title = 'Заголовок не додано';
                        $titleContent = ArrayHelper::getValue(
                            $model->getSliderTranslations()->where(['language' => Yii::$app->language])->one(),
                            'title',
                            null
                        );
                        if ($titleContent) {
                            $class = 'info';
                            $title = $titleContent;
                        }

                        return "<span class='label label-{$class}'>" . StringHelper::truncateWords($title, 5) . "</span>";
                    },
                ],
                [
                    'attribute' => 'description',
                    'label' => 'Опис банера',
                    'format' => 'html',
                    'value' => function ($model) {
                        $title = 'Опис не додано';
                        $titleContent = ArrayHelper::getValue(
                            $model->getSliderTranslations()->where(['language' => Yii::$app->language])->one(),
                            'description',
                            null
                        );
                        if ($titleContent) {
                            $title = $titleContent;
                        }

                        return "<span>" . StringHelper::truncateWords($title, 5) . "</span>";
                    },
                ],
                [
                    'attribute' => 'slider_type',
                    'format' => 'html',
                    'value' => function ($model) {
                        $class = 'default';
                        $icon = 'fa fa-file-o';
                        /** @var $model Slider */
                        switch ($model->slider_type) {
                            case $model::SLIDER_TYPE_IMAGE:
                                $class = 'default';
                                $icon = 'fa fa-file-image-o';
                                break;
                            case $model::SLIDER_TYPE_VIDEO:
                                $class = 'primary';
                                $icon = 'fa fa-file-video-o';
                                break;
                        }

                        return FilterHelper::filter($model::sliderTypes(), $model->slider_type, "label label-{$class}", $icon);
                    },
                    'filter' => FilterHelper::filter(Slider::sliderTypes())
                ],
                [
                    'attribute' => 'file',
                    'format' => 'html',
                    'value' => function ($model) {
                        /** @var $model Slider */
                        $isExist = FileUploadHelper::fileExist(ArrayHelper::getValue(Slider::uploadedPaths(), $model->slider_type), $model->file);
                        return ($isExist) ? '<span class="label label-success">Файл успішно завантажено</span>' :
                            '<span class="label label-danger">Файл не завантажено</span>';
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return Status::getStatus($data->status);
                    },
                    'filter' => Status::getStatus()
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Yii::$app->getFormatter()->asDate($data->created_at, 'dd MMMM, yyyy H:m:s');
                    },
                    'filter' => false
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>

