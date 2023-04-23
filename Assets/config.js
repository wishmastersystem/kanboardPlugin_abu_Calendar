'use strict';

$(function () {
    if (new URLSearchParams(window.location.search).get('controller') !== 'ConfigController') {
        return;
    }

    $('.cal-tp').timepicker({
        stepMinute: 30,
        timeFormat: 'HH:mm',
    });

    $('#cal-config').submit(function () {
        let weekdays = '';

        $('.cal-wd').each(function () {
            weekdays += this.checked ? '1' : '0';
        });

        $('#form-calendar_weekdays').val(weekdays);
    });

    let i = 0;
    let weekdays = $('#form-calendar_weekdays').val();
    $('.cal-wd').each(function () {
        this.checked = weekdays[i++] == '1';
    });
});
