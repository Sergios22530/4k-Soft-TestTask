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
$this->registerJsFile('/js/forms/form1-handler.js', ['depends' => [AppAsset::class, RequestAsset::class]]);
?>
    <div class="alert alert-success text-center fade " role="alert">
        Вы успешно отправили <strong>Форму 1</strong>!
        <span aria-hidden="true" class="closeBtn" onclick="listenAlert(this)">&times;</span>
    </div>


<?php $form = ActiveForm::begin([
    'id' => 'contact-form1',
    'action' => Url::to(['site/form1-handler']),
    'enableClientScript' => true,
    'enableClientValidation' => true,
]); ?>
    <p class="h3 text-center">Форма 1</p>
<?= $form->field($model, 'company_name')->textInput(['placeholder' => $model->getAttributeLabel('company_name')]); ?>

<?= $form->field($model, 'post')->textInput(['placeholder' => $model->getAttributeLabel('post')]); ?>

<?= $form->field($model, 'post_description')->textarea(['placeholder' => $model->getAttributeLabel('post_description')]); ?>

<?= $form->field($model, 'salary')->textInput(['placeholder' => $model->getAttributeLabel('salary')]); ?>

<?= $form->field($model, 'date_start')->textInput(['placeholder' => $model->getAttributeLabel('date_start')]); ?>

<?= $form->field($model, 'date_end')->textInput(['placeholder' => $model->getAttributeLabel('date_end')]); ?>

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
            'onClick' => 'listenForm1(this); return false;'
        ]) ?>
    </div>
<?= PreloaderWidget::widget() ?>
<?php ActiveForm::end(); ?>

<?php $this->registerJs(' 
initDatePicker("#' . Html::getInputId($model, 'date_start') . '", new Date());
initDatePicker("#' . Html::getInputId($model, 'date_end') . '", new Date());
initDatePicker("#' . Html::getInputId($model, 'created_at') . '", new Date());

function listenAlert() {
    $(\'.alert\').removeClass(\'show\');
    $(\'#contact-form1\').removeClass(\'fade\');
    initDatePicker("#contactform-date_start", new Date());
    initDatePicker("#contactform-date_end", new Date());
    initDatePicker("#contactform-created_at", new Date());
}

', $this::POS_END) ?>