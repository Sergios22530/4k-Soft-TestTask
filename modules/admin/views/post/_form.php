<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use kartik\select2\Select2Asset;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\Post */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories array (get records from tree view for current module) */

Select2Asset::register($this);

$bootstrapWrapClasses = $model->isNewRecord ? 'col-xs-12 col-sm-12 col-md-12 col-lg-12' : 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
$mainItems = [];
$metaItems = [];
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
        'enableClientValidation' => true
    ]); ?>

    <?= $form->errorSummary($model->getErrors()) ?>


    <?php $items[] = [
        'label' => '<i class="fa fa-suitcase"></i> Контент',
        'content' => $this->render('@adminModuleViews/post/fields/_content_block', [
            'model' => $model,
            'form' => $form,
            'bootstrapWrapClasses' => $bootstrapWrapClasses
        ])
    ]; ?>

    <?php $items[] = [
        'label' => '<i class="fa fa-scribd"></i> SEO',
        'content' => $this->render('@adminModuleViews/post/fields/_seo_block', [
            'model' => $model,
            'form' => $form,
            'bootstrapWrapClasses' => $bootstrapWrapClasses
        ])
    ]; ?>

    <?php $items[] = [
        'label' => '<i class="fa fa-picture-o"></i> Зображеня',
        'content' => $this->render('@adminModuleViews/post/fields/_images_block', [
            'model' => $model,
            'form' => $form,
            'bootstrapWrapClasses' => $bootstrapWrapClasses
        ])
    ]; ?>

    <?php $items[] = [
        'label' => '<i class="fa fa-cogs"></i> Налаштування',
        'content' => $this->render('@adminModuleViews/post/fields/_setting-block', [
            'model' => $model,
            'form' => $form,
            'bootstrapWrapClasses' => $bootstrapWrapClasses
        ])
    ]; ?>

    <?php echo Tabs::widget([
        'items' => $items,
        'encodeLabels' => false
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?  'Додати' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php Modal::begin([
    'header' => '<h2></h2>',
    'size' => Modal::SIZE_LARGE,
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
    'options' => [
        'id' => 'modal-dialog'
    ]
]); ?>
<?php Modal::end(); ?>

