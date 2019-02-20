<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\Post */

$this->title = 'Оновити новину: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Новини', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="box box-solid <?= \app\modules\admin\helpers\ThemeHelper::boxClass() ?>">
    <div class="box-header">
        <h3 class="box-title"><?php Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>
</div>
