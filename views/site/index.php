<?php

use yii\helpers\VarDumper;
use yii\web\View;
use app\models\Tree;

/* @var $this View */
/* @var $tree  Tree */

$this->title = 'Test Task';

VarDumper::dump($tree, 10, true);
?>