<?php
use yii\bootstrap\Modal;

/**
 * @var $pjaxContainerId string
 * @var $indexUrl string
 */

Modal::begin([
    'header' => "<h4>Оновити запис</h4>",
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => false]
]);
echo "<div id='modalContent' class='box box-solid " . \app\modules\admin\helpers\ThemeHelper::boxClass() . "'></div>";
Modal::end();
?>

<div id="grid-preloader" class="outer-wrap-preloader" style="display: none;">
    <div class="preloader"></div>
</div>

<?php
$this->registerJs('
        $(document).on("pjax:beforeSend", function(event, xhr, settings) {
            $(document).find(\'#grid-preloader\').removeAttr(\'style\');
        });

        $(document).on("pjax:success", function(event, xhr, settings) {
            $(document).find(\'#grid-preloader\').attr(\'style\',\'display:none\');
        });

        $(document).on(\'click\',\'.delete-btn span\',function(e){
            var deleteBtnObj = $(this);
            bootbox.confirm(\'Ви впевнені, що хочете видалити цей елемент?\', function(confirmStatus){
                if(confirmStatus){
                   $.ajax({
                        type: "POST",
                        url: deleteBtnObj.parent().attr("action"),
                        data: deleteBtnObj.serialize(),
                        success: function () {
                           $.pjax.reload({container:"#' . $pjaxContainerId . '", push: false, replace: false, url: "' . $indexUrl . '", timeout: 25000});
                        }
                    });
                }
            });
        });
    ', $this::POS_END);
?>
