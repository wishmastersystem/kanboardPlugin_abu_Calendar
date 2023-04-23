KB.component('calendar', function (containerElement, options) {
    let modeMapping = {
        month: 'month',
        week: 'agendaWeek',
        day: 'agendaDay',
    };

    function getTimeFormat() {
        let fmt24h = $('#form-calendar_timeformat').val() === 'H:i';
        return [
            fmt24h ? 'HH' : null, // slotLabelFormat
            fmt24h ? 'HH:mm' : null, // eventTimeFormat
        ];
    }

    function getWeekdays() {
        let arr = [];
        let weekdays = $('#form-calendar_weekdays').val();

        if ($('#form-calendar_firstday').val() == '1') {
            weekdays = weekdays[weekdays.length - 1] + weekdays.substr(0, 6);
        }

        for (let i = 0; i < weekdays.length; i++) {
            if (weekdays[i] == '1') {
                arr.push(Number(i));
            }
        }

        return arr;
    }

    function getBool(name) {
        return $(`#form-${name}`).val() == '1';
    }

    function formatTimeString(str) {
        return `${str.slice(0, 10)} ${str.slice(11, 16)}`;
    }

    function updateTask(json) {
        // console.log('save',json);
        $.ajax({
            cache: false,
            url: options.saveUrl,
            contentType: 'application/json',
            type: 'POST',
            processData: false,
            data: json,
        });
    }

    this.render = function () {
        let calendar = $(containerElement);
        let mode = $('#form-calendar_view').val();
        if (window.location.hash) { // Check if hash contains mode
            let hashMode = window.location.hash.substr(1);
            mode = modeMapping[hashMode] || mode;
        }

        let timeformat = getTimeFormat();

        calendar.fullCalendar({
            locale: $('html').attr('lang'),
            firstDay: Number($('#form-calendar_firstday').val()),
            slotLabelFormat: timeformat[0],
            eventTimeFormat: timeformat[1],

            editable: false, // Determines whether the events on the calendar can be modified. Default: false
            eventLimit: true, // Limits the number of events displayed on a day. The rest will show up in a popover.
            // A value of true will limit the number of events to the height of the day cell.
            defaultView: mode,

            allDaySlot: getBool('calendar_allday'),
            navLinks: getBool('calendar_navlinks'),
            nowIndicator: getBool('calendar_nowindic'),
            weekNumbers: getBool('calendar_weeknums'),
            weekNumberCalculation: 'ISO',

            maxTime: $('#form-calendar_maxtime').val(),
            minTime: $('#form-calendar_mintime').val(),

            businessHours: {
                // Days of week. an array of zero-based day of week integers (0=Sunday)
                dow: getWeekdays(),
                start: $('#form-calendar_maxtimebusi').val(),
                end: $('#form-calendar_mintimebusi').val(),
            },

            header: {
                left: 'prev,next today gotoDate',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
            },

            customButtons: {
                gotoDate: {
                    text: 'date...',
                    click: function () {
                        $('.cal-dp').val('');
                        $('.cal-dp').datepicker('show');
                    },
                },
            },

            eventDrop: function (event) {
                let droppedEvent = {
                    'task_id': event.id,
                    'date_due': event,
                    'date_started': event,
                };

                updateTask(JSON.stringify(droppedEvent, function (name, val) {
                    let droppedDate = null;

                    if ((name.length == 0) || (name == 'task_id')) {
                        return val;
                    } else {
                        switch (name) {
                        case 'date_started':
                            droppedDate = val.start ? val.start : null;
                            break;
                        case 'date_due':
                            droppedDate = val.end ? val.end : null;
                            break;
                        default:
                            console.error('Illegal name:', name);
                        }
                        // console.log(name, droppedDate ? formatTimeString(droppedDate.format()) : '#')
                        return droppedDate ? formatTimeString(droppedDate.format()) : '';
                    }
                }));
            },

            eventResize: function (event) {
                let droppedEvent = {
                    'task_id': event.id,
                    'date_due': event,
                };

                updateTask(JSON.stringify(droppedEvent, function (name, val) {
                    if ((name.length == 0) || (name == 'task_id')) {
                        return val;
                    } else {
                        return formatTimeString(event.end.format());
                    }
                }));
            },

            viewRender: function (view) {
                // Map view.name back and update location.hash
                for (let id in modeMapping) {
                    if (modeMapping[id] === view.name) { // Found
                        window.location.hash = id;
                        break;
                    }
                }
                let url = options.checkUrl;
                let params = {
                    'start': view.start.format(),
                    'end': view.end.format(),
                };

                for (let key in params) {
                    url += '&' + key + '=' + params[key];
                }

                $.getJSON(url, function (events) {
                    // console.log(events);
                    calendar.fullCalendar('removeEvents');
                    calendar.fullCalendar('addEventSource', events);
                });
            },
        });

        const toolBar = document.querySelector('div.fc-header-toolbar');
        const leftToolbar = toolBar.querySelectorAll('div.fc-left');
        $(leftToolbar).append('<input type="text" class="cal-dp" />');

        $('.cal-dp').datepicker({
            // changeYear: true,
            showWeek: getBool('calendar_weeknums'),
            firstDay: Number($('#form-calendar_firstday').val()),
            onClose: function (dateText) {
                if (dateText.length) {
                    calendar.fullCalendar('gotoDate', dateText);
                }
            },
        });
    };
});

KB.on('dom.ready', function () {
    function goToLink(selector) {
        if (!KB.modal.isOpen()) {
            let element = KB.find(selector);

            if (element !== null) {
                window.location = element.attr('href');
            }
        }
    }

    KB.onKey('v+c', function () {
        goToLink('a.view-calendar');
    });
});
