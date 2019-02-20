<?php

use app\helpers\StringHelper;
use app\models\systemModels\SourceMessage;
use app\modules\admin\overrides\CustomGridView;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\admin\models\search\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Переклади';
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
            <?= Html::a('Додати запис', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= CustomGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'category',
                    'filter' => ArrayHelper::map(SourceMessage::find()->select('category')->asArray()->all(), 'category', 'category')
                ],
                'message:ntext',
                [
                    'attribute' => 'translation',
                    'label' => 'Переклад ' . Yii::$app->language,
                    'format' => 'html',
                    'value' => function ($model) {
                        $class = 'danger';
                        $title = 'Переклад не доданий';
                        $titleContent = ArrayHelper::getValue(
                            $model->getSourceMessageTranslations()->where(['language' => Yii::$app->language])->one(),
                            'translation',
                            null
                        );
                        if ($titleContent) {
                            $class = 'info';
                            $title = $titleContent;
                        }

                        return "<span class='label label-{$class}'>" . StringHelper::truncateWords($title, 5) . "</span>";
                    },
                ],

            ],
        ]); ?>
        <?php
        $this->registerJs('
            let deleteButtons = document.querySelectorAll(\'#grid-view-id .delete-btn\');
            if(deleteButtons.length > 0){
                for(let i = 0; i < deleteButtons.length; i++){
                    deleteButtons[i].classList.add(\'hide\');
                }
            }
        ', $this::POS_READY);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>




