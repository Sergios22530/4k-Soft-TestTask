<?php

use app\modules\admin\models\Slider;
use app\models\systemModels\Language;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use sergios\uploadFile\components\Uploader;
use sergios\uploadFile\UploadFileWidget;
use sergios\uploadFile\helpers\UploadHelper;
use app\modules\admin\helpers\FileUploadHelper;

/**
 * @var $bannerType integer
 * @var $model \app\modules\admin\models\Slider
 * @var $this \yii\web\View
 * @var $form \yii\widgets\ActiveForm
 * @var $bootstrapClasses string
 */

$translationAltItems = [];
?>

<div class="field-block" data-type="<?= Slider::SLIDER_TYPE_IMAGE ?>"
     style="display: <?= ($model->slider_type == Slider::SLIDER_TYPE_IMAGE) ? 'block' : 'none' ?>;">
    <?= UploadFileWidget::widget([
        'model' => $model,
        'form' => $form,
        'uploadType' => Uploader::UPLOAD_TYPE_IMAGE,
        'language' => 'uk-UA',
        'uploadPath' => Slider::UPLOAD_FOLDER_IMAGE,
        'attributes' => [
            'attribute' => 'imageFile',
            'tempAttribute' => 'tempUploadImage'
        ],
        'options' => [
            'uploadMineType' => UploadHelper::uploadMineTypeForImages(),
            'multiple' => false,
            'maxFileSize' => FileUploadHelper::MAX_UPLOAD_IMAGE_SIZE,
            'resize' => [
                'resizeWidth' => Slider::IMAGE_RESIZE_WIDTH,
                'resizeHeight' => Slider::IMAGE_RESIZE_HEIGHT,
            ],
        ],
        'templateOptions' => [
            'uploadLimitWindow' => true,
            'bootstrapOuterWrapClasses' => $bootstrapClasses,
//                'bootstrapInnerWrapClasses' => 'col-xs-6 col-sm-6 col-md-6 col-lg-12'
        ]
    ]) ?>

    <div style="clear: both;"></div>

    <?php foreach (Language::getAllLanguage() as $language => $languageName) {

        $html = '';
        $html .= Html::tag('label', $model->translate($language)->getAttributeLabel('image_alt'), [
            'for' => Html::getInputId($model, 'image_alt'),
            'class' => 'control-label'
        ]);
        $html .= Html::activeInput('input', $model->translate($language), "[$language]image_alt", ['class' => 'form-control form-group']);
        $translationAltItems[] = [
            'label' => $languageName,
            'content' => $html,
            'options' => ['id' => 'my-tab' . rand(1, 9999999)]
        ];
    } ?>

    <div class="row" style="margin-top: 20px;">
        <div class="<?= $bootstrapClasses ?>">
            <?php echo Tabs::widget([
                'items' => $translationAltItems
            ]); ?>
        </div>
    </div>
</div>

<div class="field-block" data-type="<?= Slider::SLIDER_TYPE_VIDEO ?>"
     style="display: <?= ($model->slider_type == Slider::SLIDER_TYPE_VIDEO) ? 'block' : 'none' ?>;">
    <?= UploadFileWidget::widget([
        'model' => $model,
        'form' => $form,
        'uploadType' => Uploader::UPLOAD_TYPE_VIDEO,
        'language' => 'uk-UA',
        'uploadPath' => Slider::UPLOAD_FOLDER_VIDEO,
        'attributes' => [
            'attribute' => 'videoFile',
            'tempAttribute' => 'tempUploadVideo'
        ],
        'options' => [
            'uploadMineType' => UploadHelper::uploadMineTypeForVideo(),
            'multiple' => true,
            'maxFileSize' => FileUploadHelper::MAX_UPLOAD_VIDEO_SIZE,
        ],
        'templateOptions' => [
            'uploadLimitWindow' => true,
            'bootstrapOuterWrapClasses' => $bootstrapClasses,
//                'bootstrapInnerWrapClasses' => 'col-xs-6 col-sm-6 col-md-6 col-lg-12'
        ]
    ]) ?>
</div>

