$(document).ready(function() {
    window.cal = $("#calendar");
    cal.fullCalendar({
        defaultView : 'agendaWeek',
        viewRender: function (view) {
            if (view.name == "month" | view.name == "agendaWeek") {
                cal.css("max-width","98%").css("min-width","700px");
                $("table.fc-agenda-slots td > div").height((56560 - 25*cal.width()) / 868);
            }
            var h;
            if (view.name == "month") {
                h = NaN;
            }
            else {
                h = 2500;  // high enough to avoid scrollbars
            }
            cal.fullCalendar('option', 'contentHeight', h);
        },
        hiddenDays : [0],
        weekNumbers : true,
        dayClick: function(date, allDay, jsEvent, view) {
            if (view.name == "month" || view.name == "agendaWeek") {
                cal.fullCalendar('changeView', 'agendaDay');
                cal.fullCalendar('gotoDate', date);
            }            
        },
        minTime: 8,
        maxTime: 19,
        allDaySlot: false,
        axisFormat: 'H:mm',
        columnFormat: 'dddd d/M',
        timeFormat: 'H:mm{ - H:mm}',
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        weekNumberTitle: 'S',
        //events: Agenda.init,
        header: {
                left: 'prev,next today ,month,agendaWeek,agendaDay',
                right: '',
		},
        buttonText: {
            month: "Mois",
            week: "Semaine",
            day: "Jour",
            today: "Aujourd'hui",
        },
        allDayDefault: false,
        eventRender: function(event, element) {
            element.find('.fc-event-title').attr("id", event.uid);
            element.find('.fc-event-title').after("<div class='fc-event-desc'>" + event.description.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + "<br />" + '$2') + "</div>");
            element.find('.fc-event-time').after("<div class='fc-event-loc'>" + event.location + "</div>");
        },
    });
    Agenda.init();
    /*if (window.matchMedia("(max-width: 767px)").matches)
        $("#calendar").fullCalendar('changeView', 'agendaDay');
    else
        $("#calendar").fullCalendar('changeView', 'agendaWeek');*/
    
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
    
    function closePoplight() {
        $('#fade , .popup_block').fadeOut(function() {
            $('#fade, a.close').remove();  
        });		
        return false; 
    }
	
	$('body').on('click', 'a.close, #fade', closePoplight);
    
    $("#idENIB").on("input", function(e) {
        if (!(Util.checkUsername($(this).val()))) {
            $("#choix_groupe input[type=submit]").attr("disabled", "disabled");
            $("#choix_groupe p").text("Cesse donc de faire l'enfant !");
        }
        else {
            $("#choix_groupe input[type=submit]").removeAttr("disabled");
            $("#choix_groupe p").text("");
        }
        
    });
    
    $("#choix_groupe").submit(function (e) { //Connexion (on rentre son identifiant)
        e.preventDefault();
        var id = $("#idENIB").val();
        if (Agenda.logIn(id)) {
            Agenda.init();
            closePoplight();
        }
    });
    
});

var Util = new (function Util() {  //Objet Util
    this.checkUsername = function (usr) {
        var reg = /^([a-z]{1})([0-9]{1})([a-z]{2,6})$/;
        if (reg.test(usr.toLowerCase()))
            return true;
        return false;
    };
    this.getCalendarURI = function (usr) {
        return "http://edt.enib.fr/ics.php?username=" + usr + "&pass='" + btoa(usr) + "'";
    };
    this.checkCalendar = function (usr) { // won't work
        $.ajax({
            context: this,
            type: 'HEAD',
            url: this.getCalendarURI(usr)
        }).done(function () {
            return true;
        }).fail(function () {
            return false;
        });
    };
})();

var Agenda = new (function Agenda() {  //Objet Agenda
    this.logIn = function (id) {
        this.logOut();
        if (Util.checkUsername(id)) {
            Browser.setData("id", id);
            return true;
        }
        return false;
    };
    this.logOut = function () {
        Browser.unsetData("id");
        Browser.unsetData("feed");
        cal.fullCalendar("removeEvents");
    };
    this.init = function () {
        var id = Browser.getData("id") || "p0baudry";
        var data = JSON.parse(Browser.getData("feed"));
        if (!data || this.feedTooOld(data)) {
            $.ajax({
                url: this.getCalendarFeed(id),
                context: this
            }).done(function (data) {
                if (data.error === 0) {
                    this.setFeed(JSON.stringify(data));
                    this.initCb();
                }
            });
        }
        else
            this.initCb();
    };
    this.initCb = function () {
        cal.fullCalendar("removeEvents");
        cal.fullCalendar("addEventSource", JSON.parse(this.getFeed()).data);
    };
    this.getCalendarFeed = function (usr) {
          return "/api/getcalendar/" + usr;
    };
    this.setFeed = function (data) {
        Browser.setData("feed", data);
    };
    this.getFeed = function () {
        return Browser.getData("feed");
    };
    this.feedTooOld = function (data) {
        return ((Math.round($.now()/1000) - data.timestamp) > 20*60);
    };
})();

var Browser = new (function Browser() {  //Objet Browser
    var sto = window.localStorage || null;
    this.setData = function (key, val) {
        if (sto)
            sto.setItem(key, val);
        else
            this.createCookie(key, val, 7);
        
    };
    this.getData = function (key) {
        if (sto)
            return sto.getItem(key);
        else
            return this.readCookie(key);
    };
    this.unsetData = function (key) {
        if (sto)
            sto.removeItem(key);
        else
            this.eraseCookie(key);
    };
    this.createCookie = function (name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            expires = "; expires="+date.toGMTString();
        }
        else
            expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
    };
    this.readCookie = function (name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) === 0)
                return c.substring(nameEQ.length,c.length);
        }
        return null;   
    };
    this.eraseCookie = function (name) {
        createCookie(name,"",-1);
    };
})();

var DBHelper = new (function DBHelper() {  //Objet Util
    this.getUids = function () {
        var res = [];
        var feed = JSON.parse(Browser.getData("feed")).data;
        for(i=0 ; i<feed.length ; i++)
            res.push(feed[i].uid);
        return res;
    };
    this.requestData = function (uids) {
        var req = uids || this.getUids();
        req = JSON.stringify(req);
        $.ajax({
            context: this,
            datatype: "JSON",
            url: "/api/getuids",
            data: {uids: req}
        }).success(function (data) {
            console.log(data);
        })
    };
})();