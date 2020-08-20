function listenForm2(context) {
    formPreloader('show');
    var form2 = $('#contact-form2');
    return new Promise((resolve, reject) => {
        request.post(form2.attr('action'), form2.serialize()).then(resolve, (error) => {
            reject(error);
        });
    }).then((response) => {
        response = JSON.parse(response);
        if (response.success) {
            form2[0].reset();
            form2.addClass('fade');
            $('.alert-success').addClass('show');
            setTimeout(function () {
                $('.alert-success').removeClass('show');
                $('#contact-form2').removeClass('fade');
                initDatePicker("#contactform-created_at", new Date());
            }, 15000);
            formPreloader('hide');
        }
        if (response.errors) {
            form2.yiiActiveForm("updateMessages", response.errors);
            formPreloader('hide');
        }
    });
}

