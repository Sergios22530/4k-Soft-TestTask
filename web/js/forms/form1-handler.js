function listenForm1(context) {
    formPreloader('show');
    var form1 = $('#contact-form1');
    return new Promise((resolve, reject) => {
        request.post(form1.attr('action'), form1.serialize()).then(resolve, (error) => {
            reject(error);
        });
    }).then((response) => {
        response = JSON.parse(response);
        if (response.success) {
            form1[0].reset();
            form1.addClass('fade');
            $('.alert-success').addClass('show');
            setTimeout(function(){
                $('.alert-success').removeClass('show');
                $('#contact-form1').removeClass('fade');
            }, 15000);
            formPreloader('hide');
        }
        if (response.errors) {
            form1.yiiActiveForm("updateMessages", response.errors);
            formPreloader('hide');
        }
    });
}
