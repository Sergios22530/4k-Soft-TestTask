<?php

use app\models\systemModels\Language;
use sergios\uploadFile\UploadFileWidget;
use sergios\uploadFile\components\Uploader;
use app\modules\admin\models\Post;
use yii\bootstrap\Tabs;

/**
 * @var $model Post
 * @var $form \yii\widgets\ActiveForm
 * @var $bootstrapWrapClasses string
 */

$translationImageAlt = [];
$translationInnerImageAlt = [];
?>

<?= UploadFileWidget::widget([
    'model' => $model,
    'form' => $form,
    'uploadType' => Uploader::UPLOAD_TYPE_IMAGE,
    'language' => Yii::$app->language,
    'uploadPath' => Post::UPLOAD_FOLDER_IMAGE,
    'attributes' => [
        'attribute' => 'image',
        'tempAttribute' => 'tempUploadImage'
    ],
    'options' => [
//                'fileMineType' => FileUploader::MINE_TYPE_PDF,
//                'uploadMineType' => UploadHelper::uploadMineTypeForImages(),
        'multiple' => true,
        'maxFileSize' => 20,
        'resize' => [
            'resizeWidth' => $model::PREVIEW_RESIZE_WIDTH,
            'resizeHeight' => $model::PREVIEW_RESIZE_HEIGHT,
        ],
    ],
    'templateOptions' => [
        'uploadLimitWindow' => true,
        'bootstrapOuterWrapClasses' => $bootstrapWrapClasses,
//                'bootstrapInnerWrapClasses' => 'col-xs-6 col-sm-6 col-md-6 col-lg-12'
    ]
]) ?>

<div style="clear: both;"></div>

<?php foreach (Language::getAllLanguage() as $language => $languageName) {

    $html = '';
    $html .= $form->field($model->translate($language), "[$language]image_alt")->textInput();
    $translationImageAlt[] = [
        'label' => $languageName,
        'content' => $html
    ];
} ?>

<div class="<?= $bootstrapWrapClasses ?>">
    <?php echo Tabs::widget([
        'items' => $translationImageAlt
    ]); ?>
</div>

<div style="clear: both;"></div>

<?= UploadFileWidget::widget([
    'model' => $model,
    'form' => $form,
    'uploadType' => Uploader::UPLOAD_TYPE_IMAGE,
    'language' => Yii::$app->language,
    'uploadPath' => Post::UPLOAD_FOLDER_INNER_IMAGE,
    'attributes' => [
        'attribute' => 'inner_image',
        'tempAttribute' => 'tempUploadInnerImage'
    ],
    'options' => [
//                'fileMineType' => FileUploader::MINE_TYPE_PDF,
//                'uploadMineType' => UploadHelper::uploadMineTypeForImages(),
        'multiple' => true,
        'maxFileSize' => 20,
        'resize' => [
            'resizeWidth' => $model::INNER_IMAGE_RESIZE_WIDTH,
            'resizeHeight' => $model::INNER_IMAGE_RESIZE_HEIGHT,
        ],
    ],
    'templateOptions' => [
        'uploadLimitWindow' => true,
        'bootstrapOuterWrapClasses' => $bootstrapWrapClasses,
//                'bootstrapInnerWrapClasses' => 'col-xs-6 col-sm-6 col-md-6 col-lg-12'
    ]
]) ?>

<div style="clear: both;"></div>

<?php foreach (Language::getAllLanguage() as $language => $languageName) {

    $html = '';
    $html .= $form->field($model->translate($language), "[$language]inner_image_alt")->textInput();
    $translationInnerImageAlt[] = [
        'label' => $languageName,
        'content' => $html
    ];
} ?>

<div class="<?= $bootstrapWrapClasses ?>">
    <?php echo Tabs::widget([
        'items' => $translationInnerImageAlt
    ]); ?>
</div>

<div style="clear: both;"></div>
