'use strict';

$(function () {
    if (new URLSearchParams(window.location.search).get('controller') !== 'ConfigController') {
        return;
    }

    $('.cal-tp').timepicker({
        stepMinute: 30,
        timeFormat: 'HH:mm',
    });
});
