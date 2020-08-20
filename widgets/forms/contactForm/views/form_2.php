<?php

use app\assets\AppAsset;
use app\assets\DatePickerAsset;
use app\assets\RequestAsset;
use app\widgets\preloader\PreloaderWidget;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\forms\ContactForm;

/**
 * @var View $this
 * @var ContactForm $model
 */

DatePickerAsset::register($this);
$this->registerJsFile('/js/forms/form2-handler.js', ['depends' => [AppAsset::class, RequestAsset::class]]);
?>
    <div class="alert alert-success text-center fade " role="alert">
        Вы успешно отправили <strong>Форму 2</strong>!
        <span aria-hidden="true" class="closeBtn" onclick="listenAlert(this)">&times;</span>
    </div>

<?php $form = ActiveForm::begin([
    'id' => 'contact-form2',
    'action' => Url::to(['site/form2-handler']),
    'enableClientScript' => true,
    'enableClientValidation' => true,
]); ?>
    <p class="h3 text-center">Форма 2</p>
<?= $form->field($model, 'company_name')->textInput(['placeholder' => $model->getAttributeLabel('company_name')]); ?>

<?= $form->field($model, 'post')->textInput(['placeholder' => $model->getAttributeLabel('post')]); ?>

<?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')]); ?>

<?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')]); ?>

<?= $form->field($model, 'created_at')->textInput(['placeholder' => $model->getAttributeLabel('created_at')]); ?>

<?= $form->field($model, 'emptyField', [
    'template' => "<div class='hiddenInput'>{label}\n<{input}\n{error}</div>",
])->label(false) ?>

    <div class="bottom">
        <?= Html::submitButton('Отправить', [
            'id' => 'submitContactForm1',
            'name' => 'contact-button',
            'class' => 'btn btn-primary',
            'onsubmit' => "return false",
            'onClick' => 'listenForm2(this); return false;'
        ]) ?>
    </div>
<?= PreloaderWidget::widget() ?>

<?php ActiveForm::end(); ?>

<?php $this->registerJs(' 
initDatePicker("#' . Html::getInputId($model, 'created_at') . '");
function listenAlert() {
    $(\'.alert\').removeClass(\'show\');
    $(\'#contact-form2\').removeClass(\'fade\');
    initDatePicker("#contactform-created_at");
}
', $this::POS_END) ?>