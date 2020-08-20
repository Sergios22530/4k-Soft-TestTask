<?php

use app\assets\AppAsset;
use app\models\forms\ContactForm;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

/**
 * @var View $this
 */

$this->registerJsVar('formTypeConfig', [
    ContactForm::SCENARIO_FORM_1 => Url::to(['site/index','formView' => ContactForm::SCENARIO_FORM_1]),
    ContactForm::SCENARIO_FORM_2 => Url::to(['site/index','formView' => ContactForm::SCENARIO_FORM_2]),
]);

$this->registerJsFile('/js/forms/form-type-handler.js',['depends' => AppAsset::class]);
?>
<div class="container ">
    <div class="form-group">
        <?= Html::tag('label', 'Тип формы', ['for' => 'formTypesId']) ?>
        <?= Html::dropDownList('formTypes', null, ContactForm::formTypes(), ['id' => 'formTypesId', 'prompt' => 'Выберите тип формы', 'class' => 'form-control']) ?>
    </div>
</div>

