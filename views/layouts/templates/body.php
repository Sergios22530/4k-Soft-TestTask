<?php


/** @var $this View */
/* @var $content string */

use yii\web\View;

?>
<body class="<?= (isset($this->context->bodyClass) ? $this->context->bodyClass : '') ?>">

<?php $this->beginBody() ?>

<?= $this->render('//layouts/templates/body-templates/header') ?>

<div class="container">
    <?= $content ?>
</div>

<?php $this->endBody() ?>


</body>