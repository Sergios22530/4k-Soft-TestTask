<?php

use app\models\AnalyticsScript;


/** @var $this \yii\web\View */
/* @var $content string */
?>
<body class="<?= (isset($this->context->bodyClass) ? $this->context->bodyClass : '') ?>">

<div class="main-grid-wrapper">
    <?php AnalyticsScript::beginBody(); ?>

    <?php $this->beginBody() ?>

    <?= $this->render('//layouts/templates/body-templates/header') ?>

    <div class="content-wg">
        <?= $content ?>
    </div>

    <?php if ($this->context->footerAlias): ?>
        <?= $this->render($this->context->footerAlias) ?>
    <?php endif; ?>

    <?php $this->endBody() ?>

    <?php AnalyticsScript::endBody(); ?>
</div>

</body>