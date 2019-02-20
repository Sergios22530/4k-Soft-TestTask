<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\systemModels\SourceMessage */

$this->title = 'Додати запис';
$this->params['breadcrumbs'][] = ['label' => 'Переклади', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-solid <?= \app\modules\admin\helpers\ThemeHelper::boxClass() ?>">
    <div class="box-header">
        <h3 class="box-title"><?php Html::encode($this->title) ?></h3>
    </div>

    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
            //'categories' => $categories
        ]) ?>
    </div>
</div>