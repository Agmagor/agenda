$(document).ready(function() {
    $('#calendar').fullCalendar({
        viewDisplay: function (view) {
            var h;
            if (view.name == "month") {
                h = NaN;
            }
            else {
                h = 2500;  // high enough to avoid scrollbars
            }        
            $('#calendar').fullCalendar('option', 'contentHeight', h);
        },
        hiddenDays : [0],
        weekNumbers : true,
        dayClick: function(date, allDay, jsEvent, view) {
            console.log(date);
        },
        minTime: 8,
        maxTime: 19,
        allDaySlot: false,
        axisFormat: 'H:mm',
        columnFormat: 'dddd d/M',
        timeFormat: 'H:mm{ - H:mm}',
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        weekNumberTitle: 'Semaine ',
        eventSources: [
            {
                events : [
                    {
                        title: "Eau-No-Lo-Lo",
                        start: '2013-10-09 11:00:00',
                        end: '2013-10-09 14:20:00',
                    },
                ]
            },
            {
                events : [
                    {
                        title: "Bosser projai",
                        start: '2013-10-11 17:00:00',
                        end: '2013-10-11 18:20:00',
                        prof: 'test',
                    },
                ]
            },
            {
                events : [
                    {
                        title: "\"pseudo-cours\"",
                        start: '2013-10-11 14:20:00',
                        end: '2013-10-11 17:15:00',
                    },
                ]
            }
        ],
        header: {
                left: 'prev,next aujourd\'hui',
				/*center: 'agendaDay',*/
				right: 'month,agendaWeek,agendaDay'
		},
        buttonText: {
            month: "Mois",
            week: "Semaine",
            day: "Jour",
        },
        allDayDefault: false,
        eventRender: function(event, element) {
            element.click(function() { console.log(element); });
        },
    });
    if (window.matchMedia("(max-width: 767px)").matches)
        $("#calendar").fullCalendar('changeView', 'agendaDay');
    else
        $("#calendar").fullCalendar('changeView', 'agendaWeek');
    
	$('a.poplight').on('click', function() {
		var popID = $(this).data('rel');
		var popWidth = $(this).data('width');

		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="/public/img/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');
		
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;
		
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		$('body').append('<div id="fade"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
		
		return false;
	});
	
	$('body').on('click', 'a.close, #fade', function() {
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
        });		
		return false;
	});
});
