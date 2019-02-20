$(document).ready(function(){
    console.log(asyncGridConfig);

    function init(){
        if(asyncGridConfig.page === asyncGridConfig.const['indexPage']){
            indexPageJs();
        }

        if(asyncGridConfig.page === asyncGridConfig.const['formPage'] && asyncGridConfig.isNewRecord === false){
            formPageJs();
        }
    }

    function indexPageJs(){
        $(document).on("pjax:beforeSend", function(event, xhr, settings) {
            $(document).find('#grid-preloader').removeAttr('style');
        });

        $(document).on("pjax:success", function(event, xhr, settings) {
            $(document).find('#grid-preloader').attr('style','display:none');
        });
        $(document).on('click','.delete-btn span',function(e){
            var deleteBtnObj = $(this);
            bootbox.confirm('Ви впевнені, що хочете видалити цей елемент?', function(confirmStatus){
                if(confirmStatus){
                    $.ajax({
                        type: "POST",
                        url: deleteBtnObj.parent().attr("action"),
                        data: deleteBtnObj.serialize(),
                        success: function () {
                            $.pjax.reload({
                                container:"#"+asyncGridConfig.gridViewId,
                                push: false,
                                replace: false,
                                url: asyncGridConfig.indexUrl
                            });
                        }
                    });
                }
            });
        });
    }

    function formPageJs(){
        $("form").on("beforeSubmit", function () {
            $(document).find('.outer-wrap-preloader').removeAttr('style');
            var modalDialog = $(document).find('#modalDialog');
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function () {
                    modalDialog.modal("hide");
                    modalDialog.find(".modal-body").html('');
                    $('#modal').modal('toggle');
                    $.pjax.reload({
                        container:"#"+asyncGridConfig.gridViewId,
                        push: false,
                        replace: false,
                        url: asyncGridConfig.indexUrl
                    });
                }
            });
            return false;
        });
    }

    init();

});
