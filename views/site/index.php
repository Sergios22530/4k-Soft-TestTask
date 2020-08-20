<?php

use app\widgets\forms\contactForm\ContactFormWidget;
use yii\web\View;
use app\widgets\forms\formTypes\FormTypesWidget;
use yii\widgets\Pjax;

/* @var $this View */

$this->title = 'Test Task';
?>


<div class="row justify-content" style="margin-top: 100px;">
    <?= FormTypesWidget::widget() ?>

    <?php Pjax::begin([
        'id' => 'forms-pjax-wrap',
        'enablePushState' => false,
        'timeout' => 25000,
        'options' => ['class' => 'container']
        //'linkSelector' => '',
    ]); ?>
    <?= ContactFormWidget::widget(['formView' => Yii::$app->request->get('formView', ContactFormWidget::DEFAULT_VIEW)]) ?>
    <?php Pjax::end(); ?>

</div>