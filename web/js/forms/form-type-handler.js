var formTypeField = document.getElementById('formTypesId');

if (formTypeField) {
    formTypeField.addEventListener('change', function () {
        $.pjax.reload({
            container: "#forms-pjax-wrap",
            push: false,
            replace: false,
            url: formTypeConfig[this.value],
            timeout: 25000
        });
    }, false);
}