<?php

use yii\web\View;

/**
 * @var View $this
 */

$this->registerCss('
    .outer-wrap-preloader{
    background-color: white;
    position: fixed;
    width: 100%;
    height: 100%;
    left: 50%;
    top: 50%;
    z-index: 30;
    opacity: 0.8;
    transform: translate(-50%,-50%);
}
.preloader{
    background: url(/images/preloader.gif) center no-repeat;
    width: 50%;
    height: 50%;
    background-size: inherit;
    position: absolute;
    top: 25%;
    left: 25%;
    z-index: 99999999999999999999;
}
.hidePreloader{
    display: none;
}

.showPreloader{
    display: inline-block;
}
');
?>
<div class="outer-wrap-preloader hidePreloader">
    <div class="preloader"></div>
</div>