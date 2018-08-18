/*!
 * Calendar v1.0.0
 * Docs & License: https://github.com/dreboard
 * (c) 2018 Dev-PHP
 */
$(function() {

    $('#calendar').fullCalendar({
        themeSystem: 'bootstrap4',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        weekNumbers: true,
        eventLimit: true, // allow "more" link when too many events
        events: 'https://fullcalendar.io/demo-events.json'
    });

});