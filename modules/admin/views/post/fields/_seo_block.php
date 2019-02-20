<?php

use app\models\systemModels\Language;
use yii\bootstrap\Tabs;

/**
 * @var $model \app\modules\admin\models\Post
 * @var $form \yii\widgets\ActiveForm
 * @var $bootstrapWrapClasses string
 */
$metaItems = [];
?>

<?php foreach (Language::getAllLanguage() as $language => $languageName) {
    $html = '';

    $html .= $form->field($model->translate($language), "[$language]meta_title")->textarea();
    $html .= $form->field($model->translate($language), "[$language]meta_keywords")->textarea();
    $html .= $form->field($model->translate($language), "[$language]meta_description")->textarea();
    $metaItems[] = [
        'label' => $languageName,
        'content' => $html
    ];

} ?>

<div class="row" style="margin-top: 20px;">
    <div class="<?= $bootstrapWrapClasses ?>">
        <?php echo Tabs::widget([
            'items' => $metaItems
        ]); ?>
    </div>
</div>
