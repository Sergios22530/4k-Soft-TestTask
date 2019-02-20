<?php

use app\helpers\Status;
use kartik\datetime\DateTimePicker;
/**
 * @var $model \app\modules\admin\models\Post
 * @var $form \yii\widgets\ActiveForm
 * @var $bootstrapWrapClasses string
 * @var $filterCategories array
 */
?>

<div class="row">
    <div class="<?= $bootstrapWrapClasses ?>">

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'count_views')->textInput() ?>

        <?= $form->field($model, 'created_at')->widget(DateTimePicker::class, [
            'options' => ['placeholder' => $model->getAttributeLabel('created_at'),'autocomplete' => 'off'],
            'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd hh:mm',//d/M/Y
                'startDate' => Yii::$app->getFormatter()->asDate(date('Y', strtotime('last year')), 'yyyy-M-dd hh:mm'),
                'todayHighlight' => true
            ]
        ]);?>

        <?= $form->field($model, 'status')->dropDownList(Status::getStatus()) ?>
    </div>
</div>