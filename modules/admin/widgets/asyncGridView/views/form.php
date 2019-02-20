<?php
/**
 * @var $pjaxContainerId string
 * @var $indexUrl string
 * @var $model \yii\db\ActiveRecord
 * @var $this \yii\web\View
 */
?>

<div class="outer-wrap-preloader" style="display: none;">
    <div class="preloader"></div>
</div>

<?php
if (!$model->isNewRecord) {
    $this->registerJs('            
            $("form").on("beforeSubmit", function () {
                $(document).find(\'.outer-wrap-preloader\').removeAttr(\'style\');
                var modalDialog = $(document).find(\'#modalDialog\');
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success: function (data) {                  
                        if(data.errors){
                            $(document).find(\'.outer-wrap-preloader\').attr(\'style\',\'display:none\');
                            $("form").yiiActiveForm("updateMessages", data.errors);
                        }else{                           
                           modalDialog.modal("hide");
                           modalDialog.find(".modal-body").html(\'\');
                           $(\'#modal\').modal(\'toggle\');
                           $.pjax.reload({container:"#' . $pjaxContainerId . '", push: false, replace: false, url: "' . $indexUrl . '", timeout: 25000});
                       }
                    }
                });
                return false;
            });
    ', $this::POS_END);
}
?>
