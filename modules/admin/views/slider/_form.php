<?php

use app\models\systemModels\Language;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\widgets\asyncGridView\AsyncGridViewWidget;
use yii\helpers\Url;
use app\modules\admin\models\Slider;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\Slider */
/* @var $form yii\widgets\ActiveForm */

$bootstrapOuterWrapClasses = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
$bootstrapWrapClasses = $model->isNewRecord ? 'col-xs-12 col-sm-12 col-md-7 col-lg-7' : 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
$items = [];
$translationAltItems = [];
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model->getErrors()) ?>

    <div class="row">
        <div class="<?= $bootstrapOuterWrapClasses ?>">

            <?php $this->beginBlock('translation_block') ?>
            <?php foreach (Language::getAllLanguage() as $language => $languageName) {

                $html = '';
                $html .= $form->field($model->translate($language), "[$language]title")->textInput();
                $html .= $form->field($model->translate($language), "[$language]description")->textarea();

                $translationAltItems[] = [
                    'label' => $languageName,
                    'content' => $html,
                    'options' => ['id' => 'my-tab' . rand(1, 9999999)]
                ];
            } ?>

            <div class="row" style="margin-top: 20px;">
                <div class="<?= $bootstrapWrapClasses ?>">
                    <?php echo Tabs::widget([
                        'items' => $translationAltItems
                    ]); ?>
                </div>
            </div>

            <?php $this->endBlock() ?>

            <?php $this->beginBlock('files') ?>

            <div class="row">
                <div class="<?= $bootstrapWrapClasses ?>">
                    <?= $form->field($model, 'slider_type')->dropDownList(Slider::sliderTypes(), ['prompt' => 'Оберіть тип слайдера']) ?>
                </div>
            </div>

            <?= $this->render('_fields', [
                'model' => $model,
                'bootstrapClasses' => $bootstrapWrapClasses,
                'form' => $form
            ]) ?>

            <?php $this->endBlock() ?>

            <?php $items[] = [
                'label' => '<i class="fa fa-suitcase"></i> Контент',
                'content' => $this->blocks['translation_block']
            ]; ?>

            <?php $items[] = [
                'label' => '<i class="fa fa-picture-o"></i> Файл',
                'content' => $this->blocks['files']
            ]; ?>

            <?= Tabs::widget([
                'items' => $items,
                'encodeLabels' => false
            ]); ?>

            <div class="row" style="margin-top: 20px;">
                <div class="<?= $bootstrapWrapClasses ?>">
                    <?= $form->field($model, 'status')->dropDownList(\app\helpers\Status::getStatus()) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Додати' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs('
         var bannerType = document.getElementById("' . Html::getInputId($model, "slider_type") . '");
         bannerType.addEventListener(\'change\',function(){
           
             if(this.value.length){
                hideFields();
                var field = document.querySelector(\'div[data-type="\'+this.value+\'"]\');
                field.removeAttribute(\'style\')
            }else{  
                hideFields();
            }

        },false);
        
        function hideFields(){
            var fields = document.querySelectorAll(\'.field-block\');
             for (var i = 0; i < fields.length; i++) {
                fields[i].style.display = \'none\';                        
            }              
        }        
        
    ', $this::POS_READY);
?>

<?= AsyncGridViewWidget::widget([
    'pjaxContainerId' => 'index-page-grid',
    'indexUrl' => Url::to([Yii::$app->controller->id . '/index']),
    'page' => AsyncGridViewWidget::FORM_PAGE,
    'model' => $model
]); ?>
