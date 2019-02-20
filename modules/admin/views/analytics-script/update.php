<?php

use app\modules\admin\models\AnalyticsScript;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model AnalyticsScript */

$this->title = 'Оновити скрипт: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Скрипти систем аналітики', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="box box-solid <?= \app\modules\admin\helpers\ThemeHelper::boxClass() ?>">
    <div class="box-header">
        <h3 class="box-title"><?php Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
