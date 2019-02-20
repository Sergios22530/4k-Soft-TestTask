<?php

use yii\helpers\Html;
use app\helpers\Status;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\helpers\Path;
use app\modules\admin\models\Post;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use app\modules\admin\overrides\CustomGridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\admin\models\search\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новини';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AsyncGridViewWidget::widget([
    'pjaxContainerId' => 'index-page-grid',
    'indexUrl' => Url::to([Yii::$app->controller->id . '/index'])
]); ?>

<div id='modalContent' class="box box-solid <?= \app\modules\admin\helpers\ThemeHelper::boxClass() ?>">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <p class="add-btn">
            <?= Html::a('<span>Додати новину</span>', ['create'], ['class' => 'fa fa-plus btn btn-success btn-lg']) ?>
        </p>
        <?= CustomGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'useCustomColumns' => false,
            'rowOptions' => function ($model) {
                if ($model->status == Status::STATUS_INACTIVE) {
                    return ['class' => 'danger'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                [
                    'header' => 'Зображення',
                    'attribute' => 'image',
                    'format' => 'html',
                    'value' => function ($data) {
                        if ($data->image) {
                            return Html::img(Path::getUploadUrl(Post::UPLOAD_FOLDER_IMAGE, true) . $data->image, [
                                'width' => Post::PREVIEW_RESIZE_WIDTH / 2,
                                'height' => Post::PREVIEW_RESIZE_HEIGHT / 2
                            ]);
                        } else {
                            return '<span class="label label-danger">Фото не завантажено</span>';
                        }
                    },
                    'filter' => false
                ],
                [
                    'header' => 'Заголовок',
                    'attribute' => 'title',
                    'format' => 'html',
                    'value' => function ($data) {
                        if ($data->title) {
                            return StringHelper::truncateWords($data->title, 3);
                        } else {
                            return '<span class="label label-danger">Заголовок не доданий</span>';
                        }
                    },
                    'filter' => false
                ],
                'slug',
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
                        return Yii::$app->getFormatter()->asDate($data->created_at, 'yyyy-M-dd hh:mm');
                    },
                    'filter' => false
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
</div>
