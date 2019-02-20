<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $this \yii\web\View
 * @var $items array
 * @var $defaultLanguage string
 * @var $currentName string
 */
?>
<div class="language-panel">
    <div class="language-current">
        <?php echo $currentName; ?>
    </div>
    <div class="language-dropdown">
        <?php foreach ($items as $item): ?>
            <?php $url = Url::to($item['url']); ?>
            <?php echo Html::a($item['label'],
                null,
                array_merge($item['options'],['href' => $url,'data-language' => $item['url']['language'],'class' => 'anchor-lang'])); ?>
        <?php endforeach; ?>
    </div>
</div>