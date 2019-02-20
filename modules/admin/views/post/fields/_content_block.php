<?php

use app\models\systemModels\Language;
use yii\bootstrap\Tabs;
use app\modules\admin\models\Post;

/**
 * @var $model Post
 * @var $form \yii\widgets\ActiveForm
 * @var $bootstrapWrapClasses string
 */

$mainItems = [];
?>

<?php foreach (Language::getAllLanguage() as $language => $languageName) {

    $html = '';
    $html .= $form->field($model->translate($language), "[$language]title")->textInput();

    $html .= $form->field($model->translate($language), "[$language]content")->widget(\vova07\imperavi\Widget::class, [
        'settings' => [
            'lang' => 'uk',
            'minHeight' => 200
        ],
        'plugins' => [
            'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
        ],
    ]);
    $mainItems[] = [
        'label' => $languageName,
        'content' => $html
    ];
} ?>

<div class="row" style="margin-top: 20px;">
    <div class="<?= $bootstrapWrapClasses ?>">
        <?php echo Tabs::widget([
            'items' => $mainItems
        ]); ?>
    </div>
</div>
