<?php


/** @var $this \yii\web\View */
/* @var $content string */
?>
<body class="<?= (isset($this->context->bodyClass) ? $this->context->bodyClass : '') ?>">

<div class="main-grid-wrapper">

    <?php $this->beginBody() ?>

    <?= $this->render('//layouts/templates/body-templates/header') ?>

    <div class="content-wg">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
</div>

</body>