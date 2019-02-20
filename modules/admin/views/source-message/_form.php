<?php

use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use app\models\systemModels\Language;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model \app\models\systemModels\SourceMessage */
/* @var $form yii\widgets\ActiveForm */

$items = [];
?>

<div class="source-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?php foreach (Language::getAllLanguage() as $language => $languageName) {
        $html = '';
        $html .= $form->field($model->translate($language), "[$language]translation")->textarea(['style' => 'height: 300px;']);
        $items[] = [
            'label' => $languageName,
            'content' => $html
        ];
    } ?>

    <?php echo Tabs::widget([
        'items' => $items
    ]); ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>

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

