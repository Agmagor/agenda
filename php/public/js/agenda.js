$(document).ready(function() {
    $('#calendar').fullCalendar({
        hiddenDays : [0],
        weekNumbers : true,
        dayClick: function(date, allDay, jsEvent, view) {
            console.log(date);
        },
        minTime: 8,
        maxTime: 19,
        allDaySlot: false,
    });
    $("#calendar").fullCalendar('changeView', 'agendaWeek');
});
