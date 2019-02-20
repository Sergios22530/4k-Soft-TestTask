$(document).ready(function () {
    $(document).on('click', '.modalButton', function (e) {
        e.preventDefault();
        showCustomPreloader();
        $('#modal').find('#modalContent')
            .load($(this).attr('value'), function () {
                hideCustomPreload();
                $('#modal').modal("show");
            });
    });
    $('#modal').on('hidden.bs.modal', function () {
        $('#modalContent').html('');
        return false;
    });

    function showCustomPreloader() {
        var customPreload = $(document).find('.outer-wrap-preloader');
        if (customPreload !== 'undefined') {
            customPreload.removeAttr('style');
        }
    }

    function hideCustomPreload() {
        var customPreload = $(document).find('.outer-wrap-preloader');
        if (customPreload !== 'undefined') {
            customPreload.attr('style', 'display:none');
        }
    }
});
