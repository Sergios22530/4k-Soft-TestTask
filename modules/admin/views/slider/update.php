<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\Slider */

$this->title = 'Оновити запис: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер головна', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="box box-solid <?= \app\modules\admin\helpers\ThemeHelper::boxClass() ?>">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
