<?php

use app\modules\admin\models\AnalyticsScript;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model AnalyticsScript */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analytics-script-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'script')->textarea(['rows' => 6]); ?>

    <?php echo Collapse::widget([
        'items' => [
            [
                'label' => $model->getAttributeLabel('description'),
                'content' => $form->field($model, 'description')->textarea(['rows' => 6])->label(false)
            ],
        ],
        'encodeLabels' => false
    ]); ?>

    <?= $form->field($model, 'position')->dropDownList($model->getPosition()); ?>

    <?= $form->field($model, 'status')->dropDownList(\app\helpers\Status::getStatus()); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= AsyncGridViewWidget::widget([
    'pjaxContainerId' => 'index-page-grid',
    'indexUrl' => Url::to([Yii::$app->controller->id.'/index']),
    'page' => AsyncGridViewWidget::FORM_PAGE,
    'model' => $model
]); ?>
