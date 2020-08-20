function initDatePicker(fieldId, startValue) {
    $(fieldId).datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
        format: "dd-mm-yyyy",
        language: "ru"
    });
    if (startValue) {
        $(fieldId).datepicker("setDate", startValue);
    }
}

function formPreloader(process) {
    var preloader = document.querySelector('.outer-wrap-preloader');
    var submitBtn = document.querySelector('form button[type="submit"]');
    if (preloader && submitBtn) {
        if (process === 'show') {
            submitBtn.disabled = true;
        } else {
            submitBtn.disabled = false;
        }

        preloader.classList.remove('showPreloader', 'hidePreloader');
        preloader.classList.add(process + 'Preloader');
    }
}