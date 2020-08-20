<?php

use app\models\Form1;
use app\models\Form2;

/**
 * @var Form1 | Form2 $model
 * @var array $attributes
 */

foreach ($attributes as $attributeName => $attributeValue): ?>
    <p><b><?= $model->getAttributeLabel($attributeName); ?>:</b> <?= $attributeValue; ?></p>
<?php endforeach; ?>